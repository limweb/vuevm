<?php
require_once __DIR__ . '/vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
require_once __DIR__ . '/configs/config.php';
$dbname = "dbname";


class Genmodel
{
    private $dbname = "dbname";
    private $tables = [];
    public function __construct()
    {
    }

    public function gen()
    {
        $this->getTables();
        $this->getColumnsPrimaryAndForeignKeysPerTable();
        $eloquentRules = $this->getEloquentRules();
        
        //4. Generate our Eloquent Models
        echo ("Generating Eloquent models\n");
        $this->generateEloquentModels($destinationFolder, $eloquentRules);
        return $this;
    }

    private function getTables()
    {
        $qrtables = Capsule::select('SHOW TABLES');
        foreach ($qrtables as $table) {
            $this->tables[] = $table->Tables_in_dbname;
        }
    }

    private function getColumnsPrimaryAndForeignKeysPerTable()
    {
        $prep = [];
        foreach ($this->tables as $table) {
            //get foreign keys
            $foreignKeys = Capsule::select("SELECT concat(table_name,'.',column_name) AS 'fk',concat(referenced_table_name,'.',referenced_column_name) AS 'references' 
                            FROM information_schema.key_column_usage WHERE referenced_table_name IS NOT NULL 
                            AND table_schema='dbname' AND table_name='$table'
                        ");
            $sql = "SELECT  TABLE_NAME,COLUMN_NAME,CONSTRAINT_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME
                    FROM   INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE   REFERENCED_TABLE_SCHEMA = 'dbname' 	AND  REFERENCED_TABLE_NAME = '$table'";
            $fkss = Capsule::select($sql);
            dump($fkss);                    
            //get primary keys
            $primaryKeys = Capsule::select('SHOW KEYS FROM ' . $table . ' WHERE Key_name = "PRIMARY"');
            // get columns lists
            $__columns = Capsule::select("DESCRIBE $table");

            $columns = [];
            foreach ($__columns as $col) {
                $columns[] = $col;
            }
            $prep[$table] = [
                'foreign' => $foreignKeys,
                'primary' => $primaryKeys,
                'columns' => $columns,
            ];
        }
        $this->prep = $prep;
        return $prep;
    }

    private function getEloquentRules()
    {
        $rules = [];
        //first create empty ruleset for each table
        foreach ($this->prep as $table => $properties) {
            $rules[$table] = [
                'hasMany' => [],
                'hasOne' => [],
                'belongsTo' => [],
                'belongsToMany' => [],
                'fillable' => [],
            ];
        }
        foreach ($this->prep as $table => $properties) {
            $foreign = $properties['foreign'];
            $primary = $properties['primary'];
            $columns = $properties['columns'];

            $this->setFillableProperties($table, $rules, $columns);
            $isManyToMany = $this->detectManyToMany($this->prep, $table);
            if ($isManyToMany === true) {
                $this->addManyToManyRules($tables, $table, $prep, $rules);
            }
        //     //the below used to be in an ELSE clause but we should be as verbose as possible
        //     //when we detect a many-to-many table, we still want to set relations on it
        //     //else
            {
                foreach ($foreign as $fk) {
                    $isOneToOne = $this->detectOneToOne($fk, $primary);
                    if ($isOneToOne) {
                        $this->addOneToOneRules($tables, $table, $rules, $fk);
                    } else {
                        $this->addOneToManyRules($tables, $table, $rules, $fk);
                    }
                }
            }
        }
        exit();
        $this->eloquentRules = $rules;
        return $rules;
    }

    private function generateEloquentModels()
    {

    }


    private function setFillableProperties($table, &$rules, $columns)
    {
        $fillable = [];
        $nofills = ['deleted_at', 'created_by', 'updated_by', 'created_at', 'updated_at', ];
        foreach ($columns as $column_name) {
            if (!in_array($column_name->Field, $nofills)) {
                $fillable[] = "'$column_name->Field'";
            }
        }
        $rules[$table]['fillable'] = $fillable;
    }

 //does this table have exactly two foreign keys that are also NOT primary,
    //and no tables in the database refer to this table?
    private function detectManyToMany($prep, $table)
    {
        $properties = $prep[$table];
        $foreignKeys = $properties['foreign'];
        $primaryKeys = $properties['primary'];
        //ensure we only have two foreign keys
        if (count($foreignKeys) === 2) {
            //ensure our foreign keys are not also defined as primary keys
            $primaryKeyCountThatAreAlsoForeignKeys = 0;
            foreach ($foreignKeys as $foreign) {
                foreach ($primaryKeys as $primary) {
                    if ($primary === $foreign['name']) {
                        ++$primaryKeyCountThatAreAlsoForeignKeys;
                    }
                }
            }
            if ($primaryKeyCountThatAreAlsoForeignKeys === 1) {
                //one of the keys foreign keys was also a primary key
                //this is not a many to many. (many to many is only possible when both or none of the foreign keys are also primary)
                return false;
            }
            //ensure no other tables refer to this one
            foreach ($prep as $compareTable => $properties) {
                if ($table !== $compareTable) {
                    foreach ($properties['foreign'] as $prop) {
                        if ($prop['on'] === $table) {
                            return false;
                        }
                    }
                }
            }
            //this is a many to many table!
            return true;
        }
        return false;
    }

    private function detectOneToOne($fk, $primary)
    {
        // if (count($primary) === 1) {
        //     foreach ($primary as $prim) {
        //         if ($prim === $fk['field']) {
        //             return true;
        //         }
        //     }
        // }
        return false;
    }

    private function addManyToManyRules($tables, $table, $prep, &$rules)
    {
        //$FK1 belongsToMany $FK2
        //$FK2 belongsToMany $FK1
        $foreign = $prep[$table]['foreign'];
        $fk1 = $foreign[0];
        $fk1Table = $fk1['on'];
        $fk1Field = $fk1['field'];
        //$fk1References = $fk1['references'];
        $fk2 = $foreign[1];
        $fk2Table = $fk2['on'];
        $fk2Field = $fk2['field'];
        //$fk2References = $fk2['references'];
        //User belongstomany groups user_group, user_id, group_id
        if (in_array($fk1Table, $tables)) {
            $rules[$fk1Table]['belongsToMany'][] = [$fk2Table, $table, $fk1Field, $fk2Field];
        }
        if (in_array($fk2Table, $tables)) {
            $rules[$fk2Table]['belongsToMany'][] = [$fk1Table, $table, $fk2Field, $fk1Field];
        }
    }


    private function addOneToOneRules($tables, $table, &$rules, $fk)
    {
        //$table belongsTo $FK
        //$FK hasOne $table
        $fkTable = $fk['on'];
        $field = $fk['field'];
        $references = $fk['references'];
        if (in_array($fkTable, $tables)) {
            $rules[$fkTable]['hasOne'][] = [$table, $field, $references];
        }
        if (in_array($table, $tables)) {
            $rules[$table]['belongsTo'][] = [$fkTable, $field, $references];
        }
    }

    private function addOneToManyRules($tables, $table, &$rules, $fk)
    {
        //$table belongs to $FK
        //FK hasMany $table
        $fkTable = $fk['on'];
        $field = $fk['field'];
        $references = $fk['references'];
        if (in_array($fkTable, $tables)) {
            $rules[$fkTable]['hasMany'][] = [$table, $field, $references];
        }
        if (in_array($table, $tables)) {
            $rules[$table]['belongsTo'][] = [$fkTable, $field, $references];
        }
    }
}

$models = new Genmodel();
dump($models->gen());
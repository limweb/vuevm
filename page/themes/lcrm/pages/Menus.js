import crudmix from "../mixins/CrudMixin.js";
import Tableitemedit from "../components/Tableitemedit.js";
import Fieldinsert from "../components/FieldInsert.js";
import Fieldedit from "../components/Fieldedit.js";
import Viewitem from "../components/ViewItem.js";
import Printa4table from "../components/Printa4table.js";
export default {
    template: `
<div>
    <h1  >
        {{title}}
    </h1>
    <div v-show="viewstate.v_lists" ref="v_lists" >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button v-if="info.v_insert"  v-show="!viewstate.v_insert" @click="insert" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Insert</button>
                <button v-if="info.v_import"  class="btn btn-primary" @click="changeview('v_import')"><i class="fa fa-download"></i> Import</button>
                <button v-if="info.v_export"  class="btn btn-primary" @click="changeview('v_export')"><i class="fa fa-upload"></i> Export</button>
                <button v-if="info.v_print"  class="btn btn-primary" @click="printv"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">
                        archive</i> {{title}}
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display:block;">
                <div id="data_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="data_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="data_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="dataTables_length" id="data_length">
                                                        <label>
                                                                Show
                                                                <select v-model="perpage" @change="changeperpage" name="data_length" aria-controls="data" class="form-control input-sm">
                                                                    <option value="10">10</option>
                                                                    <option value="25">25</option>
                                                                    <option value="50">50</option>
                                                                    <option value="100">100</option>
                                                                </select>
                                                                entries
                                                            </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button @click="updatedtablerows" class="btn btn-primary"><i class="fa fa-save"></i> Save Page</button>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div id="data_filter" class="dataTables_filter">
                                                        <label>
                                                                Search:
                                                                <div class="input-group">
                                                                    <input v-model="filtertxt" type="search" class="form-control"/>
                                                                    <span v-show="ajax" class="input-group-addon" style="cursor:pointer" @click="search">
                                                                        <i class="fa fa-search"></i>
                                                                    </span>
                                                                </div>
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12" style="overflow-x:auto;">
                                                    <table id="data" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="data_info" style="width: 737px;">
                                                        <thead>
                                                            <tr role="row">
                                                                <th width="60px;">
                                                                    <input type="checkbox" v-model="checked_all" @click="checkeall"> &nbsp;# </th>
                                                                <th v-for="(col,idx) in columns" v-show="col.visible" :tabindex="idx" :key="idx" :class="{ active: sortKey == col.key }" :style="{ cursor: col.orderable ? 'pointer' : '' }" @click="sortBy(col)" >
                                                                    <div style="display:inline-flex;align-items:center;flex-wrap: nowrap;">
                                                                        <span style="white-space: nowrap;">{{col.label}}</span>
                                                                        <i v-show="col.orderable && sortKey != col.key " class="fa fa-sort pull-right" style="color: #ddd;" aria-hidden="true"></i>
                                                                        <i v-show="col.orderable && sortKey==col.key && sortOrders[col.key]==1" style="display:none" class="fa fa-sort-asc pull-right" aria-hidden="true"></i>
                                                                        <i v-show="col.orderable && sortKey==col.key && sortOrders[col.key]==-1" style="display:none" class="fa fa-sort-desc pull-right" aria-hidden="true"></i>
                                                                    </div>
                                                                </th>
                                                                <th>Option</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(row,index) in lists" role="row" class="">
                                                                <td style="display:flex" ><input type="checkbox" v-model="row.checked">&nbsp; {{index+1}}</td>
                                                                <td v-for="(col,idx) in columns" :key="idx" v-if="col.visible">
                                                                    <tableitemedit :select="{inputtype:inputtypes}"  :col="col" :item="row" />
                                                                </td>
                                                                <td style="cursor: pointer;display:inline-flex;align-items:center;flex-wrap: nowrap;">
                                                                    <i v-if="info.v_view" @click="view(row)" class="fa fa-fw fa-eye text-primary"></i> 
                                                                    <i v-if="info.v_update" @click="edit(row)" alt="edit" aria-hidden="true" class="fa fa-pencil"></i>
                                                                    <i v-if="info.v_update" @click="updatedtablerow(row)" alt="save" aria-hidden="true" class="fa fa-save"></i>
                                                                    <i v-if="info.v_import" @click="changeview('v_import')" alt="reset password" aria-hidden="true" class="fa fa-key"></i>  
                                                                    <i v-if="info.v_export" @click="changeview('v_export')" alt="reset password" aria-hidden="true" class="fa fa-key"></i>  
                                                                    <i v-if="info.v_delete" @click="deleterow(row)" alt="delete" aria-hidden="true" class="fa fa-times-circle " style="color: red;"></i>
                                                                    <i v-if="info.v_print" @click="printv(row)" alt="print" aria-hidden="true" class="fa fa-print"></i> 
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <thead>
                                                            <tr role="row">
                                                                <th width="60px;">
                                                                    <input type="checkbox" v-model="checked_all" @click="checkeall"> &nbsp;# </th>
                                                                <th v-for="(col,idx) in columns" v-show="col.visible" :tabindex="idx" :key="idx" :class="{ active: sortKey == col.key }" :style="{ cursor: col.orderable ? 'pointer' : '' }" @click="sortBy(col)" >
                                                                    <div style="display:inline-flex;align-items:center;flex-wrap: nowrap;">
                                                                        <span style="white-space: nowrap;">{{col.label}}</span>
                                                                        <i v-show="col.orderable && sortKey != col.key " class="fa fa-sort pull-right" style="color: #ddd;" aria-hidden="true"></i>
                                                                        <i v-show="col.orderable && sortKey==col.key && sortOrders[col.key]==1" style="display:none" class="fa fa-sort-asc pull-right" aria-hidden="true"></i>
                                                                        <i v-show="col.orderable && sortKey==col.key && sortOrders[col.key]==-1" style="display:none" class="fa fa-sort-desc pull-right" aria-hidden="true"></i>
                                                                    </div>
                                                                </th>
                                                                <th>Option</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <div id="data_processing" class="dataTables_processing panel panel-default" style="display: none;">
                                                        Processing...
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="dataTables_info" id="data_info" role="status" aria-live="polite">
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="dataTables_paginate paging_simple_numbers" id="data_paginate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="data_info" role="status" aria-live="polite">
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="data_paginate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="data_info" role="status" aria-live="polite">
                                Showing {{itempagestart}} to {{itempageend}} of {{total}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <paginate ref="paginate" :page-count="totalpage" :prev-text="'Prev'" :next-text="'Next'" :click-handler="changepage" :container-class="'pagination'">
                            </paginate>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vprint" v-show="viewstate.v_print" ref="v_print" >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </button>
            </div>
        </div>
        <div class="panel panel-default" style="position: relative;" >
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} Print
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="form-group">
                    <div class="controls">
                        <a @click="changeview('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        <button @click="print" type="button" class="btn btn-success"><i class="fa fa-print"></i> PRINT</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="preview" >
            <printa4table />
        </div>
    </div>
    
    <div v-show="viewstate.v_update" ref="v_update"  >
        <div class="page-header clearfix">
            <div class="pull-right">p
                <button @click="updatecancel" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back
                    </button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} Update
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <form method="POST" action="#" accept-charset="UTF-8" id="company" enctype="multipart/form-data" novalidate="novalidate" class="bv-form">
                    <div v-for="(item,idx) in updateobj()" :key="idx" class="row">
                        <fieldedit :col="item" :item="row_update" />
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <a @click="updatecancel('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                            <button @click="updated()" type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div v-show="viewstate.v_insert" ref="v_insert"  >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="insertcancel" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} Insert
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <form method="POST" action="#" accept-charset="UTF-8" id="company" enctype="multipart/form-data" novalidate="novalidate" class="bv-form">
                    <div v-for="(item,idx) in insertobj()" :key="idx" class="row">
                        <fieldinsert :col="item" :item="row_insert" />
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <a @click="insertcancel('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                            <button @click="inserted('v_lists')" type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <div v-show="viewstate.v_delete" ref="v_delete"  >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} delete
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div v-for="(item,idx) in viewobj" :key="idx" class="form-group">
                    <label for="title" class="control-label">{{item.label}}</label>
                    <viewitem :item="item"  />
                </div>
                <div class="form-group">
                    <div class="controls">
                        <a @click="changeview('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        <button @click="deleteyn(viewobj)" type="button" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-show="viewstate.v_import" ref="import"  >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> Import {{title}}
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="right_cont">
                    <div>
                        <form class="form-horizontal">
                            <div data-provides="fileinput" class="fileinput fileinput-new">
                                <span class="btn btn-default btn-file">
                    <span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="..."></span> <span class="fileinput-filename"></span>
                                <a href="#" data-dismiss="fileinput" class="close fileinput-exists import-cat">×</a></div> <br>
                            <button class="btn btn-primary">Upload and Review</button> <a href="#" class="btn btn-primary">Download Template</a></form>
                        <!---->
                        <div class="table-responsive">
                            <!---->
                        </div>
                        <div class="row">
                            <div class="col-md-12"><a href="" class="btn btn-primary pull-right disabled" style="display: none;">Create Selected</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-show="viewstate.v_export" ref="export"  >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} export
                </h4>
                <span class="pull-right">
                     <i class="fa fa-fw fa-chevron-up clickable">
                     </i>
                     </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="form-group">
                    <div class="controls">
                        <a @click="changeview('v_lists')" href="#" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                        <download-excel class="btn btn-default" type="slx" :data="exportdatas()" :name="exportxlsx()" v-bind:fields="json_fields()">
                            Download Excel
                        </download-excel>
                        <download-excel type="csv" class="btn btn-default" :data="exportdatas()" v-bind:name="exportcsv()" v-bind:fields="json_fields()">
                            Download CSV
                        </download-excel>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-show="viewstate.v_view" ref="view"  >
        <div class="page-header clearfix">
            <div class="pull-right">
                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="material-icons">archive</i> {{title}} view
                </h4>
                <span class="pull-right">
                                 <i class="fa fa-fw fa-chevron-up clickable">
                                 </i>
                                 </span>
            </div>
            <div class="panel-body" style="display: block;">
                <div class="right_cont">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header clearfix"></div>
                            <div class="details">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div v-for="(item,idx) in viewobj" :key="idx" class="form-group">
                                            <label for="title" class="control-label">{{item.label}}</label>
                                            <div class="controls">
                                                <span v-if="(item.label).toLowerCase() == 'status'">{{fcstatus(item.value)}}</span>
                                                <span v-else>{{item.value}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <button @click="changeview('v_lists')" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
`,
    mixins: [crudmix],
    data() {
        return {
            filtertable: -1
        };
    },
    created() {
        console.log("crud template created");
    },
    components: {
        tableitemedit: Tableitemedit,
        fieldinsert: Fieldinsert,
        fieldedit: Fieldedit,
        viewitem: Viewitem,
        printa4table: Printa4table
    },
    methods: {
        updatedtablerow(row) {
            let data = JSON.stringify(row);
            let url = "/api/v3" + this.$route.path + "/update/" + row.id;
            console.log("url==", url, row);
            this.$http
                .put(url, data, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(rs => {
                    console.log("result--->", rs);
                    this.changeview("v_lists");
                    alert("update successed!");
                })
                .catch(err => {
                    console.log(err);
                    this.changeview("v_lists");
                });
        },
        updatedtablerows() {
            let data = JSON.stringify(this.lists);
            let url = "/api/v3" + this.$route.path + "/updates/";
            console.log("url==", url);
            this.$http
                .post(url, data, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(rs => {
                    console.log("result--->", rs);
                    this.changeview("v_lists");
                    alert("Update successed!");
                })
                .catch(err => {
                    console.log(err);
                    this.changeview("v_lists");
                });
        }
    },
    computed: {
        filteredData() {
            let self = this;
            let data = self.datas;
            let sortKey = self.sortKey;
            let filtertxt = self.filtertxt && self.filtertxt.toLowerCase();
            let filtertable = self.filtertable;
            let order = self.sortOrders[sortKey] || 1;
            if (filtertable != -1) {
                data = data.filter(r => r.table_id == filtertable);
            }
            if (filtertxt) {
                data = data.filter(row => {
                    return this.columns.some(c => {
                        return (
                            String(row[c.key])
                            .toLowerCase()
                            .indexOf(filtertxt) > -1
                        );
                    });
                });
            }
            if (sortKey) {
                data = data.slice().sort(function(a, b) {
                    a = a[sortKey];
                    b = b[sortKey];
                    return (a === b ? 0 : +a > +b ? 1 : -1) * order;
                });
            }
            if (typeof data == "undefined") {
                return [];
            } else {
                return data;
            }
        }
    }
};
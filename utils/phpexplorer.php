<?php

   //************************************************************************
   //* Class fileInfo: stores a file's information
   //************************************************************************

   class FileInfo {
      var $name, $path, $fullname, $isDir, $lastmod, $owner,
      $perms, $size, $isLink, $linkTo, $extension;

      public function permissions($mode) {
         $perms  = ($mode & 00400) ? "r" : "-";
         $perms .= ($mode & 00200) ? "w" : "-";
         $perms .= ($mode & 00100) ? "x" : "-";
         $perms .= ($mode & 00040) ? "r" : "-";
         $perms .= ($mode & 00020) ? "w" : "-";
         $perms .= ($mode & 00010) ? "x" : "-";
         $perms .= ($mode & 00004) ? "r" : "-";
         $perms .= ($mode & 00002) ? "w" : "-";
         $perms .= ($mode & 00001) ? "x" : "-";
         return $perms;
      }

      public function getInfo($file) {                 // Stores a file's information in the class variables
         $this->name = basename($file);
         $this->path = dirname($file);
         $this->fullname = $file;
         $this->isDir = is_dir($file);
         $this->lastmod = date("m/d/y, H:i", filemtime($file));
         $this->owner = fileowner($file);
         $this->perms = $this->permissions(fileperms($file));
         $this->size = filesize($file);
         $this->isLink = is_link($file);
         if ($this->isLink) $this->linkTo = readlink($file);
         $buffer = explode(".", $this->fullname);
         $this->extension = $buffer[sizeof($buffer)-1];      
      }
   };

// require_once __DIR__.'/vendor/autoload.php';
setlocale(LC_CTYPE, 'th_TH.utf8');
error_reporting(0);
header("content-type: text/html; charset=UTF-8");  
   //************************************************************************//
   //* PHP Explorer 0.7                     Codename: "mustard"             *//
   //* Author: Marcelo L. Mottalli <mottalli@sinectis.com.ar>               *//
   //* Homepage: http://phpexplorer.sourceforge.net/                        *//
   //************************************************************************//

////////////////////////////////   USEFUL VARIABLES   /////////////////////////////


   $associations = array(   	
      "gif" =>  array(   "function" => "viewGIF",   "icon" => "icons/gif.gif"     ),
      "jpg" =>  array(   "function" => "viewJPEG",  "icon" => "icons/jpg.png"    ),
      "jpeg" => array(   "function" => "viewJPEG",  "icon" => "icons/jpg.png"    ),
      "png" =>  array(   "function" => "viewPng",   "icon" => "icons/jpg.png"   ),
      "wav" =>  array(   "function" => "",          "icon" => "icons/sound.gif"   ),
      "mp3" =>  array(   "function" => "",          "icon" => "icons/sound.gif"   ),
      "php" =>  array(   "function" => "viewPHP",   "icon" => ""                  )
   );

   if (file_exists("phpexplorer_extras.inc")) 
      include("phpexplorer_extras.inc");        // PHP Explorer extra package

////////////////////////////////     CONSTANTS     ////////////////////////////////

   $OS_UNIX 					= false;			// UNIX or Windows?

   $PHP_EXPLORER_VERSION   = "v0.7";
   $BACKGROUND_COLOR       = "#ffffff";
   $FONT_COLOR             = "#000000";
   $TABLE_BORDER_COLOR     = "#000000";
   $TABLE_BACKGROUND_COLOR = "#ffffff";
   $TABLE2_BACKGROUND_COLOR= "#eeeeee";
   $TABLE_FONT_COLOR       = "#000000";
   $COLOR_PRIVATE          = "#ffbb99";
   $COLOR_PUBLIC           = "#cceeff";
   $LINK_COLOR             = "#0000ff";
   $LINK_HOVER_COLOR       = "#ff0000";
   $DEFAULT_FONT           = "Verdana";


   // $default_directory = dirname($PATH_TRANSLATED);   
   $default_directory = SRVPATH;
   $dir = filter_input(INPUT_GET,'dir');
   $dir = ($dir?:$default_directory);
   $dir = ($dir =='/'? SRVPATH: $dir);
   if ($OS_UNIX) {
   	$USERNAME = `whoami`;
   }

   $fileInfo = new FileInfo;        // This will hold a file's information all over the script   
   $show_icons= true;
   $PHP_SELF = $_SERVER['PHP_SELF'];
 
///////////////////////////     BEGIN OF THE SCRIPT     ///////////////////////////   
   $action = filter_input(INPUT_GET,'action');
   switch ($action) {
      case "phpinfo":
         phpinfo();
         exit;
      case "view":
      	viewFile($dir);
      	break;
      case "edit":
         printHTMLHeader();
      	showFile($dir, 1);
      	break;
      case "download":
         // viewFileHeader($dir, "Content-type: application/octet-stream");
         viewFileHeader($dir,'Content-Disposition: attachment; filename="'.basename($dir).'"');
         break;
      case "delete":
         printHTMLHeader();
         $confirm = filter_input(INPUT_GET,'confirm');
         deleteFile($dir);
         $dir = dirname($dir);
         $show_directory = true;
         $show_footer = true;
         break;
      case "makedir":
         printHTMLHeader();
         $dir_from = filter_input(INPUT_GET,'dir_from');
         createDirectory($dir);
         $dir = $dir_from;
         $show_directory = true;
         $show_footer = true;
         break;
      case "exec":
         header("Content-type: text/plain");
         escapeshellcmd($dir);
         echo system($dir);
         break;
      case "upload":
         printHTMLHeader();
         $HTTP_POST_FILES = $_FILES;
         uploadFile();
         $show_directory = true;
         $show_footer = true;
         break;
      case "save":
         printHTMLHeader();
      	saveFile($dir);
         $show_directory = true;
         $show_footer = true;
         break;
      case "rename":
         printHTMLHeader();
         $rename_to = filter_input(INPUT_GET,'rename_to');
         renameFile($dir, $rename_to);
         $dir = dirname($dir);
         break;
      case "showreferences" :
         showReferences();
         break;
      default:
         printHTMLHeader();
         $show_directory = true;
         $show_footer = true;
         break;
   };
   
   if (isset($show_directory) && $show_directory = true) showDirectory($dir);
   if (isset($show_footer) && $show_footer = true) printHTMLFooter();
   
   exit;

///////////////////////////////     HTML STYLE     ///////////////////////////////

   function printHTMLHeader() {
      global $PHP_SELF, $FONT_COLOR, $TABLE_FONT_COLOR, $LINK_COLOR, $LINK_HOVER_COLOR;
      global $BACKGROUND_COLOR, $DEFAULT_FONT;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PHP Explorer</title>
<style type="text/css">
<!--
   .body { font-family: "<?= $DEFAULT_FONT ?>"; font-size: 13 ; color: "<?= $FONT_COLOR ?>" }
   body, table, div, tr, td {font-family: "<?= $DEFAULT_FONT ?>"; font-size: 13; color: "<?= $TABLE_FONT_COLOR ?>" }
   a {text-decoration: none; color: "<?= $LINK_COLOR ?>" }
   a:hover {text-decoration: none; color: "<?= $LINK_HOVER_COLOR ?>" }
-->
</style>
</head>
<body class="body" bgcolor="<?= $BACKGROUND_COLOR; ?>">
<?php 	} // End of printHTMLHeader() 

   function printHTMLFooter() {
      global $PHP_SELF, $PHP_EXPLORER_VERSION, $dir;
?>
<p>
   <table border="0">
   <tr><td>
      <form method="get" action="<?=$PHP_SELF?>">
         <input type="hidden" name="dir_from" value="<?=$dir?>">
         <select name="action" size="1">
            <option value="jump" selected>Jump to directory</option>
            <option value="makedir">Create directory</option>
            <option value="exec">Execute shell cmd</option>
         </select>
         <input type="text" name="dir" size="20">
         <input type="submit" value="Go">
      </form>
      <span><?=is_dir($dir)?>/<?=fileperms($dir) & 00002 ?>
      <?php
         substr(decoct(fileperms(__DIR__)), -4); // 0777
         substr(decoct(fileperms(__DIR__)), -3); // 777
         substr(decoct(fileperms(__FILE__)), -4); // 0644
         substr(decoct(fileperms(__FILE__)), -3); // 644
      ?>
      </span>
   </td>
<?php if ((is_dir($dir) && (fileperms($dir) & 00002))):  // is $dir world-writeable? 
?>
   <td>
      <form enctype="multipart/form-data" action="<?= "$PHP_SELF?dir=$dir&amp;action=upload" ?>" method="post">
         <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
         <input name="userfile" type="file">
         <input type="submit" value="Upload file">
      </form>
   </td>
<?php endif; ?>
   </tr>
   </table>
<p>
   <hr>
   <div align="right"><font size="-1"><b>PHP Explorer</b> <?= $PHP_EXPLORER_VERSION; ?></font></div>
</body>
</html>
<?php 
   }  // End of printHTMLFooter ()
   
///////////////////////////     DIRECTORY FUNCTIONS     ///////////////////////////
   
   //************************************************************************
   //* Stores a directory's files and directories on 
   //* the arrays $files and $directories respectively.
   //************************************************************************

   function readDirectory($directory) {
      global $files, $directories;

      $files = array();
      $directories = array();
      $a = 0;
      $b = 0;
    
      $dirHandler = @opendir($directory) 
         or throw_error("Could not open directory <i>$directory</i>", true);
      
      while ($file = readdir($dirHandler)) {
         if ($file != "." && $file != "..") {
   
            $fullName = $directory.($directory == "/" ? "" : "/").$file;
   
            if (is_dir($fullName)) $directories[$a++] = $fullName;
            else $files[$b++] = $fullName;
         }
      }
      sort($directories);                    // We want them to be displayed alphabetically
      sort($files);
   };

   //************************************************************************
   //* Shows a directory's information
   //************************************************************************

   function showInfoDirectory($directory) {
      global $PHP_SELF, $TABLE_BORDER_COLOR, $TABLE2_BACKGROUND_COLOR, $OS_UNIX, $USERNAME;

      echo "<p><div align=\"right\"><table cellpadding=3 cellspacing=1 width=\"100%\" border=\"0\" bgcolor=\"$TABLE_BORDER_COLOR\">\n";
      echo "<tr><td bgcolor=\"$TABLE2_BACKGROUND_COLOR\" align=\"left\" width=\"90%\">";
   
      $dirs = split("/", $directory);
      print "<b><font size=\"-1\">Directory <a href=\"$PHP_SELF?dir=/\">/</a>";
      $upper_directory = "";
   
      for ($i = 1; $i < (sizeof($dirs)); $i++) {
         print "<a href=\"$PHP_SELF?dir=";
   
         for ($a = 1; $a <= $i; $a++)
            echo "/$dirs[$a]";
   
         echo "\">$dirs[$i]</a>";
   
         if ($i < ((sizeof($dirs) - 1))) $upper_directory .= "/$dirs[$i]";
         if ($directory != "/") echo "/";
      }
   
      if ($upper_directory == "") $upper_directory = "/";

      echo "</font></b>\n";
      echo "</td>\n";
      echo "<td align=\"center\" width=\"10%\" bgcolor=\"$TABLE2_BACKGROUND_COLOR\"><b><a href=\"$PHP_SELF?dir=$upper_directory\">Up</a></b></td>\n";
      echo "</tr></table></div>";

      print "<div align=\"right\"><small>Free space on disk: ";
      $freeSpace = diskfreespace($directory);
      if ($freeSpace/(1024*1024) > 1024)
         printf("%.2f GBytes", $freeSpace/(1024*1024*1024));
      else echo (int)($freeSpace/(1024*1024))."Mbytes\n";
      
      if ($OS_UNIX) {
         echo "<div align=\"right\"><small>Current user: $USERNAME</small></div>";
		}
            
      echo "</small></div>\n";
   };

   //************************************************************************
   //* Shows directory's content
   //************************************************************************
   
   function showDirectory($directory) {
      global $files, $directories, $fileInfo, $PHP_SELF, $TABLE_BORDER_COLOR, $TABLE_BACKGROUND_COLOR;
      global $show_icons, $TABLE2_BACKGROUND_COLOR;

      echo "<p><b><font face='Arial' size='+2'>PHP Explorer</font></b>";   

      readDirectory($directory);
      showInfoDirectory($directory);
?>
      <p><table cellpadding=3 cellspacing=1 width="100%" border="0" bgcolor="<?= $TABLE_BORDER_COLOR; ?>">
         <tr bgcolor="#dddddd">
            <?php if ($show_icons): ?>
            <td width="16" align="center" bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>">&nbsp;</td>
            <?php endif; ?>
            <td align="center"><b><small>NAME</small></b></td>
            <td align="center"><b><small>SIZE</small></b></td>
            <td align="center"><b><small>LAST MODIF.</small></b></td>
            <td align="center"><b><small>PERMISSIONS</small></b></td>
            <td align="center"><b><small>ACTIONS</small></b></td>
         </tr>

<?php 
      for ($i = 0; $i < sizeof($directories); $i++) {
         dump($directories[$i]);
         $fileInfo->getInfo($directories[$i]);
         dump($fileInfo);
         showFileInfo($fileInfo);
      }

      for ($i = 0; $i < sizeof($files); $i++) {
         $fileInfo->getInfo($files[$i]);
         showFileInfo($fileInfo);
      }
?>
      </table>
      <p><table cellpadding=3 cellspacing=1 width="100%" border="0" bgcolor="<?= $TABLE_BORDER_COLOR; ?>">
      <tr bgcolor="<?= $TABLE2_BACKGROUND_COLOR ?>"><td align="center">
      <b><a href="<?= $PHP_SELF ?>?action=phpinfo">Show PHP Information</a> |
      <a href="<?= $PHP_SELF ?>?action=showreferences" target="_blank">Help</a>
      </b>
      </td></tr>
      </table>      
<?php    };

   //************************************************************************
   //* Creates a directory
   //************************************************************************
   
   function createDirectory($directory) {
      global $PHP_SELF, $dir_from;
      $old_umask = umask(0);
      $dirname = $dir_from.'/'.$directory;
      if (!@mkdir($dirname, 0777))
         throw_error("Could not create directory $dirname");

      umask($old_umask);
   }
   

/////////////////////////////     FILE FUNCTIONS     //////////////////////////////

   //************************************************************************
   //* Shows a file and/or directory info and makes the corresponding links
   //************************************************************************

   function showFileInfo($fileInfo) {
      global $PHP_SELF, $associations, $TABLE_BACKGROUND_COLOR, $COLOR_PUBLIC, $COLOR_PRIVATE;
      global $show_icons;

      echo "\n<tr bgcolor=\"$TABLE_BACKGROUND_COLOR\" align=\"center\">";
      
      if (isset($show_icons) && $show_icons == true) {
         echo "<td>";      

         if ($fileInfo->isDir) echo "<img src=\"icons/dir.gif\" alt=\"\">";
         elseif ($associations[$fileInfo->extension]["icon"] != "")
            echo "<img src=\"".$associations[$fileInfo->extension]["icon"]."\" alt=\"\">";
         else echo "<img src=\"icons/generic.gif\" alt=\"\">";

         echo "</td>";
      }
      
      echo "<td align=\"left\""; 

      if ($fileInfo->perms[7] == "w") echo " bgcolor=\"$COLOR_PUBLIC\"";
      if ($fileInfo->perms[6] == "-") echo " bgcolor=\"$COLOR_PRIVATE\"";

      echo ">";

      if ($fileInfo->isLink) {
         echo $fileInfo->name." -> ";
         $fileInfo->fullname = $fileInfo->linkTo;
         $fileInfo->name = $fileInfo->linkTo;
      }
      if ($fileInfo->isDir && $fileInfo->perms[6] != "-") {       // Make directory link if not private
         echo "<b><a href=\"$PHP_SELF?dir=$fileInfo->fullname\" ";
         echo ">$fileInfo->name</a></b>";
      }
      else echo $fileInfo->name;

      echo "</td>";
      echo "<td>$fileInfo->size</td>";
      echo "<td>$fileInfo->lastmod</td>";
      echo "<td>$fileInfo->perms</td>";
      echo "<td>";
      
      if (!$fileInfo->isDir) {
         if ($fileInfo->perms[6] == 'r') {
            echo "<a href=\"$PHP_SELF?dir=$fileInfo->fullname&amp;action=view\"> V</a>";
            echo "<a href=\"$PHP_SELF?dir=$fileInfo->fullname&amp;action=download\"> D</a>";
         }

         if ($fileInfo->perms[7] == 'w') {
            echo "<a href=\"$PHP_SELF?dir=$fileInfo->fullname&amp;action=edit\"> E</a>";
         }
      }

      if ($fileInfo->perms[7] == 'w') {
         echo "<a href=\"$PHP_SELF?dir=$fileInfo->fullname&amp;action=rename\"> R</a>";
         echo "<a href=\"$PHP_SELF?dir=$fileInfo->fullname&amp;action=delete\"> X</a>";
      }

      echo "</tr>";
      flush();
   };

   //************************************************************************
   //* Decides which function use to show a file
   //************************************************************************

   function viewFile($file) {
      global $associations, $fileInfo;
      $fileInfo->getInfo($file);

      if (!$associations[$fileInfo->extension] 
          || $associations[$fileInfo->extension]["function"] == "") showFile($file);
      else $associations[$fileInfo->extension]["function"]($file);
   };
	
	//************************************************************************
	//* Shows a file in the default form. If the variable $editing is different 
   //* to 0, it edits the file
	//************************************************************************

   function showFile($file, $editing = 0) {
      global $PHP_SELF, $dir;
      $handlerFile = @fopen($file, "r") or throw_error("Could not open file $file", true);
      
      if ($editing) echo "<h3><b>Edit file $file</b></h3><hr>";
      else echo "<h3><b>File $file</b></h3><hr>";
      
      echo "<form";
      if ($editing) 
         echo " action=\"$PHP_SELF?action=save&dir=$file\" method=\"post\"";
      echo ">";
      
      $buffer = fread($handlerFile, filesize($file));
      $buffer = str_replace("&", "&amp;", $buffer);
      $buffer = str_replace("<", "&lt;", $buffer);
      $buffer = str_replace(">", "&gt;", $buffer);
      
      echo "<textarea wrap=\"off\" cols=\"90\" rows=\"20\" name=\"text\">$buffer</textarea>";

      if ($editing) echo "<p><input type=\"submit\" name=\"Submit\" value=\"Save changes\">\n</form>";
      echo "</form>";
      fclose($handlerFile);
   };
	
   //************************************************************************
   //* Saves a changed file
   //************************************************************************

   function saveFile($file) {
      global $dir, $text;

      $handlerFile = @fopen($file, "w") or throw_error("Could not open file ".basename($file)." for writing", true);
      $text = filter_input(INPUT_POST,'text');
      fwrite($handlerFile, $text, strlen($text)) or throw_error("Could not write to file", true);
      fclose($handlerFile);
      echo "Changes have been saved in ".basename($file)."<hr>";
      $dir = dirname($file);
   };

   //************************************************************************
   //* Uploads a file to the server
   //************************************************************************
   
   function uploadFile() {
      global $HTTP_POST_FILES, $dir;
      $userfile = $HTTP_POST_FILES['userfile']['tmp_name'];
      @copy($HTTP_POST_FILES["userfile"][tmp_name], 
            $dir."/".$HTTP_POST_FILES["userfile"][name]) 
      or throw_error("Could not upload file".$HTTP_POST_FILES["userfile"][name], true);
      echo "File ".$HTTP_POST_FILES["userfile"][name]." succesfully uploaded.";
      unlink($userfile);
   };
   
   //************************************************************************
   //* Deletes a file, asking for confirmation first
   //************************************************************************
   
   function deleteFile($file) {
      global $confirm, $PHP_SELF;
      if ($confirm != TRUE) die("<a href=\"$PHP_SELF?dir=$file&amp;action=delete&confirm=1\">Confirm deletion of $file</a>");
      else {
         if (is_dir($file)) {
            if (!@rmdir($file)) throw_error("Could not delete directory $file");
            else echo "Directory $file succesfully deleted<br>";
         }
         else {
            if (!@unlink($file)) throw_error("Could not delete file $file");
            else echo "$file succesfully deleted<br>";            
         }
      }
   };

   //************************************************************************
   //* Renames a file
   //************************************************************************

   function renameFile($file, $rename_to = "") {
      global $PHP_SELF, $show_directory, $show_footer;
      if (!isset($rename_to) || $rename_to == "") {
         echo "<form action=\"$PHP_SELF\">\n";
         echo "<input type=\"hidden\" name=\"action\" value=\"rename\">\n";
         echo "<input type=\"hidden\" name=\"dir\" value=\"$file\">\n";
         echo "<p>Rename/move file <b>$file</b> (relative to ".getcwd().")<br>\n";
         echo "To: <input type=\"text\" name=\"rename_to\" value=\"".basename($file)."\"><br><br>\n";
         echo "<input type=\"submit\" value=\"Rename\">\n";
         echo "</form>\n";
      }
      else {
         chdir(dirname($file));
         if (!@rename($file, $rename_to)) throw_error("Could not rename $file to $rename_to");
         else echo "$file renamed/moved succesfully.<br>\n";
         $show_directory = true;
         $show_footer = true;
      }
   }
   
   //************************************************************************
   //* Echoes a file to the output sending previously an HTML header.
   //* Used to download files of certain MIME type and to display images. 
   //* Can also be used for plugins.
   //************************************************************************

   function viewFileHeader($file, $header) {
      header($header);
      header("Content-Lenght: ".filesize($file));
      readfile($file);
   };

   //************************************************************************
   //* Functions for viewing associated files (AKA "plugins")
   //************************************************************************
	
   function viewGIF($file) {
      viewFileHeader($file, "Content-type: image/gif");
   };

   function viewJPEG($file) {
      viewFileHeader($file, "Content-type: image/jpeg");
   };

   function viewPng($file) {
      viewFileHeader($file, "Content-type: image/png");
   };
   
   function viewPHP($file) {
      show_source($file);
   };
   
   // Include any additional plugin file in here using the function
   // require("plugin_file")

//////////////////////////////     MISC FUNCTIONS     /////////////////////////////

   function throw_error($text, $end = false) {     // Shows an error message
      global $php_errormsg;

      echo "<b>Error:</b> $text";
      if (isset($php_errormsg)) echo ". <b>Last PHP error:</b> <i>$php_errormsg</i>";
      echo "<br><br>\n";

      if ($end == true) die();
   }
   
   function showReferences() {
      global $TABLE_BORDER_COLOR, $TABLE_BACKGROUND_COLOR, $COLOR_PRIVATE, $COLOR_PUBLIC;
      printHTMLHeader();
?>
      <table cellpadding=3 cellspacing=1 border="0" bgcolor="<?= $TABLE_BORDER_COLOR; ?>">
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td colspan="2" align="center"><b>References:</b></td></tr>
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td>V</td><td>Views a file</td></tr>
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td>D</td><td>Downloads a file</td></tr>
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td>E</td><td>Edits a file (only world writeable)</td></tr>
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td>X</td><td>Deletes a file or directory (only world writeable)</td></tr>
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td bgcolor="<?= $COLOR_PUBLIC ?>">&nbsp;</td><td>Public access</td></tr>
      <tr bgcolor="<?= $TABLE_BACKGROUND_COLOR ?>"><td bgcolor="<?= $COLOR_PRIVATE ?>">&nbsp;</td><td>Private access</td></tr>
      </table>
<?php   
 }

 function mb_basename($file)
{
  $temp = explode('/', $file);
  return end($temp);
}
?>

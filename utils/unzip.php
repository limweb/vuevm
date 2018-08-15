<?php

$zip = new ZipArchive;
$res = $zip->open('web.zip');
if ($res === TRUE) {
  $zip->extractTo('./');
  $zip->close();
  echo 'Yes!';
} else {
  echo 'No!';
}
<?php
session_start();
$filename = $_SESSION['cvDetails']->name;
$filetype = $_SESSION['cvDetails']->type;
$filesize = $_SESSION['cvDetails']->size;
$filedata = $_SESSION['cvDetails']->data;

header("Content-length: $filesize");
header("Content-type: $filetype");
header("Content-Disposition: attachment; filename=$filename");
ob_clean();
flush();
echo $filedata;
exit;
?>
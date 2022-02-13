<?php
session_start();
$filename = $_SESSION['flyerDetails']->name;
$filetype = $_SESSION['flyerDetails']->type;
$filesize = $_SESSION['flyerDetails']->size;
$filedata = $_SESSION['flyerDetails']->data;

header("Content-length: $filesize");
header("Content-type: $filetype");
header("Content-Disposition: attachment; filename=$filename");
ob_clean();
flush();
echo $filedata;
exit;
?>
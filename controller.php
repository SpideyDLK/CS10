<?php
include '../model/dao.php';
$db=new dao();
if(isset($_GET['ok'])){
    $select= $db->select();
    
}
if(isset($_GET['Search'])){
    $select= $db->selectOptional($_GET['txtSearch']);
}
if(isset($_GET['delete'])){
    $db->delete($_GET['txtSearch']);
}

if(isset($_GET['insert'])){
    $index=(int)$_GET['txtIndex'];
    $name=$_GET['txtName'];
    $age=(int)$_GET['txtAge'];
    $tel=(int)$_GET['txtTel'];
    $db->insert($index,$name,$age,$tel);
}
if(isset($_GET['update'])){
    $index=(int)$_GET['txtIndex'];
    $name=$_GET['txtName'];
    $age=(int)$_GET['txtAge'];
    $tel=(int)$_GET['txtTel'];
    $db->update($index,$name,$age,$tel);
}

?>
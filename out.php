<?php
session_start();
session_destroy();

//直接アクセスの禁止
if (!isset ($_SESSION['user'] )){
    header('Location:home.php');
}

header('Location:form.php');
?>
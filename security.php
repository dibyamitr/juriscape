<?php
session_start();
error_reporting(E_ALL);
require_once 'core/functions.php';
$fnc=new Functions();

$p=$_REQUEST['p'];
require_once 'security/'.$p.'.php';
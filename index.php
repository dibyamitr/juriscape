<?php
ob_start();
session_start();
error_reporting(E_ALL);
require_once 'core/functions.php';

$fnc=new Functions();
$fnc->checkAuthenticate();

$p=$_REQUEST['p'];
include_once('common/header.php');
include_once('pages/'.$p.'.php');
include_once('common/footer.php');
ob_end_flush();
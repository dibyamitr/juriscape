<?php
session_start();
require_once "core/functions.php";
$fnc=new Functions();

$fnc->checkAuthenticate();
$fnc->clearSession('userdetails');
$fnc->clearSession('session');
$url=$fnc->siteurl('sign-in');
$fnc->redirect($url);
<?php
date_default_timezone_set('Asia/Taipei');
$mysqli = @new mysqli('localhost', 'root', '123', 'earbomb');

$mysqli->query("SET NAMES utf8");

if(! isset($_SESSION)){
    session_start();
}
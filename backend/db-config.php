<?php
/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */
/*
$databaseHost     = 'sql11.freemysqlhosting.net';
$databaseName     = 'sql11456588';
$databaseUsername = 'sql11456588';
$databasePassword = 'glIvsIxT2D';*/

$databaseHost     = 'localhost';
$databaseName     = 'simplegymhelper';
$databaseUsername = 'dsr2021';
$databasePassword = 'dsr2021';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);


<?php
    session_start();
    $dbserver='localhost';
    $dbuser='root';
    $dbpass='';
    $dbname='danerics';

    $connection=mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
    if (!$connection){
        echo 'CANNOT CONNECT TO DATABASE';
    }
?>
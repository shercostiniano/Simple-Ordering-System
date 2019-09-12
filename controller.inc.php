<?php
    include 'database.php';

    if ($_SESSION['position'] == "Admin"){

        if (isset($_POST['delete'])){
            $sql = "DELETE FROM order_details WHERE order_id = $_POST[getid]";
            if ($connection->query($sql) === TRUE){
                header ("location: admin.php");
            }
    
        }
        
        if (isset($_POST['paid'])){
            $sql = "UPDATE order_details SET status='Delivered' WHERE order_id = $_POST[getid]";
            if ($connection->query($sql) === TRUE){
                header ("location: admin.php");
            }
            else{
                echo"error";
            }
        }
    }
    elseif ($_SESSION['position'] == "Customer"){
        
        if (isset($_POST['delete'])){
            $sql = "DELETE FROM order_details WHERE order_id = $_POST[getid]";
            if ($connection->query($sql) === TRUE){
                header ("location: order.php");
            }

        }
        
        if (isset($_POST['paid'])){
            $sql = "UPDATE order_details SET status='Delivered' WHERE order_id = $_POST[getid]";
            if ($connection->query($sql) === TRUE){
                header ("location: index.php");
            }
            else{
                echo"error";
            }
        }
    }
?>
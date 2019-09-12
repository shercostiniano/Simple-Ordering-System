<?php
    include 'header.php';

    if (isset($_POST['pay'])){
        if ($_SESSION['pay_available'] === FALSE){
            echo '<script>alert("No order to pay");</script>';
            echo '<script>window.location.replace("http://localhost/dan_erics/index.php");</script>';
        }
        else{
            $sql = "UPDATE order_details SET status='Yet Deliver' WHERE id = $_SESSION[user]";
            if ($connection->query($sql)){
        
?>

<body>
    <div class="main">
        <div class="row">
            <h1 class="h1-order">Success!</h1>
            <center>
            <h3 class="h3-topping">You order will be delivered soon</h3>
            <div class="div-checkout">
                        <form method="POST">
                        <button type="submit" name="home" id="button-checkout">Home</button>
                        <?php 
                            if (isset($_POST['home'])){
                                header ("location: index.php");
                            }
                        ?>
                        </form>
            </div>        
        </div>
    </div>

<?php
            }
        }
    }

    else{
        header ("location:index.php");
    }
?>

    

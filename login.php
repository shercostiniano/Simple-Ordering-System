<?php
    include 'header.php';
    if (isset($_SESSION['customer_id'])){ 
        if($_SESSION['customer_id']==session_id()){
            header ('location: index.php');
        }
    }
    else{
?>
<head>
    <style type="text/css">
        .topnav .login-container #logout{
            visibility:hidden;
        }
        #invalid{
            color:white;
        }
    </style>
</head>
<body>

<form method="POST">
    <div class="container">
        <center>
        <h1>Login Form</h1>
        </center>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Username" name="username">

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Password" name="password">
    <?php

        if (isset($_POST['login'])){
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
            $result = $connection->query($sql);

            if ($result->num_rows > 0){
                $_SESSION['customer_id']=session_id();
                while ($row = $result->fetch_array()){
                    $_SESSION['position']=$row['position'];
                    $_SESSION['user']=$row['id'];
                }
                   
                header ("location:index.php");
            }
            else{
                echo "<center><h4 id='invalid'>Invalid username or password</h4></center>";
            }
        
        }

        elseif (isset($_POST['signup'])){
            header ('location: signup.php');
        }
    }
        
    ?>

    <button type="submit" name="login" id="login">Login</button>
        <button type="submit" name="signup" id="login">Signup</button>

    </div>
</form>

</body>
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

<form method="POST">
    <div class="container">
        <center>
        <h1>Signup Form</h2>
        </center>
        <label for="firstname"><b>First Name</b></label>
        <input type="text" placeholder="Firstname" name="firstname"
        value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">

        <label for="lastname"><b>Last Name</b></label>
        <input type="text" placeholder="Lastname" name="lastname"
        value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Address" name="address"
        value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>">

        <label for="email"><b>Email Address</b></label>
        <input type="text" placeholder="Email Address" name="email"
        value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Username" name="username"
        value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Password" name="password"
        value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
        
        <label for="confirm-password"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="confirm-password"
        value="<?php if (isset($_POST['confirm-password'])) echo $_POST['confirm-password']; ?>">

<?php

        if (isset($_POST['signup'])){
            $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
            $address = mysqli_real_escape_string($connection, $_POST['address']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm-password']);

            if ($firstname == "" || $lastname == "" || $address == "" || $email == "" || $username == "" || $password == "" || $confirm_password == ""){
                echo '<center><h4 id="invalid">Please fill up all required fields</h4></center>';
            }
            else{
                if (!strpos($email, '@') || !strpos($email, '.')){
                    echo '<center><h4 id="invalid">Invalid Email Address</h4></center>';
                }

                elseif ($password != $confirm_password){

                    if (strlen($password) < 8){
                        echo '<center><h4 id="invalid">Minimum of 8 characters for password</h4></center>';
                    }
                    else{
                        echo '<center><h4 id="invalid">Password does not match!</h4></center>';
                    }
                }
                else{
                    $sql = "INSERT INTO users(username, password, firstname, lastname, address, email) 
                    VALUES('$username', '$password', '$firstname', '$lastname', '$address', '$email')";
                    if ($connection->query($sql) === TRUE){
                        header('location:index.php');
                    }
                }
            }
        
        }

        elseif (isset($_POST['already-signup'])){
            header ('location: login.php');
        }
    }
        
?>
        <button type="submit" name="signup" id="login">Signup</button>
        <button type="submit" name="already-signup" id="login">Already Signup?</button>

    </div>
</form>
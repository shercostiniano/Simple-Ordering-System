<?php
    include 'header.php';
    $total=0;
    
?>
<body>
    <div class="main">
        <div class="row">
            <form method="POST">
                 
                <h1 class="h1-order">Checkout</h1>
                <table class="table-checkout" width="100%">
                    <tr>
                        <th>Flavor</th>
                            <?php 
                                if (isset($_POST['flavor'])){
                                    $flavor = $_POST['flavor'];        
                                    $_SESSION['flavor'] = $flavor;                    
                                    $sql = "SELECT * FROM flavor WHERE flavor_name='$flavor'";
                                    $result = $connection->query($sql);
                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_array()){
                                            echo "<tr>";
                                            echo "<td><h3 class=h3-topping>$row[flavor_name]</h3></td>"; 
                                            echo "<td><h3 class=h3-topping>₱ $row[flavor_price]</h3></td>";
                                            echo "</tr>";
                                            $total += $row['flavor_price'];
                                        }
                                    }
                                }
                                else{
                                    echo "<tr><td><h3 class=h3-topping>No toppings</h3></td><tr>";
                                }
                            ?>
                    </tr>
                    <tr>
                        <th>Toppings</th>
                        <?php 
                        if (isset($_POST['topping'])){
                            $topping = $_POST['topping'];
                            $count = count($topping);
                    
                            for($i=0; $i < $count; $i++){
                                $sql = "SELECT * FROM topping WHERE topping_name='$topping[$i]'";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0){
                                    while ($row = $result->fetch_array()){
                                        $_SESSION['topping_list'] .= $row['topping_name'] . "<br>"; 
                                        echo "<tr>";
                                        echo "<td><h3 class=h3-topping>$row[topping_name]</h3></td>";
                                        echo "<td><h3 class=h3-topping>₱ $row[topping_price]</h3></td>";
                                        echo "</tr>";
                                        $total += $row['topping_price'];
                                    }
                                }
                            }
                            echo "<script>alert($_SESSION[topping_list]);</script>";
                        }
                        else{
                            echo "<tr>
                            <td><h3 class=h3-topping>No toppings</h3></td>
                            <td><h3 class=h3-topping>₱ 0</h3></td><tr>";
                        }
                    ?>
                    </tr>
                    <tr>
                        <th>Size</th>
                            <?php 
                                if (isset($_POST['size'])){
                                    $size = $_POST['size'];      
                                    $_SESSION['size'] = $size;                      
                                    $sql = "SELECT * FROM size WHERE size='$size'";
                                    $result = $connection->query($sql);
                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_array()){
                                            echo "<tr>";
                                            echo "<td><h3 class=h3-topping>$row[size]</h3></td>"; 
                                            echo "<td><h3 class=h3-topping>₱ $row[size_price]</h3></td>";
                                            echo "</tr>";
                                            $total += $row['size_price'];
                                        }
                                    }
                                }
                            ?>
                    </tr
                    <tr>
                        <td><h3 class="h3-topping">Address:</h3></td>
                        <td><input type="text" name="address" height="100px"></td>
                    </tr>

                </table>

            <div class="checkout-total">
                <h4>
                    <?php 
                            if (isset($_POST['quantity'])){
                                $quantity = $_POST['quantity'];   
                                $_SESSION['quantity'] = $quantity;
                                if ($_POST['quantity'] <= 0){
                                    $quantity = 1;
                                    $total *= 1;
                                    echo "Quantity: " . "x" . $quantity;
                                }
                                else {
                                    $total *= $quantity;
                                    echo "Quantity: " . "x" . $quantity;
                                }
                                $_SESSION['total'] = $total;
                                
                            }
                    ?>
                </h4>
                <h3>Price: 
                    <?php 
                        echo "₱ $total.00";
                    ?>
                </h3>
                <div class="div-checkout">
                        <button type="submit" name="discard" id="button-checkout">Discard</button>
                        <button type="submit" name="add" id="button-checkout">Add More</button>

                        <?php 
                            if (isset($_POST['discard'])){
                                header ("location: index.php");
                            }
                            elseif (isset($_POST['add'])){
                                echo "<script>alert($_SESSION[topping_list]);</script>";
                                $sql = "INSERT INTO order_details
                                (id, order_flavor, order_topping, order_size, order_quantity, order_total, address) VALUES
                                ('$_SESSION[user]', '$_SESSION[flavor]', '$_SESSION[topping_list]', '$_SESSION[size]', '$_SESSION[quantity]', '$_SESSION[total]', '$_POST[address]')";
                                if ($connection->query($sql) === TRUE){
                                    header ("location: index.php");
                                }
                                unset($_SESSION['topping_list']);
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>

<?php 
    include 'header.php';
    $overall_total = 0;
    $_SESSION['pay_available'] = FALSE;
?>
<body>
    <div class="main">
        <div class="row">
            <h1 class="h1-order">Order Lists</h1>
            <table class="table-checkout" width="100%">
                <th>Flavor</th>
                <th>Toppings</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Address</th>
                <th>Delete</th>

                
                <?php
                    $sql = "SELECT * FROM order_details users WHERE id = $_SESSION[user] and status = 'Waiting'";
                    $result = $connection->query($sql);
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_array()){
                            echo "<form action=controller.inc.php method=POST>";
                            echo "<tr>";
                            echo "<input type=hidden value=$row[order_id] name=getid style='{display:none;}'>"; 
                            echo "<td><h3 class=h3-topping>$row[order_flavor]</h3></td>"; 
                            echo "<td><h3 class=h3-topping>$row[order_topping]</h3></td>"; 
                            echo "<td><h3 class=h3-topping>$row[order_size]</h3></td>"; 
                            echo "<td><h3 class=h3-topping>x$row[order_quantity]</h3></td>"; 
                            echo "<td><h3 class=h3-topping>₱ $row[order_total]</h3></td>";
                            echo "<td><h3 class=h3-topping>$row[address]</h3></td>";
                            echo '<td><button type="submit" name=delete id="button-delete">Delete</button></td>';
                            echo "</tr>";
                            echo "</form>";
                            $overall_total += $row['order_total'];
                        }
                        $_SESSION['pay_available'] = TRUE;
                    }
                ?>
            </table>
        </div>
        <div class="checkout-total">
                <h3>Total: 
                    <?php 
                        echo "₱ $overall_total.00";
                    ?>
                </h3>
        <div class="div-checkout">
            <form action="success.php" method="POST">
                <button type="submit" name="pay" id="button-checkout">Pay</button>
            </form>
        </div>
    </div>
</body>



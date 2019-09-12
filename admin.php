<?php   
    include 'admin_header.php';

?>

<body>
    <table class="table-admin" width="100%">
        <th>Order #</th>
        <th>Flavor</th>
        <th>Toppings</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
        <th>Address</th>
        <th>Completed Delivery</th>

        <form action="controller.inc.php" method="POST">
        <?php
            $sql = "SELECT * FROM order_details";
            $result = $connection->query($sql);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_array()){
                    echo "<tr>";
                    echo "<input type=hidden value=$row[order_id] name=getid style='{display:none;}'>"; 
                    echo "<td><h3 class=h3-topping>$row[order_id]</h3></td>"; 
                    echo "<td><h3 class=h3-topping>$row[order_flavor]</h3></td>"; 
                    echo "<td><h3 class=h3-topping>$row[order_topping]</h3></td>"; 
                    echo "<td><h3 class=h3-topping>$row[order_size]</h3></td>"; 
                    echo "<td><h3 class=h3-topping>x$row[order_quantity]</h3></td>"; 
                    echo "<td><h3 class=h3-topping>₱ $row[order_total]</h3></td>";
                    echo "<td><h3 class=h3-topping>$row[status]</h3></td>"; 
                    echo "<td><h3 class=h3-topping>$row[address]</h3></td>";
                    echo '<td>
                    <button type="submit" name="paid" id="button-admin-change">DELIVERED</button>
                    <button type="submit" name="delete" id="button-admin-change">DELETE</button>
                    </td>';
                    echo "</tr>";
                }
                $_SESSION['pay_available'] = TRUE;
            }
        ?>
        </form>
    </table>
</body>
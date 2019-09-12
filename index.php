<?php
    include 'header.php';
    if ($_SESSION['position'] == "Admin"){
        header ("location:admin.php");
    }
    else{
        if($_SESSION['customer_id']==session_id()){
?>

<body>
    <div class="main"> 
        <div class="row">
            <form action="checkout.php" method="POST"> 
                <h1 class="h1-order">Order Icecream</h1>
                <h1 class="h1-inline">Flavor:</h1>
                    <select name="flavor" class="select-flavor">
                        <?php 
                                $sql = "SELECT * FROM flavor";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0){
                                    while ($row=$result->fetch_array()){
                                        echo "<option value='$row[flavor_name]'>";
                                        echo $row['flavor_name'];
                                    }
                                }
                        ?>
                    </select>
                <br>
                <h1 class="h1-inline">Toppings:</h1>
                    <div class="topping">
                        <?php 
                                $sql = "SELECT * FROM topping";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0){
                                    while ($row=$result->fetch_array()){
                                        echo "<input type='checkbox' value='$row[topping_name]' name='topping[]'>";
                                        echo "<h3 class='h3-topping'>$row[topping_name]</h3><br>";
                                    }
                                }
                        ?>
                    </div>
                <br>
                <h1 class="h1-inline">Size:</h1>
                    <select name="size" class="select-flavor">
                        <?php 
                                $sql = "SELECT * FROM size";
                                $result = $connection->query($sql);
                                if ($result->num_rows > 0){
                                    while ($row=$result->fetch_array()){
                                        echo "<option value='$row[size]'>";
                                        echo $row['size'];
                                    }
                                }
                        ?>
                    </select>
                <br>
                <h1 class="h1-inline">Quantity:</h1>
                    <input type="number" name="quantity" placeholder="Quantity" required>
                    <div class="div-checkout">
                        <button type="submit" name="add-cart" id="button-checkout">Add To Cart</button>
                    </div>
            </form>
        </div>
    </div>

        
</body>

<?php
    }
    else{
        header('location:login.php');
    }
}
?>
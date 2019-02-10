<?php
   
   if(!isset($_SESSION)) 
   { 
       session_start(); 
   } 

    $subtotal = 0.00;
    $tax = 0.05;
    $shipping = 5.00;
    $total = 0.00;
    $prod_list = array();

    if(isset($_GET['qty'])){
        $qty = filter_input(INPUT_GET, 'qty');
        $id = filter_input(INPUT_GET, 'id');
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        for($i = 0; $i < count($product_ids); $i++ ){
            if($product_ids[$i] == $id){
                $_SESSION['shopping_cart'][$i]['quantity'] = $qty;     
            }
        }
    }

    if(isset($_GET['prodId'])){
        $id = filter_input(INPUT_GET, 'prodId');
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        for($i = 0; $i < count($product_ids); $i++ ){
            if($product_ids[$i] == $id){
                unset($_SESSION['shopping_cart'][$i]);     
            }
        }
    }
   // reset array indexes
   $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);

    if(isset($_SESSION['shopping_cart'])){
        //echo count($_SESSION);
        for($i = 0; $i < count($_SESSION['shopping_cart']); $i++) {
            array_push($prod_list,  array( 
                                         "id" =>    $_SESSION['shopping_cart'][$i]['id'],
                                         "name" =>   $_SESSION['shopping_cart'][$i]['name'],
                                         "price" =>   $_SESSION['shopping_cart'][$i]['price'],
                                         "description" =>   $_SESSION['shopping_cart'][$i]['description'],
                                         "image_path" =>   $_SESSION['shopping_cart'][$i]['image_path'],
                                         "quantity" =>   $_SESSION['shopping_cart'][$i]['quantity']
                                        )
                     );
        }
    }
?>


<?php include('header.php'); ?>
    <div class="outer-container">
        <div class="container">
            <div class="shopping-cart">
            <h1 class="text-info">Shopping Cart</h1>
            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-quantity">Quantity</label>
                <label class="product-removal">Remove</label>
                <label class="product-line-price">Total</label>
            </div>
            <!--start for each to populate products to the cart-->
            <?php foreach ($prod_list as $prod): ?>
            <div class="product">
                <div class="product-image">
                <img src="<?php echo $prod['image_path']  ?>">
                </div>
                <div class="product-details">
                <div class="text-info"><h3><a style="text-decoration:none;" href="<?php echo "./product_page.php?id=" . $prod['id'] . "&qty=" . $prod['quantity'] ?>"><?php echo $prod['name']  ?></a></h3></div>
                <p class="product-description"><?php echo $prod['description']  ?></p>
                </div>
                <div class="product-price"><?php echo $prod['price']  ?></div>
                <div class="product-quantity">
                <input class='prodId' type="hidden" value="<?php echo $prod['id'] ?>" />
                <input type="number" value="<?php echo $prod['quantity'] ?>" min="1">
                </div>
                <div class="product-removal">
                <button class="remove-product" id="<?php echo $index++ ?>">
                    Remove
                </button>
                </div>
                <div class="product-line-price">
                    <?php 
                        $subtotal += number_format($prod['price'] * $prod['quantity'],2);
                        echo number_format($prod['price'] * $prod['quantity'],2);
                    ?>
            </div>
            </div>
            <?php endforeach; ?>
            <!-- if we don't have any products don't show this section -->
            <?php if($subtotal != 0){ ?>
                <div class="totals">
                    <div class="totals-item">
                    <label>Subtotal</label>
                    <div class="totals-value" id="cart-subtotal">
                        <?php 
                            echo number_format($subtotal, 2);
                            $tax = $subtotal * $tax;
                        ?>
                    </div>
                    </div>
                    <div class="totals-item">
                    <label>Tax (5%)</label>
                    <div class="totals-value" id="cart-tax"><?php echo number_format($tax,2)  ?></div>
                    </div>
                    <div class="totals-item">
                    <label>Shipping</label>
                    <div class="totals-value" id="cart-shipping"><?php echo number_format($shipping,2) ?></div>
                    </div>
                    <div class="totals-item">
                    <label>Grand Total</label>
                    <div class="totals-value" id="cart-total">
                        <?php
                            echo number_format(($subtotal + $tax + $shipping),2);
                        ?>
                    </div>
                    </div>
                </div>
                   <form action="checkout.php" method="POST">
                        <button type="submit" name="checkout" class="checkout">Checkout</button>
                   </form>
            <?php } ?>
            </div>
        </div>
    </div>
<?php include('footer.php') ?>
<script>
    //fix navigation links
    $('#maincss').attr('href', '../styles/main.css');
    $("#nav-bar").attr('href', './shopping_cart.php');
    $("#home").attr('href', '../index.php');
    $('#login').attr('href', './login.php')
    $("#cat-link").attr('href', '../index.php?category=1');
    $("#dog-link").attr('href', '../index.php?category=2');
</script>
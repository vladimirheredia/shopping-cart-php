<?php 
    require('../model/DatabaseRepository.php');
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    //get id from query string
    $prod_id = filter_input(INPUT_GET, 'id');
    $model = new DataRepository();
    //get product by id
    $prod = $model->getProductById($prod_id);

if(isset($_POST["add_to_cart"])){
    $count = count($_SESSION['shopping_cart']);

    //create sequential array to match keys to product ids
    $product_ids = array_column($_SESSION['shopping_cart'], 'id');

    if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name' ),
            'price' => filter_input(INPUT_POST, 'price' ),
            'quantity' => filter_input(INPUT_POST, 'quantity' ),
            'image_path' => filter_input(INPUT_POST, 'image_path'),               
            'description' => filter_input(INPUT_POST, 'description')                 
        );
    }
}
    //when plus or minus button is clicked 
    if(isset($_GET['qty'])){
        $qty = filter_input(INPUT_GET, 'qty');
        $id = filter_input(INPUT_GET, 'id');
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        for($i = 0; $i < count($product_ids); $i++ ){
            if($product_ids[$i] == $id){
                $_SESSION['shopping_cart'][$i]['quantity'] = $qty;     
            }
        }
    }//else check the session and pass whatever is there
    else{
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        for($i = 0; $i < count($product_ids); $i++ ){
            if($product_ids[$i] == $prod_id){
               $prod->qty =  $_SESSION['shopping_cart'][$i]['quantity'];     
            }
        }
    }


?>
    <?php  include('header.php')?>
      <div class="outer-container">
        <div class="container">
          <form method="POST">
        	<div class="row">
               <div class="col-xs-4 item-photo">
                    <img style="max-width:100%;" src="<?php echo $prod->image_path ?>" />
                </div>
                <div class="col-xs-5" style="border:0px solid gray">
                    <!-- product title -->
                    <h3 class="text-info"><?php echo $prod->name ?></h3>    
                    <h5 class="title-attr"><small>DESCRIPTION</small></h5> 
                    <p style="width: 280px; margin-top:5px;"> <?php echo $prod->description ?> </p>
                    <!-- Precios -->
                    <h5 class="title-price"><small>PRICE</small></h5>
                    <h3 style="margin-top:0px;"><?php echo "$" . number_format($prod->price, 2) ?></h3>
        
                    <!-- Detalles especificos del producto -->
                    <div class="section" style="padding-bottom:20px;">
                        <h5 class="title-attr"><small>QUANTITY</small></h5>                    
                        <div>
                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                            <input value="<?php 
                                if(isset($qty)){
                                    echo $qty;
                                }else{
                                    echo $prod->qty;
                                }
                            ?>" />
                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                            <input id="prodId" type="hidden" name="id" value="<?php echo $prod->id ?>" />
                            <input type="hidden" name="name" value="<?php echo $prod->name ?>" />
                            <input type="hidden" name="price" value="<?php echo $prod->price ?>" />
                            <input type="hidden" name="description" value="<?php echo $prod->description ?>" />
                            <input type="hidden" name="image_path" value="<?php echo $prod->image_path ?>" />
                            <input type="hidden" name="quantity" value="<?php echo $prod->quantity ?>" />
                        </div>
                    </div>                
        
                    <!-- Botones de compra -->
                    <div class="section" style="padding-bottom:20px;">
                        <button type="submit" name="add_to_cart" class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>ADD TO CART</button>
                    </div>                                        
                </div> 
        </form>
</div>
<?php  include('footer.php')?>
<script>
     //fix navigation links
     $('#maincss').attr('href', '../styles/main.css');
     $("#nav-bar").attr('href', './shopping_cart.php');
     $("#home").attr('href', '../index.php');
     $("#cat-link").attr('href', '../index.php?category=1');
     $("#dog-link").attr('href', '../index.php?category=2');
</script>

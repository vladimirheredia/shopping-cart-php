 <?php
     DEFINE("ROOT_PATH", dirname( __FILE__ ) ."/" );
     require('./model/DatabaseRepository.php');
     if(!isset($_SESSION)) 
     { 
         session_start(); 
     } 

     $model = new DataRepository();
     $prod_list = array();
     if(isset($_GET['category'])){
        $category = $_GET['category'];
        $prod_list = $model->getProductByCategory($category);
     }else{
       $prod_list = $model->getProducts();
     }
     

     $product_ids = array();
 
     if(isset($_POST["add_to_cart"])){
        
         //if shopping cart is set up
         if(isset($_SESSION['shopping_cart'])){
            //keep track of products in shopping cart
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
            else{ //if already exist update quantity
                for($i = 0; $i < count($product_ids); $i++ ){
                    if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                        $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                        break;
                    }
                }
            }
         }
         //if it doesn't exist then create it
         else{
            $_SESSION['shopping_cart'][0] = array(
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name' ),
                'price' => filter_input(INPUT_POST, 'price' ),
                'quantity' => filter_input(INPUT_POST, 'quantity' ),
                'image_path' => filter_input(INPUT_POST, 'image_path'),               
                'description' => filter_input(INPUT_POST, 'description')                
            );
         }
     }

     //print_r($_SESSION['shopping_cart']['quantity']);
   // print_r($_SESSION);
  // print_r( $prod_list[3]->qty = 3);
 ?>

    <?php include('view/header.php')?>
    <div class="outer-container">
    <div class="container">
    <h4 style="margin-left:15px;" class="text-info">ANIMAL FOODS</h4>
	    <!-- BEGIN PRODUCTS -->
    <?php foreach($prod_list as $prod): ?>
  		<div class="col-md-3 col-sm-6">
          <form method="POST" action="index.php?action=add&id=<?php echo $prod->id; ?>">
    		<span class="thumbnail">
                <img style="width:100px; height:100px;" src="<?php echo substr($prod->image_path, 3) ?>" alt="...">
      			<h4 name="name" class="text-info"><a href="<?php echo "view/product_page.php?id=" . $prod->id?>"><?php echo $prod->name ?></a></h4>
      			<p style="height:80px;"><?php echo $prod->description ?></p>
      			<hr class="line">
      			<div class="row">
      				<div class="col-md-4 col-sm-4">
      					<p style="margin-top:7px" ><?php echo "$" . number_format($prod->price, 2) ?></p>
                      </div>
                      <input type="hidden" name="name" value="<?php echo $prod->name ?>" />
                      <input type="hidden" name="price" value="<?php echo $prod->price  ?>" />
                      <input type="hidden" name="quantity" value="1" />
                      <input type="hidden" name="image_path" value="<?php echo $prod->image_path ?>" />
                      <input type="hidden" name="description" value="<?php echo $prod->description ?>" />
      				<div class="col-md-6 col-sm-6">
      				 <button type="submit" name="add_to_cart" class="btn btn-info right" ><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>ADD TO CART</button>
      				</div>
      				
      			</div>
            </span>
        </form>
  		</div>
		<!-- END PRODUCTS -->
        <?php endforeach;   ?>
    </div>
    </div> <!-------outer-container----->
</div><!-------outer-container----->

<?php include('view/footer.php')?>
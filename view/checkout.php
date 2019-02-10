<?php
    /**
     * Gets the information from cart and create array
     */
     require('../model/DatabaseRepository.php');
     require('../model/Order.php');

     if(!isset($_SESSION)) 
     { 
         session_start(); 
     } 
  
      if(!$_SESSION["authenticated"]){
          header('Location: login.php?checkout');
      }

      //create order object to send to db
      $orders = new DataRepository();


      //create array to be saved to db
      $prod_list = array();
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

    print_r($prod_list);
?>
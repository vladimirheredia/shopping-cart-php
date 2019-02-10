<?php
/**
 * Name: Vladimir Heredia
 * Date: 2/24/2018
 * Desc: This is the repository class that will make all the requests, updates and deletes 
 * to the database.
 */
    require_once('database.php');
    require('Product.php');
   
    class DataRepository{
        var $db;

        public function __construct(){
            $this->db = new DatabaseConnection();
        }
       
        /**
         * creaate database query to get all products
         */
        public function getProducts(){
            $query = 'SELECT * FROM products order by id';
            $stmt = $this->db->dbConnection->prepare($query);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            //create new array
            $prods = array();
            foreach($products as $product){
                //push new products to array
                array_push($prods,new Product($product['id'], $product['product_name'], $product['product_description'], $product['product_price'], $product['image_path'], 1));
            }
            
            // print_r($prods);

            // print_r($products);
            return $prods;
        }

        /**
         * creaate database query to get a product by id
         */
        public function getProductById($id){
             $sql = 'SELECT * FROM products WHERE id = :id';
             $stmt = $this->db->dbConnection->prepare($sql);
             $stmt->bindValue(':id', $id);
             $stmt->execute();
             $product = $stmt->fetch(PDO::FETCH_ASSOC);
             $stmt->closeCursor();
            //return the product
             return new Product($product['id'], $product['product_name'], $product['product_description'], $product['product_price'], $product['image_path'],1);
        }

        /**
         * creaate database query to get products by category 
         * cats / dogs
         */
        public function getProductByCategory($id){
            $sql = 'SELECT * FROM products WHERE category = :id';
            $stmt = $this->db->dbConnection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            $prods = array();
            foreach ($products as $product) {
                array_push($prods,new Product($product['id'], $product['product_name'], $product['product_description'], $product['product_price'], $product['image_path'],1));
            }
           //return the product
            return $prods;
       }
    }
?>
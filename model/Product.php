<?php
    class Product{
        var $id;
        var $name;
        var $description;
        var $price;
        var $image_path;
        var $qty;

        public function __construct($id, $name, $description, $price, $image_path,$qty){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->image_path = $image_path;
            $this->qty = $qty;
        }
    }

?>
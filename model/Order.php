<?php
/**
 * Name: Vladimir Heredia
 * Date: 2/25/2018
 * Desc: This is the object that will be used to save the order history of the user.
 */
    class Order{
        var $id;
        var $name;
        var $description;
        var $price;
        var $image_path;
        var $qty;
        var $user;
        var $date;

        public function __construct($id, $name, $description, $price, $image_path, $qty, $user, $date){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->image_path = $image_path;
            $this->qty = $qty;
            $this->user = $user;
            $this->date = $date;
        }
    }
?>
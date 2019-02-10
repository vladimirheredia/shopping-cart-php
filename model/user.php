<?php
    class User{
        var $id;
        var $first_name;
        var $last_name;
        var $email;
        var $password;

        public function __construct($id, $first_name, $last_name, $email, $password){
            $this->id = $id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->password = $password;
        }
    }

?>
<?php
    namespace App\DTOS;

    class UserDTO
    {
        public $name;
        public $email;
        public $password;

        public function __construct($name, $email, $password)
        {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
    }
?>

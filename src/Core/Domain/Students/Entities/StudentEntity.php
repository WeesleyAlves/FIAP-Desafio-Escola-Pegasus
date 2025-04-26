<?php

namespace Src\Core\Domain\Students\Entities;


class StudentEntity{
    private string $id;
    private string $name;
    private string $email;
    private string $phone;
    private string $address;

    public function __construct(){}

    public function getId(){
        return $this->id;
    } 

    public function getName(){
        return $this->name;
    } 

    public function getEmail(){
        return $this->email;
    } 

    public function getPhone(){
        return $this->phone;
    } 

    public function getAddress(){
        return $this->address;
    }

    public static function fromArray( array $array ){
        $instance = new self();

        $instance->id = isset($array['id']) ? $array['id'] : -1;
        $instance->name = isset($array['name']) ? $array['name'] : '';
        $instance->phone = isset($array['phone']) ? $array['phone'] : '';
        $instance->address = isset($array['address']) ? $array['address'] : '';
        $instance->email = isset($array['email']) ? $array['email'] : '';

        return $instance;
    }

    public function toArray(){
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
        );
    }
}

?>
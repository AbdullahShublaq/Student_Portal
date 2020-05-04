<?php
/**
 * Created by PhpStorm.
 * User: Abdullah Shublaq
 * Date: 09/05/2019
 * Time: 05:09 م
 */
//error_reporting(E_ERROR | E_PARSE);
class Student{

    private $id;
    private $name;
    private $email;
    private $phone;
    private $gpa;

    /**
     * Student constructor.
     * @param $id
     * @param $name
     * @param $email
     * @param $phone
     * @param $gpa
     */
    public function __construct($id, $name, $email, $phone, $gpa)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->gpa = $gpa;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getGpa()
    {
        return $this->gpa;
    }

    /**
     * @param mixed $gpa
     */
    public function setGpa($gpa)
    {
        $this->gpa = $gpa;
    }

}
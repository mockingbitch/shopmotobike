<?php

$filepath = realpath(dirname(__FILE__));
include '../lib/session.php';
include '../lib/database.php';
include '../helpers/format.php';

class register
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function register($data){
//        if(strlen($data['name'])<20){
//            $alert = "Your name length must less than 20 characters";
//            return $alert;
//        }
        if ($data['pass'] != $data['confirmpass']){
            $alert = "Passwords does not match";
            return $alert;
        }
        else{
            $email = $this->fm->validation($data['email']);
            $password = $this->fm->validation($data['pass']);
            $name = $this->fm->validation($data['name']);
            $email = mysqli_real_escape_string($this->db->link,$email);
            $password = mysqli_real_escape_string($this->db->link,$password);
            $name = mysqli_real_escape_string($this->db->link,$name);
            $vkey = md5(time().$email);
            $permission = 2;
            $password = md5($password);
            $query = "INSERT INTO tbl_admin(adminUser,adminPass,permission,adminName,vkey) 
            VALUES ('$email','$password','$permission','$name','$vkey')";
            $result = $this->db->insert($query);
            if($result){
                $to = $email;
                $subject = "Email Verification";
                $message = "<p>Bạn đang sử dụng hệ thống xác nhận đăng ký tự động từ TechShop. 
                Vui lòng ấn<a href='https://techshop.test/admin/verify.php?vkey=".$vkey."'>Xác nhận</a> thủ tục.
                 Đây là tin nhắn tự động, không trả lời hoặc forward tin nhắn</p> ";
                $headers = "From: phongtq1@smartosc.com \r \n";
                $headers .= "MIME-Version:1.0"."\r \n";
                $headers .= "Content-type:text/html;charset=UTF-8"."\r \n";
                mail($to,$subject,$message,$headers);
                header('Location:thankyou.php');
            }
            else{
                $alert = "fail";
                return $alert;
            }
        }
    }
}
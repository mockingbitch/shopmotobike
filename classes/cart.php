<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
session_start();
?>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($data){
        $id = $data['productid'];
        $query = "SELECT * FROM tbl_product WHERE productid = '$id'";
        $result = $this->db->select($query);
        $row = mysqli_fetch_row($result);
        if(!isset($_SESSION['cart'])){
            $cart[$id] = array(
                'productName'=>$row[2],
                'img'=>$row[9],
                'productPrice'=>$row[7],
                'quantity'=> 1
            );
        }else{
            $cart = $_SESSION['cart'];
            if (array_key_exists($id,$cart)){
                $cart[$id] = array(
                    'productName'=>$row[2],
                    'img'=>$row[9],
                    'productPrice'=>$row[7],
                    'quantity'=> (int)$cart[$id]['quantity']+1
                );
            }
            else{
                $cart[$id] = array(
                    'productName'=>$row[2],
                    'img'=>$row[9],
                    'productPrice'=>$row[7],
                    'quantity'=> 1
                );
            }
        }
        $cart = $_SESSION['cart'];
        print_r($_SESSION['cart']);
    }
    public function get_product_cart(){
        $sessionid = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionid='$sessionid'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity($quantity,$cartid){
        $quantity = mysqli_real_escape_string($this->db->link,$quantity);
        $cartid = mysqli_real_escape_string($this->db->link,$cartid);
    }
}
?>
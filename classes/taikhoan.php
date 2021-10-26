<?php
$filepath = realpath(dirname(__FILE__));
require_once '../lib/session.php';
Session::checkLogin();
require_once '../lib/database.php';
require_once '../helpers/format.php';
?>
<?php
class taikhoan
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function dangnhap($taikhoan, $matkhau){
        $taikhoan = $this->fm->validation($taikhoan);
        $matkhau = $this->fm->validation($matkhau);
        $taikhoan = mysqli_real_escape_string($this->db->link, $taikhoan);
        $matkhau = mysqli_real_escape_string($this->db->link, $matkhau);
        if(empty($taikhoan)||empty($matkhau)){
            $alert = "Tài khoản mật khẩu không được bỏ trống!";
            return $alert;
        }
        else{
            $query = "SELECT * FROM tbl_taikhoan WHERE  taikhoan = '$taikhoan' AND matkhau = '$matkhau' LIMIT 1";
            $result = $this->db->select($query);
            if($result!=false){
                $value = $result->fetch_assoc();
                Session::set('login',true);
                Session::set('id',$value['id']);
                Session::set('taikhoan',$value['taikhoan']);
                Session::set('ten',$value['ten']);
                Session::set('quyen',$value['quyen']);
                header('Location:index.php');
                $alert = "Success";
                return $alert;
            }
            else{
                $alert = "Sai tài khoản hoặc mật khẩu!";
                return $alert;
            }
        }
    }


}

?>
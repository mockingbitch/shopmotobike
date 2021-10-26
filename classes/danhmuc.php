<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class danhmuc
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function them_danhmuc($tendanhmuc,$mota){
        $tendanhmuc = $this->fm->validation($tendanhmuc);
        $mota = $this->fm->validation($mota);
        $tendanhmuc = mysqli_real_escape_string($this->db->link, $tendanhmuc);
        $mota  = mysqli_real_escape_string($this->db->link, $mota);
        if (empty($tendanhmuc)) {
            $alert = "Tên danh mục không được để trống!";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_danhmuc(tendanhmuc,mota) 
            VALUES ('$tendanhmuc','$mota')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Thêm " . $tendanhmuc . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function xoa_danhmuc($id){
        $query = "DELETE FROM tbl_danhmuc WHERE iddanhmuc ='$id'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
    public function show_danhmuc(){
        $query = "SELECT * FROM tbl_danhmuc ORDER BY iddanhmuc DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_danhmuctheoid($id){
        $query = "SELECT * FROM tbl_danhmuc WHERE iddanhmuc = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function sua_danhmuc($id,$tendanhmuc,$mota){
        $tendanhmuc = $this->fm->validation($tendanhmuc);
        $mota = $this->fm->validation($mota);
        $tendanhmuc = mysqli_real_escape_string($this->db->link, $tendanhmuc);
        $mota  = mysqli_real_escape_string($this->db->link, $mota);
        if (empty($tendanhmuc)) {
            $alert = "Tên danh mục không được để trống!";
            return $alert;
        } else {
            $query = "UPDATE tbl_danhmuc SET tendanhmuc = '$tendanhmuc',mota = '$mota' WHERE iddanhmuc = '$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Sửa " . $tendanhmuc . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }

}
?>
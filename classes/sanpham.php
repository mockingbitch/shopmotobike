<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
class sanpham
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function them_sanpham($tensanpham,$mota,$danhmuc,$gia,$hinhanh,$soluong){
        $tensanpham     = $this->fm->validation($tensanpham);
        $mota           = $this->fm->validation($mota);
        $danhmuc        = $this->fm->validation($danhmuc);
        $gia            = $this->fm->validation($gia);
        $soluong        = $this->fm->validation($soluong);
        $tensanpham     = mysqli_real_escape_string($this->db->link, $tensanpham);
        $mota           = mysqli_real_escape_string($this->db->link, $mota  );
        $danhmuc        = mysqli_real_escape_string($this->db->link, $danhmuc);
        $gia            = mysqli_real_escape_string($this->db->link, $gia);
        $soluong        = mysqli_real_escape_string($this->db->link, $soluong);
        $permited  = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['hinhanh']['name'];
        $file_size = $_FILES['hinhanh']['size'];
        $file_temp = $_FILES['hinhanh']['tmp_name'];
        $div       = explode('.',$file_name);
        $file_ext  = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../admin/uploads/".$unique_image;

        if (empty($tensanpham)||empty($mota)||empty($danhmuc)||empty($gia)||empty($soluong)||empty($hinhanh)) {
            $alert = "Không được để trống";
            return $alert;
        } else {
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_sanpham(tensanpham,mota,danhmuc,gia,soluong,hinhanh) 
            VALUES ('$tensanpham','$mota','$danhmuc','$gia','$soluong','$unique_image')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Thêm " . $tensanpham . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function show_sanpham()
    {
        $query = "SELECT * FROM tbl_sanpham order by idsanpham DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function xoa_sanpham($id)
    {
        $query = "DELETE FROM tbl_sanpham WHERE idsanpham ='$id'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
    public function show_sanphamtheoid($id){
        $query = "SELECT * FROM tbl_sanpham WHERE idsanpham = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function sua_sanpham($id,$tensanpham,$mota,$danhmuc,$gia,$hinhanh,$soluong){
        $tensanpham     = $this->fm->validation($tensanpham);
        $mota           = $this->fm->validation($mota);
        $danhmuc        = $this->fm->validation($danhmuc);
        $gia            = $this->fm->validation($gia);
        $soluong        = $this->fm->validation($soluong);
        $tensanpham     = mysqli_real_escape_string($this->db->link, $tensanpham);
        $mota           = mysqli_real_escape_string($this->db->link, $mota  );
        $danhmuc        = mysqli_real_escape_string($this->db->link, $danhmuc);
        $gia            = mysqli_real_escape_string($this->db->link, $gia);
        $soluong        = mysqli_real_escape_string($this->db->link, $soluong);
        $permited  = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['hinhanh']['name'];
        $file_size = $_FILES['hinhanh']['size'];
        $file_temp = $_FILES['hinhanh']['tmp_name'];
        $div       = explode('.',$file_name);
        $file_ext  = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../admin/uploads/".$unique_image;

        if (empty($tensanpham)||empty($mota)||empty($danhmuc)||empty($gia)||empty($soluong)||empty($hinhanh)) {
            $alert = "Không được để trống";
            return $alert;
        }
        else {
            if(!empty($file_name)) {
                if($file_size>20480000){
                    $alert = "<span class='error'>Image size shoult be less than 2MB!</span>";
                    return $alert;
                }
                elseif(in_array($file_ext,$permited)==false){
                    $alert = "<span class='error'>You can upload only:".implode(',',$permited)." </span>";
                    return $alert;
                }
                else{
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tbl_sanpham SET 
                tensanpham = '$tensanpham',
                mota = '$mota',
                danhmuc = '$danhmuc',
                gia = '$gia',
                hinhanh = '$unique_image',
                soluong = '$soluong'
                WHERE idsanpham ='$id'";"
                ";
                }
            }
            else{
                $query = "UPDATE tbl_sanpham SET 
                tensanpham = '$tensanpham',
                mota = '$mota',
                danhmuc = '$danhmuc',
                gia = '$gia',
                soluong = '$soluong'
                WHERE idsanpham ='$id'";"
                ";
            }
        }
        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Sửa " . $tensanpham . " thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
}
?>
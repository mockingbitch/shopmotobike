<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class hangxe
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function them_hangxe($tenhangxe)
    {
        $tenhangxe = mysqli_real_escape_string($this->db->link, $tenhangxe);
        if (empty($tenhangxe)) {
            $alert = "Không được để trống";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_hangxe(tenhangxe)  VALUES ('$tenhangxe')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Thêm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function show_hangxe()
    {
        $query = "SELECT * FROM tbl_hangxe ORDER BY idhangxe DESC";
        $result = $this->db->select($query);
        if ($result){
            return $result;
        }
        else{
            $alert = "Chưa có hãng xe nào. Vui lòng thêm";
            return $alert;
        }
    }
    public function show_id($id)
    {
        $query = "SELECT * FROM tbl_hangxe WHERE idhangxe ='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function sua_hangxe($tenhangxe, $id)
    {
        $tenhangxe = mysqli_real_escape_string($this->db->link, $tenhangxe);

        if (empty($tenhangxe)) {
            $alert = "Không được bỏ trống";
            return $alert;
        } else {
            $query = "UPDATE tbl_hangxe SET tenhangxe = '$tenhangxe' WHERE idhangxe = '$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Sửa thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function delete_brand($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brandid ='$id'";
        $result = $this->db->delete($query);
        
        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
    public function activate($id)
    {
        $query = "UPDATE tbl_brand SET status = '1' WHERE brandid = '$id'";
        $result = $this->db->update($query);
        $alert = "Đã kích hoạt";
        return $alert;
    }
    public function deactivate($id)
    {
        $query = "UPDATE tbl_brand SET status = '0' WHERE brandid = '$id'";
        $result = $this->db->update($query);
        $alert = "Đã huỷ kích hoạt";
        return $alert;
    }


}

?>
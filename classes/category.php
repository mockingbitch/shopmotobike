<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }
    public function insert_category($data)
    {
        $cateName = $this->fm->validation($data['cateName']);
        $cateDes = $this->fm->validation($data['cateDes']);
        $cateSlug = $this->fm->to_slug($cateName);
        $cateName = mysqli_real_escape_string($this->db->link, $cateName);
        $cateDes = mysqli_real_escape_string($this->db->link, $cateDes);
        $cateSlug = mysqli_real_escape_string($this->db->link, $cateSlug);
        $status = mysqli_real_escape_string($this->db->link, $data['active']);
        if (empty($cateName)) {
            $alert = "category name must be not empty";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(categoryName,categoryDescription,categorySlug,status) 
            VALUES ('$cateName','$cateDes','$cateSlug','$status')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Thêm " . $cateName . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function show_category()
    {
        $query = "SELECT * FROM tbl_category ORDER BY cateid DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatebyId($id)
    {
        $query = "SELECT * FROM tbl_category WHERE cateid ='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($data, $id)
    {
        $cateName = $this->fm->validation($data['cateName']);
        $cateDes = $this->fm->validation($data['cateDes']);
        $cateSlug = $this->fm->to_slug($cateName);
        $cateName = mysqli_real_escape_string($this->db->link, $cateName);
        $cateDes = mysqli_real_escape_string($this->db->link, $cateDes);
        if (empty($cateName)) {
            $alert = "category name must be not empty";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET categoryName = '$cateName', categoryDescription = '$cateDes',categorySlug = '$cateSlug' WHERE cateid = '$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Sửa " . $cateName . " thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }
    public function delete_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE cateid ='$id'";
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
        $query = "UPDATE tbl_category SET status = '1' WHERE cateid = '$id'";
        $result = $this->db->update($query);
        $alert = "Đã kích hoạt";
        return $alert;
    }
    public function deactivate($id)
    {
        $query = "UPDATE tbl_category SET status = '0' WHERE cateid = '$id'";
        $result = $this->db->update($query);
        $alert = "Đã huỷ kích hoạt";
        return $alert;
    }
    public function get_cate_name($id){
        $query = "SELECT * FROM tbl_category WHERE cateid = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}

?>
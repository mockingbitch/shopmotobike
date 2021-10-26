<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

class admin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_user($data)
    {
        if ($data['pass'] != $data['confirmpass']) {
            $alert = "Passwords does not match";
            return $alert;
        } elseif (strlen($data['name']) > 50) {
            $alert = "Your name must be less than 50 characters";
            return $alert;
        } else {
            $email = $this->fm->validation($data['email']);
            $name = $this->fm->validation($data['name']);
            $pass = $this->fm->validation($data['pass']);
            $permission = $this->fm->validation($data['permission']);
            $pass = mysqli_real_escape_string($this->db->link, $pass);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $name = mysqli_real_escape_string($this->db->link, $name);
            $permission = mysqli_real_escape_string($this->db->link, $permission);
            $vkey = md5(time() . $email);
            $pass = md5($pass);
            if (empty($email) || empty($name) || empty($pass)) {
                $alert = "Fields must be not empty";
                return $alert;
            } elseif ($permission <= 1 || $permission > 3) {
                $alert = "Permission is incorrect";
                return $alert;
            } else {
                $querycheck = "SELECT * FROM tbl_adminprofile ORDER BY id DESC";
                $resultcheck = $this->db->select($querycheck);
                if ($resultcheck) {
                    $valuecheck = $resultcheck->fetch_assoc();
                    if ($valuecheck['adminUser'] == $email) {
                        $alert = "<span class='success' style = 'color:red; font-weight:bold'>Email đã tồn tại</span>";
                        return $alert;
                    } else {
                        $queryuserinfo = "INSERT INTO tbl_adminprofile(adminUser,adminName) VALUES('$email','$name')";
                        $resultuserinfo = $this->db->insert($queryuserinfo);
                        $query = "INSERT INTO tbl_admin(adminUser,adminPass,adminName,vkey,permission)
                        VALUES ('$email','$pass','$name','$vkey','$permission')";
                        $result = $this->db->insert($query);
                        if ($result) {
                            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Thêm " . $name . " thành công</span>";
                            return $alert;
                        } else {
                            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                            return $alert;
                        }
                    }

                }
            }
        }


    }

    public function show_user()
    {
        $query = "SELECT * FROM tbl_admin ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delete_user($id, $data)
    {
        $name = $data['adminUser'];
        $query1 = "SELECT * FROM tbl_admin WHERE adminUser = '$name' LIMIT 1";
        $result1 = $this->db->select($query1);
        $value1 = $result1->fetch_assoc();
        $query2 = "SELECT * FROM tbl_admin WHERE id = '$id' LIMIT 1";
        $result2 = $this->db->select($query2);
        $value2 = $result2->fetch_assoc();
        $nameprofile = $value2['adminUser'];
//        $query3 = "SELECT * FROM tbl_adminprofile WHERE adminUser = '$nameprofile' LIMIT 1";
//        $result3 = $this->db->select($query3);
//        $value3 = $result3->fetch_assoc();
//        $deletename = $value3['adminUser'];
        if ($value1['permission'] >= $value2['permission']) {
            $alert = "<span style='color: red'>Bạn không thể xoá tài khoản có phân quyền ngang hàng hoặc trên bạn.</span>";
            return $alert;
        } else {
            $query = "DELETE FROM tbl_admin WHERE id ='$id'";
            $result = $this->db->delete($query);
            $query1 = "DELETE FROM tbl_adminprofile WHERE adminUser ='$nameprofile'";
            $result1 = $this->db->delete($query1);
            if ($result) {
                $alert = "<span class='success' style = 'color:green; font-weight:bold'>Xoá thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
                return $alert;
            }
        }
    }

    public function show_info($nameSession)
    {
        $user = $nameSession;
//      $query = "SELECT u.*,a.* FROM tbl_adminprofile as u, tbl_admin as a
//                WHERE u.adminUser = a.adminUser AND a.adminUser = '$user' ";
        $query = "SELECT * FROM tbl_adminprofile WHERE adminUser = '$user' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_info($user, $data, $files)
    {
        $adminUser = $user;
        $description = $this->fm->validation($data['description']);
        $website = $this->fm->validation($data['website']);
        $github = $this->fm->validation($data['github']);
        $twitter = $this->fm->validation($data['twitter']);
        $instagram = $this->fm->validation($data['instagram']);
        $facebook = $this->fm->validation($data['facebook']);
        $phone = $this->fm->validation($data['phone']);
        $address = $this->fm->validation($data['address']);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $website = mysqli_real_escape_string($this->db->link, $website);
        $github = mysqli_real_escape_string($this->db->link, $github);
        $twitter = mysqli_real_escape_string($this->db->link, $twitter);
        $instagram = mysqli_real_escape_string($this->db->link, $instagram);
        $facebook = mysqli_real_escape_string($this->db->link, $facebook);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['img']['name'];
        $file_size = $_FILES['img']['size'];
        $file_temp = $_FILES['img']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../admin/uploads/adminavatar/" . $unique_image;
        if (!empty($file_name)) {
            if ($file_size > 20480000) {
                $alert = "<span class='error'>Image size should be less than 2MB!</span>";
                return $alert;
            } elseif (in_array($file_ext, $permited) == false) {
                $alert = "<span class='error'>You can upload only:" . implode(',', $permited) . " </span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_adminprofile SET description = '$description',
                    website = '$website',
                    github = '$github',
                    twitter = '$twitter',
                    instagram = '$instagram',
                    facebook = '$facebook',
                    phone = '$phone',
                    address = '$address',
                    img = '$unique_image'
                    WHERE adminUser = '$adminUser'
                    ";

            }

        } else {
            $query = "UPDATE tbl_adminprofile SET description = '$description',
                    website = '$website',
                    github = '$github',
                    twitter = '$twitter',
                    instagram = '$instagram',
                    facebook = '$facebook',
                    phone = '$phone',
                    address = '$address'
                    WHERE adminUser = '$adminUser'
                    ";

        }

        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='success' style = 'color:green; font-weight:bold'>Sửa profile thành công</span>";
            return $alert;
        } else {
            $alert = "<span class='error' style = 'color:red; font-weight:bold'>Thất bại</span>";
            return $alert;
        }
    }
}
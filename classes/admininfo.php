<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
class admininfo
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function show_info($nameSession){
        $user = $nameSession;
//      $query = "SELECT u.*,a.* FROM tbl_adminprofile as u, tbl_admin as a
//                WHERE u.adminUser = a.adminUser AND a.adminUser = '$user' ";
        $query = "SELECT * FROM tbl_adminprofile WHERE adminUser = '$user' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}

<?php include 'include/sidebar.php' ?>
<?php include '../classes/xe.php'; ?>
<?php
$xe = new xe();

if(isset($_GET['xoaid'])) {
    $id = $_GET['xoaid'];
    $xoa = $xe->xoa_xe($id);
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Danh sách xe</h3>
            <button class="btn btn-primary"><a href="themxe.php" style="color: white">Thêm xe</a></button>
            <?php
            if(isset($xoa)){
                echo $xoa;
            }
            ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên xe</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $show_xe = $xe->show_xe();
                if ($show_xe) {
                    $i = 0;
                    while ($result= $show_xe->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $result['idxe']; ?></td>
                            <td><?php echo $result['tenxe']; ?></td>
                            <td><?php echo $result['gia']; ?></td>
                            <td><?php echo $result['soluong']; ?></td>
                            <td><img style=" border-radius: 3% !important;" src="/admin/uploads/<?php echo $result['hinhanh']; ?>" width="100px" alt=""></td>
                            <td align="left"><a href="suahangxe.php?suaid=<?php echo $result['idhangxe']; ?>"><img width="25" src="images/edit.png" alt=""></a></td>
                            <td align="left"><a onclick="return confirm('Bạn muốn xoá mục này?');" href="?xoaid=<?php echo $result['idhangxe']; ?>"><img width="25" src="images/delete.png" alt=""></a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
<?php include 'include/sidebar.php' ?>
<?php
include '../classes/xe.php';
include '../classes/hangxe.php';
$xe = new xe();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['them'])){
    $tenxe = $_POST['tenxe'];
    $gia = $_POST['gia'];
    $soluong = $_POST['soluong'];
    $mota = $_POST['mota'];
    $tenhangxe = $_POST['tenhangxe'];
    $themxe = $xe->them_xe($tenxe,$gia,$soluong,$mota,$tenhangxe,$_FILES);
}
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: green">Thêm xe</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title"> <small><span><?php
                                            if(isset($themxe)){
                                                echo $themxe;
                                            }
                                            ?></span></small></h3>

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="" method="POST" enctype="multipart/form-data">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="menu">Tên xe</label>
                                        <input type="text" name="tenxe" class="form-control" id="menu"
                                               placeholder="Nhập tên xe">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="menu">Giá xe</label>
                                        <input type="number" name="gia" class="form-control"
                                               placeholder="Nhập giá">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="menu">Số lượng xe</label>
                                        <input type="number" name="soluong" class="form-control"
                                               placeholder="Nhập số lượng">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="menu"> Mô tả</label>
                                        <textarea name="mota" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="menu">Hình ảnh</label>
                                        <input type="file" name="hinhanh" class="form-control"
                                               placeholder="Nhập hình ảnh">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="menu">Hãng:</label>
                                    <select name="tenhangxe" style="width:50%;height:50px;margin-left:17px " class="select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        <option>-----------Chọn hãng---------</option>
                                        <?php
                                        include "../classes/category.php";
                                        $hangxe = new hangxe();
                                        $show = $hangxe->show_hangxe();
                                        if($show){
                                            while($result=$show->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo $result['idhangxe']; ?>"><?php echo $result['tenhangxe']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="them" class="btn btn-primary">Thêm</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<?php include 'include/footer.php' ?>
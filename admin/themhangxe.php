<?php include 'include/sidebar.php' ?>
<?php
include '../classes/hangxe.php';
$hangxe = new hangxe();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['them'])){
    $tenhangxe = $_POST['tenhangxe'];
    $themhangxe = $hangxe->them_hangxe($tenhangxe);
}
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: green">Thêm hãng xe</h1>
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
                                            if(isset($themhangxe)){
                                                echo $themhangxe;
                                            }
                                            ?></span></small></h3>

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="" method="POST">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="menu">Tên hãng xe</label>
                                        <input type="text" name="tenhangxe" class="form-control" id="menu"
                                               placeholder="Nhập tên thương hiệu">
                                    </div>
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
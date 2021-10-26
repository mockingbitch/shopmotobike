<?php include 'include/sidebar.php' ?>
<?php
include '../classes/hangxe.php';
$hangxe = new hangxe();
if(!isset($_GET['suaid']) || $_GET['suaid'] == NULL) {
    echo "<script>window.location='danhsachhangxe.php'</script>";
}
else{
    $id = $_GET['suaid'];
}
if($_SERVER['REQUEST_METHOD'] =='POST'){
$tenhangxe = $_POST['tenhangxe'];
    $sua = $hangxe->sua_hangxe($tenhangxe,$id);
}
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: green">Sửa hãng xe</h1>
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
                                            if(isset($sua)){
                                                echo $sua;
                                            }
                                            ?></span></small></h3>

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="" method="POST">

                                <div class="card-body">
                                    <?php
                                    $show_hangxe = $hangxe->show_id($id);
                                        if ($show_hangxe){
                                            while ($result = $show_hangxe->fetch_assoc()){
                                    ?>
                                    <div class="form-group">
                                        <label for="menu">Tên hãng xe</label>
                                        <input type="text" name="tenhangxe" class="form-control" id="menu"
                                               value="<?php echo $result['tenhangxe'] ?>">
                                    </div>
                                                <?php
                                            }
                                        }?>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="them" class="btn btn-primary">Sửa</button>
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
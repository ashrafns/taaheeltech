<?php session_start();
include('config.php');
include('functuins.php');

$breadcrumb_array = array(
        "لوحة التحكم",
        "إدارة الصور",
        "نعديل بيانات صورة");
include('header.php'); 
?>
<?php
if(isset($_POST['save_form']) && !empty($_POST['save_form']))
{

	// upload files
	$expensions = array("jpg","png","jpeg");
	if(isset($_FILES['data']['name']) && $_FILES['data']['name'] !=""){
		$photo_image = upload_file($_FILES['data'],$expensions,"photo_","صورة الصورة");
        $imga_sql = ",photo_img='". $photo_image ."'";
	} else {
		$imga_sql = "";
	}

	$photo_name = input_secure($_POST['photo_name']);
	$photo_type = input_secure($_POST['photo_type']);
	if(isset($_POST['pvalid']) && !empty($_POST['pvalid']))
	{
		$pvalid = 1;
	} else {
		$pvalid = 0 ;
	}
    $photo_id = input_secure($_POST['photo_id']);

	// Edit Row
	mysqli_query($conn,"update ". $sql_insert_ignore ." photos set photo_name='". $photo_name ."',photo_type='". $photo_type ."',pvalid='". $pvalid ."',photo_order='1'". $imga_sql ." WHERE id='". $photo_id ."'");
	?>
	<script language="javascript">window.location.href="photos.php";</script>
<?php
} else {

    if(isset($_GET['photo_id']) && !empty($_GET['photo_id'])) {
        $photo_id = input_secure($_GET['photo_id']);

        $sqtstmnt = "SELECT * from photos WHERE id='". $photo_id ."'";
        $result = mysqli_query($conn,$sqtstmnt);

        $cats_num = mysqli_num_rows($result);
        if(isset($cats_num) && $cats_num > 0) {
            
            $row = mysqli_fetch_array($result);
    ?>
            <!--begin::Dashboard-->
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">
                            إضافة صورة جديد
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post" action="photos_update.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">اسم الصورة</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <input name="photo_name" id="photo_name" type="text" class="form-control" value="<?php echo $row['photo_name']; ?>" placeholder=""/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">صورة</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="data" id="data">
                                            <label class="custom-file-label" for="data"> Choose file </label>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($row['photo_img'])) { ?> 
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">الصورة الحالية</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <a href='<?php echo $row['photo_img']; ?>' target="_blank"><img src='<?php echo $row['photo_img']; ?>' style="max-width: 50px;"></a>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">التصنيف</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <select name="photo_type" id="photo_type" class="form-control form-control-solid">
                                            <?php
                                                $sql = mysqli_query($conn,"SELECT * from category where cat_type=2 ");
                                                while($row_cat = mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row_cat['id'] ;?>" <?php if($row_cat['id']==$row['photo_type']){echo 'selected';} ?>><?php echo $row_cat['cat_name'];?></option>
                                                <?php    
                                                }                                           
                                                ?>
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">تفعيل</label>
                                    <div class="col-3">
                                        <span class="switch switch-icon">
                                            <label>
                                                <input type="checkbox" <?php if($row['pvalid'] == 1) {?> checked="checked" <?php } ?> name="pvalid" id="pvalid" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">
                                        <input type="hidden" id="save_form" name="save_form" value="1">
                                        <input type="hidden" id="photo_id" name="photo_id" value="<?php echo $photo_id; ?>">
                                        <button type="submit" class="btn btn-success mr-2">حفظ</button>
                                        <a href="photos.php" class="btn btn-secondary">إلغاء</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
            <!--end::Dashboard-->
    <?php 
        } else { 
            echo "لا يوجد صورة بقاعدة البيانات بهذا الرقم";
        }
    } else {
        echo "يجب تحديد رقم الصورة الذي ترغب في تعديل بياناته";
    }
}
include('footer.php'); 
?>
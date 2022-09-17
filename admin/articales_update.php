<?php session_start();
include('config.php');
include('functuins.php');

$breadcrumb_array = array(
        "لوحة التحكم",
        "إدارة المقالات",
        "نعديل بيانات مقال");
include('header.php'); 
?>
<?php
if(isset($_POST['save_form']) && !empty($_POST['save_form']))
{

	// upload files
	$expensions = array("jpg","png","jpeg");
	if(isset($_FILES['data']['name']) && $_FILES['data']['name'] !=""){
		$articale_image = upload_file($_FILES['data'],$expensions,"articale_","مقال المقال");
        $imga_sql = ",articale_img='". $articale_image ."'";
	} else {
		$imga_sql = "";
	}

	$articale_name = input_secure($_POST['articale_name']);
	$articale_type = input_secure($_POST['articale_type']);
    $aricale_text = input_secure($_POST['aricale_text']);
	if(isset($_POST['pvalid']) && !empty($_POST['pvalid']))
	{
		$pvalid = 1;
	} else {
		$pvalid = 0 ;
	}
    $articale_id = input_secure($_POST['articale_id']);

	// Edit Row
    $aricale_text = input_secure($_POST['aricale_text']);
	mysqli_query($conn,"update ". $sql_insert_ignore ." articales set articale_name='". $articale_name ."',aricale_text='". $aricale_text ."',articale_type='". $articale_type ."',pvalid='". $pvalid ."',articale_order='1'". $imga_sql ." WHERE id='". $articale_id ."'");
	?>
	<script language="javascript">window.location.href="articles.php";</script>
<?php
} else {

    if(isset($_GET['articale_id']) && !empty($_GET['articale_id'])) {
        $articale_id = input_secure($_GET['articale_id']);

        $sqtstmnt = "SELECT * from articales WHERE id='". $articale_id ."'";
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
                            إضافة مقال جديد
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post" action="articales_update.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">اسم المقال</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <input name="articale_name" id="articale_name" type="text" class="form-control" value="<?php echo $row['articale_name']; ?>" placeholder=""/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">مقال</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="data" id="data">
                                            <label class="custom-file-label" for="data"> Choose file </label>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($row['articale_img'])) { ?> 
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">المقال الحالية</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <a href='<?php echo $row['articale_img']; ?>' target="_blank"><img src='<?php echo $row['articale_img']; ?>' style="max-width: 50px;"></a>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">نص المقال</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <textarea name="aricale_text" id="aricale_text" class="form-control" cols="30" rows="10" value=""><?php echo $row['aricale_text']; ?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label text-right">التصنيف</label>
                                    <div class="col-lg-9 col-xl-4">
                                        <select name="articale_type" id="articale_type" class="form-control form-control-solid">
                                            <?php
                                                $sql = mysqli_query($conn,"SELECT * from category where cat_type=1 ");
                                                while($row_cat = mysqli_fetch_array($sql)){
                                            ?>
                                                <option value="<?php echo $row_cat['id'] ;?>" <?php if($row_cat['id']==$row['articale_type']){echo 'selected';} ?>><?php echo $row_cat['cat_name'];?></option>
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
                                        <input type="hidden" id="articale_id" name="articale_id" value="<?php echo $articale_id; ?>">
                                        <button type="submit" class="btn btn-success mr-2">حفظ</button>
                                        <a href="articles.php" class="btn btn-secondary">إلغاء</a>
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
            echo "لا يوجد مقال بقاعدة البيانات بهذا الرقم";
        }
    } else {
        echo "يجب تحديد رقم المقال الذي ترغب في تعديل بياناته";
    }
}
include('footer.php'); 
?>
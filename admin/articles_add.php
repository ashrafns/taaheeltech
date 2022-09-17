<?php session_start();
include('config.php');
include('functuins.php');

$breadcrumb_array = array(
        "لوحة التحكم",
        "إدارة المقالات",
        "إضافة مقال جديد");
include('header.php'); 


if(isset($_POST['save_form'])&& !empty($_POST['save_form'])){

    // upload files
	$expensions = array("jpg","png","jpeg");
	if(isset($_FILES['data']['name']) && $_FILES['data']['name'] !=""){
		$articale_image = upload_file($_FILES['data'],$expensions,"articale_","صورة المقال");
	} else {
		$articale_image = "";
	}

    $articale_name = input_secure($_POST['articale_name']);
    $articale_type = input_secure($_POST['articale_type']);
	$aricale_text = input_secure($_POST['aricale_text']);
    if(isset($_POST['pvalid'])&& !empty($_POST['pvalid'])){

        $pvalid = 1 ;
    }else{
        $pvalid = 0 ;
    }

    //add row
    $sql = "INSERT ".$sql_insert_ignore." articales SET 
    articale_name='$articale_name',
    articale_type='$articale_type',
	aricale_text='$aricale_text',
    pvalid='$pvalid',
    articale_img='$articale_image',
    articale_order='1'";

    mysqli_query($conn, $sql);
    
    //"INSERT".$sql_insert_ignore."articales SET articale_name='". $articale_name ."',articale_type='". $articale_type ."',pvalid'". $pvalid ."',articale_img='',articale_order='1'");
    ?>
        <script language="javascript">window.location.href="articles.php";</script>
    <?php
}else{
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
			<form class="form" method="post" action="" enctype="multipart/form-data">
				<div class="card-body">
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label text-right">اسم المقال</label>
						<div class="col-lg-9 col-xl-4">
							<input name="articale_name" id="articale_name" type="text" class="form-control" placeholder=""/>
						</div>
					</div> 
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label text-right">مقال</label>
						<div class="col-lg-9 col-xl-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="data" name="data">
                                <label class="custom-file-label" for="data"> Choose file </label>
                            </div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label text-right">نص المقال</label>
						<div class="col-lg-9 col-xl-4">
							<textarea name="aricale_text" id="aricale_text" class="form-control" cols="30" rows="10"></textarea>
						</div>
					</div> 
                    <div class="form-group row">
						<label class="col-lg-3 col-form-label text-right">التصنيف</label>
						<div class="col-lg-9 col-xl-4">
                            <select name="articale_type" id="articale_type" class="form-control form-control-solid">
                                <?php
                                    $articale_type = mysqli_query($conn,"SELECT * from category where cat_type = 1 ");
                                    while ($row_cat = mysqli_fetch_array($articale_type))
                                    {
                                        ?>
                                        <option value="<?php echo $row_cat['id'] ;?>"><?php echo $row_cat['cat_name'];?></option>
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
									<input type="checkbox" checked="checked" name="pvalid" id="pvalid"/>
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
}
include('footer.php'); 
?>
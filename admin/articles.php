<?php if(!isset($_SESSION)){session_start();}

if(isset($_SESSION['admin_role'])){

include('config.php');
include('functuins.php');
$breadcrumb_array = array(
    "لوحة التحكم",
    "إدارة المقالات" 
);
include('header.php'); 
if(isset($_GET['del_id']) && !empty($_GET['del_id'])) {
	$del_id = input_secure($_GET['del_id']);
	mysqli_query($conn,"DELETE FROM articales WHERE id='". $del_id ."'");
	?>
	<script language="javascript">window.location.href="articales.php";</script>
<?php
}
if(isset($_GET['articale_search']) && !empty($_GET['articale_search'])) {
    $articale_search = input_secure($_GET['articale_search']);
    $read = mysqli_query($conn,"SELECT * from articales WHERE articale_name LIKE '%". $articale_search ."%' ORDER BY ID ASC");
} else {
    $read = mysqli_query($conn,"SELECT * from articales ORDER BY ID ASC");
}
?>
<!--begin::Card-->
<div class="card card-custom">
	<div class="card-header">
		<div class="card-title">
			<h3 class="card-label">
            إدارة المقالات 
			</h3>
		</div>
		<div class="card-toolbar">
            <!--begin::Button-->
            <a href="articles_add.php" class="btn btn-primary font-weight-bolder">
    			إضافة مقال جديد
            </a>
            <!--end::Button-->
		</div>
	</div>
	<div class="card-body">
        <!--begin::Search Form-->
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="row align-items-center">
						<form id="search_frm" name="search_frm" action="">
							<div class="col-md-4 my-2 my-md-0">
								<div class="input-icon">
									<input type="text" class="form-control" placeholder="" id="articale_search" name="articale_search" />
									<button name="search" id="search" value="search" class="btn btn-primary font-weight-bolder">بحث </button>
								</div>
							</div>
							
						</form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Search Form-->
        <!--begin: Datatable-->
		<table class="table datatable-bordered datatable-head-custom">
			<thead>
				<tr>
					<th>ID</th>
                    <th>اسم المقال</th>
					<th>نص المقال</th>
                    <th>التصنيف</th>
                    <th>فعال</th>
                    <th>تعديل</th>
                    <th>حذف</th>
				</tr>
			</thead>
			<tbody>
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM articales order by id asc");
                    while($row=mysqli_fetch_array($result)){
                ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['articale_name']; ?></td>
					<td><?php echo $row['aricale_text']; ?></td>

                    <td>
                        <?php 
                            $row_cat = mysqli_fetch_array(mysqli_query($conn,"SELECT * from category where id = ".$row['articale_type']." "));
                            echo $row_cat['cat_name'];
                        ?>
                       </td>
                    <td><?php if($row['pvalid']==1) {echo "نعم";}else{echo "لا";} ?></td>
                    <td><a href="articales_update.php?articale_id=<?php echo $row['id']; ?>">تعديل</a></td>
                    <td><a href="articales.php?del_id=<?php echo $row['id'] ?>">حذف</a></td>
				</tr>
                <?php } ?>
                
			</tbody>
		</table>
		<!--end: Datatable-->
	</div>
</div>
<!--end::Card-->
<?php 
include('footer.php'); 
}else{
	?>
	<script language="javascript">window.location.href="index.php";</script>
	<?php
	}

?>
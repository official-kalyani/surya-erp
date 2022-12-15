<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>

<?php

if(isset($_POST['itemsbmt'])) // Add query
{
 $asset_type = $_POST['asset_type'];
 if($asset_type == 'Admin')
 {
   $assetcode = $_POST['asetcode'];
   $qu = "SELECT * FROM aset_stock_entry WHERE assetcode ='$assetcode' ORDER BY id DESC LIMIT 1";
   $qu_con = mysqli_query($con, $qu);

   if(mysqli_num_rows($qu_con) > 0)
   {
      $admin_qu = mysqli_query($con,"SELECT * FROM aset_stock_entry WHERE assetcode ='$assetcode' AND `asset_type`='Admin' ORDER BY id DESC LIMIT 1");
      $fetch_ser = mysqli_fetch_object($admin_qu);
      $ser_id = $fetch_ser->auto_serial;
      $diff_val= explode("-", $ser_id);
      $ser_id = array_values($diff_val)[1];
      $ser_id = $ser_id +1;
    }
  else{
    $ser_id = 1;
  }
                        // $string = "SIA0000";
  $auto_ser = $assetcode."-". $ser_id;

}
else
{
 $assetcode = '';

 $qu = "SELECT * FROM aset_stock_entry WHERE `asset_type`='User' ORDER BY id DESC LIMIT 1";
 $qu_con = mysqli_query($con, $qu);
 $fetch_ser = mysqli_fetch_object($qu_con);
 if(mysqli_num_rows($qu_con) > 0)
 {
  $ser_id = $fetch_ser->auto_serial;
  $ser_id = substr($ser_id,7);
                        // $ser_id = array_values($diff_val)[1];
  $ser_id = $ser_id +1;
}
else{
  $ser_id = 1;
}
$string = "SIA0000";
$auto_ser = $string . $ser_id;
}


$serial = $auto_ser;
$organisation = $_POST['org'];
$fullname = $_POST['itemname'];
$description = $_POST['itemdesc'];
$qty = $_POST['item_qty'];
$category = $_POST['asset_category'];
$sub_category = $_POST['asset_subcategory'];
// $sub_type = $_POST['itemtype'];




$sdate = $_POST['pdate'];
$inv_no = $_POST['att_doc_te'];
// $att_inv = $_POST['att_doc'];
$supplier = $_POST['supplier'];
$godown = $_POST['godown'];
$warrenty = $_POST['warrenty'];
$serial_no = $_POST['serial_no'];
$amount = $_POST['amount'];


$created_on = date('Y-m-d H:i:s');
$created_by = $_SESSION['ERP_SESS_ID'];
// echo $created_by;

// print_r($_POST);







$fname8 = pathinfo($_FILES['att_doc']['name'], PATHINFO_FILENAME);
// Returns Filename without extention  a
$exn8 = pathinfo($_FILES['att_doc']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att_doc']['name']=='') // Returns Filename without extention  a)
{ 
  $docs8 =  '';
}
else
{
  $docs8 = $fname8.'-'.time().'.'.$exn8;
}

$target = "attinv/";
$target = $target . $docs8;
$pic=($_FILES['att_doc']['name']);
if(move_uploaded_file($_FILES['att_doc']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att_doc']['name']). " has been uploaded, and your information has been added to the directory";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file.";
}

$fname6 = pathinfo($_FILES['warrenty_att']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn6 = pathinfo($_FILES['warrenty_att']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['warrenty_att']['name']=='') // Returns Filename without extention  a)
{ 
  $docs =  '';
}
else
{
  $docs6 = $fname6.'-'.time().'.'.$exn6;
}
// $docs6 = $fname6.'-'.time().'.'.$exn6;
$target5 = "attwar/";
$target = $target5 . $docs6;
$pic=($_FILES['warrenty_att']['name']);
if(move_uploaded_file($_FILES['warrenty_att']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['warrenty_att']['name']). " has been uploaded, and your information has been added to the directory of warrenty";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of warrenty.";
}



$c_db = "INSERT INTO `aset_stock_entry` (`organisation`,`asset_type`,`assetcode`, `auto_serial`, `item_name`,`aset_category`,`aset_subcatagory`, `description`, `qty`, `sub_type_id`, `date_purchase`, `inv_no`, `att_inv`, `supplier`, `godowo`, `warrenty`, `att_war`, `serial_no`, `amount`, `created_on`, `status`, `created_by`) VALUES ('$organisation','$asset_type','$assetcode', '$serial','$fullname','$category','$sub_category',  '$description', '$qty', '$sub_type', '$sdate', '$inv_no','$docs8', '$supplier', '$godown', '$warrenty','$docs6', '$serial_no','$amount', '$created_on', '1', '$created_by')";
$db = mysqli_query($con, $c_db);
// echo "INSERT INTO `aset_stock_entry` (`organisation`,`asset_type`,`assetcode`, `auto_serial`, `item_name`,`aset_category`,`aset_subcatagory`, `description`, `qty`, `sub_type_id`, `date_purchase`, `inv_no`, `att_inv`, `supplier`, `godowo`, `warrenty`, `att_war`, `serial_no`, `amount`, `created_on`, `status`, `created_by`) VALUES ('$organisation','$asset_type','$assetcode', '$serial','$fullname','$category','$sub_category',  '$description', '$qty', '$sub_type', '$sdate', '$inv_no','$docs8', '$supplier', '$godown', '$warrenty','$docs6', '$serial_no','$amount', '$created_on', '1', '$created_by')";exit;
$last_id = mysqli_insert_id($con);
//echo $last_id;
$qut = mysqli_query($con,"SELECT x.*, y.*, z.subtypenm  FROM  aset_stock_entry  x, aset_item_creation  y, fin_grouping_subtype  z WHERE x.id =' $last_id' AND x.item_name = '$fullname' AND x.item_name = y.id AND y.sub_type = z.id");
$ftch_dtl = mysqli_fetch_object($qut);
$subtype = $ftch_dtl->sub_type;
if($ftch_dtl->sub_type == '6'){
  $rc_name = $_POST['rc_name'];
  $chasis_no = $_POST['chasis_no'];
  $engine_no = $_POST['engine_no'];
  $rc_date = $_POST['cdate'];

  $valid_rc = $_POST['valid'];
  $ins_no = $_POST['ins_no'];
  $valid_ins = $_POST['valid_ins'];
  $poc_no = $_POST['pocc_no'];
  $maintain = $_POST['maintainance'];
  $pc_date = $_POST['valid_poc'];
  $created_on = date('Y-m-d');
  $ins_comp = $_POST['ins_com'];

$fname4 = pathinfo($_FILES['att']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn4 = pathinfo($_FILES['att']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att']['name']=='') // Returns Filename without extention  a)
{ 
  $docs4 =  '';
}
else
{
  $docs4 = $fname4.'-'.time().'.'.$exn4;
}
// $docs4 = $fname4.'-'.time().'.'.$exn4;
$target2 = "ve_rc/";
$target = $target2 . $docs4 ;
$pic=($_FILES['att']['name']);
if(move_uploaded_file($_FILES['att']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att']['name']). " has been uploaded, and your information has been added to the directory of RC name";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of RC name.";
}


$fname2 = pathinfo($_FILES['att_ins']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn2 = pathinfo($_FILES['att_ins']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att_ins']['name'] == '')
{
  $docs3 =  '';
}
else
{
  $docs3 = $fname2.'-'.time().'.'.$exn2;

}
$target3 = "ve_ins/";
$target = $target3 . $docs3;
$pic=($_FILES['att_ins']['name']);
if(move_uploaded_file($_FILES['att_ins']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att_ins']['name']). " has been uploaded, and your information has been added to the directory of ins";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of ins.";
}


$fname3 = pathinfo($_FILES['att_poc']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn3 = pathinfo($_FILES['att_poc']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att_poc']['name'] == '')
{
  $docs5 =  '';
}
else
{
  $docs5 = $fname3.'-'.time().'.'.$exn3;
}

$target4 = "ve_poc/";
$target = $target4 . $docs5;

$pic=($_FILES['att_poc']['name']);
if(move_uploaded_file($_FILES['att_poc']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att_poc']['name']). " has been uploaded, and your information has been added to the directory of poc";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of poc.";
}
$sql1 = "INSERT INTO `aset_stock_entry_vechile` (`name_id`, `rc_name`,`chasis`, `engie`, `rc_date`, `rc_valid`,`rc_file`,`ins_no`, `ins_valid`,`ins_file`,`ins_comp`, `poc_no`, `poc_valid`, `poc_file`, `maintain`, `date`) VALUES ('$last_id','$rc_name', '$chasis_no', '$engine_no', '$rc_date', '$valid_rc', '$docs4', '$ins_no','$valid_ins', '$docs3', '$ins_comp', '$poc_no', '$pc_date', '$docs5','$maintain', '$created_on')";
if(isset($_POST['ins_no']))
{

  $query = mysqli_query($con,"INSERT INTO `aset_update_ins` (`name_id`, `date`,`valid_date`,`ins_comp`, `attach`,`status`) VALUES ('$last_id','$created_on', '$valid_ins','$ins_comp', '$docs3','1')");
  $query1 = mysqli_query($con,"INSERT INTO `aset_poc_update` (`name_id`, `date`,`valid_date`, `attach`,`status`) VALUES ('$last_id','$created_on', '$valid_ins', '$docs5','1')");
}
// echo "INSERT INTO `aset_stock_entry_vechile` (`name_id`, `rc_name`,`chasis`, `engie`, `rc_date`, `rc_valid`,`rc_file`,`ins_no`, `ins_valid`,`ins_file`, `poc_no`, `poc_valid`, `poc_file`, `maintain`) VALUES ('$last_id','$rc_name', '$chasis_no', '$engine_no', '$rc_date', '$valid_rc', '$docs4', '$ins_no','$valid_ins', '$docs3', '$poc_no', '$pc_date', '$docs5','$maintain')";

$query2 = mysqli_query($con, $sql1);
$vechile_id = mysqli_insert_id($con);

if($maintain == '2'){
  $duration = $_POST['duration'];
  $days_interval = $_POST['days_interval'];
// $or = $_POST['or'];
// $qty_req = $_POST['QTY'];
  $kms_interval = $_POST['km_interval'];
  $present_reading_date = $_POST['present_reading'];

  $sql2 = "INSERT INTO `aset_stock_entry_maintain` (`name_id`,`vechile_id`,`duration`,`days_interval`, `km_interval`, `present_reading_date`) VALUES ('$last_id','$vechile_id','$duration', '$days_interval', '$kms_interval', '$present_reading_date')";
  $query1 = mysqli_query($con, $sql2);
// echo "INSERT INTO `aset_stock_entry_maintain` (`name_id`,`vechile_id`,`duration`,`days_interval`, `km_interval`, `present_reading_date`) VALUES ('$last_id','$vechile_id','$duration', '$days_interval', '$kms_interval', '$present_reading_date')";


}
}

$vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '$subtype' "); 

while($ftch = mysqli_fetch_object($vet))
{
  $entry = $ftch->feild_name;
  $enter = $ftch->id;
  $entry  = str_replace(' ', '_', $entry);
  $ab = $_POST[$entry];

  
  $query = "INSERT INTO `aset_stock_entry_other` (`feild_id`,`feild_name`, `stock_entry_id`, `value`) VALUES ('$subtype',' $enter', '$last_id', '$ab')";
  $sql = mysqli_query($con, $query);


}


if($db){
  $msg="Stock entered successfully";
  header("Location: stock_entry.php?msg=$msg");

}
else {
 $msgel="Unsuccessfull in entering field...retry again";
}

}
if(isset($_GET['id']))
{
  $id = $_GET['id'];
  if(isset($_POST['upreqsubmit']))
  {
   $organisation = $_POST['org'];
   $fullname = $_POST['itemname'];
   $description = $_POST['itemdesc'];
   $qty = $_POST['item_qty'];
   $category = $_POST['asset_category'];
   $sub_category = $_POST['asset_subcategory'];
// $sub_type = $_POST['itemtype'];

   $sdate = $_POST['pdate'];
   $inv_no = $_POST['att_doc_te'];
// $att_inv = $_POST['att_doc'];
   $supplier = $_POST['supplier'];
   $godown = $_POST['godown'];
   $warrenty = $_POST['warrenty'];
   $serial_no = $_POST['serial_no'];
   $amount = $_POST['amount'];


   $created_on = date('Y-m-d H:i:s');
   $created_by = $_SESSION['ERP_SESS_ID'];
   if(isset($_FILES['att_doc']))
   {
    $fname8 = pathinfo($_FILES['att_doc']['name'], PATHINFO_FILENAME);
// Returns Filename without extention  a
$exn8 = pathinfo($_FILES['att_doc']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att_doc']['name']=='') // Returns Filename without extention  a)
{ 
  $docs8 =  '';
}
else
{
  $docs8 = $fname8.'-'.time().'.'.$exn8;
}

$target = "attinv/";
$target = $target . $docs8;
$pic=($_FILES['att_doc']['name']);
if(move_uploaded_file($_FILES['att_doc']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att_doc']['name']). " has been uploaded, and your information has been added to the directory";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file.";
}
$update_file4 =  mysqli_query($con,"UPDATE `aset_stock_entry` SET `att_inv` = '$docs8' WHERE `id`='$id'");

}
else if(isset($_FILES['warrenty_att']))
{
$fname6 = pathinfo($_FILES['warrenty_att']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn6 = pathinfo($_FILES['warrenty_att']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['warrenty_att']['name']=='') // Returns Filename without extention  a)
{ 
  $docs6 =  '';
}
else
{
  $docs6 = $fname6.'-'.time().'.'.$exn6;
}
// $docs6 = $fname6.'-'.time().'.'.$exn6;
$target5 = "attwar/";
$target = $target5 . $docs6;
$pic=($_FILES['warrenty_att']['name']);
if(move_uploaded_file($_FILES['warrenty_att']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['warrenty_att']['name']). " has been uploaded, and your information has been added to the directory of warrenty";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of warrenty.";
}
$update_file4 =  mysqli_query($con,"UPDATE `aset_stock_entry` SET `att_war` = '$docs6' WHERE `id`='$id'");

}
// echo $created_by;

// print_r($_POST);





$update = mysqli_query($con,"UPDATE `aset_stock_entry` SET `organisation`='$organisation',`aset_category`='$category',`aset_subcatagory`='$sub_category',`description`='$description',`date_purchase`='$sdate',`inv_no` = '$inv_no',`supplier` = '$supplier',`godowo`='$godown',`warrenty`='$warrenty',`serial_no`='$serial_no',`amount` = '$amount' WHERE `id` = '$id' ORDER BY id DESC LIMIT 1");
$qut = mysqli_query($con,"SELECT x.*, y.*  FROM  aset_stock_entry  x, aset_item_creation  y, fin_grouping_subtype  z WHERE x.id =' $id' AND x.item_name = y.id AND y.sub_type = z.id");
$ftch_dtl = mysqli_fetch_object($qut);

$subtype = $ftch_dtl->sub_type;
if($ftch_dtl->sub_type == '6')
{
  $rc_name = $_POST['rc_name'];
  $chasis_no = $_POST['chasis_no'];
  $engine_no = $_POST['engine_no'];
  $rc_date = $_POST['cdate'];

  $valid_rc = $_POST['valid'];
  $ins_no = $_POST['ins_no'];
  $valid_ins = $_POST['valid_ins'];
  $poc_no = $_POST['pocc_no'];
  $maintain = $_POST['maintainance'];
  $pc_date = $_POST['valid_poc'];
  $created_on = date('Y-m-d');
  $ins_comp = $_POST['ins_com'];

// if(isset($_FILES['att']))
// {
$fname4 = pathinfo($_FILES['att']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn4 = pathinfo($_FILES['att']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att']['name']=='') // Returns Filename without extention  a)
{ 
  $docs4 = $_POST['att'];
}
else
{
  $docs4 = $fname4.'-'.time().'.'.$exn4;
}
// $docs4 = $fname4.'-'.time().'.'.$exn4;
$target2 = "ve_rc/";
$target = $target2 . $docs4 ;
$pic=($_FILES['att']['name']);
if(move_uploaded_file($_FILES['att']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att']['name']). " has been uploaded, and your information has been added to the directory of RC name";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of RC name.";
}
// $update_file1 =  mysqli_query($con,"UPDATE `aset_stock_entry_vechile` SET `rc_file` = '$docs4' WHERE `name_id`='$id'");
// }
// else if(isset($_FILES['att_ins']))
// {
$fname2 = pathinfo($_FILES['att_ins']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn2 = pathinfo($_FILES['att_ins']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att_ins']['name'] == '')
{
  $docs3 =  $_POST['att_ins'];
}
else
{
  $docs3 = $fname2.'-'.time().'.'.$exn2;

}
$target3 = "ve_ins/";
$target = $target3 . $docs3;
$pic=($_FILES['att_ins']['name']);
if(move_uploaded_file($_FILES['att_ins']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att_ins']['name']). " has been uploaded, and your information has been added to the directory of ins";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of ins.";
}
// $update_file2 =  mysqli_query($con,"UPDATE `aset_stock_entry_vechile` SET `ins_file` = '$docs3' WHERE `name_id`='$id'");




$fname3 = pathinfo($_FILES['att_poc']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
$exn3 = pathinfo($_FILES['att_poc']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
if($_FILES['att_poc']['name'] == '')
{
  $docs5 =  $_POST['att_poc'];
}
else
{
  $docs5 = $fname3.'-'.time().'.'.$exn3;
}

$target4 = "ve_poc/";
$target = $target4 . $docs5;

$pic=($_FILES['att_poc']['name']);
if(move_uploaded_file($_FILES['att_poc']['tmp_name'], $target)) {
    //Tells you if its all ok
  echo "The file ". basename( $_FILES['att_poc']['name']). " has been uploaded, and your information has been added to the directory of poc";
} else {
    //Gives and error if its not
  echo "Sorry, there was a problem uploading your file of poc.";
}
// $update_file3 =  mysqli_query($con,"UPDATE `aset_stock_entry_vechile` SET `poc_file` = '$docs5' WHERE `name_id`='$id'");
// echo"UPDATE `aset_stock_entry_vechile` SET `poc_file` = '$docs5' WHERE `name_id`='$id'";

// exit();

$update_vechile = mysqli_query($con,"UPDATE `aset_stock_entry_vechile` SET `rc_name`='$rc_name',`chasis`='$chasis_no',`engie`='$engine_no',`rc_date` = '$rc_date',`rc_valid` = '$valid_rc',`ins_no`='$ins_no',`ins_valid`='$valid_ins',`ins_comp`='$ins_comp',`poc_no`='$poc_no',`poc_valid`='$pc_date',`maintain`= '$maintain',`rc_file`='$docs4',`ins_file` = '$docs3',`poc_file`='$docs5' WHERE `name_id` = '$id' ");


$update_file_ins =  mysqli_query($con,"UPDATE `aset_update_ins` SET `attach` = '$docs3',`ins_comp` = '$ins_comp' WHERE `name_id`='$id' ORDER BY id ASC LIMIT 1");
$update_file_poc =  mysqli_query($con,"UPDATE `aset_poc_update` SET `attach` = '$docs5' WHERE `name_id`='$id' ORDER BY id ASC LIMIT 1");


if($maintain == '2')
{
  $up_query = mysqli_query($con,"SELECT * FROM `aset_stock_entry_vechile` WHERE `name_id` = '$id'");
  $up_query_data = mysqli_fetch_object($up_query);
  $vec_id = $up_query_data->id;
  echo $vec_id;
  $duration = $_POST['duration'];
// $days_interval = $_POST['days_interval'];
// $or = $_POST['or'];
// $qty_req = $_POST['QTY'];
  $kms_interval = $_POST['km_interval'];
// $present_reading_date = $_POST['present_reading'];
  $query_maintain = mysqli_query($con,"SELECT * FROM `aset_stock_entry_maintain` WHERE `status` = '1' And `vechile_id` = '$vec_id'");
  if(mysqli_num_rows($query_maintain) >0)
  {
    $update_maintain = mysqli_query($con,"UPDATE `aset_stock_entry_maintain` SET `duration`='$duration',`km_interval`='$kms_interval' WHERE `vechile_id` = '$vec_id'");
  }
  else{
    $update_maintain = mysqli_query($con,"INSERT INTO `aset_stock_entry_maintain` (`duration`,`km_interval`,`vechile_id`,`name_id`) VALUES ('$duration',' $kms_interval','$vec_id','$id')");

  }
}
}

$query_feild = mysqli_query($con,"SELECT x.*,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name= y.id AND x.id = '$id'");
$vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '$subtype' "); 

while($ftch = mysqli_fetch_object($vet))
{
  $entry = $ftch->feild_name;
  $enter = $ftch->id;
  $entry  = str_replace(' ', '_', $entry);
  $ab = $_POST[$entry];

  $query_select = mysqli_query($con,"SELECT * FROM `aset_stock_entry_other` WHERE `feild_name` = $enter AND `stock_entry_id` = '$id'");
  if (mysqli_num_rows($query_select)>0) {


    $query = "UPDATE `aset_stock_entry_other` SET `value`='$ab' WHERE `stock_entry_id` = '$id' AND `feild_name` = $enter";
    $sql = mysqli_query($con, $query);
  }
  else{


    $query = "INSERT INTO `aset_stock_entry_other` (`feild_id`,`feild_name`, `stock_entry_id`, `value`) VALUES ('$subtype',' $enter', '$id', '$ab')";
    $sql = mysqli_query($con, $query);
  }
  // echo "UPDATE `aset_stock_entry_other` SET `value`='$ab' WHERE `stock_entry_id` = '$id' AND `feild_name` = $enter";


}
 // exit();
if($update){
  $msg="Stock updated  successfully";
  header("Location: stock_entry.php?msg=$msg&id=$id");

}
else {
 $msgel="Unsuccessfull in updating field...retry again";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Add Asset Item Stock : Suryam Group</title>

  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="../../css/metisMenu.min.css" rel="stylesheet">

  <!-- Timeline CSS -->
  <link href="../../css/timeline.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../../css/startmin.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="../../css/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.../../js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- jQuery -->
      <script src="../../js/jquery.min.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="../../js/bootstrap.min.js"></script>

      <link rel="shortcut icon" href="../../images/favicon.png" />

      <!-- Calendar -->
<!-- <script type="text/javascript" src="../../calendar/datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="../../calendar/datepicker.css"/> -->
  <!-- //Calendar -->

  <!-- Used For Auto Typing Search -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />    
  <!-- // Used For Auto Typing Search-->    

  <!--Clock-->
  <script src="../../js/clock.js" type="text/javascript"></script>
  <!--//Clock-->
  <!-- DATETIMEPICKER CDNs -->

  <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

  <!-- DATETIMEPICKER CDNs -->





</head>
<body>

  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

     <?php require_once('../../header.php'); // include Header Portion ?>

     <?php require_once('../../menu.php'); // include Menu Portion ?>

   </nav>
   <div id="page-wrapper">
     <div class="row">
      <div class="col-lg-12">
        <h4 class="page-header">Stock Entry</h4>
        <span><button onClick='javascript:location.href="stock_view.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
        </span>
        <?php if(isset($_GET['msg'])) { 
         $msg = $_GET['msg'];
         echo "<i style=color:#33D15B;>".$msg."</i>";
       } ?>
       <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 

     </div>
     <!-- /.col-lg-12 -->
   </div>
   <div class="row">

    <form name="form" method="post" class="forms-sample" enctype="multipart/form-data">
      <?php
      if(isset($_GET['id']))
      {
        $id = $_GET['id'];
        $idquery = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  id = '$id'");
        $id_fetch = mysqli_fetch_object($idquery);
        $category = $id_fetch->aset_category; 
        $subcategory = $id_fetch->aset_subcatagory;

        ?>
        <input type="hidden" name="cat_name" id="cat_name" value="<?php echo $category;?>">
        <input type="hidden" name="subcat_name" id="subcat_name" value="<?php echo $subcategory;?>">
        <?php
      }
      ?>
      <fieldset>
        <legend><h5><b>&nbsp;</b></h5></legend>  
        <div class="input_fields_wrap">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="itemname">Organisation:</label>
              <select name="org" id="org" class="form-control" >
                <option value=''>Type to Select Organisation</option>
                <?php
                if(isset($_GET['id']))
                {
                  $org = $id_fetch->organisation;
                  $org_name = mysqli_query($con,"SELECT * FROM `prj_organisation` WHERE `status`='1'");
                  while($org_name_fetch = mysqli_fetch_object($org_name))
                  {
                    if($org_name_fetch->id == $org)
                    {
                      echo '<option value="'. $org_name_fetch->id . '" selected >' . $org_name_fetch->organisation .'</option>';
                    }
                    else{
                     echo '<option value="'. $org_name_fetch->id . '">' . $org_name_fetch->organisation .'</option>';
                   }
                 }
               }
               else{
                $eq = "SELECT * FROM `prj_organisation` WHERE `status`='1'";
                $efq=mysqli_query($con,$eq); 

                while ($egq = mysqli_fetch_object($efq))
                { 
                  echo '<option value="'. $egq->id . '">' . $egq->organisation .'</option>';
                }
              }
              ?>
            </select>
            <!-- ID For Who given the Task -->
          </div>
        </div>

        <div class="col-lg-3">
          <div class="form-group">
            <label for="itemname">Item Name:</label>
            <select name="itemname" id="itemname" class="form-control" >
              <option value=''>Type to Select Name</option>
              <?php
              if(isset($_GET['id']))
              {
                $name = $id_fetch->item_name;
                $eq = "SELECT * FROM `aset_item_creation` WHERE `status`='1'";
                $efq=mysqli_query($con,$eq); 

                while ($egq = mysqli_fetch_object($efq))
                { 
                  if($egq->id == $name)
                  {
                    echo '<option value="'. $egq->id . '" selected>' . $egq->name .'</option>';
                  }
                }

              }
              else{
                $eq = "SELECT * FROM `aset_item_creation` WHERE `status`='1'";
                $efq=mysqli_query($con,$eq); 

                while ($egq = mysqli_fetch_object($efq))
                { 
                  echo '<option value="'. $egq->id . '">' . $egq->name .'</option>';
                }
              }
              ?>
            </select>
            <!-- ID For Who given the Task -->
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label for="itemdesc">Asset Name:</label>
            <input type="text" class="form-control" name="itemdesc" id="itemdesc" value="<?php if(isset($_GET['id'])){echo   $id_fetch->description; }?>">
            <!-- <textarea name="itemdesc" id="itemdesc" class="form-control" rows="2" ></textarea> -->


          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label for="item_qty">QTY:</label>
            <input type="text" class="form-control" name="item_qty" id="item_qty" value="1" readonly="readonly">
            <!-- ID For Who given the Task -->
          </div>
        </div>
        <?php
        if (isset($_GET['id'])) {
         $id_er = $_GET['id'];
         ?>
         <input type="hidden" class="form-control" name="id_er" id="id_er" value="<?php echo $id_er; ?>">
         <?php
       }
       ?>

       <div class="col-lg-3">  
        <div class="form-group"> 
          <label for="itemtype"> Sub Type</label>
          <!-- <input type="text" class="form-control" name="sub_type" id="sub_type" value="" readonly="" > -->
          <select name="itemtype" id="itemtype" class="form-control" value="" readonly disabled="disabled">
            <option value="">--Select Sub-Type--</option>
          </select>

        </div>
      </div>

    </div>
    <div class="col-lg-3">  
      <div class="form-group"> 
        <label for="assettype"> Item Type</label>
        <!-- <input type="text" class="form-control" name="sub_type" id="sub_type" value="" readonly="" > -->
        <select name="assettype" id="assettype" class="form-control" value="" readonly disabled="disabled">
          <option value="">--Select Sub-Type--</option>
        </select>

      </div>
    </div>
    <div class="col-lg-3">  
      <div class="form-group"> 
        <label for="asset_type"> Asset Type</label>
        <!-- <input type="text" class="form-control" name="sub_type" id="sub_type" value="" readonly="" > -->
        <select name="asset_type" id="asset_type" class="form-control" value="" readonly >

          <option value="">--Select Sub-Type--</option>
        </select>

      </div>
    </div>
    <div class="col-lg-3">
      <div class=form-group>
        <label for="category">Category:</label>

        <select name="asset_category" id="asset_category" class="form-control" <?php if(isset($_GET['id']) && ($category != '')){ echo "disabled";}?>>
          <?php
          if (isset($_GET['id']) && ($category != '') ) {
                   // $id_er = $_GET['id'];
           ?>

           <option value="<?php echo $id_fetch->aset_category ;?> " selected="selected"><?php echo $id_fetch->aset_category;?></option>
           <?php
         }
         else{


          ?> 
          <option value="">--Select Category--</option>
          <?php
        }
        ?> 
      </select>
    </div>
  </div>
  <div class="col-lg-3">
    <div class=form-group>
      <label for="asset_subcategory">Sub Category:</label>
      <select name="asset_subcategory" id="asset_subcategory" class="form-control"<?php if(isset($_GET['id']) && ($subcategory != '')){ echo "disabled";}?>>
       <?php
       if (isset($_GET['id']) && ($subcategory != '')) {
                   // $id_er = $_GET['id'];
         ?>
         <option value="<?php echo $id_fetch->aset_subcatagory ;?> " selected="selected"><?php echo $id_fetch->aset_subcatagory;?></option>
         <?php
       }
       else
       {
         ?>
         <option value="">--Select Sub Category--</option>
         <?php
       }
       ?>
     </select>
   </div>
 </div>
 <div class="col-lg-3">  
  <div class="form-group" id="assetcode">

  </div>
</div>


<div class="col-lg-12" id="formload">    


</div>

<div class="col-lg-12" id="formload_vechile">    


</div>



<div class="col-lg-12" >

  <input type="submit" name="<?php if(isset($_GET['id'])){echo 'upreqsubmit';} else{echo 'itemsbmt';}?>"  id="itemsbmt"
  value="<?php if(isset($_GET['id'])) { echo 'UPDATE';} else { echo 'SUBMIT' ;} ?>" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >  
</div> 

</fieldset>  
</form>
</div>


</div>

<!-- /#page-wrapper -->
<?php require_once('../../footer.php'); ?>
</div>
<!-- /#wrapper -->



<!-- Metis Menu Plugin JavaScript -->
<script src="../../js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../js/startmin.js"></script>
<script type="text/javascript">

  $("#itemname").change(function(){

   // var state = $(this).val();
   var name = $("#itemname").val();




   if( name != ''){

    $.ajax({
      url:"subtype.php",
      data:{s_d:name},
      type:'POST',
      success:function(data) {

        var sd = $.trim(data);
        $("#itemtype").html(sd);
        get_form();
      }
    });
    
    $.ajax({
      url:"consumable.php",
      data:{s_id:name},
      type:'POST',
      success:function(data) {

        var sd = $.trim(data);
        $("#assettype").html(sd);
        get_form();   
      }
    });
    $.ajax({
      url:"asset_type.php",
      data:{s_id:name},
      type:'POST',
      success:function(data) {

        var sd = $.trim(data);

        $("#asset_type").html(sd);

        get_code(); 

      }
    });
    $.ajax({
      url:"add_category.php",
      data:{s_d:name},
      type:'POST',
      success:function(data) {

        var sd = $.trim(data);
        $("#asset_category").html(sd);
             // get_subcategory();
           }
         });

  }


})

</script>
<?php
if(isset($_GET['id']))
{
  ?>
  <script type="text/javascript">
    $(document).ready(function(){
     var name = $("#itemname").val();
     var id = $("#id_er").val();

     if( name != ''){

      $.ajax({
        url:"subtype.php",
        data:{s_d:name},
        type:'POST',
        success:function(data) {

          var sd = $.trim(data);
          $("#itemtype").html(sd);
          get_form();
        }
      });

      $.ajax({
        url:"consumable.php",
        data:{s_id:name},
        type:'POST',
        success:function(data) {

          var sd = $.trim(data);
          $("#assettype").html(sd);
          get_form();   
        }
      });
      $.ajax({
        url:"asset_type.php",
        data:{s_id:name},
        type:'POST',
        success:function(data) {

          var sd = $.trim(data);

          $("#asset_type").html(sd);

          get_code(); 

        }
      });
      var category = $("#cat_name").val();
      var subcategory = $("#subcat_name").val();

      if(category == '' && subcategory == '')
      {
        $.ajax({
          url:"add_category.php",
          data:{s_d:name},
          type:'POST',
          success:function(data) {

            var sd = $.trim(data);
            $("#asset_category").html(sd);
             // get_subcategory();
           }
         });
      }
    }
  });
</script>
<?php
}
?>
<script type="text/javascript">
  $("#asset_category").change(function(){
   get_subcategory();
 });
</script>
<script type="text/javascript">
 function get_subcategory() {

   var name = $("#itemname").val();
   var aset_category = $('#asset_category').val();
 //alert(aset_category);

 if(aset_category != '')
 {

  $.ajax({
    url:"add_category.php",
    data:{s_id:name,a_t:aset_category},
    type:'POST',
    success:function(data) {

      var sd = $.trim(data);
            //alert(sd);
            $("#asset_subcategory").html(sd);

            

          }
        });
}
else
{
  $("#assetcode").html('');
}
} 
</script>
<script type="text/javascript">
 function get_code() {
   var name = $("#itemname").val();
   var aset_type = $('#asset_type').val();


   if(aset_type == 'Admin')
   {

    $.ajax({
      url:"get_asset_code.php",
      data:{s_id:name,a_t:aset_type},
      type:'POST',
      success:function(data) {

        var sd = $.trim(data);

        $("#assetcode").html(sd);



      }
    });
  }
  else
  {
    $("#assetcode").html('');
  }
} 
</script>
<script type="text/javascript">
  function get_form() {

    var subtype = $('#itemtype').val();


    if( subtype != ''){
      var a_name = $('#itemname').val();
      var subtype = $('#itemtype').val();
      var id = $("#id_er").val();
      console.log(id);
// console.log(subtype);
// console.log(con);
// if(con == 'consurable'){
//    $.ajax({
//             url:"form3.php",
//             data:{s_id:con},
//             type:'POST',
//             success:function(data) {

//               var sd = $.trim(data);
//               $("#formload").html(sd);
//               loaddate();
//             }
//           });

//          }

$.ajax({
  url:"form1.php",
  data:{s_id:subtype,a_name:a_name,id:id},
  type:'POST',
  success:function(data) {

    var sd = $.trim(data);
    $("#formload").html(sd);
    loaddate();
  }
});

if( subtype == '6'){

  $.ajax({
    url:"form2.php",
    data:{s_ty:subtype,id:id},
    type:'POST',
    success:function(data) {

      var sd = $.trim(data);
      $("#formload_vechile").html(sd);
      loaddate();
    }
  });

} 

else{
 $("#formload_vechile").html('');
}

}

else{
 $("#formload").html('');
}

}



function loaddate()
{
  $('#pdate,#cdate,#valid,#valid_ins,#valid_poc').datetimepicker({

    format:'YYYY-MM-DD',

    widgetPositioning:{
      horizontal: 'auto',
      vertical: 'bottom'

    }
  });
}
</script>
<script type="text/javascript">


</script>

</body>

</script>
<script>
// Form Validation
$(document).ready(function(){

  $("#itemsbmt").click(function(){

    var org = $("#org").val();  
    var name = $("#itemname").val();
    var desc = $("#itemdesc").val();
    var qty = $("#item_qty").val();
    var subtype = $("#sub_type").val();
    var dop = $("#pdate").val();
    var invno = $("#att_doc_te").val();
    var invno_file = $("#att_doc").val();

    var supply = $("#supplier").val();
    var godown = $("#godown").val();
    var warrenty = $("#warrenty").val();
    var warrenty_file = $("#warrenty_att").val();

    var serial_no = $("#serial_no").val();
    var rc = $("#rc_name").val();
    var chasis = $("#chasis_no").val();
    var engine = $("#engine_no").val();
    var rc_date = $("#cdate").val();
    var rc_valid = $("#valid").val();
    var rc_file = $('#att').val();
    var ins = $("#ins_no").val();
    var ins_valid = $("#valid_ins").val();
    var ins_file = $('#att_ins').val();

    var poc = $("#pocc_no").val();
    var poc_valid = $("#valid_poc").val();
    var poc_file = $('#att_poc').val();

    var maintain = $("#maintainance").val();
    var duration = $("#duration").val();
    var days_interval =$("#days_interval").val();
    var or = $("#or").val();
    var qty1 = $("#QTY").val();
    var km_interval = $("#km_interval").val();
    var comp = $("#ins_com").val();

// var tname = $("#tname").val();

// Checking for Blank Fields.
if( org == 0){
  $('#org').css("border","2px solid #ec1313");
  alert("Please provide the organisation!!!");
  $('#org').focus();
  return false;
}

if( name ==''){
  $('#itemname').css("border","2px solid #ec1313");
  $('#org').css("border","1px solid #D3D3D3");
  alert("Please provide name!!!");
  $('#itemname').focus();
  return false;
}
if( desc ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname').css("border","1px solid #D3D3D3");
  $('#itemdesc').css("border","2px solid #ec1313");
  alert("Provide description.");
  $('#itemdesc').focus();
  return false;
}
if( qty ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc').css("border","1px solid #D3D3D3");
  $('#item_qty').css("border","2px solid #ec1313");
  alert("Provide quantity ");
  $('#item_qty').focus();
  return false;
}
if( dop ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty').css("border","1px solid #D3D3D3"); 
  $('#pdate').css("border","2px solid #ec1313");
  alert("Give your Date Of Purchase");
  $('#pdate').focus();
  return false;
}
if( invno ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate').css("border","1px solid #D3D3D3"); 
  $('#att_doc_te').css("border","2px solid #ec1313");
  alert("Give invoice no.");
  $('#att_doc_te').focus();
  return false;
}
// if( invno_file ==''){
// $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te').css("border","1px solid #D3D3D3"); 
// $('#att_doc').css("border","2px solid #ec1313");
// alert("Give invoice  attached file.");
// $('#att_doc').focus();
// return false;
// }
if( supply ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc').css("border","1px solid #D3D3D3");
  $('#supplier').css("border","2px solid #ec1313");
  alert("Give supplier name");
  $('#supplier').focus();
  return false;
}

if( godown ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier ').css("border","1px solid #D3D3D3");
  $('#godown').css("border","2px solid #ec1313");
  alert("Provide your godown location ");
  $('#godown').focus();
  return false;
}
if( warrenty ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown').css("border","1px solid #D3D3D3");
  $('#warrenty').css("border","2px solid #ec1313");
  alert("Please attach your warrenty number");
  $('#warrenty').focus();
  return false;
}
// if( warrenty_file ==''){
// $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty').css("border","1px solid #D3D3D3");
// $('#warrenty_att').css("border","2px solid #ec1313");
// alert("Give warrenty file.");
// $('#warrenty_att').focus();
// return false;
// }
if( serial_no ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att').css("border","1px solid #D3D3D3");
  $('#serial_no').css("border","2px solid #ec1313");
  alert("Please give your serial no.");
  $('#serial_no').focus();
  return false;
}

if( rc ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no').css("border","1px solid #D3D3D3");
  $('#rc_name').css("border","2px solid #ec1313");
  alert("Please provide name on RC");
  $('#rc_name').focus();
  return false;
}
if( chasis ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name').css("border","1px solid #D3D3D3");
  $('#chasis_no').css("border","2px solid #ec1313");
  alert("Please Provide chasis number!!!");
  $('#chasis_no').focus();
  return false;
}
if( engine ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no').css("border","1px solid #D3D3D3");
  $('#engine_no').css("border","2px solid #ec1313");
  alert("Please Provide engine no.!!!");
  $('#engine_no').focus();
  return false;
}
if( rc_date ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no').css("border","1px solid #D3D3D3");
  $('#cdate').css("border","2px solid #ec1313");
  alert("Please Provide date of rc!!!");
  $('#cdate').focus();
  return false;
}
if( rc_valid ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate').css("border","1px solid #D3D3D3");
  $('#valid').css("border","2px solid #ec1313");
  alert("Please Provide rc valid upto!!!");
  $('#valid').focus();
  return false;
}
// if( rc_file ==''){
// $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid').css("border","1px solid #D3D3D3");
// $('#att').css("border","2px solid #ec1313");
// alert("Please Provide rc document!!!");
// $('#att').focus();
// return false;
// }

if( ins ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att').css("border","1px solid #D3D3D3");
  $('#ins_no').css("border","2px solid #ec1313");
  alert("Please provide ins no.!!!");
  $('#ins_no').focus();
  return false;
}
if( ins_valid ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no').css("border","1px solid #D3D3D3");
  $('#valid_ins').css("border","2px solid #ec1313");
  alert("Please provide ins no valid upto date");
  $('#valid_ins').focus();
  return false;
}
// if( ins_file ==''){
// $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins').css("border","1px solid #D3D3D3");
// $('#att_ins').css("border","2px solid #ec1313");
// alert("Please Provide ins  file");
// $('#att_ins').focus();
// return false;
// }
if( poc ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins').css("border","1px solid #D3D3D3");
  $('#pocc_no').css("border","2px solid #ec1313");
  alert("Please provide poc no.!!!");
  $('#pocc_no').focus();
  return false;
}
if( poc_valid ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no').css("border","1px solid #D3D3D3");
  $('#valid_poc').css("border","2px solid #ec1313");
  alert("Please provide valid poc date!!!");
  $('#valid_poc').focus();
  return false;
}
// if( poc_file ==''){
// $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc').css("border","1px solid #D3D3D3");
// $('#att_poc').css("border","2px solid #ec1313");
// alert("Please provide poc file!!!");
// $('#att_poc').focus();
// return false;
// }


if( maintain ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc').css("border","1px solid #D3D3D3");
  $('#maintainance').css("border","2px solid #ec1313");
  alert("please provide maintainance");
  $('#maintainance').focus();
  return false;
}
if( duration ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance').css("border","1px solid #D3D3D3");
  $('#duration').css("border","2px solid #ec1313");
  alert("Please provide duration!!!");
  $('#duration').focus();
  return false;
}
// if( isNaN(duration)){
// $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance').css("border","1px solid #D3D3D3");
// $('#duration').css("border","2px solid #ec1313");
// alert("Please provide in number");
// $('#duration').focus();
// return false;
// }
if( days_interval ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance,#duration').css("border","1px solid #D3D3D3");  
  $('#days_interval').css("border","2px solid #ec1313");
  alert("Please provide days_interval!!!");
  $('#days_interval').focus();
  return false;
}
if( or ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance,#duration,#days_interval').css("border","1px solid #D3D3D3"); 
  $('#or').css("border","2px solid #ec1313");
  alert("Please provide or!!!");
  $('#or').focus();
  return false;
}
if( qty1 ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance,#duration,#days_interval,#or').css("border","1px solid #D3D3D3");
  $('#QTY').css("border","2px solid #ec1313");
  alert("Please provide quantity of vechile required!!!");
  $('#QTY').focus();
  return false;
}
if( km_interval ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance,#duration,#days_interval,#or,#QTY').css("border","1px solid #D3D3D3");
  $('#km_interval').css("border","2px solid #ec1313");
  alert("Please provide km interval in which maintainance required!!!");
  $('#km_interval').focus();
  return false;
}
if(comp ==''){
  $('#org').css("border","1px solid #D3D3D3");
  $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance,#duration,#days_interval,#or,#QTY').css("border","1px solid #D3D3D3");
  $('#ins_com').css("border","2px solid #ec1313");
  alert("Please provide name of insurance company");
  $('#ins_com').focus();
  return false;
}
// if(isNaN( km_interval))
// {
//   $('#itemname, #itemdesc,#item_qty, #pdate, #att_doc_te, #att_doc, #supplier, #godown, #warrenty, #warrenty_att, #serial_no,#rc_name,#chasis_no,#engine_no,#cdate,#valid,#att,#ins_no,#valid_ins,#att_ins,#pocc_no,#valid_poc,#att_poc,#maintainance,#duration,#days_interval,#or,#QTY').css("border","1px solid #D3D3D3");
// $('#km_interval').css("border","2px solid #ec1313");
// alert("Please provide this data only in number");
// $('#km_interval').focus();
// return false;
// }


else {
  return true;
}

});
});

</script>
<script type="text/javascript">
  function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
      return true;
    } else if ( key < 48 || key > 57 ) {
      return false;
    } else {
      return true;
    }
  };
</script>
</html>


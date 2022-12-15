<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {
$id = $_POST['s_id'];
$query = mysqli_query($con, "SELECT * FROM aset_item_creation WHERE id='$id'");
$row = mysqli_fetch_object($query);
echo $row->UOM;
}
?>
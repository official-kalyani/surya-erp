<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {

  $id = $_POST['s_id'];
?>
<input type='text' name='spname' placeholder='Search Asset-Name'  style="width:95px;" id="spname" >
<?php
}?>
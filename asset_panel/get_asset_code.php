<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
 if(isset($_POST['s_id']) && isset($_POST['a_t']))
    {
    $id = $_POST['s_id'];
$asset_type = $_POST['a_t'];
// $id = $_POST['s_id'];
  $sql = "SELECT * from `aset_item_creation` where status='1' AND `id`= '$id' AND `asset_type` = '$asset_type'";

  $res = mysqli_query($con, $sql);



    $row = mysqli_fetch_object($res);

?>

    	<label for="asetcode">Asset Code</label>
                      <input type="text" class="form-control" name="asetcode" id="asetcode" value="<?php echo $row->asset_code; ?>" readonly  >
                      <?php
                            
      
}

    


    
?>
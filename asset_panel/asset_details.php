<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id']))
{
	$aset_no = $_POST['s_id'];
	$duery = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE `auto_serial`  =  '$aset_no'");
	$ftch_aset_no = mysqli_fetch_object($duery);
	?>

						<div class="col-lg-3">
                            <div class="form-group">
                              <label for="ser_no">Serial No:</label>
                              <input type="text" name="ser_no" id="ser_no" class="form-control" value="<?php echo $ftch_aset_no->serial_no; ?>" readonly>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label for="ser_no">Purchase Dt:</label>
                              <input type="text" name="ser_no" id="ser_no" class="form-control" value="<?php echo $ftch_aset_no->date_purchase; ?>" readonly>
                            </div>
                          </div>
                         
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label for="ser_no">Warrenty Valid Upto:</label>
                              <input type="text" name="ser_no" id="ser_no" class="form-control" value="<?php echo $ftch_aset_no->warrenty; ?>" readonly>
                            </div>
                          </div>
                       
<?php
}
?>
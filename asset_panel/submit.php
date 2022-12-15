<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['use'])) {

  $asset_no = $_POST['use'];



  // $asset_no = $_POST['ass_no'];
                        



                        $query1 = mysqli_query($con, "SELECT * FROM `aset_stock_entry` WHERE auto_serial = '$asset_no'");
                        if(mysqli_num_rows($query1))
                        {
                        
                          ?>
                          		<div class="col-lg-12" >
                     <input type="submit" name="itemsbmt"  id="itemsbmt"
                   value="SUBMIT" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >
                  
                </div> 
                          <?php
                      }
                      						}
                          ?>
<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_d'])) {

$asset_no = $_POST['s_d'];
$query = mysqli_query($con, "SELECT * FROM `aset_stock_entry` WHERE auto_serial = '$asset_no' ");

                        if(mysqli_num_rows($query) > 0)
                        {

                          $fetch = mysqli_fetch_object($query);
                          $query2 = mysqli_query($con, "SELECT * FROM `aset_stock_assaignment` WHERE asset_no = '$asset_no' AND status = '1'");
                            if(mysqli_num_rows($query2) > 0)
                            {  
                             }
                            else{         

                          ?>
                           <div class="col-lg-3">
                    <div class="form-group">

                      <label for="aset_name">Asset Name:</label>
                      <input type="text" name="aset_name" id="aset_name" class="form-control" value="<?php echo $fetch->description ; ?>" readonly>
          <!--            <?php echo $fetch->description ; ?> -->
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">

                      <label for="ass_ser">Serial NO:</label>
                      <input type="text" name="ass_ser" id= "ass_ser "class="form-control" value="<?php echo $fetch->serial_no ; ?>" readonly>
                  
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">

                      <label for="ass_qty">QTY:</label>
                       <input type="text" name="ass_qty" id="ass_qty"class="form-control" value="<?php echo $fetch->qty ; ?>" readonly>
                
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">

                      <label for="ass_godown">Godown:</label>
                      <input type="text" name="ass_godown" id="ass_godown" class="form-control" value="<?php echo $fetch->godowo ; ?>" readonly>

                      
                    </div>
                  </div>
                  

<?php

                        }
                      }


}
?>
<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {

  $asset_no = $_POST['s_id'];



  // $asset_no = $_POST['ass_no'];
                        



                        $query1 = mysqli_query($con, "SELECT * FROM `aset_stock_entry` WHERE auto_serial = '$asset_no'");
                        
                          ?>
                <div class="col-lg-3">
                    <div class="form-group">

                      
                          <?php
                          if(mysqli_num_rows($query1) > 0)
                          {
                          
                        
                            $query2 = mysqli_query($con, "SELECT * FROM `aset_stock_assaignment` WHERE asset_no = '$asset_no' AND status = '1'");
                            if(mysqli_num_rows($query2) > 0)
                            {
                                echo "<i style=color:#D71313;>"."ASSET ALREADY ASSIGNED"."</i>";
                            }
                            else{
                              ?><label for="used">USED:</label>
                            <select name = "used" id="used" class="form-control">
                              <option value="0">--Select--</option>
                              <option value="1">Old</option>
                              <option value="2">New</option>
                            </select>
                            <?php
                            }

                           }
                          else
                          {
                        
                          
                                echo "<i style=color:#D71313;>"."NO SUCH ASSET EXIST"."</i>";
                                
                              }
                              
                              ?>
                    </div>
                </div>
               
                
 <?php
              }
                ?>
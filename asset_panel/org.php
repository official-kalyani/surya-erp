<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
 <select  name="spname"  id="spname" style="height: 21px; width: 100px; margin-left: 20px;" >
  <option value="">-- SELECT--</option>
 <?php
                        $eq = "SELECT * FROM `prj_organisation` WHERE `status`='1'";
                        $efq=mysqli_query($con,$eq); 

                        while ($egq = mysqli_fetch_object($efq))
                            { 
                          echo '<option value="'. $egq->id . '">' . $egq->organisation .'</option>';
                            }
                      ?>
</select>
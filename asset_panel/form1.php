<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id']) && isset($_POST['a_name']) ) {

  $id = $_POST['s_id'];
  $name = $_POST['a_name'];
  if(isset($_POST['id']))
  {
  $id_fetch = $_POST['id'];
  // echo $name;
  // echo $id_fetch;

  

$query_fetch = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  id = '$id_fetch'");
$query_fetch_data = mysqli_fetch_object($query_fetch);
}
?>

    <fieldset>
        <legend><h5><b>Information</b></h5></legend> 
        <div class="row">
        	 <div class="col-lg-3">  
                    <div class="form-group"> 
                        <label for="pdate"> Date of purchase:</label>
                       <input type="text" name="pdate" id="pdate" placeholder="YYYY-MM-DD"  class="form-control datepicker" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->date_purchase;}?>">
                         
                    </div>
                  </div> 
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="att_doc_te"> Inv no.:</label>
                        <input type="text" class="form-control" name="att_doc_te" id="att_doc_te" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->inv_no;}?>" >
                         
                    </div>
                  </div>
                  <?php
                  if(isset($_POST['id']))
                  {
                    if($query_fetch_data->att_inv != '')
                    {
                      ?>
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname"> Inv. No Attached Data:</label>
                         <!-- <img src="attinv/<?php echo $ftch_dtl->att_inv; ?>" style = "width: 100%; height: 350px;"> -->
                         <a href="attinv/<?php echo $query_fetch_data->att_inv; ?>" target="_blank"><?php echo $query_fetch_data->att_inv; ?></a>
                         </div>
                    </div>
              
               
                       <?PHP
                    }
                    else{
                   ?>
                   <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="att_doc">Attach:</label>
                        <input type="file" class="form-control" name="att_doc" id="att_doc"  >
                         
                    </div>
                  </div>
                   <?php 
                
                  }  
                  }
                  else{
                  ?>
                    <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="att_doc">Attach:</label>
                        <input type="file" class="form-control" name="att_doc" id="att_doc"  >
                         
                    </div>
                  </div>
                  <?php
                }
                ?>
                  <div class="col-lg-3">  
                    <div class="form-group"> 
                       <label for="supplier"> Supplier:</label>
                        <input type="text" class="form-control" name="supplier" id="supplier" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->supplier;}?>" >
                         
                     </div>
                  </div>
                  <div class="col-lg-3">  
                    <div class="form-group"> 
                       <label for="godown"> Godown:</label>
                        <input type="text" class="form-control" name="godown" id="godown" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->godowo;}?>" >
                         
                     </div>
                  </div>
                
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="warrenty"> Warranty:</label>
                        <input type="text" class="form-control" name="warrenty" id="warrenty"  value="<?php if(isset($_POST['id'])){echo $query_fetch_data->warrenty;}?>" >
                      </div>
                  </div>
                  <?php
                  if(isset($_POST['id']))
                  {
                   if($query_fetch_data->att_war != '')
                    {
                      ?>
                    
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Warranty Attached Data:</label>
                         <!-- <img src="attwar/<?php echo $ftch_dtl->att_war; ?>" style = "width: 100%; height: 350px;"> -->
                         <a href="attwar/<?php echo $query_fetch_data->att_war; ?>" target="_blank"><?php echo $query_fetch_data->att_war; ?></a>
                      </div>
                    </div>

                      <?PHP
                    }
                    else{
                      ?>
                      <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="warrenty_att"> Attach:</label>
                        <input type="file" class="form-control" name="warrenty_att" id="warrenty_att"  >
                      </div>
                  </div>
                      <?php

                    }
                  }
                  else{
                    ?>
                  
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="warrenty_att"> Attach:</label>
                        <input type="file" class="form-control" name="warrenty_att" id="warrenty_att"  >
                      </div>
                  </div>
                  <?php
                }
                ?>
                   <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="serial_no">Serial no</label>
                        <input type="text" class="form-control" name="serial_no" id="serial_no" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->serial_no;}?>" >
                      </div>
                  </div>
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="serial_no">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" value="<?php if(isset($_POST['id'])) if($query_fetch_data->amount != ''){{echo $query_fetch_data->amount;}}?>" >
                      </div>
                  </div>
                  <?php
                  if(isset($_POST['id']))
                  {
                    $query = mysqli_query($con, "SELECT * FROM `aset_item_creation` WHERE id = '$name' ")   ;
   $fetching = mysqli_fetch_object($query);
   if( $fetching->consumable == 'Asset')
   {

  $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '$id' "); 
        while($ftch = mysqli_fetch_object($vet))
        {
          $entry = $ftch->feild_name;
          $id_feild = $ftch->id;
          // echo $id_feild;
            $entry = str_replace(' ', '_', $entry);

            // echo $entry;
    ?>
    <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="<?php echo $entry ?>"><?php echo $ftch->feild_name; ?></label>
                        <?php
                        $feild_other = mysqli_query($con,"SELECT * FROM `aset_stock_entry_other` WHERE `feild_name` = $id_feild AND stock_entry_id = '$id_fetch'");

                        $feild_data = mysqli_fetch_object($feild_other);
                        if(mysqli_num_rows($feild_other)>0)
                        {
                        // echo  $feild_data ->value;
                        ?>
                       

                        <input type="text" class="form-control" name="<?php echo $entry; ?>" id="<?php echo $entry; ?>" value="<?php if($feild_data->value != ''){ echo $feild_data->value ;}?>" >
                        <?php
                      }
                      else{
                        ?>
                          <input type="text" class="form-control" name="<?php echo $entry; ?>" id="<?php echo $entry; ?>" value="" >
                        <?php
                      }
                      ?>
                      </div>
                  </div>
                <?php  } } 
                  }
                  else{
                  ?>
                   <?php
   $query = mysqli_query($con, "SELECT * FROM `aset_item_creation` WHERE id = '$name' ")   ;
   $fetching = mysqli_fetch_object($query);
   if( $fetching->consumable == 'Asset')
   {

  $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '$id' "); 
        while($ftch = mysqli_fetch_object($vet))
        {
          $entry = $ftch->feild_name;
            $entry = str_replace(' ', '_', $entry);

            // echo $entry;
    ?>
    <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="<?php echo $entry ?>"><?php echo $ftch->feild_name; ?></label>
                        <input type="text" class="form-control" name="<?php echo $entry ?>" id="<?php echo $entry ?>" required >
                        
                      </div>
                  </div>
                <?php  } } }?>
        </div>

    </fieldset>
    
<?php  } ?>
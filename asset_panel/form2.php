<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_ty'])) {
  if(isset($_POST['id']))
  {
  $id_fetch = $_POST['id'];
  // echo $name;
  // echo $id_fetch;

  

$query_fetch = mysqli_query($con,"SELECT * FROM `aset_stock_entry_vechile` WHERE  name_id = '$id_fetch'");
$query_fetch_data = mysqli_fetch_object($query_fetch);
}
?>
<fieldset>
        <legend><h5><b>Other details</b></h5></legend> 
        <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="rc_name">RC Name:</label>

                <input type="text" class="form-control" name="rc_name" id="rc_name" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->rc_name;}?>" >           
              </div>
            </div>
              <div class="col-lg-3">
              <div class="form-group">

                          <label for="chasis_no">Chasis No:</label>

                                <input type="text" class="form-control" name="chasis_no" id="chasis_no" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->chasis;}?>"  >           
                        </div>
              </div>

              <div class="col-lg-3">
              <div class="form-group">

                          <label for="engine_no">Engine No:</label>

                                <input type="text" class="form-control" name="engine_no" id="engine_no" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->engie;}?>"  >           
                        </div>
              </div>

        
        
       </div>
        <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="cdate">RC Date:</label>

                            <input type="text" name="cdate" id="cdate" placeholder="YYYY-MM-DD"  class="form-control datepicker" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->rc_date;}?>"  >          
                    </div>
          </div>

          <div class="col-lg-3">
          <div class="form-group">

                      <label for="valid">Valid upto:</label>

                            <input type="text" class="form-control" name="valid" id="valid" placeholder="YYYY-MM-DD" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->rc_valid;}?>"  >           
                    </div>
          </div>

          <?php
                if(isset($_POST['id']))
                  {

                    if($query_fetch_data->rc_file != '')
                    {

                      ?>
                      <!-- <h5>hello</h5> -->
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname"> RC Attached File:</label>
                         <!-- <img src="attinv/<?php echo $ftch_dtl->att_inv; ?>" style = "width: 100%; height: 350px;"> -->
                         <a href="ve_rc/<?php echo $query_fetch_data->rc_file; ?>" target="_blank"><?php echo $query_fetch_data->rc_file; ?></a>
                         <input type="hidden" class="form-control" name="att" id="att" value="<?php echo $query_fetch_data->rc_file; ?>"  >

                         </div>
                    </div>
              
               
                       <?PHP
                    }
                    else{
                      ?>
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname"> RC Attached File:</label>
                        <input type="file" class="form-control" name="att" id="att"  >
                         </div>
                    </div>
                    <?php
                    }
                    
                
                    
                  }
                  else{
                  ?>
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att">Attach:</label>

                            <input type="file" class="form-control" name="att" id="att"  >           
                    </div>
          </div>
        
      
       <?php
     }
     ?>
      </div>
       <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="ins_no">Ins No:</label>

                            <input type="text" class="form-control" name="ins_no" id="ins_no" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->ins_no;}?>"   >           
                    </div>
          </div>

          <div class="col-lg-3">
          <div class="form-group">

                      <label for="valid_ins">Valid upto:</label>

                            <input type="text" class="form-control" name="valid_ins" id="valid_ins" placeholder="YYYY-MM-DD"  value="<?php if(isset($_POST['id'])){echo $query_fetch_data->ins_valid;}?>" >           
                    </div>
          </div>
          <?php
  if(isset($_POST['id']))
                  {
                    if($query_fetch_data->ins_file != '')
                    {
                      ?>
                     <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">INS Attached File:</label>
                      <!--  <img src="ve_ins/<?php echo $ftch_vechile->ins_file; ?>" style = "width: 100%; height: 200px;"> -->
                      <a href="ve_ins/<?php echo $query_fetch_data->ins_file; ?>" target="_blank"><?php echo $query_fetch_data->ins_file; ?></a>
                       <input type="hidden" class="form-control" name="att_ins" id="att_ins" value="<?php echo $query_fetch_data->ins_file; ?>"  >
                     </div>
                  </div>
               
                       <?PHP
                    }
                     else{
                      ?>
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">INS Attached File:</label>
                        <input type="file" class="form-control" name="att_ins" id="att_ins"  > 
                         </div>
                    </div>
                    <?php
                    }
                    
                
                    
                  }
                  else{
                  ?>
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att_ins">Attach:</label>

                            <input type="file" class="form-control" name="att_ins" id="att_ins"  >           
                    </div>
          </div>
        
     <?php
   }
   ?>
       <div class="col-lg-3">
          <div class="form-group">

                      <label for="ins_no">Insurance Sompany:</label>

                            <input type="text" class="form-control" name="ins_com" id="ins_com" value="<?php if(isset($_POST['id'])){echo $query_fetch_data->ins_comp;}?>"  >           
                    </div>
          </div>
            </div>
        <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="pocc_no">Pocc No:</label>

                            <input type="text" class="form-control" name="pocc_no" id="pocc_no"  value="<?php if(isset($_POST['id'])){echo $query_fetch_data->poc_no;}?>" >             
                    </div>
          </div>

          <div class="col-lg-3">
          <div class="form-group">

                      <label for="valid_poc">Valid upto:</label>

                            <input type="text" class="form-control" name="valid_poc" id="valid_poc"  value="<?php if(isset($_POST['id'])){echo $query_fetch_data->poc_valid;}?>" >           
                    </div>
          </div>
<?php
  if(isset($_POST['id']))
                  {
                    if($query_fetch_data->poc_file != '')
                    {
                      ?>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">POC Attached File:</label>
                       <!-- <img src="ve_poc/<?php echo $ftch_vechile->poc_file; ?>" style = "width: 100%; height: 200px;"> -->
                       <a href="ve_poc/<?php echo $query_fetch_data->poc_file; ?>" target="_blank"><?php echo $query_fetch_data->poc_file; ?></a>
                        <input type="hidden" class="form-control" name="att_poc" id="att_poc" value="<?php echo $query_fetch_data->poc_file; ?>"  >
                     </div>
                  </div>
               
                       <?PHP
                    }
                    else{
                      ?>
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname"> POC Attached File:</label>
                          <input type="file" class="form-control" name="att_poc" id="att_poc"  > 
                         </div>
                    </div>
                    <?php
                    } 
                
                    
                  }
                  else{
                  ?>
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att_poc">Attach:</label>

                            <input type="file" class="form-control" name="att_poc" id="att_poc"  >           
                    </div>
          </div>
        
       
       <?php
     }
     ?>
     </div>
     <?php
     if(isset($_POST['id']))
     {
      ?>
       <input type="hidden" class="form-control" name="id" id="id"  value="<?php echo $query_fetch_data->id?>" >
      <?php
     }
     ?>
       <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="maintainance">Is Periodic Maintainance Required?</label>

                            <select name="maintainance" id="maintainance" class="form-control">
                              <option value="">--Select a Option--</option>
                              <option value="2" <?php if(isset($_POST['id'])){if($query_fetch_data->maintain == '2'){echo "selected";}}?>>Yes</option>
                              <option value="1" <?php if(isset($_POST['id'])){if($query_fetch_data->maintain == '1'){echo "selected";}}?>>No</option>
                            </select>           
                    </div>
          </div>
               
                    
                  
            </div>
            
        
        <div class="col-lg-12" id="formload_select"></div>
    </fieldset>
<script type="text/javascript">
$("#maintainance").change(function(){

   
    var select = $("#maintainance").val();
  

    if( select == '2'){

          $.ajax({
            url:"maintain.php",
            data:{m_re:select},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#formload_select").html(sd);
               // loaddatemaintain();
            }
          });


    }else{
       $("#formload_select").html('');
    }

  });
// function loaddatemaintain()
// {
//   $('#present_reading').datetimepicker({

//           format:'YYYY-MM-DD',
          
//           widgetPositioning:{
//             horizontal: 'auto',
//             vertical: 'bottom'
           
//         }
//         });
// }
</script>
<?php
if(isset($_POST['id']))
{
  ?>
  <script type="text/javascript">
 $(document).ready(function(){

   
    var select = $("#maintainance").val();
    var id =$("#id").val();

    if( select == '2'){

          $.ajax({
            url:"maintain.php",
            data:{m_re:select,id:id},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#formload_select").html(sd);
               // loaddatemaintain();
            }
          });


    }else{
       $("#formload_select").html('');
    }

  });
// function loaddatemaintain()
// {
//   $('#present_reading').datetimepicker({

//           format:'YYYY-MM-DD',
          
//           widgetPositioning:{
//             horizontal: 'auto',
//             vertical: 'bottom'
           
//         }
//         });
// }
</script>
  <?php
}
?>
    

<?php } ?>
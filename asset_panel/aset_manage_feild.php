<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['use'])) {

  $asset_no = $_POST['use'];



  // $asset_no = $_POST['ass_no'];
                        



                        $query1 = mysqli_query($con, "SELECT * FROM `aset_stock_entry` WHERE auto_serial = '$asset_no'");
                     
                          if(mysqli_num_rows($query1) > 0)
                          {
                          
                        
                            $query2 = mysqli_query($con, "SELECT * FROM `aset_stock_assaignment` WHERE asset_no = '$asset_no'");
                            if(mysqli_num_rows($query2) > 0)
                            {
                              ?>
                   <div class="col-lg-4" >
                      <div class="form-group">
                          <label for="ass_to">Assign To:</label>
                  <select name="ass_to" id="ass_to" class="form-control-select"  >
                    <option value=''>Type to Select Name</option>
                          <?php
                            $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' order by `fullname` ASC";
                            $efq=mysqli_query($con,$eq); 

                            while ($egq = mysqli_fetch_object($efq))
                                { 
                              echo '<option value="'. $egq->id . '">' . $egq->fullname .'('.$egq->designation.')</option>';
                                }
                          ?>
                  </select>
                      
                      </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="form-group">
                      <label for="from_date"> Assign Date:</label>
                       <input type="text" name="from_date" id="from_date" placeholder="YYYY-MM-DD"  class="form-control datepicker" autocomplete="off">
                    </div>
                  </div>
                     <div class="col-lg-4">
                    <div class="form-group">
                      <label for="site"> Project Site:</label>
                       <input type="text" name="site" id="site"   class="form-control" autocomplete="off" >
                    </div>
                  </div>
                  <div class="col-lg-12">
                    
                    <div id="km_run"></div>
                  </div>
              <!--   <div class="row"> -->
             

              <!--   <div class="row"> -->
                  <div class="col-lg-12" >
                     <input type="submit" name="itemsbmt"  id="itemsbmt"
                   value="SUBMIT" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >
                 </div>
            
                
                <?php
                            }
                            else{
                              ?>
                              <div class="col-lg-12">
                                <i style=color:#D71313;>ASSET IS NOT ASSAIGNED</i>
                              </div>
                             <!--  echo "<i style=color:#D71313;>"."ASSET IS NOT ASSAIGNED"."</i>"; -->
                           
                             <?php
                           }
                         }
                          else
                          {
                        ?>
                              <div class="col-lg-12">
                                <i style=color:#D71313;>NO SUCH ASSET EXIST</i>
                              </div>
                             <!--  echo "<i style=color:#D71313;>"."ASSET IS NOT ASSAIGNED"."</i>"; -->
                           
                             <?php
                          
                                // echo "<i style=color:#D71313;>"."NO SUCH ASSET EXIST"."</i>";
                                
                              }
                              
                              ?>
                    
               
                
 <?php
              }
                ?>
                 <script type="text/javascript">
                  $(document).ready(function(){
                     var asset = $("#ass_no").val();
                     console.log(asset) ;
                    $('#from_date').datetimepicker({

          format:'YYYY-MM-DD',
          
          widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
           
        }
        });
                         $.ajax({
            url:"km_run.php",
            data:{i_dv:asset},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#km_run").html(sd);
              loaddate();
              // $("#itemsbmt").css("visibility", "visible");
              
            }
            // $("#itemsbmt").css("visibility", "visible");
          });
              
                    
             });
                </script>
                <script type="text/javascript">
  $(document).ready(function () {
      $('#ass_to').selectize({
          sortField: 'text'
      });




  });
</script>
     <script type="text/javascript">
      $(document).ready(function(){

        $("#itemsbmt").click(function(){


          var asset_no = $("#ass_no").val();
           var subtype = $("#used").val();
          var assaign_to = $("#ass_to").val();
          var assaign_date = $("#from_date").val();
          var project_site = $('#site').val();
          var km_read = $("#km_read").val();
           var km_read_date = $("#read_date").val();

if( asset_no ==''){
$('#ass_no').css("border","2px solid #ec1313");
alert("Please provide required asset no");
$('#ass_no').focus();
return false;
}
if( subtype =='0'){
  $('#ass_no').css("border","1px solid #D3D3D3");
$('#used').css("border","2px solid #ec1313");
alert("Please provide the entered asset is new or old");
$('#used').focus();
return false;
}
if( assaign_to ==''){
  $('#ass_no,#used').css("border","1px solid #D3D3D3");
$('.form-control-select').css("border","2px solid #ec1313");
alert("Provide assign_to ");
$('.form-control-select').focus();
return false;
}
if( assaign_date ==''){
  $('#ass_no,#used').css("border","1px solid #D3D3D3");
   $('.form-control-select').css("border","1px solid #D3D3D3");
$('#from_date').css("border","2px solid #ec1313");
alert("Mention the date of asset assign");
$('#from_date').focus();
return false;
}
if( project_site ==''){
  $('#ass_no,#ass_to,#used,#from_date').css("border","1px solid #D3D3D3");
  $('.form-control-select').css("border","1px solid #D3D3D3");
$('#site').css("border","2px solid #ec1313");
alert("Provide the location in which project is alerted");
$('#site').focus();
return false;
}
if( km_read ==''){
  $('#ass_no,#ass_to,#used,#from_date,#site').css("border","1px solid #D3D3D3");
  $('.form-control-select').css("border","1px solid #D3D3D3");
$('#km_read').css("border","2px solid #ec1313");
alert("Provide the vechile last runed km reading");
$('#km_read').focus();
return false;
}
if( km_read_date ==''){
  $('#ass_no,#ass_to,#from_date,#used,#site,#km_read').css("border","1px solid #D3D3D3");
  $('.form-control-select').css("border","1px solid #D3D3D3");
$('#read_date').css("border","2px solid #ec1313");
alert("Provide the vechile last runned km reading updated date");
$('#read_date').focus();
return false;
}
else {
    return true;
}

        });


});
    </script>


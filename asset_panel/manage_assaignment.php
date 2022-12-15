<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
 if(isset($_POST['itemsbmt'])){

$asset_no = $_POST['ass_no'];
$assaign_to = $_POST['ass_to'];
  if(isset($_POST['ass_to']) != '')
{

$assaign_dt = $_POST['from_date'];
$project_site = $_POST['site'];
// $used = $_POST['used'];
// echo $used;
// echo $asset_no;
$created_on = date('Y-m-d H:i:s');


$update = mysqli_query($con,"UPDATE `aset_stock_assaignment` SET `status` = '0',`recovery_date` = '$assaign_dt' WHERE `asset_no` = '$asset_no' ORDER BY id DESC LIMIT 1");
 // echo "UPDATE `aset_stock_assaignment` SET `status` = '0' WHERE `asset_no` = '$asset_no' ORDER BY id DESC LIMIT 1";
 // exit();
 $query = "INSERT INTO aset_stock_assaignment (`assaign_to`,`used`, `assaign_dt`, `project_site`, `asset_no` , `created_on`, `status`) VALUES ('$assaign_to','$used','$assaign_dt', '$project_site', '$asset_no', '$created_on', '1')";
 // echo "INSERT INTO aset_stock_assaignment (`assaign_to`,`used`, `assaign_dt`, `project_site`, `asset_no` , `created_on`, `status`) VALUES ('$assaign_to','$used','$assaign_dt', '$project_site', '$asset_no', '$created_on', '1')";
  $sql = mysqli_query($con, $query);
   $id_last = mysqli_insert_id($con);

  // if($used == 'OLD' || $used == 'NEW' ){

    $qtr = mysqli_query($con, "SELECT x.*, y.* FROM  aset_stock_entry  x, aset_item_creation  y WHERE  x.auto_serial = '$asset_no' AND x.item_name = y.id");
    // echo "SELECT x.id, y.sub_type FROM  aset_stock_assaignment  x, aset_stock_entry  y  WHERE x.asset_no ='$asset_no'AND x.id = '$id'  AND x.asset_no = y.auto_serial";
    $fetch = mysqli_fetch_object($qtr);
      $sub_type = $fetch->sub_type;
if($sub_type == '6')
{
  // $query1 = mysqli_query($con, "SELECT * FROM `aset_stock_assaignment` WHERE asset_no = '$asset_no'");
  //                            if(mysqli_num_rows($query1) > 0)
  //                            {

  $id = $fetch->id;
  $km_reading =$_POST['km_read'];
  $read_date = $_POST['read_date'];
  // echo  $km_reading;
  // echo $asset_no;
  // echo $id;


  $query1 = "INSERT INTO `aset_km_reading`(`asset_id`, `asset_no`, `km_reading`, `reading_date`, `asset_no_id`) VALUES ('$id', '$asset_no', '$km_reading', '$read_date', ' $id_last')";
  // echo "INSERT INTO `aset_km_reading`(`asset_id`, `asset_no`, `km_reading`, `reading_date`) VALUES ('$id', '$asset_no', '$km_reading', '$read_date')";
  // echo "INSERT INTO `aset_km_reading`(`asset_id`, `asset_no`, `km_reading`) VALUES ('$id', '$asset_no', '$km_reading')";
  $sql2 = mysqli_query($con, $query1);

      if($sql2){
          $msg=" Asset Allotted successfully";
          header("Location: manage_assaignment.php?msg=$msg");

      }
      else {
           $msgel="Unsuccessfull in alloting field...retry again";
    }

 }




 // $query = "INSERT INTO `aset_stock_assaignment` (`assaign_to`,`assaign_dt`, `project_site`, `asset_no`) VALUES ('$assaign_to','$assaign_dt', '$project_site', '$asset_no')";
// }
  else{
       if($sql){
            $msg="Asset re-assigned successfully";
            header("Location: manage_assaignment.php?msg=$msg");

        }
        else {
             $msgel="Unsuccessfull in entering field...retry again";
      }
}
 }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title> Asset Stock Assaignment : Suryam Group</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.../../js/1.4.2/respond.min.js"></script>
        <![endif]-->
    
     <!-- jQuery -->
        <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.min.js"></script>
    
    <link rel="shortcut icon" href="../../images/favicon.png" />
    
<!-- Calendar -->
<script type="text/javascript" src="../../calendar/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../calendar/datepicker.css"/>
<!-- //Calendar -->

<!-- Used For Auto Typing Search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />    
<!-- // Used For Auto Typing Search-->    
    
<!--Clock-->
<script src="../../js/clock.js" type="text/javascript"></script>
<!--//Clock-->

<!-- DATETIMEPICKER CDNs -->

        <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

       

       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

     

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

        <!-- DATETIMEPICKER CDNs -->

        <script type="text/javascript">
      $(document).ready(function () {
      $('#ass_to').selectize({
          sortField: 'text'
      });




  });
</script>


 
    </head>
    <body>

     <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
               
         <?php require_once('../../header.php'); // include Header Portion ?>
               
         <?php require_once('../../menu.php'); // include Menu Portion ?>
              
            </nav>
            <div id="page-wrapper">
               <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">Manage Assignment</h4>
                      </div>
                      <div class="col-lg-12" style="height: 10px;">
                       <span><button onClick='javascript:location.href="aset_assaignment_listing.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                </span>
                <?php
                 if(isset($_GET['aset_no']))
                {
                  ?>
                  <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                        <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
                        <?php if(isset($upmsg)) { echo "<i style=color:#33D15B;>".$upmsg."</i>"; } ?>
                      <?php
               }
               else{
                ?>

                 <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                        <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
                        <?php if(isset($upmsg)) { echo "<i style=color:#33D15B;>".$upmsg."</i>"; } ?>
                <?php

               }

               ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                <div class="row">
                    
                     <form name="form" method="post" class="forms-sample" >
                      
                        
                      <fieldset>
                        <legend><h5><b>&nbsp;</b></h5></legend> 
                       
                         <?php 

                        if(isset($_GET['aset_no']))
                        {
                          $asset = $_GET['aset_no'];

                          $query = mysqli_query($con, "SELECT x.*,x.id as xid,y.*,z.sub_type  FROM vw_aset_stock_assaignment  x, aset_stock_entry y, aset_item_creation z Where x.asset_no = '$asset'  AND x.asset_no = y.auto_serial AND y.item_name = z.id order by x.id DESC LIMIT 1");
                           $ftch_dtl = mysqli_fetch_object($query);
                        
                        
                        ?>
                        <div class="input_fields_wrap">
                            <div class="row" >
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="name">Asset No:</label>
                                    <input type="text" class="form-control" name="ass_no" id="ass_no"  autocomplete="off" value="<?php echo $ftch_dtl->asset_no; ?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="<?php echo $ftch_dtl->description; ?>" readonly>
                                </div>
                              </div>
                            <!-- </div>
                            <div class="row"> -->
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="serial_no">Asset Serial No</label>
                                    <input type="text" class="form-control" name="serial_no" id="serial_no" autocomplete="off" value="<?php echo $ftch_dtl->serial_no; ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="Used_Person">Used To Person</label>
                                    <input type="text" class="form-control" name="Used_Person" id="Used_Person"  autocomplete="off"  value="<?php echo $ftch_dtl->fullname; ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="Fdate">From Date</label>
                                    <input type="text" class="form-control" name="Fdate" id="Fdate" autocomplete="off"   value="<?php echo $ftch_dtl->assaign_dt; ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="Tdate">To Date</label>
                                    <input type="text" class="form-control" name="Tdate" id="Tdate"  autocomplete="off" value="<?php $date = date('Y-m-d');
                                    echo $date;?>" readonly>
                                </div>
                              </div>
                               <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="p_site">Project Site</label>
                                    <input type="text" class="form-control" name="p_site" id="p_site" autocomplete="off" value="<?php echo $ftch_dtl->project_site; ?>" readonly>
                                </div>
                              </div>

                           
                              <div class="col-lg-12" >
                                  <div class="form-group">
                                 <!--  <label>&nbsp;</label> -->
                                      <input type="button" name="hstryshow"  id="hstryshow"
                                      value="View History" class="btn btn-primary mr-2" style="margin-top: 20px;" >
                                      <input type="button" name="matainshow"  id="matainshow"
                                      value="View Maintenance Request" class="btn btn-success mr-2" style="margin-top: 20px;" >
                                      <input type="button" name="upmaintain"  id="upmaintain"
                                      value="Updated Maintenance History" class="btn btn-primary mr-2" style="margin-top: 20px;">
                                      <!--  <input type="button" name="cancel"  id="cancel"
                                      value="Cancel" class="btn btn-danger mr-2" style="margin-top: 20px;" > -->
                                  </div>
                              </div> 
                             </div>
                             <div class="row">
                               <div id="asset_history"></div>
                             </div>
                         <!--     <div class="row"> -->
                               <div id="asset_maintainance"></div>
             <!--                 </div> -->
                              <div class="row">
                              <div class="col-lg-4" >
                                <div class="form-group">
                                <label for="assaigned_to">Assigned To:</label>
                                  <select name="ass_to" id="ass_to" class="form-control-select" >
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
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="from_date">From Date:</label>
                                    <input type="text" class="form-control" name="from_date" id="from_date" autocomplete="off">
                                </div>
                              </div>
                                <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="from_date">Project Site:</label>
                                    <input type="text" class="form-control" name="site" id="site"  autocomplete="off" >
                                </div>
                              </div>
                             </div>
                           <!--  </div> -->

                            <?php
                          
                             if($ftch_dtl->sub_type == '6')
                             {
                                $ptl = mysqli_query($con, "SELECT * FROM `aset_vehicle_report`WHERE`aset_no` = '$asset' ORDER BY id DESC LIMIT 1");
                            $ptl_ftch = mysqli_fetch_object($ptl);

                              ?>
                          <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group">

                                    <label for="km_read">Present KM Reading:</label>
                                    <input type="text" name="km_read"  id="km_read" class="form-control" autocomplete="off" onkeypress="return validateNumber(event);" value="<?php if(mysqli_num_rows($ptl) > 0) {echo $ptl_ftch->pr_reading;}else{ echo "0000";} ?>" readonly>
                                  </div>
                                </div>
                                
                                <div class="col-lg-4">
                                  <div class="form-group">

                                    <label for="read_date">Reading Date:</label>
                                    <input type="text" name="read_date"  id="read_date" class="form-control" autocomplete="off" value="<?php echo $ptl_ftch->date; ?>" readonly>
                                  </div>
                                </div> 
                      
                           </div>

                              <?php
                             }

                            ?>
                            
                   
                            <div class="col-lg-12">
                              <input type="submit" name="itemsbmt"  id="itemsbmt"
                               value="SUBMIT" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >
                            </div>
                            

                                                        

        <?php
        }
        else{

        ?>
        <div class="row" >
                <div class="col-lg-4" >
                    <div class="form-group">
                      <label for="ass_no">Asset No:</label>
                      <input type="text" class="form-control" name="ass_no" id="ass_no" autocomplete="off" >
                    </div>

                  </div>
                   <div class="col-lg-4" >
                    <div class="form-group">
                    <label>&nbsp;</label>
                     <input type="button" name="tasksbmt"  id="tasksbmt"
                   value="SEARCH" class="btn btn-success mr-2" style="margin-top: 20px;" >
                  </div>
                </div> 
                 
                </div>
               
                <div class="row">
                
                      <div id="used_details"></div>
                   
                   </div>
                   <div class="row">
                 

                      <div id="used_details_data"></div>
                   
                  </div>
                  <div class="row">
                   <div id="assaignment_details"></div>
                  
                  </div>

        <?php } ?>
                        
                       


                           <!--    </div> -->





                        <!-- </div> -->
                     <!--  </div> -->



                      </fieldset>


                    </form>

                
                <p style="padding-top:20px;">&nbsp;</p>
                            
                 <!-- //Body Ends Here -->      
                </div>
                <!-- /.row -->
            </div>

            <!-- /#page-wrapper -->
        <?php require_once('../../footer.php'); ?>
        </div>
        <!-- /#wrapper -->

       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>

<script type="text/javascript">
$(document).ready(function(){
    startclock ();
    // 
    // $("#ass_no").blur(function(){
    $('#tasksbmt').click(function(){
          var asset = $("#ass_no").val();

          // console.log(asset);

          if( asset != ''){

          // $.ajax({
          //   url:"stock.php",
          //   data:{s_id:asset},
          //   type:'POST',
          //   success:function(data) { 

          //     var sd = $.trim(data);
          //     $("#used_details").html(sd);

          //   }

                // });
                $.ajax({
                  url:"user_dtl.php",
                  data:{s_id:asset},
                  type:'POST',
                  success:function(data) {

                  var sd = $.trim(data);
                  $("#used_details_data").html(sd);

                  }
                });

                $.ajax({
                  url:"aset_manage_feild.php",
                  data:{use:asset},
                  type:'POST',
                  success:function(data) {

                  var sd = $.trim(data);
                  $("#assaignment_details").html(sd);
            // $("#tasksbmt").css("visibility", "hidden");


            }
          });

          }






    });

    $('#from_date,#read_date').datetimepicker({

    format:'YYYY-MM-DD',

    widgetPositioning:{
    horizontal: 'auto',
    vertical: 'bottom'

    }
    });




});
</script>
<script type="text/javascript">
$(document).ready(function(){

    $("#hstryshow").click(function(){
    var asset = $("#ass_no").val();

    if( asset != ''){

        $.ajax({
        url:"viewhistory.php",
        data:{s_id:asset},
        type:'POST',
        success:function(data) {

        var sd = $.trim(data);
        $("#asset_history").html(sd);
        // $("#asset_history").show();

        }
        });

    }


    });
    $("#matainshow").click(function(){
        var asset = $("#ass_no").val();

        if( asset != ''){

        $.ajax({
        url:"viewmaintain.php",
        data:{s_d:asset},
        type:'POST',
        success:function(data) {

        var sd = $.trim(data);
        $("#asset_history").html(sd);
        // $("#asset_history").show();

        }
        });

        }


    });

$("#upmaintain").click(function(){
        var asset = $("#ass_no").val();

        if( asset != ''){

        $.ajax({
        url:"aset_updated_mainten_history.php",
        data:{a_id:asset},
        type:'POST',
        success:function(data) {

        var sd = $.trim(data);
        $("#asset_history").html(sd);
        // $("#asset_history").show();

        }
        });

        }


    });



});

</script>
    <script type="text/javascript">
       $(document).ready(function(){
        $("#tasksbmt").click(function(){

          var asset_no = $("#ass_no").val();
          if( asset_no ==''){
            $('#ass_no').css("border","2px solid #ec1313");
            alert("Please provide the asset no.");
            $('#ass_no').focus();
            return false;
}


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
    <script type="text/javascript">
  function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
};
</script>


    </html>
  
<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
 if(isset($_POST['itemsbmt'])){

$asset_no = $_POST['ass_no'];
$assaign_to = $_POST['ass_to'];
  if(isset($_POST['ass_to']) != '')
{

$assaign_dt = $_POST['pdate'];
$project_site = $_POST['psite'];
$used = $_POST['used'];
// echo $used;
// echo $asset_no;
$created_on = date('Y-m-d H:i:s');



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
          $msg=" Assignment occured successfully";
          header("Location: stock_assaignment.php?msg=$msg");

      }
      else {
           $msgel="Unsuccessfull in entering field...retry again";
    }

 }




 // $query = "INSERT INTO `aset_stock_assaignment` (`assaign_to`,`assaign_dt`, `project_site`, `asset_no`) VALUES ('$assaign_to','$assaign_dt', '$project_site', '$asset_no')";
// }
  else{
       if($sql){
            $msg="Asset allotted successfully";
            header("Location: stock_assaignment.php?msg=$msg");

        }
        else {
             $msgel="Unsuccessfull in alloting field...retry again";
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
                        <h4 class="page-header">Asset Assignment</h4>
                      </div>
                      <div class="col-lg-12" style="height: 10px;">
                       <span><button onClick='javascript:location.href="aset_assaignment_listing.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                </span>

                <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                        <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
                        <?php if(isset($upmsg)) { echo "<i style=color:#33D15B;>".$upmsg."</i>"; } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                <div class="row">
                    
                     <form name="form" method="post" class="forms-sample" >
                      
                <fieldset>
                    <legend><h5><b>&nbsp;</b></h5></legend>  
            <div class="input_fields_wrap">
             

              <div class="row" style="margin-left:30%;">
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
                   <!-- <div class="col-lg-12" >
                     <input type="button" name="tasksbmt"  id="tasksbmt"
                   value="SEARCH" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >
                  
                </div>  -->
                 
                </fieldset>  
                    </form>
                  </div>
                
                <p style="padding-top:20px;">&nbsp;</p>
                            
                 <!-- //Body Ends Here -->      
                </div>
                <!-- /.row -->

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

          $.ajax({
            url:"stock.php",
            data:{s_id:asset},
            type:'POST',
            success:function(data) { 
             
              var sd = $.trim(data);
              $("#used_details").html(sd);
              
            }

          });
              $.ajax({
            url:"stock_details.php",
            data:{s_d:asset},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#used_details_data").html(sd);
              
            }
          });

            $.ajax({
            url:"stock_assaignment_field.php",
            data:{use:asset},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#assaignment_details").html(sd);
              // $("#tasksbmt").css("visibility", "hidden");

              
            }
          });

}

 
     

    
function loaddate()
{
  $('#pdate,#read_date').datetimepicker({

          format:'YYYY-MM-DD',
          
          widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
           
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
    </html>

    

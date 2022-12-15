<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['itemsbmt']))
{
    // print_r($_POST);exit();
    $check = $_POST['chkbox_ind'];
    $total = count($check);
    // echo $total;
    for($i = 0; $i < $total; $i++) { 
if(isset($_POST['chkbox_ind'][$i]))
{
    $chk_box = $_POST['chkbox_ind'][$i];
    // echo  $chk_box;
        $asset = $_POST['assn'][$chk_box];
        // echo $asset."<br>" ;
        $rec_date = $_POST['rcdate'][$chk_box];
        // echo $rec_date ."<br>" ;
        $current_location = $_POST['rdate'][$chk_box];
         // echo $current_location ."<br>" ;
        $quality = $_POST['quality'][$chk_box];
         // echo $quality ."<br>" ;
        $reason = $_POST['reson'][$chk_box];
        $recovered_from = $_POST['recovery'];
        // echo $recovered_from;
        // exit();
         // echo $reason ."<br>" ;
        
      $query = mysqli_query($con,"INSERT INTO `aset_recovery` (`asset_no`,`recovered_from`, `recovery_date`, `location`, `quality` ,`reson`, `status`) VALUES ('$asset', '$recovered_from','$rec_date','$current_location','$quality','$reason','1')") ;
      $update = mysqli_query($con,"UPDATE `aset_stock_assaignment` SET `status` = '0' WHERE `asset_no` = '$asset' ORDER BY id DESC LIMIT 1");
     // echo "INSERT INTO `aset_recovery` (`asset_no`, `recovery_date`, `location`, `quality` ,`reson`, `status`) VALUES ('$asset','$rec_date','$current_location','$quality','$reason','1')";  
       
    }
    // echo "hyyy";
    }
    if($query && $update)
    {
        $msg="Items Recovered Successfully"; 
  header("Location: recovery.php?msg=$msg");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title> Asset Item Recovery : Suryam Group</title>

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
<!-- <script type="text/javascript" src="../../calendar/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../calendar/datepicker.css"/> -->
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
                        <h4 class="page-header">Item Recovery</h4>
                       <span><button onClick='javascript:location.href="recoverydata.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                </span>
                <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                <div class="row">

                 <form name="form" method="post" class="forms-sample" >
                          
                   <fieldset>
                    <legend><h5><b>&nbsp;</b></h5></legend>  
                    
                    <div class="row" >
                        <div class="col-lg-4" >
                            <div class="form-group">
                                <label for="recovery" >Select Employee Name:</label>
                                <select name="recovery" id="recovery" class="form-control">
                                     <option value=''>Type to Select Name</option>
                      <?php
                            // print_r($req_id); 
                        $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' ORDER BY `mstr_emp`.`id` ASC";
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
                                <label>&nbsp;</label>
                                <input type="button" name="tasksbmt"  id="tasksbmt"
                                value="SEARCH" class="btn btn-success mr-2" style="margin-top: 20px;" >
                            </div>
                        </div>
                        </div> 
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="recovery_id"></div> 
                            </div>
                            
                        </div>
                            
                      
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
                                   $(document).ready(function () {
                                        $('#recovery').selectize({
                                        sortField: 'text'
                                        });
                                    }); 
                                </script>   
   <script type="text/javascript">
      $(document).ready(function () {
         $("#itemsbmt").hide();
        $("#tasksbmt").click(function(){

          var name = $("#recovery").val();
          //console.log(name);
          if( name !=''){
           
 $.ajax({
            url:"recoverytable.php",
            data:{n_id:name},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#recovery_id").html(sd);
              
              $("#itemsbmt").show();
                // loaddate();
              // $("#tasksbmt").css("visibility", "hidden");

              
            }
          });



}

        });

  });

    </script> 
    <script type="text/javascript">
    
$(document).ready(function() { 

  $('.rcdate').datetimepicker({

            format:'YYYY-MM-DD',

            widgetPositioning:{
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });
})
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#tasksbmt").click(function(){
      var item_type = $("#recovery").val();    
if(item_type == 0)
{
  $('#consumable').css("border","2px solid #ec1313");
alert("Please provide the employee name");
$('#recovery').focus();
return false;
}
else {
    return true;
}

    });

});
</script>
<script type="text/javascript">

  $("#itemsbmt").click(function(){
    var checked = $("#chkbox_ind input:checked").length > 0;
    if (!checked){
        alert("Please check at least one checkbox");
        return false;
    }
});
</script>
 
</html>
   
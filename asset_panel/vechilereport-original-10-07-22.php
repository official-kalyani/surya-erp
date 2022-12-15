 <?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['wsmt']))
{
    $asset_no = $_POST['asset_no'];
    $asset_name = $_POST['vechilename'];
      $vechileno = $_POST['vechileno'];
    $project_site = $_POST['project'];
    $date = $_POST['date'];
    $preading = $_POST['pr_reading'];
    $reading = $_POST['reading'];
    $id = $_POST['asset_id'];
    $updated_by = $_SESSION['ERP_SESS_ID'];
    $id = $_POST['asset_id'];
     $sql3="INSERT INTO aset_vehicle_report (`aset_no`,`vname`, `vserial`,`date`,`location`,`pr_reading`,`reading`,`updated_by`, `asset_id`,`status`) VALUES ('$asset_no', '$asset_name','$vechileno', '$date', '$project_site', '$preading', '$reading','$updated_by','$id', '1')";
     echo "INSERT INTO aset_vehicle_report (`aset_no`,`vname`, `vserial`,`date`,`location`,`pr_reading`,`reading`,`status`) VALUES ('$asset_no', '$asset_name','$vechileno', '$date', '$project_site', '$preading', '$reading', '1')";
         
              $sql4 = mysqli_query($con, $sql3);  
        if($sql4){
          $msg=" All field entered successfully";
          header("Location: vechilereport.php?msg=$msg");

      }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Daily vehicle Update : Suryam Group</title>

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
<!--Clock-->
<script src="../../js/clock.js" type="text/javascript"></script>
<!--//Clock-->
<script>
$(document).ready(function() { 
  startclock ();
})
</script>


<script>
// Form Validation
$(document).ready(function(){
	
$("#wsmt").click(function(){
	
var pr_reading = $("#pr_reading").val();
var reading = $("#reading").val();

// Checking for Blank Fields.

if(pr_reading ==''){
$('#pr_reading').css("border","2px solid #ec1313");
alert("Please provide your present reading");
$('#pr_reading').focus();
return false;
}
if(reading ==''){
$('#reading').css("border","2px solid #ec1313");
alert("Please provide your present reading");
$('#reading').focus();
return false;
}
else {
	return true;
}

});
});

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#wsmt").hide();
        $("#vechilenameed").change(function(){
          var name = $("#vechilenameed").val();
          console.log(name);
          if(name != '1')
          {
            $.ajax({
                  url:"vechilereportdata.php",
                  data:{s_id:name},
                  type:'POST',
                  success:function(data) {

                  var sd = $.trim(data);
                  $("#used_details_data").html(sd);
                  $("#wsmt").show();

                  }
                });
          }
          else{

            $("#used_details_data").html('');
             $("#wsmt").hide();
          }

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
                        <h4 class="page-header">Daily Vehicle Update</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
			   
                <!-- /.row -->
                <div class="row">
                <!-- Body Starts Here -->  
				<span style="float:right;">
					<button onClick='javascript:location.href="vwvehiclereport.php"' class="btn btn-success btn-xs" style="font-weight: bold;">Show vehicle report</button>
				</span>					
				<?php if(isset($_GET['msg']))
                 { 
                    $msg = $_GET['msg'];
                    echo "<i style=color:#33D15B;>".$msg."</i>"; } ?>
					<form name="form" method="post" class="forms-sample">
				<fieldset>
                    <legend><h5><b>&nbsp;</b></h5></legend>	 
                    <?php
                    $user_id =  $_SESSION['ERP_SESS_ID'];
                              $query = mysqli_query($con, "SELECT x.*,x.id as xid,y.*,y.description as ydesc,z.*,w.km_reading  FROM aset_stock_assaignment x,aset_stock_entry y,aset_item_creation z,aset_km_reading w WHERE x.assaign_to =  '$user_id' AND x.status = 1 AND x.asset_no = y.auto_serial AND y.item_name = z.id  AND x.id = w.asset_no_id AND z.sub_type = '6' ORDER BY x.id ");
                              if(mysqli_num_rows($query) > 0)
                      {
                    //           $fetch_id = mysqli_fetch_object($query);


                    // $auto_serial = $fetch_id->auto_serial;
                    // $query1 = mysqli_query($con,"SELECT * FROM `aset_stock_assaignment` WHERE  `asset_no` = '$auto_serial' ORDER BY `id`DESC LIMIT 1");
                    // $fetch_id = mysqli_fetch_object($query1);
                    // if($user_id == $fetch_id->assaign_to)
                    // {
                              
             
                    ?>
			   
                    
               
                <div class="row">
           
            <div class="col-lg-4">
                <div class="form-group">
                <label for="vechilename">Vehicle Name:</label>
              <!--   <input type="text" name="vechilename" id="vechilename" class="form-control" value="<?php echo $fetch->ydesc; ?>" readonly> -->
                <select name="vechilenameed" id="vechilenameed" class="form-control" >
                  <option value="1">--SELECT--</option>
                    <?php
                      $abs = mysqli_query($con, "SELECT x.*,x.id as xid,y.*,y.description as ydesc,y.id as yid,z.*,w.km_reading  FROM aset_stock_assaignment x,aset_stock_entry y,aset_item_creation z,aset_km_reading w WHERE x.assaign_to =  '$user_id' AND x.asset_no = y.auto_serial AND y.item_name = z.id  AND x.id = w.asset_no_id AND z.sub_type = '6' AND x.status = '1' GROUP BY x.asset_no ");

                      while ($ftab = mysqli_fetch_object($abs))
                      {
                        $auto_serial = $ftab->auto_serial;
                        $query1 = mysqli_query($con,"SELECT * FROM `aset_stock_assaignment` WHERE  `asset_no` = '$auto_serial' ORDER BY `id`DESC LIMIT 1");
                        while($fetch_id = mysqli_fetch_object($query1))
                        {
                            if($user_id == $fetch_id->assaign_to)
                            {

                      echo "<option value='".$ftab->auto_serial."'>".$ftab->ydesc."</option>";
                  }
                  }
                  }
                      ?>
                </select>
            </div>
            </div> 
            </div>

            <div id="used_details_data"></div> 
           
        <?php
            }
            // else{
            //    echo "<i style=color:#D71313;>NO VEHICLE ALLOTTED</i>";
            // }
          
            else{
                echo "<i style=color:#D71313;>NO VEHICLE ALLOTTED</i>";
            }
            ?>
             <div class="row">
                <div class="col-lg-12">
                   
                <!--  -->
                       
                    <input type="submit" name="wsmt" id="wsmt" value="Submit" class="btn btn-success mr-2" style="margin-top: 24px; float:right;">
                    
                </div>  
                </div>
               

                 
               
                
			
				</fieldset>  
					</form>
				 
				<p style="padding-top:20px;">&nbsp;</p>
				</div>
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

<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Show Daily Vehicle Update : Suryam Group</title>

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
<!-- DATETIMEPICKER CDNs -->

        <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>


       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

     

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

        <!-- DATETIMEPICKER CDNs -->
<script>
$(document).ready(function() { 
  startclock ();
  $('#sdate, #tdate').datetimepicker({

            format:'YYYY-MM-DD',

            widgetPositioning:{
                horizontal: 'auto',
                vertical: 'bottom'
            }
        });
})
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
                        <h4 class="page-header">Show Vehicle Report</h4>
                    </div>
                    <!-- /.col-lg-12 --> 
                </div>
			   
                <!-- /.row -->
                       <form name='search' method='POST'>  
                                <div class="row"> 
                                    <div class="col-lg-3">  
                                        <div class="form-group"> 
                                            
                                           <input type="text" name="sdate" id="sdate" placeholder="From date"  class="form-control datepicker" >
                                        </div>
                                     </div>
                                      <div class="col-lg-3">  
                                        <div class="form-group"> 
                                            
                                           <input type="text" name="tdate" id="tdate" placeholder="To date"  class="form-control datepicker">
                                        </div>
                                     </div>
                                           <div class="col-lg-3">  
                                                <div class="form-group"> 
                                                    <input type='submit' name="submitdt" id="submitdt" value='Search' class="btn btn-success btn-xs">
                                                </div>
                                            </div>

                                            <?php 
                                if(isset($_POST['submitdt']))    { // Show Only if Search Action Performed ?>
                                  <!--   <span style="float:left; padding-right:10px;"> -->
                                       
                                    <button onClick='javascript:location.href="vwvechilereport.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                           
                                </div>
                            </form>
                                                       
                           <!--  </span> -->
                    
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="height:40px;">
                              <!--   <div class="row"> -->
                                    <!-- <span><a href="stock_entry.php" class="btn btn-success btn-xs" style="text-decoration:none;" ><b>ADD  STOCK ENTRY </b></a>
                                    </span> -->
                                     <span style="float:left;">      
                <button onClick='javascript:location.href="vechilereport.php"' class="btn btn-success btn-xs" style="font-weight: bold;">DAILY VEHICLE UPDATE</button>
                  </span>
                                    <span style="float:right;">
                                    	<form name='search' method='POST'> 
                                      <div class="col-lg-2">
                                      <?php 
                                if(isset($_POST['submitnm']))    { // Show Only if Search Action Performed ?>
                                  <!--   <span style="float:left; padding-right:10px;"> -->
                                       
                                    <button onClick='javascript:location.href="vwvechilereport.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                </div>
                                       
                                        <div class="col-lg-4">
                                          <select  name="select_search"  id="select_search" style="height: 21px;" onchange="getPic()">
                                              <option value>--select by search--</option>
                                              <option value="1">Asset no.</option>
                                              <option value = "2">Asset Name</option>
                                              <
                                             </select>
                                        </div>
                                               <div class="col-lg-4" >
                                               <div id="ldt">

                                                 <input type='text' name='spname' placeholder='Search Asset-Name'  id="spname" autocomplete="off" >&nbsp &nbsp &nbsp
                                                </div>
                                                </div>
                                  <!--   <div class="col-lg-4" style="float: right;"> -->
                                        <div class="col-lg-2" >
                                        <input type='submit' name="submitnm" id="submitnm" value='Search' class="btn btn-success btn-xs" >
                                      <!--   </div> -->
                                        
                                </div>
                                       
                                       </span>
                                   </form>

                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive"> 
								<span style="float:right;"> <?php if(isset($_GET['msg']) && $_GET['msg']=='404') { echo "Record Not Found."; } ?> </span>
                                    <table class="table table-striped">
                                        <thead> 
											
												
<?php 
$emplyID = array("1", "2", "24","55","329"); // Setting Up the user id's who gonna access this.

?>
					
						
											<tr> 
												<th>#</th>
												<th>Asset No</th>
												<th>Asset Name</th>
												<th>Date</th>
												<th>Present Reading</th>
												<th>Reading</th>
												<th>Project Site</th>
												<th>Used By</th>
												
												
											</tr> 
										</thead> 
                                        <tbody>


<?php
// Pagination

				if (in_array($_SESSION['ERP_SESS_ID'], $emplyID)) // Only for Choosable Super Admin  
						{		
						$query = mysqli_query($con,"SELECT COUNT(*) as `num` FROM `aset_vehicle_report` WHERE `status`='1'"); 
						}
						else 
						{
						$query = mysqli_query($con, "SELECT COUNT(*) as `num` FROM `aset_vehicle_report` WHERE `updated_by`=".$_SESSION['ERP_SESS_ID']." AND `status`='1'"); 
						}
    
   // $query = mysqli_query($con, "SELECT COUNT(*) as `num` FROM `task_dailywu` WHERE `status`='1'");
    $total_pages = mysqli_fetch_array($query);
    $total_pages = $total_pages['num'];
	
	// echo $total_pages;
	
    $limit = 30;                                 // How many items to show per page
    
	
	if(isset($_GET['page'])) { 
		$page = $_GET['page'];
	} else {
		$page = 0;
	}
	
    if($page) 
        $start = ($page - 1) * $limit;          // First item to display on this page
    else
        $start = 0;                             // If no page var is given, set start to 
   
   
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  // If no page var is given, default to 1.
    $prev = $page - 1;                          // Previous page is page - 1
	
	$first_number = $prev+1;                    // Mid Portion 
	$showing_limit = $first_number+2;           // Pagination
	
    $next = $showing_limit + 1;            		// Next page is page + 1
	
    $lastpage = ceil($total_pages/$limit);      // Lastpage is = total pages / items per page, rounded up.
    $last_number = $lastpage-2;

    $pagination = "";

    if($lastpage > 1)
    {   
        $pagination .= "<div class=\"pagination\">";
       
		// Previous button
        if ($page > 1) 
		 {
			$pagination.= "<a href=\"?page=1\">|« First</a> &nbsp;&nbsp;&nbsp;"; // First Page Link
			$pagination.= "<a href=\"?page=$prev\">« Previous</a> &nbsp;&nbsp;&nbsp;";
		 }
        else
		 {
            $pagination.= "<span class=\"disabled\">|« First</span> &nbsp;&nbsp;&nbsp;"; 
            $pagination.= "<span class=\"disabled\">« Previous</span> &nbsp;&nbsp;&nbsp;"; 

		 }
		
		
		if ($page > $last_number)
		     {
				  for($i = $last_number; $i <= $last_number+2; $i++)
             
        	    {
                  $pagination .= '<a href="?page='.$i.'">'.$i.'</a> &nbsp;&nbsp;&nbsp;';
			    }
             }
		
		else
		  {
		         for($i = $first_number; $i <= $showing_limit; $i++)
             
        	    {
                 $pagination .= '<a href="?page='.$i.'">'.$i.'</a> &nbsp;&nbsp;&nbsp;';
			    }
		  }
		
        // Next button
        if ($page < $last_number)
		    {
            $pagination.= "<a href=\"?page=$next\">Next »</a> &nbsp;&nbsp;&nbsp;";
		    $pagination.= "<a href=\"?page=$lastpage\">Last »|</a>";
		    }
        else
		    {
            $pagination.= "<span class=\"disabled\">Next »</span> &nbsp;&nbsp;&nbsp;";
		    $pagination.= "<span class=\"disabled\">Last »|</span>";
		    }
		 
      
	   $pagination.= "</div>\n";       
    }
				if(isset($_POST['submitdt']))// For Search
					{
	        	$sdate = mysqli_real_escape_string($con,$_POST['sdate']); 
	        	$tdate = mysqli_real_escape_string($con,$_POST['tdate']);

	        	// Prevent SQL-Injection
			   	
				if (in_array($_SESSION['ERP_SESS_ID'], $emplyID)) // Only for Choosable Super Admin  
						{
				$result = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `status`='1'  AND `date` BETWEEN  '$sdate' AND '$tdate' AND `status`='1' ORDER BY `aset_no`,`id` DESC"); 
							
						}
						else
						{ 
				$result = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `updated_by`=".$_SESSION['ERP_SESS_ID']." AND `status`='1' AND `date` BETWEEN  '$sdate' AND '$tdate'   ORDER BY `aset_no`,`id` DESC ");
						}

					}
					else if(isset($_POST['submitnm']))
					{
						$search = $_POST['select_search'];
						// Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut = "aset_no = '$spname'";
                   }
                else if($search == 2)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut = "vname LIKE '%$spname%'";
                   
                }

						if (in_array($_SESSION['ERP_SESS_ID'], $emplyID)) // Only for Choosable Super Admin  
						{
				$result = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `status`='1'  AND  $qut AND `status`='1' ORDER BY `aset_no`,`id` DESC"); 
							
						}
						else
						{ 
				$result = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `updated_by`=".$_SESSION['ERP_SESS_ID']." AND `status`='1' AND  $qut  ORDER BY `aset_no`,`id` DESC ");
						}

					}
				else // For Normal
					{
					
					if (in_array($_SESSION['ERP_SESS_ID'], $emplyID)) // Only for Choosable Super Admin  
						{		
						$result = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `status`='1' ORDER BY `aset_no`,`id` DESC limit $start,$limit"); 
						}
						else 
						{
						$result = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `updated_by`=".$_SESSION['ERP_SESS_ID']." AND `status`='1'  ORDER BY `aset_no`,`id`,`date` ASC limit $start,$limit"); 
						}		
					} 
					
		$total_results = mysqli_num_rows($result);
		if($total_results == 0) // Set For Record Not Found 
		{
			$Error_message="NO RECORDS FOUND.";
		} 
	     
$i=$start; 
    while($fetch=mysqli_fetch_object($result))
	    {
?>
	                                    <tr> 
												<td><?php echo $i; ?></td>
												<td><?php echo $fetch->aset_no; ?></td>
												<td><?php echo $fetch->vname; ?></td>
												<td><?php echo $fetch->date; ?></td>
												<td><?php echo $fetch->pr_reading; ?></td>
												<td><?php echo $fetch->reading; ?></td>
													<td><?php echo $fetch->location; ?></td>
													<?php
													$updated_by = $fetch->updated_by;
													$assname = mysqli_query($con,"SELECT x. *,y.*,z.fullname  FROM aset_vehicle_report x,aset_stock_assaignment y, mstr_emp z  WHERE x.aset_no = y.asset_no AND x.updated_by = '$updated_by' AND x.updated_by = y.assaign_to AND y.assaign_to = z.id ORDER BY y.id");
													$ftch_name = mysqli_fetch_object($assname);
													?>
												<td><?php echo $ftch_name->fullname; ?></td>
												
												
										</tr> 
										
										
										
<?php $i++; } ?>
<?php // Error Message For Record Not Found.
  if(isset($Error_message))
    {
  echo "<tr align='center'><td colspan='12'> $Error_message </td></tr>";
    }
?>
                                        </tbody>
                                    </table>
<?php 
//Displaying Pagination. 
 if(!isset($_GET['wname']))
    {
   echo $pagination;
    } 
?>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>							
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
    
$("#submitdt").click(function(){
    
var sdate = $("#sdate").val();
var tdate = $("#tdate").val();

if( sdate ==''){
$('#sdate').css("border","2px solid #ec1313");
alert("Please provide from date");
$('#sdate').focus();
return false;
}
if( tdate ==''){
  $('#sdate').css("border","1px solid #D3D3D3");
$('#tdate').css("border","2px solid #ec1313");
alert("Please provide the to date ");
$('#tdate').focus();
return false;
}

else {
    return true;
}

});
});

</script>
<script type="text/javascript">
$(document).ready(function(){
    
$("#submitnm").click(function(){
    
var sname = $("#spname").val();
var choose = $("#select_search").val();
// var tdate = $("#tdate").val();
if( choose ==''){
$('#select_search').css("border","2px solid #ec1313");
alert("Please provide field for search");
$('#select_search').focus();
return false;
}

if( sname ==''){
$('#spname').css("border","2px solid #ec1313");
$('#select_search').css("border","1px solid #D3D3D3");
alert("Please provide name for search");
$('#spname').focus();
return false;
}

else {
    return true;
}

});
});

</script>
</html>

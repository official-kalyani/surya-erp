<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Manage Asset Stock Item : Suryam Group</title>

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
        <script src="https://oss.maxcdn.com/libs/respond.../js/1.4.2/respond.min.js"></script>
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
    });
</script>
<script type="text/javascript">

function getPic()
{
   var select_search = document.getElementById('select_search').value;
   if(select_search == '4' || select_search == '7')
   {

     // $('#spname').datetimepicker();
     showDate();
   }
   else
   {
   $('#ldt').load('gettxtfld.php').fadeIn('fast');
   }
}







function showDate()
{
    $('#spname').datetimepicker({

        format:'YYYY-MM-DD',

        widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'

        }
    });
}
 function closeDate(){
      $('#spname').datepicker({
      format: "YYYY-MM-DD"
    }).on('change', function(){
        $('.datepicker').hide();
    });

 }
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
<!-- <script type="text/javascript">
    
   $("#select_search").change(function(){

 var select = $("#select_search").val();
  if( select == '4'){

   $('#spname').datetimepicker({

        format:'YYYY-MM-DD',

        widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'

        }
    });

  }
  else{
    closeDate();
  }

   });
</script> -->


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
                        <h4 class="page-header">Asset Item Management</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                
                <!-- Body Starts Here --> 
                            <!-- <span style="float:right;"> --> 
                <form name='search' method='POST'>  
                                          
                           <!--  </span> -->
                    
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <!--   <div class="row"> -->
                                    <span><a href="stock_assaignment.php" class="btn btn-success btn-xs" style="text-decoration:none;" ><b>ASSIGN STOCK </b></a>
                                    </span>
                                    
                                    <span style="float:right;">
                                      <div class="col-lg-2">
                                      <?php 
                                if(isset($_POST['submitnm']))    { // Show Only if Search Action Performed ?>
                                  <!--   <span style="float:left; padding-right:10px;"> -->
                                       
                                    <button onClick='javascript:location.href="aset_assaignment_listing.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                </div>
                                       
                                        <div class="col-lg-4">
                                          <select  name="select_search"  id="select_search" style="height: 21px;" onchange="getPic()">
                                              <option value>--select by search--</option>
                                              <option value="1">Asset no</option>
                                              <option value = "2">Serial no</option>
                                              <option value = "3">Name of Asset</option>
                                              <option value = "4">Date of purchase</option>
                                             
                                                <option value="5">Current Location</option>
                                                 <option value="6">Used By</option>
                                                  <option value="7">From Date</option>
                                             </select>
                                        </div>
                                               <div class="col-lg-4" >
                                               <div id="ldt">

                                                 <input type='text' name='spname' placeholder='Search Asset-Name'  id="spname" autocomplete="off" required="required">&nbsp &nbsp &nbsp
                                                </div>
                                                </div>
                                  <!--   <div class="col-lg-4" style="float: right;"> -->
                                        <div class="col-lg-2" >
                                        <input type='submit' name="submitnm" id="submitnm" value='Search' class="btn btn-success btn-xs" >
                                      <!--   </div> -->
                                        
                                </div>
                                       
                                       </span>
                            </div>
                                         
                                    
                                 <!--    </div> -->
                               <!--      </div> -->
                                    
                            
                         <!--             </div> -->
                              
                                
                                 
                            
                                
                           
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                                 <th>Slno</th>
                                                <th> Asset No</th>
                                                <th>Serial No</th>
                                                <th>Name Of Asset</th>
                                                <th>Date Of Purchase</th>
                                                <th> Current Location</th>
                                                <th> Used By</th>
                                                <th> From Date</th>
                                                <th>Operations</th>
                                            </tr> 
                                        </thead> 
                                        <tbody>



<?php
// Pagination
    
    $query = mysqli_query($con, "SELECT COUNT(*) as `num_t`  FROM ( SELECT COUNT(*) as `num` FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND y.status = '1' GROUP BY x.auto_serial) as X ");
    $total_pages = mysqli_fetch_array($query);
    $total_pages = $total_pages['num_t'];
    
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
    
    $next = $showing_limit + 1;                 // Next page is page + 1
    
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
              
                 if(isset($_POST['submitnm'])) // For Search
                    {
               
                $search = $_POST['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no  AND auto_serial LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                }
                else if($search == 2)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND serial_no LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                }
                else if($search == 3)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no  AND description LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial ");
                }
                else if($search == 4)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no  AND date_purchase LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                }
                 
                else if($search == 5)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND y.project_site LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                }
                else if($search == 6)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND y.fullname LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial ");
                }
                else if($search == 7)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND y.assaign_dt LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                }

                else{
                    $spname = mysqli_real_escape_string($con,$_POST['spname']);
                $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND y.status = '1' GROUP BY x.auto_serial LIKE '%$spname%' "); 
                // if(mysqli_num_rows($result) == 0)
                // {
                //      $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND auto_serial LIKE '%$spname%'");

                }
               
                    }
                    else // For Normal
                    {
                $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND y.status = '1' GROUP BY x.auto_serial ORDER BY x.id ASC limit $start,$limit"); 
     
               
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
                        
                        <td><?php echo $fetch->auto_serial ?></td>
                        
                        <td><?php echo $fetch->serial_no; ?></td>
                        <td><?php echo $fetch->description; ?></td>
                        <td><?php echo $fetch->date_purchase; ?></td>
                       
                        <?php

                        $serial = $fetch->auto_serial;
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = '$serial' AND x.auto_serial = y.asset_no ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {


                        ?>
                            <td><?php echo $fetch_ass_data->project_site; ?></td>
                            <td><?php echo $fetch_ass_data->fullname; ?></td>
                            <td><?php echo $fetch_ass_data->assaign_dt; ?></td>
                            <td><!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="aset_stock_assaign_detail.php?aset_no=<?php echo $fetch->asset_no; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>
                             
                <!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="manage_assaignment.php?aset_no=<?php echo $fetch->asset_no; ?>" style="text-decoration:none;" class="btn btn-success btn-xs" ><b>Manage Assignment</b></a>
                             
                        </td>
                        <?php 

                        }
                        } 

                        else 
                        {
                        ?>
                              <td></td>
                              <td></td>
                              <td></td>
                               <td><!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="aset_stock_assaign_detail.php?aset_no=<?php echo $fetch->asset_no; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>
                             
                <!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="manage_assaignment.php?aset_no=<?php echo $fetch->asset_no; ?>" style="text-decoration:none;" class="btn btn-success btn-xs" ><b>Manage Assignment</b></a>
                             
                        </td>
                        <?php 
                        }
                        
                        ?>
                     
                       
                    </tr> 
<?php $i++; } ?>
<?php // Error Message For Record Not Found.
  if(isset($Error_message))
    {
  echo "<tr align='center'><td colspan='11'> $Error_message </td></tr>";
    }
?>
                                        </tbody>
                                    </table>
<?php 
//Displaying Pagination. 
 if(!isset($_GET['spname']))
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
            
              </form>

            <!-- /#page-wrapper -->
        <?php require_once('../../footer.php'); ?>
        </div>


        <!-- /#wrapper -->

       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>
</html>

<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_GET['aset_no'])) // Delete query
{
 $asset = $_GET['aset_no'];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Manage Asset Assigned Stock : Suryam Group</title>

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
<script>
$(document).ready(function() { 
  startclock ();
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
                        <h4 class="page-header">Asset Assignment Details</h4>
                      </div>
                  </div>
                  <div class="row" style="height: 10px;">
                      <div class="col-lg-12" >
                       <span><button onClick='javascript:location.href="aset_assaignment_listing.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                       </span>


                 <?php
                 $quter = mysqli_query($con,"SELECT * FROM aset_stock_entry WHERE auto_serial = '$asset'");
                 $ftch_des = mysqli_fetch_object($quter);
                 ?>
                 <h4 class="page-header"><?php echo $ftch_des->description."(".$ftch_des->auto_serial.")" ." ". "detailed history";?></h4>
                
                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
                    <!-- /.col-lg-12 -->
           
               
                <!-- /.row -->
                <div class="row">
                <!-- Body Starts Here -->    
                 
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                           
                                


                               
                                    
                            <!--     <span style="float:right;">
                                <form name='search' method='get'>
                                    <input type='text' name='spname' placeholder='Search Asset-Name' autocomplete='off' style="width:95px;" required>
                                    <input type='submit' value='Search' class="btn btn-success btn-xs">
                                </form>
                                </span>
                            <?php if(isset($_GET['spname']))    { // Show Only if Search Action Performed ?>
                                <span style="float:right; padding-right:10px;">
                                <button onClick='javascript:location.href="listing.php"' class="btn btn-primary btn-xs">Refresh</button>
                                </span>
                            <?php } ?> -->
                                
                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Assigned To</th>
                                                <th>Current Location</th>
                                                <th>Assigned Date</th>
                                                <?php
                                                $qut = mysqli_query($con,"SELECT x.*, y.sub_type,z.* FROM  aset_stock_entry  x, aset_item_creation  y, vw_aset_stock_assaignment z WHERE  z.asset_no = '$asset' AND x.item_name = y.id AND x.auto_serial = z.asset_no ORDER BY z.id DESC limit 1");
                                                $ftch_row = mysqli_fetch_object($qut);
                                                   if($ftch_row->sub_type == '6')
                                                {
                                                ?>
                                                <th>Present Km Reading</th>
                                                <th>Present KM Reading Date</th> 
                                                <?php
                                            }
                                            else{

                                            }
                                            ?>
                                                <th>Recovery Date</th>

                                            </tr> 
                                        </thead> 
                                        <tbody>


<?php
// Pagination
    
   $query = mysqli_query($con, "SELECT COUNT(*) as `num` FROM  aset_stock_entry  x, aset_item_creation  y, vw_aset_stock_assaignment z WHERE  x.item_name = y.id AND x.auto_serial = z.asset_no");
    $total_pages = mysqli_fetch_array($query);
    $total_pages = $total_pages['num'];
    
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
            $pagination.= "<a href=\"?page=1&aset_no=$asset\">|« First</a> &nbsp;&nbsp;&nbsp;"; // First Page Link
            $pagination.= "<a href=\"?page=$prev&aset_no=$asset\">« Previous</a> &nbsp;&nbsp;&nbsp;";
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
                  $pagination .= '<a href="?page='.$i.'&aset_no='.$asset.'">'.$i.'</a> &nbsp;&nbsp;&nbsp;';
                }
             }
        
        else
          {
                 for($i = $first_number; $i <= $showing_limit; $i++)
             
                {
                 $pagination .= '<a href="?page='.$i.'&aset_no='.$asset.'">'.$i.'</a> &nbsp;&nbsp;&nbsp;';
                }
          }
        
        // Next button
        if ($page < $last_number)
            {
            $pagination.= "<a href=\"?page=$next&aset_no=$asset\">Next »</a> &nbsp;&nbsp;&nbsp;";
            $pagination.= "<a href=\"?page=$lastpage&aset_no=$asset\">Last »|</a>";
            }
        else
            {
            $pagination.= "<span class=\"disabled\">Next »</span> &nbsp;&nbsp;&nbsp;";
            $pagination.= "<span class=\"disabled\">Last »|</span>";
            }
        
      
       $pagination.= "</div>\n";       
    }
              
               // if(isset($_GET['spname'])) // For Search
               //      {
               //  $spname = mysqli_real_escape_string($con,$_GET['spname']); // Prevent SQL-Injection
               //  $result = mysqli_query($con,"SELECT x.*, y.sub_type,z.* FROM  aset_stock_entry  x, aset_item_creation  y, vw_aset_stock_assaignment z WHERE  z.asset_no = '$asset' AND x.item_name = y.id AND x.auto_serial = z.asset_no AND z.fullname LIKE '%$spname%'  ORDER BY z.id DESC"); 
               //      }
                // else // For Normal
                //     {
                $result = mysqli_query($con,"SELECT x.*, y.sub_type,z.* FROM  aset_stock_entry  x, aset_item_creation  y, vw_aset_stock_assaignment z WHERE  z.asset_no = '$asset' AND x.item_name = y.id AND x.auto_serial = z.asset_no ORDER BY z.id DESC limit $start,$limit"); 
                    // }
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
                        <td><?php echo $fetch->fullname; ?></td>
                        <td><?php echo $fetch->project_site; ?></td>
                        <td><?php echo $fetch->assaign_dt; ?></td>
                       <?php
          if($fetch->sub_type == '6' )
          {

            $quest = mysqli_query($con, "SELECT * FROM aset_km_reading WHERE  asset_no_id = '".$fetch->id."' ");
            if(mysqli_num_rows($quest) > 0)
            {
            while($ftch_data = mysqli_fetch_object($quest))
            {
            ?>
                        <td><?php echo $ftch_data->km_reading; ?></td>
                        <td><?php echo $ftch_data->reading_date; ?></td>
                    <?php } 
                }
                    else
                      {
                        ?>
                            <td></td>
                            <td></td>
                            <?php
                        }
                    }
                        ?>
                        <td>
                            <?php
                          $id = $fetch->assaign_to;
                          $recovery = mysqli_query($con,"SELECT * FROM `aset_recovery` WHERE `recovered_from` = '$id' AND `asset_no`= '$asset' ORDER BY id DESC");
                          // echo"SELECT * FROM `aset_recovery` WHERE `recovered_from` = '$id' AND `asset_no`= '$asset' ORDER BY id DESC";
                          if(mysqli_num_rows($recovery)>0)
                          {
                            $recovery_fetch = mysqli_fetch_object($recovery);

                            echo $recovery_fetch->recovery_date;
                          }
                          else{
                            $assaign = mysqli_query($con,"SELECT * FROM `aset_stock_assaignment` WHERE `assaign_to` = '$id' AND `asset_no` = '$asset' AND `status` = '1'");
                            if(mysqli_num_rows($assaign) > 0)
                            {
                                echo "Using";
                            }
                            else{
                               $recovery_dt = mysqli_query($con,"SELECT * FROM `aset_stock_assaignment` WHERE `assaign_to` = '$id' AND `asset_no` = '$asset' AND `status` = '0'");
                               $recovery_data = mysqli_fetch_object($recovery_dt);
                               if($recovery_data->recovery_date != '')
                               {
                                echo $recovery_data->recovery_date;
                               }
                            }
                          }
                          ?> 
                        </td>
                    </tr>
<?php $i++; }
 ?>
<?php // Error Message For Record Not Found.
  if(isset($Error_message))
    {
  echo "<tr align='center'><td colspan='4'> $Error_message </td></tr>";
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

<?php
}
?>


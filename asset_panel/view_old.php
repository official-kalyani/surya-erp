<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Manage Asset Item Field : Suryam Group</title>

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
                        <h4 class="page-header">Asset Field Details</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                <div class="row">
                <!-- Body Starts Here -->    
                
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span><button onClick='javascript:location.href="feild_entry.php"' class="btn btn-success btn-xs" style="font-weight: bold;">ADD FIELD</button>
                                </span>
                                
                                <span style="float:right;">
                                <form name='search' method='get'>
                                    <input type='text' name='spname' placeholder='Search Asset-subtype' autocomplete='off' style="width:95px;" required>
                                    <input type='submit' value='Search' class="btn btn-success btn-xs">
                                </form>
                                </span>
                            <?php if(isset($_GET['spname']))    { // Show Only if Search Action Performed ?>
                                <span style="float:right; padding-right:10px;">
                                <button onClick='javascript:location.href="view.php"' class="btn btn-primary btn-xs">Refresh</button>
                                </span>
                            <?php } ?>
                                
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead> 
                                                     <tr> 
                                                        <th>Slno</th>
                                                        <th> Sub-type</th>
                                                        <th>Operations</th> 
                                                    </tr> 
                                        </thead> 
                                        <tbody>


<?php
// Pagination
    
    $query =  mysqli_query($con, "SELECT COUNT(*) as `num` from `aset_feild_entry` where `status`='1'");
    $total_pages = mysqli_fetch_array($query);
    $total_pages = $total_pages['num'];
    
    $limit = 15;                                 // How many items to show per page
    
    
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
               if(isset($_GET['spname'])) // For Search
                    {
                $spname = mysqli_real_escape_string($con,$_GET['spname']); // Prevent SQL-Injection
                $result = mysqli_query($con,"SELECT x.*,y.subtypenm FROM `aset_feild_entry` x, `fin_grouping_subtype` y WHERE y.`subtypenm` LIKE '%$spname%'  AND x.`sub_type_id` = y.`id` and x.`status`='1'  GROUP BY x. sub_type_id"); 
                    }
                else // For Normal
                    {
                $result = mysqli_query($con,"SELECT x.*,y.subtypenm FROM `aset_feild_entry` x, `fin_grouping_subtype` y WHERE x.`sub_type_id` = y.`id` and x.`status`='1'  GROUP BY x. sub_type_id limit $start,$limit"); 
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
                                            <tr>  
                                                <td><?php echo $i; ?></td> 
                                                <td><?php echo $fetch->subtypenm; ?></td>
                                                
                                                <td>
                                                   
                                                    <!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                                                    <a href="viewpg_feild_entry.php?id=<?php echo $fetch->id;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>
                                                     <?php 
                                                    $assetID = array("2","74","316","215");

                                                    if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){

                                                     ?>
                                                    <a href="feild_entry.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-success btn-xs" ><b>Edit</b></a>
                                                     <?php } ?>
                                                </td>
                                            </tr>   
<?php $i++; } ?>
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

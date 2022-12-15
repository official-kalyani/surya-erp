<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php  $assetID = array("2","74","316","215","1","55","330"); ?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Stock Report : Suryam Group</title>

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
   if(select_search == '4' || select_search == '10')
   {

     // $('#spname').datetimepicker();
     showDate();
   }
   else if(select_search == '12')
   {
    $('#ldt').load('form3.php').fadeIn('fast');
   }
   else if(select_search == '13')
   {
    $('#ldt').load('org.php').fadeIn('fast');
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
                        <h4 class="page-header">Asset Stock Report</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                
                <!-- Body Starts Here --> 
                            <!-- <span style="float:right;"> --> 
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
                                       
                                    <button onClick='javascript:location.href="stockreport.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                            <?php
                                            if(isset($_POST['sdate']) || isset($_POST['tdate']) || isset($_POST['spname']))
                    {
                      if($_POST['sdate'] != '' || $_POST['tdate'] !='')
                      {
                        ?>
                         <a href="printreport.php?sdate=<?php echo $_POST['sdate'];?>&tdate=<?php echo $_POST['tdate'];?>&spname=<?php echo $_POST['spname'];?>&select_search=<?php echo $_POST['select_search'];?>&empid=<?php echo $_SESSION['ERP_SESS_ID'] ;?>" class="btn btn-warning btn-xs" style="text-decoration:none;" target="_blank"><b>Print</b></a>
                         <a href="downloadreport.php?sdate=<?php echo $_POST['sdate'];?>&tdate=<?php echo $_POST['tdate'];?>&spname=<?php echo $_POST['spname'];?>&select_search=<?php echo $_POST['select_search'];?>&empid=<?php echo $_SESSION['ERP_SESS_ID'] ;?>" class="btn btn-warning btn-xs" style="text-decoration:none;" ><b>Download</b></a>
                         <?php
                      }
                      else{
                        ?>
                <a href="printreport.php?empid=<?php echo $_SESSION['ERP_SESS_ID'] ;?>" class="btn btn-warning btn-xs" style="text-decoration:none;"  target="_blank" ><b>Print</b></a>
                <a href="downloadreport.php?empid=<?php echo $_SESSION['ERP_SESS_ID'] ;?>" class="btn btn-warning btn-xs" style="text-decoration:none;"><b>Download</b></a>
                <?php

                      }
                    
                }
               
                      
                
                    else // For Normal
                    {
                        ?>
                <a href="printreport.php?empid=<?php echo $_SESSION['ERP_SESS_ID'] ;?>" class="btn btn-warning btn-xs" style="text-decoration:none;"  target="_blank" ><b>Print</b></a>
                <a href="downloadreport.php?empid=<?php echo $_SESSION['ERP_SESS_ID'] ;?>" class="btn btn-warning btn-xs" style="text-decoration:none;"><b>Download</b></a>
                <?php
                    } ?>


                                </div>
                              </form>
                                                       
                           <!--  </span> -->
                    
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="height:40px;">
                              <!--   <div class="row"> -->
                                   
                                    <form name="text_search" method="GET">

                                       <span>
                                        <button type="button" onClick='javascript:location.href="stockreport.php"' class="btn btn-default btn-md active btn-xs" style="font-weight: bold;">User Asset List</button>
                                         <?php
                                    if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){
                                      ?>  
                                        <button type="button" onClick='javascript:location.href="admin_stockreport.php"' class="btn btn-primary btn-xs" style="text-decoration:none;">ADMIN ASSET LIST</button>
                                        <?php
                                      }
                                      ?>
                                    </span>
                                    <span style="float:right;">
                                      <div class="col-lg-2">
                                      <?php 
                                if(isset($_GET['submitnm']))    { // Show Only if Search Action Performed ?>
                                  <!--   <span style="float:left; padding-right:10px;"> -->
                                       
                                    <button onClick='javascript:location.href="stockreport.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                </div>
                                       
                                        <div class="col-lg-4">
                                          <select  name="select_search"  id="select_search" style="height: 21px;" onchange="getPic()">
                                             <option value>--select by search--</option>
                                              <option value="1">Asset no.</option>
                                              <option value = "2">Serial no</option>
                                              <option value = "3">Name of Asset</option>
                                              <option value="14"> Category</option>
                                              <option value="15">Sub Category</option>
                                              <option value = "4">Date of purchase</option>
                                              <option value = "5">Supplier</option>
                                              <option value="6">Invoice No</option>
                                               <option value="7">QTY</option>
                                               <option value="11">Item Sub Type</option>
                                               <option value="13">Organisation</option>
                                                <option value="8">Current Location</option>
                                                 <option value="9">Used By</option>
                                                  <option value="10">From Date</option>
                                                  <option value="12">Status</option>
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
                                                <th> Serial No</th>
                                                <th>Name Of Asset</th>
                                                <th>Sub Type</th>
                                                 <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th> Date Of Purchase</th>
                                                <th> Supplier</th>
                                                <th> Invoice No.</th>
                                                <th> QTY</th>
                                                <th>Item Sub Type</th>
                                                <th>Organisation</th>
                                                <th> Current Location</th>
                                                <th> Used By</th>
                                                <th> From Date</th>
                                                <th>Status</th>
                                               
                                                <th>Operations</th> 
                                            </tr> 
                                        </thead> 
                                        <tbody>



<?php
// Pagination
     
                                    if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){
                                      
    $query = mysqli_query($con, "SELECT COUNT(*) as `num` from `aset_stock_entry` where `status`='1' AND `asset_type` = 'Admin'");
  }
    else{
       $query = mysqli_query($con, "SELECT COUNT(*) as `num` from `aset_stock_entry` where `status`='1' AND `asset_type` = 'User'");

    }
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
    $assetID = array("2","74","316","215","55","330");

                        if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){

               if(isset($_POST['submitdt']))
                    {
                         $spdate = $_POST['sdate'];
                         $SESSION['spdate']= $spdate;
                        
                         $pdate = $_POST['tdate'];
                         $SESSION['pdate']= $pdate;
                         $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User'  AND x.date_purchase BETWEEN '$spdate' AND '$pdate' "); 
                    }
                
                else if(isset($_GET['submitnm'])) // For Search
                    {
                     
               
                $search = $_GET['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = mysqli_real_escape_string($con,$_GET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.auto_serial LIKE '%$spname%'");
                }
                else if($search == 2)
                     {
                     $spname = mysqli_real_escape_string($con,$_GET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.serial_no LIKE '%$spname%'");
                }
                else if($search == 3)
                     {
                     $spname = mysqli_real_escape_string($con,$_GET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.description LIKE '%$spname%' ");
                }
                else if($search == 4)
                     {
                     $spname = mysqli_real_escape_string($con,$_GET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.date_purchase LIKE '%$spname%'");
                }
                 else if($search == 5)
                     {
                     $spname = mysqli_real_escape_string($con,$_GET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.supplier LIKE '%$spname%'");
                }
                 else if($search == 6)
                     {
                     $spname = mysqli_real_escape_string($coGET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.inv_no LIKE '%$spname%' ");
                }
                else if($search == 7)
                     {
                     $spname = mysqli_real_escape_string($coGET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.qty LIKE '%$spname%' ");
                }
                else if($search == 8)
                     {
                     $spname = mysqli_real_escape_string($coGET['spname']);
                    $abc = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND x.asset_type = 'User' AND y.project_site LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                    if(mysqli_num_rows($abc) > 0)
                    {
                      $result = mysqli_query($con,"SELECT x.*, x.id as xid,x.description as xdescription, y.*, y.id as id ,z.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y, aset_item_creation z WHERE x.auto_serial = y.asset_no AND x.item_name = z.id AND x.asset_type = 'User' AND y.project_site LIKE '%$spname%' AND y.status = 1  GROUP BY x.auto_serial");

                    }
                    else{
                          $result = mysqli_query($con,"SELECT x.*, x.id as xid,x.description as xdescription, y.*, y.id as id ,z.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y, aset_item_creation z WHERE x.auto_serial = y.asset_no AND x.asset_type = 'User' AND x.item_name = z.id AND x.godowo LIKE '%$spname%'  GROUP BY x.auto_serial");

                    }
                }
                else if($search == 9)
                     {
                     $spname = mysqli_real_escape_string($coGET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.*,z.sub_type FROM aset_stock_entry  x, vw_aset_stock_assaignment y,aset_item_creation z WHERE x.auto_serial = y.asset_no AND x.item_name = z.id  AND x.asset_type = 'User' AND y.fullname LIKE '%$spname%' GROUP BY x.auto_serial ");
                }
                else if($search == 10)
                     {
                     $spname = mysqli_real_escape_string($con,$_GET['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.*,z.sub_type FROM aset_stock_entry  x, vw_aset_stock_assaignment y,aset_item_creation z WHERE x.auto_serial = y.asset_no AND x.item_name = z.id AND x.asset_type = 'User' AND y.assaign_dt LIKE '%$spname%' GROUP BY x.auto_serial ");
                }
                 else if($search == 11)
                {
                  $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.asset_type = 'User' AND y.name LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                  else if($search == 12)
                {
                  $spname = $_GET['spname'];
                  if($spname == '1')
                   {
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,x.id as xid, y.*, y.id as yid,z.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y ,aset_item_creation z WHERE  x.auto_serial = y.asset_no AND x.item_name = z.id AND x.asset_type = 'User'  GROUP BY x.auto_serial");
                  }
                  else if($spname == '2')
                  {
                   
                   $result = mysqli_query($con,"SELECT  x.*,x.description as xdescription,y.*  from   aset_stock_entry x,aset_item_creation y  WHERE x.auto_serial  NOT IN (SELECT asset_no from aset_stock_assaignment GROUP BY asset_no) AND x.item_name = y.id AND x.asset_type = 'User'");
                   
                }
              }
                else if($search == 13)
                {
                  $spname = $_GET['spname'];
                
                $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type,z.* FROM  aset_stock_entry x ,  aset_item_creation  y , prj_organisation z WHERE x.item_name = y.id AND x.organisation = z.id AND x.asset_type = 'User' AND x.organisation = '$spname' GROUP BY x.auto_serial");
              }
               else if($search == 14)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.aset_category LIKE '%$spname%' GROUP BY x.auto_serial");
              }
               else if($search == 15)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.aset_subcategory LIKE '%$spname%' GROUP BY x.auto_serial");
              }

               


               
                    }
                    else // For Normal
                    {
                $result = mysqli_query($con," SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' ORDER BY x.auto_serial limit $start,$limit"); 
     
               
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
                        <td><?php echo $fetch->auto_serial;   ?></td>
                        
                        <td><?php echo $fetch->serial_no; ?></td>
                        <td><?php echo $fetch->xdescription; ?></td>
                        <?php
                        $sub_type = $fetch->sub_type;
                         $ass_subtype = mysqli_query($con, "SELECT x.*, y.* FROM aset_item_creation  x, fin_grouping_subtype y WHERE x.sub_type = '$sub_type' AND x.sub_type = y.id") ;
                         $fetch_type = mysqli_fetch_object($ass_subtype);
                        ?>
                        <td><?php echo $fetch_type->subtypenm; ?></td>
                        <!-- <td><?php echo $fetch->description; ?></td> -->
                        <td>
                          <?php
                          if( $fetch->aset_category != '')
                          {
                            echo $fetch->aset_category;
                          }
                          ?>
                        </td>
                        <td><?php
                          if( $fetch->aset_subcatagory != '')
                          {
                            echo $fetch->aset_subcatagory;
                          }
                          ?></td>
                         
                        <td><?php echo $fetch->date_purchase; ?></td>
                        <td><?php echo $fetch->supplier; ?></td>
                        <td><?php echo $fetch->inv_no; ?></td>
                        <td><?php echo $fetch->qty; ?></td>
                        <td>
                         <?php

                        $serial = $fetch->item_name;
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = '$serial' AND x.item_name = y.id ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {


                        ?>
                        <?php echo $fetch_ass_data->name; ?></td>
                        <?php
                      }
                    }
                      ?>
                  
                         <td> <?php 
                      $serial = $fetch->auto_serial;
                      $org = mysqli_query($con,"SELECT x.*,y.* FROM  aset_stock_entry x ,prj_organisation  y WHERE x.organisation = y.id AND x.auto_serial = '$serial'  GROUP BY x.auto_serial");
                      while ($fetch_org = mysqli_fetch_object($org))
  {

                       ?>
                     <?php echo $fetch_org->organisation; ?>
                       <?php
                     }
                     ?></td>
                        <?php

                        $serial = $fetch->auto_serial;
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = '$serial' AND x.auto_serial = y.asset_no AND y.status = '1' ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {


                        ?>
                            <td><?php echo $fetch_ass_data->project_site  ?></td>
                            <td><?php echo $fetch_ass_data->fullname; ?></td>
                            <td><?php echo $fetch_ass_data->assaign_dt; ?></td>
                            <td>Assigned</td>

                             <td><!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="stock_detal_data.php?id=<?php echo $fetch_ass_data->xid;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>

                            
                        </td>
                        <?php 

                        }
                        } 

                        else 
                        {
                        ?>
                              <td><?php echo $fetch->godowo; ?></td>
                              <td></td>
                              <td></td>
                               <td>Not assigned</td>
                              <td><!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="stock_detal_data.php?id=<?php echo $fetch->id;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>
                            
                            
                        </td>
                        <?php 
                        }
                        
                        ?>
                     
                       
                    </tr> 
<?php $i++; } ?>
<?php }
else {
   
  $user_id = $_SESSION['ERP_SESS_ID'];
                      $abc = mysqli_query($con,"SELECT * FROM `aset_stock_assaignment` WHERE `assaign_to` = '$user_id' AND `status` = '1' GROUP BY `asset_no`");
                     
                      $i=1;
                      $x=1;
                       if(mysqli_num_rows($abc) > 0)
                      {
                      while($abc_fe = mysqli_fetch_object($abc))
                      {

                        $serial = $abc_fe->asset_no;
                        // echo $serial;
                        $abs = mysqli_query($con,"SELECT x.*,y.sub_type,z.* FROM  aset_stock_entry x ,  aset_item_creation  y, aset_stock_assaignment z WHERE x.auto_serial ='$serial' AND  x.item_name = y.id AND z.asset_no = x.auto_serial AND x.asset_type = 'User'  ORDER BY z.id DESC LIMIT 1");

                        $abs_fet = mysqli_fetch_object($abs);
                        if($user_id == $abs_fet->assaign_to)
                        {
                          
                          $serial = $abs_fet->auto_serial;
                           if(isset($_POST['submitdt']))
                    {
                      
                         $spdate = $_POST['sdate'];
                        
                         $SESSION['spdate']= $spdate;
                        
                         $pdate = $_POST['tdate'];
                        
                         $SESSION['pdate']= $pdate;
                         $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.auto_serial = '$serial'  AND x.date_purchase BETWEEN '$spdate' AND '$pdate'  GROUP BY x.auto_serial"); 

                    }
                    else if(isset($_POST['submitnm'])) // For Search
                    {
                  
                $search = $_POST['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.auto_serial LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                else if($search == 2)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.serial_no LIKE '%$spname%'GROUP BY x.auto_serial");
                }
                else if($search == 3)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.description LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                else if($search == 4)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.date_purchase LIKE '%$spname%'GROUP BY x.auto_serial");
                }
                 else if($search == 5)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.supplier LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                 else if($search == 6)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.inv_no LIKE '%$spname%' GROUP BY x.auto_serial ");
                }
                else if($search == 7)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND x.qty LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                else if($search == 8)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, x.id as xid, y.*, y.id as id,z.sub_type FROM aset_stock_entry  x, vw_aset_stock_assaignment y,aset_item_creation z WHERE x.auto_serial = y.asset_no AND  x.item_name = z.id AND x.auto_serial = '$serial'  AND y.assaign_to = '$user_id' AND y.project_site LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                else if($search == 9)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*, x.description as xdescription,y.*,z.sub_type FROM aset_stock_entry  x, vw_aset_stock_assaignment y,aset_item_creation z WHERE x.auto_serial = y.asset_no AND x.item_name = z.id AND x.auto_serial = '$serial' AND y.fullname LIKE '%$spname%' GROUP BY x.auto_serial ");
                }
                else if($search == 10)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.*,z.sub_type FROM aset_stock_entry  x, vw_aset_stock_assaignment y,aset_item_creation z WHERE x.auto_serial = y.asset_no AND x.item_name = z.id AND x.auto_serial = '$serial' AND y.assaign_dt LIKE '%$spname%' GROUP BY x.auto_serial ");
                }
                else if($search == 11)
                {
                  $spname = mysqli_real_escape_string($con,$_POST['spname']);
                   $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$serial' AND y.name LIKE '%$spname%' GROUP BY x.auto_serial");
                }
                  else if($search == 12)
                {
                  $spname = $_POST['spname'];
                  if($spname == '1')
                   {
                    $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,x.id as xid, y.*, y.id as yid,z.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y ,aset_item_creation z WHERE  x.auto_serial = y.asset_no AND x.item_name = z.id AND x.auto_serial = '$serial' GROUP BY x.auto_serial");
                  }
                  else if($spname == '2')
                  {
                   
                   $result = mysqli_query($con,"SELECT  x.*,x.description as xdescription,y.*  from   aset_stock_entry x,aset_item_creation y  WHERE x.auto_serial  NOT IN (SELECT asset_no from aset_stock_assaignment GROUP BY asset_no) AND x.item_name = y.id AND x.auto_serial = '$serial'");
                  
                }
              }
               else if($search == 13)
                {
                  $spname = $_POST['spname'];
                  // echo $spname;
                $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type,z.* FROM  aset_stock_entry x ,  aset_item_creation  y , prj_organisation z WHERE x.item_name = y.id AND x.organisation = z.id AND x.organisation = '$spname' AND x.auto_serial = '$serial' GROUP BY x.auto_serial");
              }
               else if($search == 14)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.aset_category LIKE '%$spname%' GROUP BY x.auto_serial");
              }
               else if($search == 15)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*,x.description as xdescription, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.asset_type = 'User' AND x.aset_subcategory LIKE '%$spname%' GROUP BY x.auto_serial");
              }


               

               
                    }
                    else{
                        // $x++;
                          $result = mysqli_query($con,"SELECT x.*,x.description as xdescription,y.sub_type FROM  aset_stock_entry x ,  aset_item_creation  y WHERE x.item_name = y.id AND x.auto_serial = '$serial' GROUP BY x.auto_serial limit $start,$limit");
                           $total_results = mysqli_num_rows($result);
       
 
                        }
                           
        
     
    while($fetch=mysqli_fetch_object($result))
        {
           $x++;
?>
                              
                                                <tr>  
                        <td><?php echo $i; ?></td> 
                        <td><?php echo $fetch->auto_serial;   ?></td>
                        
                        <td><?php echo $fetch->serial_no; ?></td>
                        <td><?php echo $fetch->xdescription; ?></td>
                        <?php
                        $sub_type = $fetch->sub_type;
                         $ass_subtype = mysqli_query($con, "SELECT x.*, y.* FROM aset_item_creation  x, fin_grouping_subtype y WHERE x.sub_type = '$sub_type' AND x.sub_type = y.id") ;
                         $fetch_type = mysqli_fetch_object($ass_subtype);
                        ?>
                         <td><?php echo $fetch_type->subtypenm; ?></td>
                          <td>
                          <?php
                          if( $fetch->aset_category != '')
                          {
                            echo $fetch->aset_category;
                          }
                          ?>
                        </td>
                        <td><?php
                          if( $fetch->aset_subcatagory != '')
                          {
                            echo $fetch->aset_subcatagory;
                          }
                          ?></td>
                        <td><?php echo $fetch->date_purchase; ?></td>
                        <td><?php echo $fetch->supplier; ?></td>
                        <td><?php echo $fetch->inv_no; ?></td>
                        <td><?php echo $fetch->qty; ?></td>
                        <td>
                        <?php

                        $serial = $fetch->item_name;
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = '$serial' AND x.item_name = y.id ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {


                        ?>
                        <?php echo $fetch_ass_data->name; ?>
                        <?php
                      }
                    }
                      ?> </td>
                      <td>
                      <?php 
                      $serial = $fetch->auto_serial;
                      $org = mysqli_query($con,"SELECT x.*,y.* FROM  aset_stock_entry x ,prj_organisation  y WHERE x.organisation = y.id AND x.auto_serial = '$serial'  GROUP BY x.auto_serial");
                      while ($fetch_org = mysqli_fetch_object($org))
  {

                       ?>
                       <?php echo $fetch_org->organisation; ?>
                       <?php
                     }
                     ?></td>
                        <?php

                        $serial = $fetch->auto_serial;
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = '$serial' AND x.auto_serial = y.asset_no ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {


                        ?>
                            <td><?php echo $fetch_ass_data->project_site  ?></td>
                            <td><?php echo $fetch_ass_data->fullname; ?></td>
                            <td><?php echo $fetch_ass_data->assaign_dt; ?></td>
                            <td>Assigned</td>
                             <td><!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="stock_detal_data.php?id=<?php echo $fetch_ass_data->xid;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>

                            
                        </td>
                        <?php 

                        }
                        } 

                        else 
                        {
                        ?>
                              <td><?php echo $fetch->godowo; ?></td>
                              <td></td>
                              <td></td>
                              <td>Not assigned</td>
                              <td><!-- <a href="item_creation.php?id=<?php echo $fetch->id; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs"><b>view</b></a> -->
                            <a href="stock_detal_data.php?id=<?php echo $fetch->id;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a>
                            
                            
                        </td>
                        <?php 
                        }
                        
                        ?>
                     
                       
                    </tr> 
<?php $i++; } ?>
<?php


}


}
 $total_results = mysqli_num_rows($abs);
        if($x==1) // Set For Record Not Found 
        {
            $Error_message="NO RECORDS FOUND.";
        }  
}
else{

 
  $total_results = mysqli_num_rows($abc);
        if($x==1) // Set For Record Not Found 
        {
            $Error_message="NO RECORDS FOUND.";
        }     
}
    }


  
 ?>
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
    <script type="text/javascript">
$(document).ready(function(){
    
$("#submitdt").click(function(){
    
var sdate = $("#sdate").val();
var tdate = $("#tdate").val();
// var HSN = $("#itemcode").val();
// var select = $('#itemtype').val();
// var desc = $("#itemdesc").val();
// var tname = $("#tname").val();

// Checking for Blank Fields.

if( sdate ==''){
$('#sdate').css("border","2px solid #ec1313");
alert("Please provide from date");
$('#sdate').focus();
return false;
}
if( tdate ==''){
  $('#sdate').css("border","1px solid #D3D3D3");
$('#tdate').css("border","2px solid #ec1313");
alert("Please provide the from date ");
$('#tdate').focus();
return false;
}
// if( HSN ==''){
//    $('#itemname, #itemno').css("border","1px solid #D3D3D3");
// $('#itemcode').css("border","2px solid #ec1313");
// alert("Provide HSN code");
// $('#itemcode').focus();
// return false;
// }
// if( select ==''){
//    $('#itemname, #itemno, #itemcode').css("border","1px solid #D3D3D3");
// $('#itemtype').css("border","2px solid #ec1313");
// alert("Select sub-type");
// $('#itemname').focus();
// return false;
// }
// if( desc ==''){
//      $('#itemname, #itemno, #itemcode, #itemtype').css("border","1px solid #D3D3D3");

// $('#itemdesc').css("border","2px solid #ec1313");
// alert("Provide description ");
// $('#itemdesc').focus();
// return false;
// }

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

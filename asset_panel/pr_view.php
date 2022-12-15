<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Asset Procurement Request  : Suryam Group</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../css/startmin.css" rel="stylesheet">
        <!-- New added css by kalyani 1-9-22-->
        <link href="../../css/custom-menu.css" rel="stylesheet" type="text/css">
        <link href="../../css/responcive.css" rel="stylesheet" type="text/css">
        <!-- New added css by kalyani 1-9-22-->
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
   if(select_search == '6' || select_search == '11')
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
                        <h4 class="page-header">Procurement Request</h4>
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
                                    <span><button type="button"onClick='javascript:location.href="aset_pr_form.php"' class="btn btn-success btn-xs" style="font-weight: bold;">RAISE</button>
                                  <button type="button" onClick='javascript:location.href="pr_pend.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">PENDING</button>
                                </span>
                                    
                                    <span style="float:right;">
                                      <div class="col-lg-2">
                                      <?php 
                                if(isset($_POST['submitnm']))    { // Show Only if Search Action Performed ?>
                                  <!--   <span style="float:left; padding-right:10px;"> -->
                                       
                                    <button onClick='javascript:location.href="pr_view.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                </div>
                                       
                                        <div class="col-lg-4">
                                          <select  name="select_search"  id="select_search" style="height: 21px;" onchange="getPic()">
                                              <option value>--select by search--</option>
                                              <option value="1">Asset PR No.</option>
                                            <!--   <option value = "2">Material</option>
                                              <option value = "4">UOM</option>
                                              <option value = "5">QTY</option> -->
                                             
                                                <option value="6">Date</option>
                                                 <option value="9">Placed By</option>
                                                 <option value="8">Cost Center</option>
                                                 <option value="7">Location</option>
                                                 <option value="3">Position</option>
                                                  <option value="10">Status</option>
                                                  <option value="11">Stdate</option>
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
                                                <th>Asset PR No</th>
                                                <!-- <th> Material</th>
                                                <th>UOM</th>
                                                <th>QTY</th> -->
                                                <th>Date</th>
                                                <th>Placed By</th> 
                                                <th>Cost Center</th>
                                                <th>Location</th> 
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Stdate</th>
                                                <th>Operation</th>
                                            </tr> 
                                        </thead> 
                                        <tbody>



<?php
// Pagination
 $assetID = array("2","74","316","215","1","55");

                        if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){
    
    $query = mysqli_query($con, "SELECT COUNT(*) as `num`, x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id  ");
  }

  else{
    $emp_id = $_SESSION['ERP_SESS_ID'];
 $query = mysqli_query($con, "SELECT COUNT(*) as `num`,x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id') AND x.status = '0' ");
  }  
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

                        $assetID = array("2","74","316","215","1");

                        if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){

                       
              
                 if(isset($_POST['submitnm'])) // For Search
                    {
               
                $search = $_POST['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.aset_pr_no = '$spname' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                }
                // else if($search == 2)
                //      {
                //      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                //     $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND w.name LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                // }
                else if($search == 3)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id  AND u.req_to = z.id AND x.project = v.id  AND z.fullname LIKE '%$spname%' AND u.status = '0' GROUP BY x.aset_pr_no ORDER BY u.pr_id DESC");
                }
                // else if($search == 4)
                //      {
                //      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                //     $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND y.uom LIKE '%$spname%'  GROUP BY x.aset_pr_no ORDER BY u.id DESC");
                // }
                 
                // else if($search == 5)
                //      {
                //      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                //     $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND y.qty LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                 // }
                else if($search == 6)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.created_on = '$spname' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC ");
                }
                else if($search == 7)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.godown LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC");
                }
                 else if($search == 8)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND v.pname LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC");
                }
                 else if($search == 9)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND z.fullname LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC");
                }
                 else if($search == 10)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                     if($spname == 'approved')
                     {
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.status = '1' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC");
                    }
                    else if($spname == 'rejected')
                    {
                        $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.status = '2' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC");
                    }
                    else{
                         $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.status = '0' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC");
                    }

                }
                 else if($search == 11)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id  AND u.req_to = z.id AND x.project = v.id  AND u.date=' $spname' AND u.status = '0' GROUP BY x.aset_pr_noORDER BY x.created_on DESC");
                }

                else{
                    $spname = mysqli_real_escape_string($con,$_POST['spname']);
                $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.aset_pr_no = '$spname' GROUP BY x.aset_pr_no ORDER BY x.created_on DESC "); 
                // if(mysqli_num_rows($result) == 0)
                // {
                //      $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND auto_serial LIKE '%$spname%'");

                }
               
                    }
                    else // For Normal
                    {
                $result = mysqli_query($con," SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id  GROUP BY x.aset_pr_no ORDER BY x.created_on DESC limit $start,$limit"); 
     
               
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
                        <td><?php echo $fetch->aset_pr_no; ?></td>
                        <!-- <td><?php echo $fetch->name; ?></td>
                        <td><?php echo $fetch->uom; ?></td>
                        <td><?php echo $fetch->qty; ?></td> -->
                        <td><?php echo $fetch->created_on; ?></td>
                         <?php
                        $id = $fetch->xid;
                        $query1 = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_pr x, mstr_emp y WHERE x.id = '$id' AND x.req_by = y.id");
                        $fetch_name = mysqli_fetch_object( $query1);


                        ?>
                        <td><?php echo $fetch_name->fullname; ?></td>
                        <td><?php echo $fetch->pname;?></td>
                        <td><?php echo $fetch->godown; ?></td>
                        <?php
                        $id = $fetch->xid;
                        $query = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_pr_req_to x, mstr_emp y WHERE x.pr_id = '$id' AND x.req_to = y.id ORDER BY x.id DESC LIMIT 1");
                        $fetch_position = mysqli_fetch_object( $query);


                        ?>
                        <td><?php echo $fetch_position->fullname; ?></td>
                        <?php
                        if($fetch->xstatus == '2')
                        {
                            ?>
                            <td><?php echo "rejected";?></td>
                            <?php
                        }
                       
                        else if($fetch->xstatus == '1')
                        {
                            ?>
                            <td><?php echo "approved";?></td>
                            <?php
                        }
                        
                       else
                        {
                            ?>
                            <td><?php echo "pending";?></td>
                            <?php
                        }
                        ?>

                        
                        <td><?php echo $fetch_position->date; ?></td>
                        
                        <td>
                            
                            <a href="vwpg_pr_data.php?id=<?php echo $fetch->xid; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>view</b></a>
                             
                           
                        </td>
                    </tr>
<?php $i++; }
}
else{
  $emp_id = $_SESSION['ERP_SESS_ID'];
  $query = mysqli_query($con, "SELECT x.*,x.id as xid,y.* FROM aset_pr x,aset_pr_req_to y WHERE x.id = y.pr_id AND x.req_by = '$emp_id'  OR y.req_to = '$emp_id'");
            $query_array =  array( );
            // $query_req =  array( );

        
              // echo "SELECT * FROM aset_pr_req_to WHERE req_to = '$id' AND status ='0'";
            $x =1;
              while($query_ftch = mysqli_fetch_object($query))
              {
                
                $id =$query_ftch->req_to;
                //  }
                 
                //   print_r($query_array);
                //   foreach ($query_array as $id) 
                //  {
                  
              //      if($id == $emp_id)
              //   {
              //     // echo "SELECT x.*,x.id as xid,y.* FROM aset_pr x,aset_pr_req_to y WHERE x.id = y.pr_id AND x.req_by = '$id'  OR y.req_to = '$id' GROUP BY x.aset_pr_no";
              //     $query1 = mysqli_query($con, "SELECT x.*,x.id as xid,y.* FROM aset_pr x,aset_pr_req_to y WHERE x.id = y.pr_id AND x.req_by = '$id'  OR y.req_to = '$id' GROUP BY x.aset_pr_no");
              //     $query_req =  array( );
              //      while($query_ftch_id = mysqli_fetch_object($query1))
              // {
               
              //   $query_req[] = $query_ftch_id->pr_id;

              //    }
              //  }
             
             
                 // foreach ($query_req as $id) 
                 // {
  // echo $id;
                    if(isset($_POST['submitnm'])) // For Search
                    {
               
                $search = $_POST['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND x.aset_pr_no = '$spname'  GROUP BY x.aset_pr_no  ASC");
                }
                // else if($search == 2)
                //      {
                //      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                //     $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.id = '$id' AND w.name LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                // }
                else if($search == 3)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id') AND z.fullname LIKE '$spname' AND u.status = '0' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");


                }
                // else if($search == 4)
                //      {
                //      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                //     $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.id = '$id' AND y.uom = '$spname' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                // }
                 
                // else if($search == 5)
                //      {
                //      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                //     $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name ,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w,prj_project v WHERE x.id = y.last_id AND x.req_by = z.id AND y.aset_name = w.id AND x.project = v.id AND x.id = '$id' AND y.qty = '$spname' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                // }
                else if($search == 6)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND x.created_on = '$spname' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC ");
                }
                else if($search == 7)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND x.godown LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                }
                 else if($search == 8)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND v.pname LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                }
                 else if($search == 9)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SSELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND z.fullname LIKE '%$spname%' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                }
                 else if($search == 10)
                     {
                     $spname = mysqli_real_escape_string($con,$_POST['spname']);
                     if($spname == 'approved')
                     {
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND x.status = '1' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                    }
                    else if($spname == 'rejected')
                    {
                        $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id') AND x.status = '2' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                    }
                    else{
                         $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id') AND x.status = '0' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC");
                    }

                }
                 else if($search == 11)
                     {
                      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                    $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')  AND u.date=' $spname' AND u.status = '0' GROUP BY x.aset_pr_no ORDER BY u.pr_id DESC 
                      ");
                }

                else{
                    $spname = mysqli_real_escape_string($con,$_POST['spname']);
                $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id') AND x.aset_pr_no = '$spname' GROUP BY x.aset_pr_no ORDER BY x.aset_pr_no ASC "); 
                // if(mysqli_num_rows($result) == 0)
                // {
                //      $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND auto_serial LIKE '%$spname%'");

                }
               
                    }
                    else // For Normal
                    {
                $result = mysqli_query($con,"SELECT x.*,x.status as xstatus, x.id as xid,y.*,y.id as yid,z.fullname,w.name,u.*,v.pname FROM aset_pr x, aset_pr_detail y, mstr_emp z,aset_item_creation w ,aset_pr_req_to u,prj_project v WHERE x.id = y.last_id AND y.aset_name = w.id AND x.id = u.pr_id AND u.req_to = z.id AND x.project = v.id AND (u.req_to = '$emp_id' OR x.req_by = '$emp_id')   GROUP BY x.aset_pr_no  ASC limit $start,$limit"); 
     
               
                }

        // $total_results = mysqli_num_rows($result);
        // if($total_results == 0) // Set For Record Not Found 
        // {
        //     $Error_message="NO RECORDS FOUND.";
        // }
     
$i=$start; 
    while($fetch=mysqli_fetch_object($result))
        {
          $x++;
?>
                              
                                                       
                                               <tr>  
                        <td><?php echo $i; ?></td> 
                        <td><?php echo $fetch->aset_pr_no; ?></td>
                       <!--  <td><?php echo $fetch->name; ?></td>
                        <td><?php echo $fetch->uom; ?></td>
                        <td><?php echo $fetch->qty; ?></td> -->
                        <td><?php echo $fetch->created_on; ?></td>
                         <?php
                        $id = $fetch->xid;
                        $query1 = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_pr x, mstr_emp y WHERE x.id = '$id' AND x.req_by = y.id ");
                        $fetch_name = mysqli_fetch_object( $query1);


                        ?>
                        <td><?php echo $fetch_name->fullname; ?></td>
                        <td><?php echo $fetch->pname;?></td>
                        <td><?php echo $fetch->godown; ?></td>
                        <?php
                        $id = $fetch->xid;
                        $query = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_pr_req_to x, mstr_emp y WHERE x.pr_id = '$id' AND x.req_to = y.id AND y.fullname != 'Others' ORDER BY x.id DESC LIMIT 1");
                        $fetch_position = mysqli_fetch_object( $query);


                        ?>
                        <td><?php echo $fetch_position->fullname; ?></td>
                        <?php
                        if($fetch->xstatus == '2')
                        {
                            ?>
                            <td><?php echo "rejected";?></td>
                            <?php
                        }
                       
                        else if($fetch->xstatus == '1')
                        {
                            ?>
                            <td><?php echo "approved";?></td>
                            <?php
                        }
                        
                       else
                        {
                            ?>
                            <td><?php echo "pending";?></td>
                            <?php
                        }
                        ?>

                        
                        <td><?php echo $fetch_position->date; ?></td>
                        
                        <td>
                            
                            <a href="vwpg_pr_data.php?id=<?php echo $fetch->xid; ?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>view</b></a>
                             
                           
                        </td>
                    </tr>
<?php $i++; }
}
        if($x==1) // Set For Record Not Found 
        {
            $Error_message="NO RECORDS FOUND.";
        }     



}
 ?>
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
        <!-- Added by kalyani 1-9-22 -->
      <script src="../../js/custom-menu.js"></script>
      <!-- Added by kalyani 1-9-22 -->
       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>
</html>

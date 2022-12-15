<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       

        <title>Maintenance Request Asset Stock Item : Suryam Group</title>

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
   if(select_search == '1' || select_search == '5' )
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
                        <h4 class="page-header">Maintenance Update Request</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               <div class="row" style="height: 10px; margin-bottom: 30px;">
                      <!-- <div class="col-lg-12" >
                       <span><button onClick='javascript:location.href="aset_maintain_view.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                       </span>


                 
                
                    </div> -->
                    
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <!-- Body Starts Here --> 
                            <!-- <span style="float:right;"> -->

                         <form name='searching' method='POST'>       <div class="row"> 
                                    <div class="col-lg-3">  
                                        <div class="form-group"> 
                                            
                                           <input type="text" name="sdate" id="sdate" placeholder="From date"  class="form-control datepicker" required="required">
                                        </div>
                                     </div>
                                      <div class="col-lg-3">  
                                        <div class="form-group"> 
                                            
                                           <input type="text" name="tdate" id="tdate" placeholder="To date"  class="form-control datepicker" required="required">
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
                                       
                                    <button onClick='javascript:location.href="aset_approved_req.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?> 


                                </div> 
                               
                              </form> 
                  
                                          
                           <!--  </span> -->
                    
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="height: 40px;">
                              <!--   <div class="row"> -->
                                 
                                    
                                    <span style="float:right;">
                                      <form name='search' method='POST'>
                                      <div class="col-lg-2">
                                      <?php 
                                if(isset($_POST['submitnm']))    { // Show Only if Search Action Performed ?>
                                  <!--   <span style="float:left; padding-right:10px;"> -->
                                       
                                    <button onClick='javascript:location.href="aset_approved_req.php"' class="btn btn-primary btn-xs">Refresh</button>
                                
                                    <!-- </span> -->
                                <?php } ?>
                                </div>
                                       
                                        <div class="col-lg-4">
                                          <select  name="select_search"  id="select_search" style="height: 21px;" onchange="getPic()">
                                              <option value>--select by search--</option>
                                                <option value="1">Date</option>
                                                 <option value="2">Req No</option>
                                                 <option value="3">Req By</option>
                                                 <option value="4">Position</option>
                                                 <option value="5">Req Date</option>
                                                 
                                                  <option value="6">Status</option>
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
                                       </form>
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
                                                
                                                <!-- <th> Material</th>
                                                <th>UOM</th>
                                                <th>QTY</th> -->
                                                <th>Date</th>
                                                <th>Req No</th> 
                                                <th>Req BY</th>
                                                <th>Req Date</th>
                                                  <th>Position</th>
                                                <th>Status</th> 
                                               
                                                <th>Operation</th>
                                            </tr> 
                                        </thead> 
                                        <tbody>



<?php
// Pagination
 $emp_id = $_SESSION['ERP_SESS_ID'];
    
    $query = mysqli_query($con, "SELECT COUNT(*) as `num`, x.*,x.id as xid,x.status as xstatus,x.date as xdate ,y.*,z.fullname  FROM aset_req_details x, aset_req_to y , mstr_emp z WHERE x.id = y.req_id AND y.status = '0' AND x.status = '0' AND x.req_by = z.id  ");
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
             
            $emp_id = $_SESSION['ERP_SESS_ID'];
           
               if(isset($_POST['submitdt']))
                    {
                         $spdate = $_POST['sdate'];
                         $SESSION['spdate']= $spdate;
                        
                         $pdate = $_POST['tdate'];
                         $SESSION['pdate']= $pdate;
                         $result = mysqli_query($con,"SELECT x.*,x.id as xid,x.status as xstatus,x.date as xdate,y.*,y.*,y.req_date as ydate,y.status as ystatus,z.fullname  FROM aset_req_details x,aset_req_update y,mstr_emp z WHERE  y.req_to = '$emp_id' AND x.req_by = z.id  AND x.id = y.req_id AND y.req_date BETWEEN '$spdate' AND '$pdate' GROUP BY x.asset_req_no ORDER BY x.id limit $start,$limit"); 
                    }
                    else if(isset($_POST['submitnm'])) // For Search
                    {
               
                $search = $_POST['select_search'];
                // Prevent SQL-Injection
                if($search == '1')
                    {
                      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut = "x.date = '$spname'";
                    }
                    else if($search == '2')
                    {
                      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut = "x.asset_req_no = '$spname'";
                    }
                    else if($search == '3')
                    {
                      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut = " z.fullname LIKE '%$spname%'";
                    }
                     else if($search == '4')
                     {
                      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut ="z.fullname LIKE'%$spname%'";
                      
                     }
                     else if($search == '5')
                     {
                      $spname = mysqli_real_escape_string($con,$_POST['spname']);
                      $qut ="y.req_date = '$spname'";
                      
                     }
                      else if($search == '6')
                      {
                        $spname = mysqli_real_escape_string($con,$_POST['spname']);
                        if($spname == 'approved')
                        {
                          $qut = "x.status = '1' ";
                        }
                        else if($spname == 'rejected')
                        {
                          $qut = "x.status = '2' ";
                        }
                        else if($spname == 'pending')
                        {
                          $qut = "x.status = '0' ";
                        }
                      }
                      if($search != 4)
                      {
                        $result = mysqli_query($con,"SELECT x.*,x.id as xid,x.status as xstatus,x.date as xdate,y.*,y.*,y.req_date as ydate,y.status as ystatus,z.fullname  FROM aset_req_details x,aset_req_update y,mstr_emp z WHERE  y.req_to = '$emp_id' AND x.req_by = z.id  AND x.id = y.req_id AND $qut GROUP BY x.asset_req_no ORDER BY x.id"); 
                      }
                      else{
                        $result = mysqli_query($con,"SELECT x.*,x.id as xid,x.status as xstatus,x.date as xdate,y.*,y.*,y.req_date as ydate,y.status as ystatus,z.fullname  FROM aset_req_details x,aset_req_update y,mstr_emp z WHERE  y.req_to = '$emp_id' AND y.req_to = z.id  AND x.id = y.req_id AND $qut GROUP BY x.asset_req_no ORDER BY x.id"); 
                      }
               
                    }

              // echo $query_ftch->req_id;
                    else // For Normal
                    {
                $result = mysqli_query($con,"SELECT x.*,x.id as xid,x.status as xstatus,x.date as xdate,y.*,y.req_date as ydate,y.status as ystatus, z.fullname  FROM aset_req_details x,aset_req_update y,mstr_emp z WHERE  y.req_to = '$emp_id' AND x.req_by = z.id  AND x.id = y.req_id GROUP BY x.asset_req_no ORDER BY x.id limit $start,$limit"); 

               
                }
                $total_results = mysqli_num_rows($result);
        if($total_results == 0) // Set For Record Not Found 
        {
            $Error_message="NO RECORDS FOUND.";
        }
        $i = $start;
         while($fetch=mysqli_fetch_object($result))
        {
          ?>
                              
                                                       
                                              <tr>  
                        <td><?php echo $i; ?></td> 
                       
                        <td><?php echo $fetch->xdate; ?></td>
                        <td><?php echo $fetch->asset_req_no; ?></td>
                        <td><?php echo $fetch->fullname; ?></td>
                        <td><?php echo $fetch->ydate; ?></td>
                        <?php
                        $id_req = $fetch->xid;
                        // echo $id_req;
                        $query = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_req_update x, mstr_emp y WHERE x.req_id = '$id_req' AND x.req_to = y.id ORDER BY x.id DESC LIMIT 1");
                        $fetch_position = mysqli_fetch_object( $query);
                        
                        ?>
                        <td><?php echo $fetch_position->fullname; ?></td>
                        <?php
                          if($fetch->ystatus == '1')
                          {
                            ?>
                            <td>approved</td>
                            <?php
                          }
                          else if($fetch->ystatus == '2')
                          {
                        ?>
                          <td>rejected</td>
                        <?php
                      }
                      else{
                        ?>
                        <td>pending</td>
                        <?php
                      }
                      ?>
                        <td>
                            
                           <!--  <a href="aset_maintainvwpg.php?id=<?php echo $fetch->xid; ?>&a_id=<?php echo $fetch->asset_id;?>" style="text-decoration:none;" class="btn btn-success btn-xs" ><b>view</b></a> -->
                            <a href="asset_req_accept_view.php?id=<?php echo $fetch->xid; ?>&a_id=<?php echo $fetch->asset_id;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>view</b></a>
                             
                           
                        </td>
                    </tr>
<?php $i++; }
       
 
              
  
     
 
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

       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>
</html>

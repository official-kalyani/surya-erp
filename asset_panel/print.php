<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    window.print();
});
</script>

<div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                                  <th>Slno</th>
                                                <th> Asset No.</th>
                                                <th> Serial No.</th>
                                                <th>Name Of Asset</th>
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th> Date Of Purchase</th>
                                                <th> Supplier</th>
                                                <th> Invoice No.</th>
                                                <th> QTY</th>
                                                <th>Item Sub Type</th>
                                                <th> Current Location</th>
                                                <th> Used By</th>
                                                <th> From Date</th>
                                                <th>Status</th>
                                               
                                                
                                            </tr> 
                                        </thead> 
                                        <tbody>



<?php
// Pagination
    
    $query = mysqli_query($con, "SELECT COUNT(*) as `num` from `aset_stock_entry` where `status`='1' AND `asset_type` = 'User'");
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
    if(isset($_GET['sdate']) || isset($_GET['tdate']) || isset($_GET['spname']) )
    {
               if(($_GET['sdate']  != "") || ($_GET['tdate']  != ""))
                    {
                         $spdate = $_GET['sdate'];
                         
                        
                         $pdate = $_GET['tdate'];
                         $SESSION['pdate']= $pdate;
                         $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND date_purchase  BETWEEN '$spdate'AND'$pdate'"); 
                    }
                
                else if($_GET['spname'] !="") // For Search
                    {
                        $search = $_GET['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND auto_serial LIKE '%$spname%'");
                }
                else if($search == 2)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND serial_no LIKE '%$spname%'");
                }
                else if($search == 3)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND description LIKE '%$spname%'");
                }
                else if($search == 4)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND date_purchase LIKE '%$spname%'");
                }
                 else if($search == 5)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND supplier LIKE '%$spname%'");
                }
                 else if($search == 6)
                     {
                     $spname =$_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND inv_no LIKE '%$spname%'");
                }
                else if($search == 7)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND qty = '$spname'");
                }
                else if($search == 8)
                     {
                     $spname = $_GET['spname'];
                  $abc = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND y.project_site LIKE '%$spname%' AND x.asset_type = 'User' AND y.status = '1' GROUP BY x.auto_serial");
                    if(mysqli_num_rows($abc) >1)
                    {
                      $result = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND y.project_site LIKE '%$spname%'AND x.asset_type = 'User' AND y.status = '1' GROUP BY x.auto_serial");

                    }
                    else{
                          $result = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND x.godowo LIKE '%$spname%' AND x.asset_type = 'User' GROUP BY x.auto_serial");

                    }
                }
                else if($search == 9)
                     {
                     $spname = $_GET['spname'];
                     $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND y.fullname LIKE '%$spname%' AND x.asset_type = 'User' GROUP BY x.auto_serial ");
                }
                else if($search == 10)
                     {
                     $spname =$_GET['spname'];
                     $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND y.assaign_dt LIKE '%$spname%'AND x.asset_type = 'User' GROUP BY x.auto_serial");
                }
                      else if($search == 11)
                {
                  $spname =$_GET['spname'];
                   $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND y.name LIKE '%$spname%'AND x.asset_type = 'User' GROUP BY x.auto_serial");
                }
                  else if($search == 12)
                {
                  $spname = $_GET['spname'];
                  if($spname == '1')
                   {
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND x.asset_type = 'User' GROUP BY x.auto_serial");
                  }
                  else if($spname == '2')
                  {
                   
                   $result = mysqli_query($con,"SELECT  *  from   aset_stock_entry  WHERE `auto_serial`  NOT IN (SELECT asset_no from aset_stock_assaignment GROUP BY asset_no)");
                  
                }
              }
               else if($search == 13)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.aset_category LIKE '%$spname%' AND x.asset_type = 'User' GROUP BY x.auto_serial");
              }
               else if($search == 14)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.aset_subcatagory LIKE '%$spname%' AND x.asset_type = 'User' GROUP BY x.auto_serial");
              }


                else{
                    $spname = $_GET['spname'];
                $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' AND description LIKE '%$spname%'");
                
                }
            }
        }
                    else // For Normal
                    {
                $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'User' limit $start,$limit");
                    } 



        $total_results = mysqli_num_rows($result);
        if($total_results == 0) // Set For Record Not Found 
        {
            $Error_message="NO RECORDS FOUND.";
        }
     
$i=1; 
    while($fetch=mysqli_fetch_object($result))
        {
?>
                                    
                                                <tr>  
                        <td><?php echo $i; ?></td> 
                        <td><?php echo $fetch->auto_serial ?></td>
                        
                        <td><?php echo $fetch->serial_no; ?></td>
                        <td><?php echo $fetch->description; ?></td>
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
                             <?php

                        $serial = $fetch->item_name;
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = '$serial' AND x.item_name = y.id ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {


                        ?>
                        <td><?php echo $fetch_ass_data->name; ?></td>
                        <?php
                      }
                    }
                      ?>
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
                        <td> Assaigned</td>
                      <?php } } 

                      else {?>
                        <td><?php echo $fetch->godowo; ?></td>
                        <td></td>
                        <td></td>
                        <td>Not assigned</td>
                        <?php 
                      }
                      ?>
                     
                        
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
                         

<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_d'])) // Delete query
{
 $asset = $_POST['s_d'];

 
?>

                       <!--  <div class="col-lg-12"> -->
<div class="col-lg-12">
<span style="float: right; margin: 10px;"> <input type="button" name="cancel"  id="cancel"
value="Close" class="btn btn-danger mr-2" >
</span>
</div>
<div class="panel panel-default">
  <div class="panel-body">
      <div class="col-lg-12">

      <div class="table-responsive">

      </div>

            <table class="table table-striped">


                <?php
                 $quter = mysqli_query($con,"SELECT x.*, y.sub_type FROM  aset_stock_entry  x, aset_item_creation  y WHERE  x.auto_serial = '$asset' AND x.item_name = y.id");
                
                 $ftch_des = mysqli_fetch_object($quter);
                 ?>
             <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Assigned To</th>
                                                <th>Current Location</th>
                                                <th>Assigned Date</th>
                                                <?php
                                               
                                                   if($ftch_des->sub_type == '6')
                                                {
                                                ?>
                                                <th>Present Km Reading</th>
                                                <th>Present KM Reading Date</th> 
                                                <?php
                                            }


                                            ?>
                                            <th>Recovery Date</th>
                                            </tr> 
                                        </thead> 
                                        <tbody>
           <?php
// Pagination
    
    $query = mysqli_query($con, "SELECT COUNT(*) as `num` from `aset_stock_assaignment` where `status`='1'");
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
     
$i=1; 
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
                 

                 
<?php
}
?>
<script type="text/javascript">
       $(document).ready(function(){
        $("#cancel").click(function(){

          $("#asset_history").html('');
           
        });


         
       });
    </script>
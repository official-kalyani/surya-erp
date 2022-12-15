<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['a_id'])) // Delete query
{
 $asset = $_POST['a_id'];

  $query = mysqli_query($con, "SELECT  x.*,y.*,z.*,w.* FROM aset_req_details x,aset_req_update y,aset_req_vechile z,aset_req_other w WHERE x.id = y.req_id AND x.id = z.req_id AND x.id = w.req_id AND x. asset_id = '$asset'");
  $ftch_dtl = mysqli_fetch_object($query);
                        

?>
                       <!--  <div class="col-lg-12"> -->
                        <div class="col-lg-12">
                            <span style="float: right; margin: 10px;"> <input type="button" name="cancelmaintain"  id="cancelmaintain"
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
            $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$asset'");
              $ftch_aset_no = mysqli_fetch_object($dueryer);

             if( $ftch_aset_no->sub_type == '6')
             {
                        ?>

            <thead> 
                <tr> 
                    <th>Slno</th>
                     <th>Req No</th>
                    <th>Date</th>
                    <th>Particulars</th>
                    <th>Amount</th>
                  
                    <th>Kms</th>
                    <th>Used By</th>
                    <th>Status</th> 
                 
                  
                </tr> 
            </thead> 
        <?php } 
        else{
            ?>
            <thead> 
                <tr> 
                    <th>Slno</th>
                     <th>Req No</th>
                    <th>Date</th>

                    <th>Particulars</th>
                    <th>Amount</th>
                  
                    
                    <th>Used By</th>
                    <th>Status</th> 
                 
                  
                </tr> 
            </thead> 

            <?php
          }
          ?>
                                       <tbody>


                <?php
                // Pagination

                $query = mysqli_query($con, "SELECT COUNT(*) as `num` ,x.*,y.*,z.*,w.* FROM aset_req_details x,aset_req_update y,aset_req_vechile z,aset_req_other w WHERE x.id = y.req_id AND x.id = z.req_id AND x.id = w.req_id AND x. asset_id = '$asset'");
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
                $i =1;
          
                // if(isset($_GET['spname'])) // For Search
                //      {
                //  $spname = mysqli_real_escape_string($con,$_GET['spname']); // Prevent SQL-Injection
                //  $result = mysqli_query($con,"SELECT x.*, y.sub_type,z.* FROM  aset_stock_entry  x, aset_item_creation  y, vw_aset_stock_assaignment z WHERE  z.asset_no = '$asset' AND x.item_name = y.id AND x.auto_serial = z.asset_no AND z.fullname LIKE '%$spname%'  ORDER BY z.id DESC"); 
                //      }
                // else // For Normal
                $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$asset'");
              $ftch_aset_no = mysqli_fetch_object($dueryer);

             if( $ftch_aset_no->sub_type == '6')
             {


                $resultant = mysqli_query($con,"SELECT  x.*,y.*,y.status as ystatus,z.*,z.date as zdate FROM aset_req_details x,aset_req_update y,aset_req_vechile z WHERE x.id = y.req_id AND x.id = z.req_id  AND x.asset_id = '$asset' ORDER BY y.id DESC limit $start,$limit"); 
                // }
                
                $i=1; 
                if(mysqli_num_rows($resultant) > 0)
                {
                while($fetch=mysqli_fetch_object($resultant))
                {
                ?>

               <tr> 
                     <td><?php echo $i; ?></td>
               <td><?php echo $fetch->asset_req_no; ?></td>
                <td><?php echo$fetch->date; ?></td>
                <td>
                   <?php if ($fetch->change_type == 1) 
                   {
                   echo "Oil Change";
                   }
                   else{
                    echo "Tyre Change";
                   }
               
                   ?> 

                </td>
                <td><?php echo $fetch->amount; ?></td>
                <td><?php echo $fetch->km_reading; ?></td>
                <?php
            $abs = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_stock_assaignment x,mstr_emp y WHERE x.assaign_to =y.id AND x.asset_no = '$asset' ORDER BY x.id DESC LIMIT 1"); 
            $ftch_name = mysqli_fetch_object($abs);

                ?>
                <td><?php echo $ftch_name->fullname; ?></td>
                <td><?php if ($fetch->ystatus == 1) 
                   {
                   echo "approved";
                   }
                   else if ($fetch->ystatus == 2) 
                   {
                    echo "rejected";
                   }
                   else{
                    echo "Pending";
                   }

                   ?>
               </td>
              </tr>
                <?php $i++; }
              }
             
                 $query1 = mysqli_query($con,"SELECT x.*,y.*,y.status as ystatus,z.* FROM aset_req_details x,aset_req_update y,aset_req_other z WHERE x.id = y.req_id AND x.id = z.req_id  AND x.asset_id = '$asset'ORDER BY y.id DESC limit $start,$limit"); 
                  $total_results = mysqli_num_rows($query1);
                if($total_results == 0) // Set For Record Not Found 
                {
                $Error_message="NO RECORDS FOUND.";
                }




               while($fetch_data = mysqli_fetch_object($query1))
               {
               ?>
                     <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $fetch_data->asset_req_no; ?></td>
                <td><?php echo $fetch_data->date; ?></td>
                <td><?php echo $fetch_data->feildname; ?></td>
                <td><?php echo $fetch_data->amount; ?></td>
                <td></td>
              
                
                  
            <?php
            $abs = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_stock_assaignment x,mstr_emp y WHERE x.assaign_to =y.id AND x.asset_no = '$asset' ORDER BY x.id DESC LIMIT 1"); 
            $ftch_name = mysqli_fetch_object($abs);

                ?>
                <td><?php echo $ftch_name->fullname; ?></td>
                <td><?php if ($fetch_data->ystatus == 1) 
                   {
                   echo "approved";
                   }
                   else if ($fetch_data->ystatus == 2) 
                   {
                    echo "rejected";
                   }
                   else{
                    echo "Pending";
                   }
                   ?>
               </td>
           </tr>

                <?Php $i++;} }
                 else{
                $result = mysqli_query($con,"SELECT x.*,y.*,y.status as ystatus,z.* FROM aset_req_details x,aset_req_update y,aset_req_other z WHERE x.id = y.req_id AND x.id = z.req_id  AND x.asset_id = '$asset'ORDER BY y.id DESC limit $start,$limit"); 
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
                        <td><?php echo $fetch->asset_req_no; ?></td>
                <td><?php echo $fetch->date; ?></td>
                <td><?php echo $fetch->feildname; ?></td>
                <td><?php echo $fetch->amount; ?></td>
              
                
            <?php
            $abs = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_stock_assaignment x,mstr_emp y WHERE x.assaign_to =y.id AND x.asset_no = '$asset' ORDER BY y.id DESC LIMIT 1"); 
            $ftch_name = mysqli_fetch_object($abs);

                ?>
                <td><?php echo $ftch_name->fullname; ?></td>
                <td><?php if ($fetch->ystatus == 1) 
                   {
                   echo "approved";
                   }
                   else if ($fetch->ystatus == 2) 
                   {
                    echo "rejected";
                   }
                   else{
                    echo "Pending";
                   }
                   ?>
               </td>
           </tr>
               <?Php $i++;} }
             
             
                ?>
              
             
                <?php // Error Message For Record Not Found.
                if(isset($Error_message))
                {
                echo "<tr align='center'><td colspan='12'> $Error_message </td></tr>";
                }
                ?>
            </tbody>
                                    </table>

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
        $("#cancelmaintain").click(function(){

          $("#asset_history").html('');
           

           });
          

        

       });
    </script>
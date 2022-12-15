<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) // Delete query
{
  $id = $_POST['s_id'];
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
          <thead> 
            <tr> 
              <th>SLNO:</th>
              <th>ASSET NO.</th>
              <th>ITEM</th> 
              <th>SERIAL NO.</th>
              <th>NAME</th>
              <th>RENEW DATE</th>
              <th>VALID UPTO:</th>
              <th>POC NO</th>
              <th>Attached file</th>
            </tr> 
          </thead> 
          <tbody>
            <?php
              // Pagination

              $query1 =  mysqli_query($con, "SELECT COUNT(*) as `num`  FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id ");
              $total_pages = mysqli_fetch_array($query1);
              $total_pages = $total_pages['num'];

              $limit = 15;                                 // How many items to show per page
    
              if(isset($_GET['page'])) 
              { 
                $page = $_GET['page'];
              } 
              else 
              {
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

              $result = mysqli_query($con,"SELECT y.*,y.id as yid,z.* FROM  aset_stock_entry y,aset_poc_update z WHERE  y.id = z.name_id AND y.id = '$id' order by z.id desc limit $start,$limit");

              $total_results = mysqli_num_rows($result);
              if($total_results == 0) // Set For Record Not Found 
              {
                $Error_message="NO RECORDS FOUND.";
              }
              $i =1;		
              while($fetch = mysqli_fetch_object($result))
              {
              ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $fetch->auto_serial; ?></td>
                  <td><?php echo $fetch->description; ?></td>
                  <td><?php echo $fetch->serial_no; ?></td>
                  <?php
                  $assaign = $fetch->id;
                  $query1 = mysqli_query($con,"SELECT x.*,y.fullname FROM aset_poc_update x,mstr_emp y WHERE x.id = '$assaign' AND x.updated_by = y.id");

                  $fetch_name = mysqli_fetch_object($query1);
                  if(mysqli_num_rows($query1)>0 )
                  {
                    ?>
                    <td><?php echo $fetch_name->fullname; ?></td>
                    <?php
                  }
                  else
                  {
                    ?>
                    <td>Not assigned</td>
                    <?php
                  }
                  ?>
                  <td><?php echo $fetch->date; ?></td>
                  <td><?php echo $fetch->valid_date; ?></td>
                  <td><?php echo $fetch->poc_no; ?></td>
                  <td> <a href="ve_poc/<?php echo $fetch->attach; ?>" target="_blank"><?php echo $fetch->attach; ?></a></td>
                </tr>
              <?php
                $i++;
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
<?php
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#cancel").click(function(){

      $("#poc_history").hide();

      $("#pol_history").click(function(){

        $("#poc_history").show();

      });

    });
  });
</script>
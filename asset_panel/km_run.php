<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['i_dv'])) {

$asset_no = $_POST['i_dv'];
$query = mysqli_query($con, "SELECT x.*, y.* FROM  aset_stock_entry  x, aset_item_creation  y WHERE  x.auto_serial = '$asset_no' AND x.item_name = y.id");

                        if(mysqli_num_rows($query) > 0)
                        {

                          $fetch = mysqli_fetch_object($query);

                          if ($fetch->sub_type == '6') {

                            // $query1 = mysqli_query($con, "SELECT * FROM `aset_stock_assaignment` WHERE asset_no = '$asset_no'");
                            //  if(mysqli_num_rows($query1) > 0)
                            //   {
                            $ptl = mysqli_query($con, "SELECT * FROM `aset_vehicle_report`WHERE`aset_no` = '$asset_no' ORDER BY id DESC LIMIT 1");
                            $ptl_ftch = mysqli_fetch_object($ptl);

                            ?>
                     <div class="row">
                     <div class="col-lg-4">
                    <div class="form-group">

                      <label for="km_read">Present KM Reading:</label>
                      <input type="text" name="km_read"  id="km_read" class="form-control" autocomplete="off" onkeypress="return validateNumber(event);" value="<?php if(mysqli_num_rows($ptl) > 0) {echo $ptl_ftch->pr_reading;}else{ echo "0000";} ?>" readonly>
                    </div>
                  </div>
                          <div class="col-lg-4">
                    <div class="form-group">

                      <label for="read_date">Reading Date:</label>
                      <input type="text" name="read_date"  id="read_date" class="form-control" autocomplete="off" value="<?php if(mysqli_num_rows($ptl) > 0){ echo $ptl_ftch->date; } else {echo date('Y-m-d');}?>" readonly>
                    </div>
                  </div> 
                  </div>

<?php
// }

}
}
}


?>
<script type="text/javascript">
  $(document).ready(function(){
                     var asset = $("#ass_no").val();
                     console.log(asset) ;
                    $('#read_date').datetimepicker({

          format:'YYYY-MM-DD',
          
          widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
           
        }
      });
                  });
</script>


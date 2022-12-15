<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {

$id =  $_POST['s_id'];



$query = mysqli_query($con, "SELECT x.*,x.id as xid,y.*,y.description as ydesc,z.*,w.km_reading  FROM aset_stock_assaignment x,aset_stock_entry y,aset_item_creation z,aset_km_reading w WHERE y.auto_serial =  '$id' AND x.asset_no = y.auto_serial AND y.item_name = z.id  AND x.id = w.asset_no_id AND z.sub_type = '6' ORDER BY x.id DESC LIMIT 1");

   $fetch = mysqli_fetch_object($query);



 ?>
 <div class="row">
   <input type="hidden" name="asset_id" id="asset_id" class="form-control" value="<?php echo $fetch->xid; ?>">
                <input type="hidden" name="asset_no" id="asset_no" class="form-control" value="<?php echo $fetch->auto_serial; ?>">
                   <input type="hidden" name="vechilename" id="vechilename" class="form-control" value="<?php echo $fetch->ydesc; ?>" readonly>
                
						 	
            				  <div class="col-lg-4">
                <div class="form-group">
                <label for="project">Project Site:</label>
                <input type="text" name="project" id="project" class="form-control" value="<?php echo $fetch->project_site; ?>" readonly>
            </div>
            </div>  
            <div class="col-lg-4">
                <div class="form-group">
                <label for="vechileno">Vehicle No:</label>
                <input type="text" name="vechileno" id="vechileno" class="form-control" value="<?php echo $fetch->serial_no; ?>" readonly>
            </div>
            </div> 
        </div>
            
             <!-- <div class="col-lg-4">
                <div class="form-group">
                <label for="subproject">Sub-project:</label>
                <input type="text" name="subproject" id="subproject" class="form-control">
            </div> -->
              <div class="row">
             <div class="col-lg-4">
                <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" name="date" id="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            </div>
             <div class="col-lg-4">
                <div class="form-group">
                <label for="pr_reading">Present Reading:</label>
                <input type="text" name="pr_reading" id="pr_reading" class="form-control amount" onkeypress="return validateNumber(event);" >
            </div>
            </div>
             <?php
        $asset_no = $fetch->auto_serial;
        $updated_by = $_SESSION['ERP_SESS_ID'];
        $asset_id = $fetch->xid;
        $query1 = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `aset_no` = '$asset_no' AND `updated_by` = '$updated_by' AND `asset_id` = '$asset_id' ORDER BY id DESC LIMIT 1");

        if(mysqli_num_rows($query1) > 0)
        {
         $fetch_reading = mysqli_fetch_object($query1);
        ?>
         
             <div class="col-lg-4">
                <div class="form-group">
                <label for="p_reading">Previous Reading:</label>
                <input type="text" name="p_reading" id="p_reading" class="form-control" value="<?php echo $fetch_reading->pr_reading; ?>" readonly>
            </div>
            </div>
    
        <?php
    }
    else{
        ?>
       
             <div class="col-lg-4">
                <div class="form-group">
                <label for="p_reading">Previos Reading:</label>
                <input type="text" name="p_reading" id="p_reading" class="form-control" value="<?php echo $fetch->km_reading; ?>" readonly>
            </div>
            </div>
       
        <?php

    }
    ?>
</div>
      <div class="row"> 
      <div class="col-lg-4">
          
      </div> 
            <div class="col-lg-4">
                <div class="form-group">
                <label for="reading"> Reading:</label>
                <input type="text" name="reading" id="reading" class="form-control " readonly>
            </div>
            </div>   

                              <?php 
                            
                            }
                            

                           
                            
                            
						

					                 	                
                          ?>
                           <script type="text/javascript">
      $(document).ready(function () {
         $("#pr_reading").blur(function(){

             getTotal();
            
         });
      });

      function getTotal()
      {
        var amt=$("#p_reading").val();
        var amt =  parseFloat(amt);
        var pr_amt = $("#pr_reading").val();
    var pr_amt = parseFloat(pr_amt);
          if(pr_amt <= amt)
            {
                $('#pr_reading').css("border","2px solid #ec1313");
                alert("Your present reading must be greater then previos reading");
                $('#pr_reading').focus();
                return false;

            }
        pr_amt 
        if(pr_amt != '')
        {
            if( pr_amt > amt)
            {

         pr_amt  = pr_amt-amt;
        // alert(pr_amt);
        // $( ".amount" ).each(function() {

        //        amt -= Number($( this ).val());
        //        // alert(amt);
        //     });
        $('#reading').val(pr_amt);
          $('#pr_reading').css("border","1px solid #D3D3D3");

    }
      }
      else {
    return true;
}
  }
    </script>

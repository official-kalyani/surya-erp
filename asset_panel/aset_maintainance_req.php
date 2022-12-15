<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id']))
{
  $id =  $_POST['s_id'];
  // echo $id;
   $query1 = mysqli_query($con,"SELECT * FROM `aset_req_details` WHERE `asset_id` = '$id' ORDER BY id DESC LIMIT 1");
  $fetch_id = mysqli_fetch_object($query1);
  $id_ftch = $fetch_id->id;
  // echo $id_ftch;
  $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$id '");
  $ftch_aset_no = mysqli_fetch_object($dueryer);

 if( $ftch_aset_no->sub_type == '6')
                    {
                      $abc = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$id_ftch' AND `change_type` = '1' AND `status` = '1' ");
                       // <?php
   $cql_p = mysqli_query($con,"SELECT y.*,z.* FROM aset_req_vechile y,aset_req_details z WHERE y.req_id = z.id  and  z.asset_id = '$id' AND y.change_type = '1' ORDER BY z.id DESC LIMIT 1");
                        $ftch_last = mysqli_fetch_object($cql_p);
                       
                      if(mysqli_num_rows($abc) > 0)
                      {
                        ?>
                        <div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="oil_change">Oil Changes:</label>
          <input type="checkbox" name="oil_change" id="oil_change" value="1" checked >
     </div>
  </div>
 
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_km">Last Reading Km:</label>
        <input type="text" name="last_r_km" id="last_r_km" class="form-control" value="<?php if(mysqli_num_rows($cql_p)>0){echo $ftch_last->km_reading;}?>" disabled>
     </div>
  </div>
  <?php
  $cql = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$id_ftch' AND change_type ='1' AND `status` = '1'  order BY id DESC LIMIT 1");
                        $ftch = mysqli_fetch_object($cql);
                        ?>

  <div class="col-lg-3">
    <div class="form-group">
        <label for="last_r_dt">Present Reading Km:</label>
        <input type="text" name="present_r_km" id="present_r_km" class="form-control" value="<?php if(isset($ftch->reading_km)){echo $ftch->reading_km;}?>">
     </div>
  </div>
 <!--  <div class="col-lg-3">
    <div class="form-group">
         <label for="amount_oil">Amount:</label>
        <input type="text" name="amount_oil" id="amount_oil" class="form-control amount" value="<?php if(isset($ftch->amount_km)){echo $ftch->amount_km;}?>" >
     </div>
  </div> -->
</div>
<div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt"></label>
        <input type="hidden"  class="form-control"  disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt">Last Reading Date:</label>
        <input type="text" name="last_r_dt" id="last_r_dt" class="form-control" value="<?php if(mysqli_num_rows($cql_p)){echo $ftch_last->date;}?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="present_r_dt">Present Reading Date:</label>
       <input type="text" name="present_r_dt" id="present_r_dt" class="form-control" value="<?php if(isset($ftch->reading_dt )){echo $ftch->reading_dt;}?>">
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="amount_oil_dt">Amount:</label>
        <input type="text" name="amount_oil_dt" id="amount_oil_dt" class="form-control amount" value="<?php if(isset($ftch->amount_dt)){echo $ftch->amount_dt;}?>">
     </div>
  </div>
  
</div>
                        <?php
                      }
                      else{
                         $last_km = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `aset_no` = '$id' ORDER BY `id`DESC LIMIT 1");
                      $last_km_fetch = mysqli_fetch_object($last_km);
                        ?>
                        <div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="oil_change">Oil Changes:</label>
          <input type="checkbox" name="oil_change" id="oil_change" value="1">
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_km">Last Reading Km:</label>
        <input type="text" name="last_r_km" id="last_r_km" class="form-control" value="<?php if(mysqli_num_rows($cql_p)>0){echo $ftch_last->km_reading;}?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="last_r_dt">Present Reading Km:</label>
        <input type="text" name="present_r_km" id="present_r_km" class="form-control" value ="<?php if(mysqli_num_rows($last_km)>0){ echo $last_km_fetch->pr_reading;}?>" disabled="disabled">
     </div>
  </div>
 <!--  <div class="col-lg-3">
    <div class="form-group">
         <label for="amount_oil">Amount:</label>
        <input type="text" name="amount_oil" id="amount_oil" class="form-control" disabled >
     </div>
  </div> -->
</div>
<div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt"></label>
        <input type="hidden"  class="form-control"  disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt">Last Reading Date:</label>
        <input type="text" name="last_r_dt" id="last_r_dt" class="form-control" value="<?php if(mysqli_num_rows($cql_p)>0){echo $ftch_last->date;}?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="present_r_dt">Present Reading Date:</label>
       <input type="text" name="present_r_dt" id="present_r_dt" class="form-control" value ="<?php if(mysqli_num_rows($last_km)>0){ echo $last_km_fetch->date;}?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="amount_oil_dt">Amount:</label>
        <input type="text" name="amount_oil_dt" id="amount_oil_dt" class="form-control " disabled>
     </div>
  </div>
  
</div>
                        <?php
                      }
                       $abc = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$id_ftch' AND `change_type` = '2' AND `status` = '1'  order BY id DESC LIMIT 1  ");
                        $cql_t = mysqli_query($con,"SELECT y.*,z.* FROM aset_req_vechile y,aset_req_details z WHERE y.req_id = z.id  and  z.asset_id = '$id' AND y.change_type = '1' ORDER BY z.id DESC LIMIT 1");
                        $ftch_last_tyre = mysqli_fetch_object($cql_t);
                        $pql = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$id_ftch' AND `change_type` = '2' AND `status` = '1'  order BY id DESC LIMIT 1");
                        $ftch = mysqli_fetch_object($pql);
                      if(mysqli_num_rows($abc) > 0)
                      {
                       
                      ?>
                      <div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="tyre_change">Tyre Changes:</label>
        <input type="checkbox" name="tyre_change" id="tyre_change" value="2" checked="checked">
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="last_r_km_tyre">Last Reading Km:</label>
        <input type="text" name="last_r_km_tyre" id="last_r_km_tyre" class="form-control" value="<?php if(mysqli_num_rows($cql_t) > 0){echo $ftch_last_tyre->km_reading;} ?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt_tyre">Present Reading Km:</label>
        <input type="text" name="present_r_km_tyre" id="present_r_km_tyre" class="form-control" value="<?php if(isset($ftch->reading_km)){echo $ftch->reading_km;}?>">
     </div>
  </div>
  <!-- <div class="col-lg-3">
    <div class="form-group">
         <label for="amount_tyre">Amount:</label>
        <input type="text" name="amount_tyre" id="amount_tyre" class="form-control amount" value="<?php if(isset($ftch->amount_km)){echo $ftch->amount_km;}?> ">
     </div>
  </div> -->
</div>
<div class ="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt"></label>
        <input type="hidden"  class="form-control"  disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt">Last Reading Date:</label>
        <input type="text" name="last_r_dt_tyre" id="last_r_dt_tyre" class="form-control" value="<?php if(mysqli_num_rows($cql_t)){echo $ftch_last_tyre->date;} ?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="present_r_dt">Present Reading Date:</label>
        <input type="text" name="present_r_dt_tyre" id="present_r_dt_tyre" class="form-control " value="<?php if(isset($ftch->reading_dt )){echo $ftch->reading_dt;}?>">
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="present_r_dt">Amount:</label>
        <input type="text" name="amount_tyre_dt" id="amount_tyre_dt" class="form-control amount" value="<?php if(isset($ftch->amount_dt)){echo $ftch->amount_dt;}?>">
     </div>
  </div>
</div>
                      <?php
                    }
                    else{
                      $last_km = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `aset_no` = '$id' ORDER BY `id`DESC LIMIT 1");
                      $last_km_fetch = mysqli_fetch_object($last_km);
                      ?>
                      <div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="tyre_change">Tyre Changes:</label>
        <input type="checkbox" name="tyre_change" id="tyre_change" value="2" >
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="last_r_km_tyre">Last Reading Km:</label>
        <input type="text" name="last_r_km_tyre" id="last_r_km_tyre" class="form-control" value="<?php if(mysqli_num_rows($cql_t)>0){echo $ftch_last_tyre->km_reading;} ?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt_tyre">Present Reading Km:</label>
        <input type="text" name="present_r_km_tyre" id="present_r_km_tyre" class="form-control"  value ="<?php if(mysqli_num_rows($last_km)>0){ echo $last_km_fetch->pr_reading;}?>"disabled>
     </div>
  </div>
  <!-- <div class="col-lg-3">
    <div class="form-group">
         <label for="amount_tyre">Amount:</label>
        <input type="text" name="amount_tyre" id="amount_tyre" class="form-control" disabled>
     </div>
  </div> -->
</div>
<div class ="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt"></label>
        <input type="hidden"  class="form-control"  disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt">Last Reading Date:</label>
        <input type="text" name="last_r_dt_tyre" id="last_r_dt_tyre" class="form-control" value="<?php if(mysqli_num_rows($cql_t)>0){echo $ftch_last_tyre->date;} ?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="present_r_dt">Present Reading Date:</label>
        <input type="text" name="present_r_dt_tyre" id="present_r_dt_tyre" class="form-control " value ="<?php  if( mysqli_num_rows($last_km)>0){ echo $last_km_fetch->date;}?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="present_r_dt">Amount:</label>
        <input type="text" name="amount_tyre_dt" id="amount_tyre_dt" class="form-control " disabled>
     </div>
  </div>
</div>
  
                      <?php

                    }
                    ?>

<?php                      
}
}
?>
<?php
if(isset($_POST['s_d']))
{
  
  $aset_no = $_POST['s_d'];

  $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$aset_no'");
  $ftch_aset_no = mysqli_fetch_object($dueryer);

 if( $ftch_aset_no->sub_type == '6')
                    {
$cql = mysqli_query($con,"SELECT y.*,z.* FROM aset_req_vechile y,aset_req_details z WHERE y.req_id = z.id  and  z.asset_id = '$aset_no' AND y.change_type = '1' ORDER BY z.id DESC LIMIT 1");
// echo "SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$aset_no' AND `change_type` = '1' ORDER BY`id` DESC LIMIT 1";
$ftch = mysqli_fetch_object($cql);

  ?>
<div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="oil_change">Oil Changes:</label>
          <input type="checkbox" name="oil_change" id="oil_change" value="1" >
     </div>
  </div>

  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_km">Last Reading Km:</label>
        <input type="text" name="last_r_km" id="last_r_km" class="form-control" value="<?php if( mysqli_num_rows($cql)){echo $ftch->km_reading;}?>" disabled>
     </div>
  </div>
  <?php
$ctl = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `aset_no` = '$aset_no' ORDER BY `id`DESC LIMIT 1");
// echo "SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$aset_no' AND `change_type` = '1' ORDER BY`id` DESC LIMIT 1";
$ftcher = mysqli_fetch_object($ctl);
?>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="last_r_dt">Present Reading Km:</label>
        <input type="text" name="present_r_km" id="present_r_km" class="form-control" disabled value="<?php if(mysqli_num_rows($ctl) > 0){echo $ftcher->pr_reading;}?>">
     </div>
  </div>
 <!--  <div class="col-lg-3">
    <div class="form-group">
         <label for="amount_oil">Amount:</label>
        <input type="text" name="amount_oil" id="amount_oil" class="form-control" disabled >
     </div>
  </div> -->
</div>
<div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt"></label>
        <input type="hidden"  class="form-control"  disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt">Last Reading Date:</label>
        <input type="text" name="last_r_dt" id="last_r_dt" class="form-control" value="<?php if( mysqli_num_rows($cql)){echo $ftch->date;}?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="present_r_dt">Present Reading Date:</label>
       <input type="text" name="present_r_dt" id="present_r_dt" class="form-control" disabled value="<?php if(mysqli_num_rows($ctl) > 0){echo $ftcher->date;}?>">
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="amount_oil_dt">Amount:</label>
        <input type="text" name="amount_oil_dt" id="amount_oil_dt" class="form-control " disabled>
     </div>
  </div>
  
</div>
<?php
$pql = mysqli_query($con,"SELECT y.*,z.* FROM aset_req_vechile y,aset_req_details z WHERE y.req_id = z.id  and  z.asset_id = '$aset_no' AND y.change_type = '2' ORDER BY z.id DESC LIMIT 1");
$ftch1 = mysqli_fetch_object($pql);
?>
<div class="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="tyre_change">Tyre Changes:</label>
        <input type="checkbox" name="tyre_change" id="tyre_change" value="2" >
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
        <label for="last_r_km_tyre">Last Reading Km:</label>
        <input type="text" name="last_r_km_tyre" id="last_r_km_tyre" class="form-control" value="<?php if( mysqli_num_rows($pql)){echo $ftch1->km_reading;} ?>" disabled>
     </div>
  </div>
   <?php
$cql = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `aset_no` = '$aset_no' ORDER BY `id`DESC LIMIT 1");
// echo "SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$aset_no' AND `change_type` = '1' ORDER BY`id` DESC LIMIT 1";
$ftcher = mysqli_fetch_object($cql);
?>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt_tyre">Present Reading Km:</label>
        <input type="text" name="present_r_km_tyre" id="present_r_km_tyre" class="form-control" disabled value="<?php if(mysqli_num_rows($cql) > 0){echo $ftcher->pr_reading;}?>">
     </div>
  </div>
  <!-- <div class="col-lg-3">
    <div class="form-group">
         <label for="amount_tyre">Amount:</label>
        <input type="text" name="amount_tyre" id="amount_tyre" class="form-control" disabled>
     </div>
  </div> -->
</div>
<div class ="row">
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt"></label>
        <input type="hidden"  class="form-control"  disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="last_r_dt">Last Reading Date:</label>
        <input type="text" name="last_r_dt_tyre" id="last_r_dt_tyre" class="form-control" value="<?php if( mysqli_num_rows($pql)){echo $ftch1->date;} ?>" disabled>
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="present_r_dt">Present Reading Date:</label>
        <input type="text" name="present_r_dt_tyre" id="present_r_dt_tyre" class="form-control " disabled value="<?php if(mysqli_num_rows($cql) > 0){echo $ftcher->date;}?>">
     </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
         <label for="present_r_dt">Amount:</label>
        <input type="text" name="amount_tyre_dt" id="amount_tyre_dt" class="form-control " disabled>
     </div>
  </div>
</div>

<?php
}
}
?>

<script type="text/javascript">
  $("#oil_change").click(function(){
      if($(this).is(":checked")){
                                  // $('#last_r_km').prop('disabled', false);
                                  $('#present_r_km').prop('disabled', false);
                                  $('#amount_oil').prop('disabled', false);
                                  // $('#last_r_dt').prop('disabled', false);
                                  $('#present_r_dt').prop('disabled', false);
                                  $('#amount_oil_dt').prop('disabled', false);
                                  $('#amount_oil_dt').addClass("amount");
                                  $('#amount_oil').addClass("amount");

                                 // $('#present_r_dt').addClass("datetimepicker2");
                                  $(".amount").keyup(function(){
                                             getTotal();
                                            
                                         });

                                 


                                        $('#present_r_dt').datetimepicker({

                                               format:'YYYY-MM-DD',
                                          
                                          widgetPositioning:{
                                            horizontal: 'auto',
                                            vertical: 'bottom'
                                           
                                        }
                                        });
              

                                      }
  else if($(this).is(":not(:checked)")){
                      $('#last_r_km').prop('disabled', true);
                      $('#present_r_km').prop('disabled', true);
                      $('#amount_oil').prop('disabled', true);
                      $('#last_r_dt').prop('disabled', true);
                      $('#present_r_dt').prop('disabled', true);
                      $('#amount_oil_dt').prop('disabled', true);
                      $('#amount_oil_dt').removeClass("amount");
                      $('#amount_oil').removeClass("amount");   
                      // $('#present_r_km').val(""); 
                      // $('#amount_oil').val("");
                      // $('#present_r_dt').val("");
                      $('#amount_oil_dt').val("");
                  getTotal();
                                   }


  });
</script>
<!-- 
 -->
<script type="text/javascript">
  $("#tyre_change").click(function(){
     if($(this).is(":checked")){
     // $('#last_r_km_tyre').prop('disabled', false);
        $('#present_r_km_tyre').prop('disabled', false);
        $('#amount_tyre').prop('disabled', false);
        // $('#last_r_dt_tyre').prop('disabled', false);
        $('#present_r_dt_tyre').prop('disabled', false);
        $('#amount_tyre_dt').prop('disabled', false);
         $('#amount_tyre_dt').addClass("amount");
          $('#amount_tyre').addClass("amount");
           $(".amount").keyup(function(){
             getTotal();
            
         });
 

      $('#present_r_dt_tyre').datetimepicker({

                                               format:'YYYY-MM-DD',
                                          
                                          widgetPositioning:{
                                            horizontal: 'auto',
                                            vertical: 'bottom'
                                           
                                        }
                                        });
      }
     else if($(this).is(":not(:checked)")){
      $('#last_r_km_tyre').prop('disabled', true);
        $('#present_r_km_tyre').prop('disabled', true);
        $('#amount_tyre').prop('disabled', true);
        $('#last_r_dt_tyre').prop('disabled', true);
        $('#present_r_dt_tyre').prop('disabled', true);
        $('#amount_tyre_dt').prop('disabled', true);
        $('#amount_tyre_dt').removeClass("amount");
         $('#amount_tyre').removeClass("amount");
        //  $('#present_r_km_tyre').val(""); 
        // $('#amount_tyre').val("");
        // $('#present_r_dt_tyre').val("");
        $('#amount_tyre_dt').val("");
        getTotal();
} 

  });
</script>
<script type="text/javascript">
  
                                 $(".amount").keyup(function(){
                                             getTotal();
                                            
                                         });
                                 $('#present_r_dt').datetimepicker({

                                               format:'YYYY-MM-DD',
                                          
                                          widgetPositioning:{
                                            horizontal: 'auto',
                                            vertical: 'bottom'
                                           
                                        }
                                        });

   
                                    function getTotal()
                                        {
                                          var amt=0 ;
                                          $( ".amount" ).each(function() {

                                                 amt += Number($( this ).val());
                                                 // alert(amt);
                                              });
                                          $('#estimated_cost').val(amt);
                                        }
                                        $('#present_r_dt_tyre').datetimepicker({

                                               format:'YYYY-MM-DD',
                                          
                                          widgetPositioning:{
                                            horizontal: 'auto',
                                            vertical: 'bottom'
                                           
                                        }
                                        });
</script>




<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['m_t'])) {
?>
<div class="row">
<form name="form" method="post" class="forms-sample" enctype="multipart/form-data" >
  <div class="row">
  
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="duration">Duration[In Days]:</label>

                            <input type="text" class="form-control" name="duration" id="duration" readonly="readonly"  >           
                    </div>
          </div>
           <!--  <div class="col-lg-3">
          <div class="form-group">

                      <label for="days_interval">Present Reading:</label>

                            <input type="text" class="form-control" name="days_interval" id="days_interval" readonly="readonly" >           
                    </div>
          </div>
 -->

          
        
        
       
        
       
          
        
        
       
        
         
            <div class="col-lg-3">
          <div class="form-group">

                      <label for="km_interval">Duration[In Km]:</label>

                            <input type="text" class="form-control" name="km_interval" id="km_interval" readonly="readonly" >           
                    </div>
          </div>
      <!--      <div class="col-lg-3">
          <div class="form-group">

                      <label for="present_reading">Present Reading Date:</label>

                            <input type="text" class="form-control" name="present_reading" id="present_reading"   readonly="readonly">           
                    </div>
          </div> -->


          
        
        
    </div> 
</form>
  </div>
<?php } ?>
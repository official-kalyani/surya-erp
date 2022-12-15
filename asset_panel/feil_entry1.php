<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {

  $id = $_POST['s_id'];
  // echo $id;

  



?>

    <fieldset>
        <legend><h5><b>information</b></h5></legend> 
        <div class="row">
           <div class="col-lg-3">  
                    <div class="form-group"> 
                        <label for="pdate"> Date of purchase:</label>
                       <input type="text" name="pdate" id="pdate" placeholder="YYYY-MM-DD"  class="form-control datepicker" readonly="readonly">
                         
                    </div>
                  </div> 
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="att_doc_te"> Inv no.:</label>
                        <input type="text" class="form-control" name="att_doc_te" id="att_doc_te" readonly="readonly" >
                         
                    </div>
                  </div>
                    <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="att_doc">Attach:</label>
                        <input type="file" class="form-control" name="att_doc" id="att_doc" readonly="readonly" >
                         
                    </div>
                  </div>
                  <div class="col-lg-3">  
                    <div class="form-group"> 
                       <label for="supplier"> Supplier:</label>
                        <input type="text" class="form-control" name="supplier" id="supplier" readonly="readonly" >
                         
                     </div>
                  </div>
                  <div class="col-lg-3">  
                    <div class="form-group"> 
                       <label for="godown"> Godown:</label>
                        <input type="text" class="form-control" name="godown" id="godown" readonly="readonly" >
                         
                     </div>
                  </div>
                
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="warrenty"> Warranty:</label>
                        <input type="text" class="form-control" name="warrenty" id="warrenty" readonly="readonly" >
                      </div>
                  </div>
                  <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="warrenty_att"> Attach:</label>
                        <input type="file" class="form-control" name="warrenty_att" id="warrenty_att" readonly="readonly" >
                      </div>
                  </div>
                   <div class="col-lg-3">  
                      <div class="form-group"> 
                        <label for="serial_no">Serial no</label>
                        <input type="text" class="form-control" name="serial_no" id="serial_no" readonly="readonly" >
                      </div>
                  </div>
                  
        </div>

    </fieldset>
    
<?php  } ?>
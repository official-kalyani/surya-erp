<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_ty'])) {
?>
<fieldset>
        <legend><h5><b>Other details</b></h5></legend> 
        <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="rc_name">RC Name:</label>

                <input type="text" class="form-control" name="rc_name" id="rc_name" readonly="readonly" >           
              </div>
            </div>
              <div class="col-lg-3">
              <div class="form-group">

                          <label for="chasis_no">Chasis No:</label>

                                <input type="text" class="form-control" name="chasis_no" id="chasis_no" readonly="readonly" >           
                        </div>
              </div>

              <div class="col-lg-3">
              <div class="form-group">

                          <label for="engine_no">Engine No:</label>

                                <input type="text" class="form-control" name="engine_no" id="engine_no" readonly="readonly" >           
                        </div>
              </div>

        
        
       </div>
        <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="cdate">RC Date:</label>

                            <input type="text" name="cdate" id="cdate" placeholder="YYYY-MM-DD"  class="form-control datepicker" readonly="readonly" >          
                    </div>
          </div>

          <div class="col-lg-3">
          <div class="form-group">

                      <label for="valid">Valid upto:</label>

                            <input type="text" class="form-control" name="valid" id="valid" readonly="readonly" >           
                    </div>
          </div>

        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att">Attach:</label>

                            <input type="file" class="form-control" name="att" id="att" readonly="readonly" >           
                    </div>
          </div>
        
       </div>
       <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="ins_no">Ins No:</label>

                            <input type="text" class="form-control" name="ins_no" id="ins_no" readonly="readonly" >           
                    </div>
          </div>

          <div class="col-lg-3">
          <div class="form-group">

                      <label for="valid_ins">Valid upto:</label>

                            <input type="text" class="form-control" name="valid_ins" id="valid_ins" readonly="readonly"  >           
                    </div>
          </div>

        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att_ins">Attach:</label>

                            <input type="file" class="form-control" name="att_ins" id="att_ins"  readonly="readonly">           
                    </div>
          </div>
        
       </div>
        <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="pocc_no">Pocc No:</label>

                            <input type="text" class="form-control" name="pocc_no" id="pocc_no" readonly="readonly" >             
                    </div>
          </div>

          <div class="col-lg-3">
          <div class="form-group">

                      <label for="valid_poc">Valid upto:</label>

                            <input type="text" class="form-control" name="valid_poc" id="valid_poc" readonly="readonly" >           
                    </div>
          </div>

        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att_poc">Attach:</label>

                            <input type="file" class="form-control" name="att_poc" id="att_poc" readonly="readonly" >           
                    </div>
          </div>
        
       </div>
       <div class="row">
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="maintainance">Is Periodic Maintainance Required?</label>

                            <select name="maintainance" id="maintainance" class="form-control" readonly = "readonly">
                              
                              <option value="2" selected="selected">Yes</option>
                              <option value="1">No</option>
                              
                            </select>           
                    </div>
          </div>
               
                    
                  
            </div>
            
        
        <div class="col-lg-12" id="formload_select"></div>
    </fieldset>
<script type="text/javascript">


   
    var select = $("#maintainance").val();
  

    if( select == '2'){

          $.ajax({
            url:"maintain2.php",
            data:{m_t:select},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#formload_select").html(sd);
               
            }
          });
    }else{
       $("#formload_select").html('');
    }



</script>

    

<?php } ?>
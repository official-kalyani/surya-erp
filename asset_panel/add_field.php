<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_t'])) {

  $id = $_POST['s_t'];
  // echo $id;

  



?>


 <script src="../../js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() 
    {
        var max_fields      = 5; //Maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
       
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
          
               $(wrapper).append('<div id="append" class = "row"><div class="col-lg-3"><div class="form-group"><input type="text" class="form-control" name="feildentry[]" id="feild" placeholder="Enter feild name" ></div></div> <button class="btn btn-danger btn-xs remove_field">x</button></div>'); //add input box
    } 
    
    $('#feildlabel'+x).selectize({
        sortField: 'text'
          });
    
    
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#append').remove(); x--;
    })
});
</script>


<fieldset>
    <div class="input_fields_wrap">
             <div class="row">
                     
                <div class="col-lg-3">
                  <div class="form-group">
                          

                    <label for="feildlabel">Add Additional Information:</label>
           
                             <?php
                                if(isset($_GET['id'])){
          
         

                                      $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '".$ftch_dtl->sub_type_id."' "); 
                                      while($ftch = mysqli_fetch_object($vet))
                                      {
                                        $total = count($ftch->feild_name);
                                            for($i = 0; $i < $total; $i++) { 


                              ?>             
                          <input type="text" class="form-control" name="feildentry[]" id="feild[]" value="<?php if(isset($_GET['id'])){echo  $ftch->feild_name; }?>" placeholder="Enter feild name"  required="required"><br>
                          <input type="hidden" class="form-control" name="hidden_feild_entry[]" id="feild"value="<?php if(isset($_GET['id'])){echo  $ftch->id; }?>" required="required">
                          <?php 

                                                                               }
                                      }
                                                        }

                                                    else{
                                                        ?>
      <input type="text" class="form-control" name="feildentry[]" id="feild"  placeholder="Enter feild name" required="required" >
                        <?php
                                                           }
                        ?>
                          <!-- ID For Who given the Task -->
                        </div>
                      </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <button class="btn btn-primary btn-xs add_field_button">+</button>
                        </div>
                    </div>
              </div>
          </div>
            

          </fieldset>
      <?php } ?>

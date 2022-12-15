<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['n_id']))
{
	$id = $_POST['n_id'];
       $last_no = mysqli_query($con,"SELECT x.*,y.* FROM aset_stock_assaignment x  ,aset_stock_entry y WHERE x.asset_no = y.auto_serial AND x.assaign_to = '$id' AND x.status = '1' order by x.id ");
       if(mysqli_num_rows($last_no) > 0)
       {
	?>


                                <!-- <div class="table-responsive"> -->
                                    <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th><input type="checkbox" name="chkbox_all" id="chkbox_all" class="form-check-input" ></th>
                                                <th> Asset Code</th>
                                                <th>Name</th>
                                                <th>Used From</th>
                                                <th>Organisation</th>
                                                <th>Recovery</th>
                                                <th>Location</th>
                                                <th>Quality</th>
                                                <th>Reason</th>
                                            </tr> 
                                        </thead>
                                         <tbody>
                                            <?php
                                             
                                                $i = 1;
                                                
                                                  
                                                      while($fetch_id = mysqli_fetch_object($last_no))
                                                    {
                                                         
                                                       
                                                           
                                                         ?>
                                                         <tr>
                                                            <!--  -->
                                                         <td><input type="checkbox" name="chkbox_ind[]" id="chkbox_ind" class="form-check-input check" value="<?php echo $i; ?>" ></td>
                                                            <td><?php echo $fetch_id->asset_no; ?>
                                                               <input type="hidden" name="assn[<?php echo $i; ?>]" id="assn" class="form-control" value="<?php echo $fetch_id->asset_no; ?>" >  
                                                            </td>

                                                            <td><?php echo $fetch_id->description; ?></td>
                                                            <td><?php echo $fetch_id->assaign_dt; ?></td>
                                                            <?php
                                                            $asset_no = $fetch_id->asset_no;
                                                            $query_org = mysqli_query($con,"SELECT x.*,y.organisation  FROM aset_stock_entry x,prj_organisation y WHERE x.organisation = y.id AND x.auto_serial = '$asset_no'");
                                                            $fetch_org = mysqli_fetch_object($query_org);
                                                            ?>
                                                            <td><?php echo $fetch_org->organisation; ?></td>
                                                            <td>
                                                                <input type="text" name="rcdate[<?php echo $i; ?>]" id="rcdate<?php echo $i; ?>" class="form-control rcdate">

                                                            </td>
                                                            <td>
                                                                <?php echo $fetch_id->godowo; ?>
                                                                <input type="hidden" name="rdate[<?php echo $i; ?>]" id="rdate<?php echo $i; ?>" class="form-control" value="<?php echo $fetch_id->godowo; ?>" >

                                                            </td>
                                                              <td>
                                                               <select name="quality[<?php echo $i; ?>]" id="quality<?php echo $i; ?>" class="form-control" >
                                                                 <option value="">--select--</option> 
                                                                 <option value="Better">Better</option>
                                                                 <option value="Good">Good</option>
                                                                 <option value="Bad">Bad</option>
                                                                 <option value="Worst">Worst</option>
                                                                 <option value="Usefull">Usefull</option>
                                                                 <option value="Unusable">Unusable</option>
                                                               </select>
                                                            </td>
                                                              <td>
                                                                <select name="reson[<?php echo $i; ?>]" id="reson<?php echo $i; ?>" class="form-control" >
                                                                 <option value="">--select--</option> 
                                                                 <option value="Resign">Resign</option>
                                                                 <option value="Exchange">Exchange</option>
                                                                 <option value="Unusable">Unusable</option>
                                                                 <option value="Not Required">Not Required</option>
                                                                 <option value="Defective">Defective</option>
                                                                 
                                                               </select>

                                                            </td>
                                                            </tr>
                                                            
                                                         <?php
                                                        
                                                        
                                                    //      else{

                                                    //    echo "<tr align='center'><td colspan='12'> No Asset Alloted </td></tr>";
                                                    // }
                                                         
                                                    
                                                   
                                                    $i++;
                                                 }
                                            ?>
                                         </tbody>
                                      </table>
                                       <div class="row">
                        <div class="col-lg-12" >
                
                  <input type="submit" name="itemsbmt"  id="itemsbmt"
                   value="submit" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >  
                </div> 
                 
                           
                       </div>
                                      <script type="text/javascript">
    
                                        $(document).ready(function() { 

                                          $('.rcdate').datetimepicker({

                                                    format:'YYYY-MM-DD',

                                                });
                                        })
                                        </script>
                               <!--          <script type="text/javascript">
                                             $(".check").click(function(){
                                                 if ($(this).is(':checked')) {
                                         $("#chkbox_ind").prop("checked", true);
                                     }
                                     else{
                                           
                                                $("#chkbox_ind").prop("checked", false);
                                       }
                                            });
                                            
                                        </script> -->
                                        <script type="text/javascript">
                                        $('#chkbox_all').click(function() {
                                        if ($(this).is(':checked')) {
                                        $('.check').prop('checked', true);

                                        } else {
                                        $('.check').prop('checked', false);

                                        }
                                        });
                                   
                                        </script>

                                        <script type="text/javascript">
                                         $("#itemsbmt").click(function(){
                                         var sList = "";
$('.check').each(function () {
     var chk = $(this).val();
    if ($(this).is(':checked')) {
       
    
    $('#rcdate'+chk).prop('required', true);
    $('#quality'+chk).prop('required', true);
    $('#reson'+chk).prop('required', true);
}
else{

    $('#rcdate'+chk).prop('required', false);
    $('#quality'+chk).prop('required', false);
    $('#reson'+chk).prop('required', false);
}

});
                                         });   
                                        </script>
                                        <script type="text/javascript">

                                          $("#itemsbmt").click(function(){
                                            var checked = $(".check:checked").length > 0;
                                            if (!checked){
                                                alert("Please check at least one checkbox");
                                                return false;
                                                
                                            }
                                           
                                        });
                                        </script>
                                    
                                        
         <?php
                                  }
                                  else{
                                    echo"<h6 style='color:red;'>NO ASSET ALLOTTED</h6>";
                                                                                    
                                  }
                                  ?>  
	<?php
}
?>
<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id']))
{
$id = $_POST['s_id'];



if($_SESSION['ERP_SESS_ID']!='1')
{
 
?>

	<div class="col-lg-4">
<label for="forto">Request To</label>
<?php
                       // $puy = "SELECT req_to FROM `aset_pr_req_to` WHERE `pr_id` = '$id'";
                       //    $puycon=mysqli_query($con,$puy);
                        
                       //    $ftch_req = mysqli_fetch_object($puycon);

                       //    $total = count($ftch_req)
                            $names = array();
                           $vet = mysqli_query($con,"SELECT req_to FROM `aset_pr_req_to` WHERE `pr_id` = '$id'"); 
                                      while($row = mysqli_fetch_assoc($vet))
                                      {
                                        // $total = count($ftch->req_to);
                                        // // echo $total;
                                      
                                        //               for($i = 0; $i < $total; $i++) { 

                                                          $names[] = $row['req_to'];
                                                        

                                                      


                                      }
                                      // foreach($ID as $value){
                                      //   echo "Salary:". $value. "<br>";
                                      // }



                            ?>
                            <?php

                          $wet = mysqli_query($con,"SELECT req_by FROM `aset_pr` WHERE `id` = '$id'");
                          $reqby = mysqli_fetch_object($wet);
                                      $req = $reqby->req_by;
                            ?>
           
            <select name="forto" id="forto" class="form-control-select" >
                    <option value=''>Type to Select Name</option>
                      <?php
                            // print_r($req_id); 
                        $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' AND `id`!='".$_SESSION['ERP_SESS_ID']."' AND `id` NOT IN ( '" . implode( "', '" , $names ) . "' ) AND `id` != '".$req."'  ORDER BY `mstr_emp`.`id` ASC";
                        $efq=mysqli_query($con,$eq); 

                        while ($egq = mysqli_fetch_object($efq))
                            { 
                          echo '<option value="'. $egq->id . '">' . $egq->fullname .'('.$egq->designation.')</option>';
                            }
                          
                      ?>
            </select>
            <script type="text/javascript">
  $(document).ready(function () {
      $('#forto').selectize({
          sortField: 'text'
      });
  });
</script>   
            </div>

          <!--   <div class="col-lg-8"> -->
     <!--      <input type="reset" name="reset" id="reset"
           value="RESET" class="btn btn-warning mr-2" style="float:right;"> -->
          
<?php

}
?>
<!--   <div class="col-lg-12"> -->
       

<?php
}

?>
<!-- </div> -->


<!-- </div>   -->
           
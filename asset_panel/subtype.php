<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_d'])) {

$id = $_POST['s_d'];
  $sql = "SELECT * from `aset_item_creation` where status='1' AND `id`=".$id;

  $res = mysqli_query($con, $sql);



    while($row = mysqli_fetch_object($res)) {



    	if(mysqli_num_rows($res) > 0) {



     




	$eq = "SELECT * FROM `fin_grouping_subtype` WHERE `status`='1'";
                        $efq=mysqli_query($con,$eq); 

                        while ($egq = mysqli_fetch_object($efq))
                            {
                              $select='';
                            if($egq->id==$row->sub_type){
                              $select='selected';
                            } 
                           echo '<option value="'. $egq->id . '"'.$select.'>'.$egq->subtypenm.'</option>';
                            }
                            
      
}
    }


    

  }

?>
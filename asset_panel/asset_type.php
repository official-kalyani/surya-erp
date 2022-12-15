<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {

$id = $_POST['s_id'];
  $sql = "SELECT * from `aset_item_creation` where status='1' AND `id`=".$id;

  $res = mysqli_query($con, $sql);



    while($row = mysqli_fetch_object($res)) {



    	if(mysqli_num_rows($res) > 0) {



     




                              $select='selected';
                            
                           echo '<option value="'. $row->asset_type . '"'.$select.'>'.$row->asset_type.'</option>';
                            }
                            
      
}
    }


    

  

?>
<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_d'])) {

$id = $_POST['s_d'];
  $sql = "SELECT * from `asset_category` where status='1' AND `asset_id`=".$id." GROUP BY `category`";

  $res = mysqli_query($con, $sql);

 echo '<option value="">--Select Category--</option>';

    while($row = mysqli_fetch_object($res)) {



    	if(mysqli_num_rows($res) > 0) {



     




                             
                            
                           echo '<option value="'. $row->category . '">'.$row->category.'</option>';
                            }
                            
      
}
    }


    

  

?>
<?php
if(isset($_POST['s_id']) && isset($_POST['a_t'])) {

$id = $_POST['s_id'];
$category = $_POST['a_t'];
//   $sqlt = "SELECT * from `asset_category` where status='1' AND `asset_id`= '$id'AND `category`='$category' GROUP BY `category`";
// echo "SELECT * from `asset_category` where status='1' AND `asset_id`= '$id'AND `category`='$category' GROUP BY `category`";
//   $resl = mysqli_query($con, $sqlt);
$result_query = mysqli_query($con,"SELECT * from `asset_category` where status='1' AND `asset_id`= '$id'AND `category`='$category' ");

 echo '<option value="">--Select Category--</option>';

    while($row_sub = mysqli_fetch_object($result_query)) {



    	if(mysqli_num_rows($result_query) > 0) {



     




                             
                            
                           echo '<option value="'. $row_sub->sub_category . '">'.$row_sub->sub_category.'</option>';
                            }
                            
      
}
    }


    

  

?>
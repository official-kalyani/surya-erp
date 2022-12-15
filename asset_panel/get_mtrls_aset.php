<?php include("../../config.php");?>

<?php

	if(isset($_POST['matid'])) {	
		

		$mid = $_POST['matid'];


		    $m_qry = mysqli_query($con, "SELECT * FROM `prj_material` WHERE `id`=".$mid);
			$m_ftch = mysqli_fetch_object($m_qry);
			

$response = array("material" => $m_ftch->material_name, "uom" => $m_ftch->uom, "hsn" => $m_ftch->hsn_code);
			
			echo json_encode($response);


}	  
	  		
		    ?>
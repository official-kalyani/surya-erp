<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php require_once('mpdf/mpdf.php'); ?>
<?php
	$emp = $_SESSION['ERP_SESS_ID'];
	$html='';

	$html.='<table class="table table-hover table-bordered" id="insurance_table">
			<thead> 
			    <tr> 
			        <th>Slno</th>
			        <th>Asset No</th>
			        <th>Item</th> 
			        <th>Serial No</th>
			        <th>Name</th>
			        <th>Insurance Company</th>
			        <th>Valid Upto</th>
			        <th>Status</th>
			    </tr> 
			</thead> 
			<tbody>';

	        if ($emp=='55') 
	        {
	            if(isset($_GET['asset_no']) && isset($_GET['site_fullname']))
	            {
	                $spname = mysqli_real_escape_string($con,$_GET['asset_no']); // Prevent SQL-Injection
	                $erp_fullname = mysqli_real_escape_string($con,$_GET['site_fullname']); // Prevent SQL-Injection

	                if ($spname!=='' && $erp_fullname!=='') 
	                {
	                    $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND  x.assaign_to = '$erp_fullname' AND x.status = '1'");
	                }

	                if ($spname!=='' && $erp_fullname=='') 
	                {
	                    $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND x.status = '1'");
	                }

	                if ($spname=='' && $erp_fullname!=='') 
	                {
	                    $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$erp_fullname' AND x.status = '1'");
	                }

	                if ($spname=='' && $erp_fullname =='') 
	                {
	                    $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.status = '1'"); 
	                }
	            }
	            else
	            {
	                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.status = '1'"); 
	            }
	        }
	        else
	        {
	            if(isset($_GET['asset_no']))
	            {
	                $spname = mysqli_real_escape_string($con,$_GET['asset_no']); // Prevent SQL-Injection

	                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$emp' AND y.auto_serial = '$spname' AND x.status = '1'"); 
	            }
	            else
	            {
	                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$emp' AND x.status = '1'");
	            }
	        }

	        $total_results = mysqli_num_rows($result);
	        if($total_results == 0) // Set For Record Not Found 
	        {
	            $html.="<tr align='center'><td colspan='8'> NO RECORDS FOUND.</td></tr>";
	        }

	        $i = 0;
	        while($fetch= mysqli_fetch_object($result))
	        {
	        	$i++;

	            $html.='<tr>
	                		<td>'.$i.'</td>
	                		<td>'.$fetch->auto_serial.'</td>
	                		<td>'.$fetch->description.'</td>
	                		<td>'.$fetch->serial_no.'</td>';

	                        $assaign = $fetch->auto_serial;
	                        $queryan = mysqli_query($con,"SELECT x.*,y.fullname  from aset_stock_assaignment x,mstr_emp y WHERE x.assaign_to = y.id AND x.asset_no = '$assaign' AND x.status = '1' ORDER BY x.id DESC LIMIT 1");
	                        $fetch_name = mysqli_fetch_object($queryan);
	                        if(mysqli_num_rows($queryan)>0 )
	                        {
	                            $html.='<td>'.$fetch_name->fullname.'</td>';
	                        }
	                        else
	                        {
	                            $html.='<td>Not assaigned</td>';
	                        }

	                        if($fetch->ins_comp != '')
	                        {
	                           $html.='<td>'.$fetch->ins_comp.'</td>'; 
	                        }

                	$html.='<td>'.date("d-m-Y", strtotime($fetch->ins_valid)).'</td>';

	                        $date = $fetch->ins_valid;
	                        $today = date('Y-m-d');
	                        if ($today > $date) 
	                        {
	                            $html.='<td>Inactive</td>'; 
	                        }
	                        else
	                        {
	                            $html.='<td>Active</td>'; 
	                        }
	            $html.='</tr>';
	        }
	$html.='</tbody>
		</table>';


if ( isset($_GET['pdf']) ) 
{
  	$mpdf = new mPDF('c',    // mode - default ''
	   '',    // format - A4, for example, default ''
	   0,     // font size - default 0
	   '',    // default font family
	   15,    // margin_left
	   15,    // margin right
	   16,    // margin top
	   16,    // margin bottom
	   9,     // margin header
	   9,     // margin footer
	   'P');  // L - landscape, P - portrait
   
  	// Define the Header/Footer before writing anything so they appear on the first page
  	$mpdf->SetHTMLHeader('
  	<div style="text-align: center; font-weight: bold;">
      Insurance list Report 
  	</div>');
   // Set a simple Footer including the page number
  	$mpdf->setFooter('{PAGENO}');    
  	ob_clean();  
  
  	$msg.='<html>
          <head>
            <link href="../../css/bootstrap.min.css" rel="stylesheet">
          </head>
          <body>';
  	$msg.=$html;
  	$msg.='</body>
        </html>';

  	// //call watermark content and image
  	// $content = ob_get_contents();
	$mpdf->SetWatermarkText('Surya International');
	$mpdf->showWatermarkText = true;
	$mpdf->watermarkTextAlpha = 0.1;
	$mpdf->WriteHTML($msg);
	ob_end_flush();

  	//save the file put which location you need folder/filname
  	$pdfString =$mpdf->Output("Insurance Report".date("Y-m-d").".pdf", 'D');
  	exit();
}

if ( isset($_GET['excel']) ) 
{
	header("Content-type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename=Insurance Report".date("Y-m-d").".xls");
	echo $html;
}

	
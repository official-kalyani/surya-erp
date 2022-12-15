<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php 
$filename = "sia_searched_report_sheet.csv";

$file = fopen($filename,"w");
$lineData = array("Slno","Asset No.","Serial No.","Name Of Asset","Date Of Purchase","Supplier","Invoice No.","QTY","Item Sub Type"," Current Location","Used By", "From Date", "Status");
 fputcsv($file,$lineData);
if(isset($_GET['sdate']) || isset($_GET['tdate']) || isset($_GET['spname']) )
    {
               if(($_GET['sdate']  != "") || ($_GET['tdate']  != ""))
                    {
                         $spdate = $_GET['sdate'];
                         
                        
                         $pdate = $_GET['tdate'];
                         $SESSION['pdate']= $pdate;
                         $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND `asset_type` = 'Admin' AND date_purchase  BETWEEN '$spdate'AND'$pdate'"); 
                    }
                
                else if($_GET['spname'] !="") // For Search
                    {
               $search = $_GET['select_search'];
                // Prevent SQL-Injection
                if($search == 1)
                {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND auto_serial LIKE '%$spname%'");
                }
                else if($search == 2)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND serial_no LIKE '%$spname%'");
                }
                else if($search == 3)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND description LIKE '%$spname%'");
                }
                else if($search == 4)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND date_purchase LIKE '%$spname%'");
                }
                 else if($search == 5)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND supplier LIKE '%$spname%'");
                }
                 else if($search == 6)
                     {
                     $spname =$_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND inv_no LIKE '%$spname%'");
                }
                else if($search == 7)
                     {
                     $spname = $_GET['spname'];
                    $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND qty = '$spname '");
                }
                else if($search == 8)
                     {
                     $spname = $_GET['spname'];
                   $abc = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND x.asset_type = 'Admin' AND y.project_site LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");
                    if(mysqli_num_rows($abc) >1)
                    {
                      $result = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND x.asset_type = 'User'Admin y.project_site LIKE '%$spname%' AND y.status = '1' GROUP BY x.auto_serial");

                    }
                    else{
                          $result = mysqli_query($con,"SELECT x.*, x.id as xid, y.*, y.id as id FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND x.asset_type = 'Admin' AND x.godowo LIKE '%$spname%' m GROUP BY x.auto_serial");

                    }
                }
                else if($search == 9)
                     {
                     $spname = $_GET['spname'];
                     $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND y.fullname LIKE '%$spname%' AND x.asset_type = 'Admin' GROUP BY x.auto_serial ");
                }
                else if($search == 10)
                     {
                     $spname =$_GET['spname'];
                    $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = y.asset_no AND y.assaign_dt LIKE '%$spname%' AND x.asset_type = 'Admin' GROUP BY x.auto_serial");
                }
                  else if($search == 11)
                {
                  $spname =$_GET['spname'];
                   $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND y.name LIKE '%$spname%' AND x.asset_type = 'Admin' GROUP BY x.auto_serial");
                }
                  else if($search == 12)
                {
                  $spname = $_GET['spname'];
                  if($spname == '1')
                   {
                    $result = mysqli_query($con,"SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE  x.auto_serial = y.asset_no AND x.asset_type = 'Admin' GROUP BY x.auto_serial");
                  }
                  else if($spname == '2')
                  {
                   
                   $result = mysqli_query($con,"SELECT  *  from   aset_stock_entry  WHERE `auto_serial`  NOT IN (SELECT asset_no from aset_stock_assaignment GROUP BY asset_no)");
                  
                }
                 else if($search == 13)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.aset_category LIKE '%$spname%' AND x.asset_type = 'Admin' GROUP BY x.auto_serial");
              }
               else if($search == 14)
              {
                $spname = mysqli_real_escape_string($con,$_GET['spname']);
                   $result = mysqli_query($con,"SELECT x.*, y.* FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = y.id AND x.aset_subcatagory LIKE '%$spname%' AND x.asset_type = 'Admin' GROUP BY x.auto_serial");
              }


              }
                else{
                    $spname = $_GET['spname'];
                $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin' AND description LIKE '%$spname%'");
                
                }
                    }
                }
                    else // For Normal
                    {
                $result = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  status = '1' AND asset_type = 'Admin'"); 
                    } 

        $total_results = mysqli_num_rows($result);
        if($total_results == 0) // Set For Record Not Found 
        {
            $Error_message="NO RECORDS FOUND.";
        }
     
$i=1; 
while($fetch=mysqli_fetch_object($result))
{
  $slno =  $i;
  $asset_no = $fetch->auto_serial;
  $serial_no = $fetch->serial_no;
  $asset_name = $fetch->description;
  if( $fetch->aset_category != '')
                          {
                            echo $category = $fetch->aset_category;
                          }
                          else
                          {
                            echo $category = "";
                          }
                           if( $fetch->aset_subcatagory != '')
                          {
                            echo $subcategory = $fetch->aset_subcatagory;
                          }
                          else
                          {
                            echo $subcategory = "";
                          }
  $date_purchase = $fetch->date_purchase;
  $supplier = $fetch->supplier;
  $invoice = $fetch->inv_no;
  $qty = $fetch->qty;
  $godown = $fetch->godowo;


                        $serial = $fetch->auto_serial;
                        $name = $fetch->item_name;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, aset_item_creation y WHERE x.item_name = '$name' AND x.item_name = y.id ORDER BY y.id DESC LIMIT 1") ;
                       
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {
                            $item_type = $fetch_ass_data->name;
                        }
                        // echo $serial;
                        $ass_data = mysqli_query($con, "SELECT x.*,x.id as xid, y.*, y.id as yid FROM aset_stock_entry  x, vw_aset_stock_assaignment y WHERE x.auto_serial = '$serial' AND x.auto_serial = y.asset_no ORDER BY y.id DESC LIMIT 1") ;
                        if(mysqli_num_rows($ass_data) > 0){
                        while($fetch_ass_data = mysqli_fetch_object($ass_data))
                        {
                        

                       
                       $current = $fetch_ass_data->project_site;
                         $name = $fetch_ass_data->fullname; 
                       $date =  $fetch_ass_data->assaign_dt;
                       
                       $lineData = array($slno,$asset_no,$serial_no,$asset_name,$category,$subcategory,$date_purchase,$supplier,$invoice,$qty,$item_type,$current,$name,$date,"assigned");

                     } 
                 } 

                      else {
                        
                        $lineData = array($slno,$asset_no,$serial_no,$asset_name,,$category,$subcategory,$date_purchase,$supplier,$invoice,$qty,$item_type,$godown,"","","Not assigned");
                      }
                    
  
fputcsv($file,$lineData);
$i++;

}
fclose($file); 


// Download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Type: application/csv"); 

readfile($filename);

// deleting file
unlink($filename);
exit();
                                        
 


?>
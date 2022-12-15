<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $a_id = $_GET['a_id'];
      
     

     // $name = $ftch->item_name;
     // $subtype = $ftch->sub_type;
 
    

    
    if(isset($_POST['pupdte'])){
      $date = date('Y-m-d');
      $pr_km = $_POST['vechile'];
      $total_cost = $_POST['estimated_cost'];
       $req = $_POST['maintain_req'];
       $req_no = $_POST['serial'];
       $msg = $_POST['message_level'];
       $by = $_SESSION['ERP_SESS_ID'];
      $created_on = date('Y-m-d H:i:s');
if(isset($_POST['vec_cost_oil']))
{
  $oil = $_POST['vec_cost_oil'];
  $query = mysqli_query($con,"INSERT INTO `aset_req_vechile` (`req_id`, `km_reading`, `change_type`, `amount` ,`date`, `status`) VALUES ('$id','$pr_km','1','$oil','$date','1')");
 





}
if(isset($_POST['vec_cost_tyre']))
{
  $tyre = $_POST['vec_cost_tyre'];
  $query = mysqli_query($con,"INSERT INTO `aset_req_vechile` (`req_id`, `km_reading`, `change_type`, `amount` ,`date`, `status`) VALUES ('$id','$pr_km','2','$tyre','$date','1')");

  // echo $tyre;
}
 $total = count($_POST['n1']); 
 
 
     

for($i = 0; $i < $total; $i++) { 
        $add_item = mysqli_real_escape_string($con, $_POST['n1'][$i]);
 
           $cost_item =  $_POST['chng_cost'][$i];
          
        
         if(isset($_POST['n1'][$i])){

          if(($_POST['n1'][$i] )!=""){


            $vw_details = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE`feild_name` ='$add_item'") ;
             if(mysqli_num_rows($vw_details) > 0) 
             {

              echo '<script>alert(" Field already exsist..")</script>';
             }


    
$sql=  "INSERT INTO `aset_req_other` (`req_id`, `feildname`, `amount`) VALUES ('$id ','$add_item', '$cost_item')";
// $sql=  "UPDATE `aset_req_other` SET `amount`='$cost_item' WHERE id =$total_entry";
$sql2 = mysqli_query($con, $sql);
}
}
}
 $query = mysqli_query($con,"INSERT INTO `aset_req_update` (`req_id`, `asset_no`, `aset_req_no`, `total_cost` , `req_to`, `req_date`, `status`) VALUES ('$id','$a_id','$req_no','$total_cost','$req','$date','0')");
 echo "INSERT INTO `aset_req_update` (`req_id`, `asset_no`, `aset_req_no`, `total_cost` , `req_to`, `req_date`) VALUES ('$id','$a_id','$req_no','$total_cost','$req','$date')";
  $query1 = mysqli_query($con,"INSERT INTO `aset_msg_updates` (`req_id`, `message`, `message_by`, `created_on` , `status`) VALUES ('$id','$msg','$by','$created_on','1')");
if($query)
  { 
  $msg="Maintenance data updated successfully";
      // header("Location:vwpg_pr_data.php?msg=$msg");
 
      header("Location: asset_req_accept_view.php?msg=$msg&id=$id&a_id=$a_id");
    }
  else {
  $msgel="Unsuccessfull in entering field...retry again";
}

     
   
   } 
   if(isset($_POST['esubmit'])) 
   {
if(isset($_POST['amount_oil']))
{
  $oil = $_POST['amount_oil'];
  $ter = mysqli_query($con,"UPDATE aset_req_vechile SET amount ='$oil' WHERE req_id = '$id' AND change_type = '1'");
}
if(isset($_POST['amount_tyre']))
{
  $tyre = $_POST['amount_tyre'];
  $ter = mysqli_query($con,"UPDATE aset_req_vechile SET amount ='$tyre' WHERE req_id = '$id' AND change_type = '2'");
}
$total = count($_POST['n1']);
echo $total;


        for($i = 0; $i < $total; $i++)
         { 
        
          if(isset($_POST['n1'][$i]))
          {
            $add_item = $_POST['chng_cost'][$i];
          // hidden value
            $total_entry = $_POST['hidden_chng_cost'][$i];

            $query1 = "UPDATE `aset_req_other` SET `amount`='$add_item' WHERE id =$total_entry";

            $sql1 = mysqli_query($con, $query1);
         
              if($sql1) { $msg=" Your data is updated.";

              header("Location: aset_req_accept.php?msg=$msg&id=$id&a_id=$a_id");
               }
 }
}
$cost = $_POST['estimated_cost'];
 $ter = mysqli_query($con,"UPDATE aset_req_update SET total_cost ='$cost' WHERE req_id = '$id'");
if($ter) { $msg=" Your data is updated.";

              header("Location: asset_req_accept_view.php?msg=$msg&id=$id&a_id=$a_id");
               }

   }  

   if (isset($_POST['approve'])) {
      $msg = $_POST['message_level'];
       $by = $_SESSION['ERP_SESS_ID'];
      $created_on = date('Y-m-d H:i:s');
    $ter = mysqli_query($con,"UPDATE aset_req_update SET status ='1' WHERE req_id = '$id'");
     $query1 = mysqli_query($con,"INSERT INTO `aset_msg_updates` (`req_id`, `message`, `message_by`, `created_on` , `status`) VALUES ('$id','$msg','$by','$created_on','1')");
    if($ter && $query1) { $msg=" Request is accepted successfully.";

              header("Location: aset_req_accept.php?msg=$msg&id=$id&a_id=$a_id");
               }
      
    } 
    if (isset($_POST['reject'])) {
       $msg = $_POST['message_level'];
       $by = $_SESSION['ERP_SESS_ID'];
      $created_on = date('Y-m-d H:i:s');
    $ter = mysqli_query($con,"UPDATE aset_req_update SET status ='2' WHERE req_id = '$id'");
    $query1 = mysqli_query($con,"INSERT INTO `aset_msg_updates` (`req_id`, `message`, `message_by`, `created_on` , `status`) VALUES ('$id','$msg','$by','$created_on','1')");
    if($ter && $query1) { $msgel=" Request is rejected successfully.";

              header("Location: aset_req_accept.php?msgel=$msgel&id=$id&a_id=$a_id");
               }
      
    } 
if(isset($_POST['esubmit'])) 
   {
if(isset($_POST['amount_oil']))
{
  $oil = $_POST['amount_oil'];
  $ter = mysqli_query($con,"UPDATE aset_req_vechile SET amount ='$oil' WHERE req_id = '$id' AND change_type = '1'");
}
if(isset($_POST['amount_tyre']))
{
  $tyre = $_POST['amount_tyre'];
  $ter = mysqli_query($con,"UPDATE aset_req_vechile SET amount ='$tyre' WHERE req_id = '$id' AND change_type = '2'");
}
$total = count($_POST['n1']);
echo $total;


        for($i = 0; $i < $total; $i++)
         { 
        
          if(isset($_POST['n1'][$i]))
          {
            $add_item = $_POST['chng_cost'][$i];
          // hidden value
            $total_entry = $_POST['hidden_chng_cost'][$i];

            $query1 = "UPDATE `aset_req_other` SET `amount`='$add_item' WHERE id =$total_entry";

            $sql1 = mysqli_query($con, $query1);
         
              // if($sql1) {
              //  $msg=" Your data is updated.";

              // header("Location: aset_req_accept.php?msg=$msg&id=$id&a_id=$a_id");
              //  }
 }
}
$cost = $_POST['estimated_cost'];
 $msg = $_POST['message_level'];
       $by = $_SESSION['ERP_SESS_ID'];
      $created_on = date('Y-m-d H:i:s');
 $ter = mysqli_query($con,"UPDATE aset_req_update SET total_cost ='$cost' WHERE req_id = '$id'");
  $query1 = mysqli_query($con,"INSERT INTO `aset_msg_updates` (`req_id`, `message`, `message_by`, `created_on` , `status`) VALUES ('$id','$msg','$by','$created_on','1')");
if($ter && $query1) { 
  $msg=" Your data is updated.";

              header("Location: asset_req_accept_view.php?msg=$msg&id=$id&a_id=$a_id&e_id=$id");
               }

   }  

    
    ?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Maintenance Form: Suryam Group</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.../../js/1.4.2/respond.min.js"></script>
        <![endif]-->
    
     <!-- jQuery -->
        <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.min.js"></script>
    
    <link rel="shortcut icon" href="../../images/favicon.png" />
    
<!-- Calendar -->
<script type="text/javascript" src="../../calendar/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../calendar/datepicker.css"/>
<!-- //Calendar -->

<!-- Used For Auto Typing Search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />    
<!-- // Used For Auto Typing Search-->    
    
<!--Clock-->
<script src="../../js/clock.js" type="text/javascript"></script>
<!--//Clock-->
<script>
$(document).ready(function() { 
  startclock ();
})
</script>
    <script type="text/javascript">
      $(document).ready(function () {
         $(".amount").keyup(function(){
             getTotal();
            
         });
      });

      function getTotal()
      {
        var amt=0 ;
        $( ".amount" ).each(function() {

               amt += Number($( this ).val());
               // alert(amt);
            });
        $('#estimated_cost').val(amt);
      }
    </script>



    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
               
         <?php require_once('../../header.php'); // include Header Portion ?>
               
         <?php require_once('../../menu.php'); // include Menu Portion ?>
              
            </nav>

            <div id="page-wrapper">
        <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">Maintenanance Request Details</h4>
           
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <!-- /.row -->
                <div class="row">
                <!-- Body Starts Here -->  
        <span style="float:right;">
                   
                 
        <?php

                $query = mysqli_query($con,"SELECT x.*,x.id as xid,y.fullname, z.* FROM aset_req_details x,mstr_emp y,aset_stock_entry z WHERE x.req_by = y.id AND x.id = '$id' AND z.auto_serial = x.asset_id AND z.auto_serial = '$a_id'");
                $ftch = mysqli_fetch_object($query);
                if(mysqli_num_rows($query) > 0)
                {
                  if(isset($_GET['e_id']))
                  {
                    ?>
                    <button onClick='javascript:location.href="asset_req_accept_view.php?id=<?php echo $id;?>&a_id=<?php echo $a_id;?>"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
                    <?php
                  }
                  else{
                    ?>
                      <button onClick='javascript:location.href="aset_maintain_approved.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
                    <?php
                  }
                }
                else{
                ?>
           <button onClick='javascript:location.href="aset_maintain_approved.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
         <?php
       }
       ?>
        </span> 
      <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                  

                   <?php if(isset($_GET['msgel'])) { 
                   $msg = $_GET['msgel'];
                  echo "<i style=color:#D71313;>".$msg."</i>";
                   } ?>
                 </div>
              <form name="form" method="post" class="forms-sample" enctype="multipart/form-data">
                 <?php
                    $aid = mysqli_query($con,"SELECT * FROM `aset_req_update` WHERE req_id = '$id'") ;
                   
                    $fetch_req = mysqli_fetch_object($aid); 
                   ?>
           
              <fieldset>
                <legend><h5><b></b></h5></legend>
                <?php

                $query = mysqli_query($con,"SELECT x.*,x.id as xid,y.fullname, z.* FROM aset_req_details x,mstr_emp y,aset_stock_entry z WHERE x.req_by = y.id AND x.id = '$id' AND z.auto_serial = x.asset_id AND z.auto_serial = '$a_id'");

                $ftch = mysqli_fetch_object($query);
                ?>
                <div class="row">
                  <input type="hidden" name="hid_id" id="hid_id" value="<?php echo $ftch->xid;?>">
                  <input type="hidden" name="hid_no" id="hid_no" value="<?php echo $a_id;?>">
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Maintenance Request No:</label>
                         <?php if(mysqli_num_rows($query) > 0)
                {echo $ftch->asset_req_no;} ?>
                         <input type="hidden" name="serial" id="serial" value="<?php if(mysqli_num_rows($query) > 0)
                { echo $ftch->asset_req_no; } ?>">
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Date:</label>
                         <?php if(mysqli_num_rows($query) > 0)
                { echo $ftch->date;}?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Requested By:</label>
                       
                         <?php if(mysqli_num_rows($query) > 0)
                {echo $ftch->fullname; }?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Asset Name:</label>
                       
                         <?php if(mysqli_num_rows($query) > 0)
                { echo $ftch->description; }?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Serial No:</label>
                       
                         <?php if(mysqli_num_rows($query) > 0)
                { echo $ftch->serial_no; }?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Warrenty:</label>
                       
                         <?php if(mysqli_num_rows($query) > 0)
                {echo $ftch->warrenty;} ?>
                      </div>
                  </div>
                  <?php

                   $query = mysqli_query($con,"SELECT x. *,y.fullname FROM aset_stock_assaignment x, mstr_emp y WHERE x.asset_no  = '$a_id' AND  x.assaign_to = y.id  ORDER BY x. id DESC LIMIT 1");
                $ftch = mysqli_fetch_object($query);
                  ?>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Used By:</label>
                       
                         <?php if(mysqli_num_rows($query) > 0)
                {echo $ftch->fullname; }?>
                      </div>
                  </div>
                  <?php
                     $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$a_id'");
                  $ftch_aset_no = mysqli_fetch_object($dueryer);
                  if(mysqli_num_rows($dueryer) > 0)
                  {
                  if( $ftch_aset_no->sub_type == '6')
                  {

        

                  ?>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="vechile">Present Km Reading:</label>
                      <?php
                      if(isset($_GET['a_id']))
                      {
                        $aid = $_GET['a_id'];
                       $dueryer = mysqli_query($con,"SELECT * FROM `aset_vehicle_report` WHERE `aset_no` = '$aid' ORDER BY id  DESC LIMIT 1");
                      
                  $ftch_aset_no = mysqli_fetch_object($dueryer);
                }
                      ?>
                        
                       <?php echo $ftch_aset_no->pr_reading; ?>
                       <input type="hidden" name="vechile" id="vechile" value=" <?php echo $ftch_aset_no->pr_reading; ?>">
                    </div>
                  </div>
                  <?php
                }
              }
                ?>
                 
            </fieldset> 
           
            <fieldset>
               <legend><h5><b>Details</b></h5></legend>
               <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped append_feild" >
                 

  
                  
                 <?php

            $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$a_id'");
                  $ftch_aset_no = mysqli_fetch_object($dueryer);

            ?>

                                        <thead> 
                                            <tr> 
                                               <th style="width: 25%;">Slno</th>
                                                <th style="width: 48%;">Field Name</th>
                                                <th></th>
                                                
                                                <th>Amount</th>
                                                
                                            </tr> 
                                        </thead>
                                       
                                        <tbody>
                                          <?php

               if(mysqli_num_rows($dueryer) > 0)
{                         

                                            if( $ftch_aset_no->sub_type == '6')
                  {
                    $i=1;
                 $query1 = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE asset_id = '$id' ");
                 
                  while ($ftch_dtl = mysqli_fetch_object($query1))
                  {
                    
                  ?>
                  <tr>
                    <td id="serial_no" style="width: 25%;"><?php echo $i; ?></td>
                    <?php
                    if($ftch_dtl->change_type == '1')
                    {
                      ?>
                      <td >Oil Change</td>
                      <!-- <td> <input type="text" name="vec_cost_oil" id="vec_cost_oil" class="form-control amount"> </td> -->
                      <?php
                    }
                    else if($ftch_dtl->change_type == '2')
                    {
                      ?>
                      <td >Tyre Change</td>
                       <!-- <td> <input type="text" name="vec_cost_tyre" id="vec_cost_tyre" class="form-control amount"> </td> -->
                      <?php
                    }
                  
                    
                    ?>
                    
                    
                 <td></td>

                 <?php
                  $query4 = mysqli_query($con,"SELECT * FROM `aset_req_vechile` WHERE req_id = '$id'AND change_type ='1' ");
                 $ftch_dtl_oil = mysqli_fetch_object($query4);
                 $query5 = mysqli_query($con,"SELECT * FROM `aset_req_vechile` WHERE req_id = '$id'AND change_type ='2' ");
                 $ftch_dtl_tyre = mysqli_fetch_object($query5);

                    if(isset($_GET['e_id']))
                    {
                      ?>
                      <td><input type="text" class="form-control amount" <?php  if($ftch_dtl->change_type == '1'){ echo "name = 'amount_oil' id = 'amount_oil'";} else if($ftch_dtl->change_type == '2') {echo "name = 'amount_tyre' id = 'amount_tyre'";}?> value="<?php if($ftch_dtl->change_type == '1'){ echo $ftch_dtl_oil->amount;} else if($ftch_dtl->change_type == '2') {echo $ftch_dtl_tyre->amount ;} ?>"></td>
                      <td></td>
                      <?php
                    }
                    else{

                     if($ftch_dtl->change_type == '1')
                     {
                      if(mysqli_num_rows($query4) > 0)
                      {
                      echo "<td>".$ftch_dtl_oil->amount."</td>";
                    }else{
                      ?>
                      <td><input type="tect" name="vec_cost_oil" id="vec_cost_oil" class="form-control amount"></td>
                      <?php
                    }
                     }
                     else if($ftch_dtl->change_type == '2')
                     {
                       if(mysqli_num_rows($query5) > 0)
                      {
                      echo "<td>".$ftch_dtl_tyre->amount."</td>";
                    }
                    else{
                      ?>
                      <td><input type="tect" name="vec_cost_tyre" id="vec_cost_tyre" class="form-control amount"></td>
                      <?php
                     }
                    }
                  }
                  $i++;
                }
              }
                  ?>
                  <td></td>
                 <td></td>
               
                   

                  </tr>
                    
                  
                 <?php
                 
                
                $aid = mysqli_query($con,"SELECT * FROM `aset_req_update` WHERE req_id = '$id'") ;
                   
                    $fetch_req = mysqli_fetch_object($aid); 
                if(mysqli_num_rows($aid) > 0)
                {
                                    if(isset($_GET['id']))
                    {
                      $id = $_GET['id'];
                        $query1 = mysqli_query($con,"SELECT * FROM `aset_req_other` WHERE `req_id` = '$id'");
                   
                 
                  while ($ftch_req = mysqli_fetch_object($query1))
                  {
                    ?>
                   <tr>
                    <td  style="width: 300px;" class="sel_no"><?php echo $i; ?></td>
                    <td style="width:380px;"> <?php echo $ftch_req->feildname; ?><input type="hidden" name="n1[]" value=" <?php echo $ftch_req->feildname; ?>"></td>
                           <?php 
                    if(isset($_GET['e_id']))
                    {
                      ?>
                      <td></td>

                          <td><input type="text" class="form-control amount" name="chng_cost[]" id="chng_cost"value="<?php echo $ftch_req->amount; ?>"></td>
                           <input type="hidden" class="form-control" name="hidden_chng_cost[]" id="hidden_chng_cost" value="<?php echo $ftch_req->id;?>">
                           <td></td>
                           <td></td>
                      <?php
                    }
                    else{
                    ?>
                    <td></td>
                    <td> <?php echo $ftch_req->amount; ?></td>
                    <?php 
                  }
                  ?>
                  
                    
                    <td></td>

                    <!--  <input type="hidden" class="form-control" name="hidden_chng_cost[]" id="chng_cost[]"value="<?php if(isset($_GET['id'])){echo  $ftch->id; }?>" required="required"> -->
                    
                    <td><!-- <button type="button"class="btn btn-primary btn-xs add_field_button">+</button> --></td>
                  </tr>
                    
                  
                 <?php
                 
                }
                $i++;


}
}

                
              else{
                $query2 = mysqli_query($con,"SELECT x.*,y.* FROM aset_req_details x, aset_feild_entry_maintain y WHERE x.id = '$id' AND  x.id = y.aset_id");

                
                  while ($ftch_req = mysqli_fetch_object($query2))
                  {
                    ?>
                   <tr >
                    <td ><?php echo $i; ?></td>
                    <td> <?php echo $ftch_req->feild_name; ?><input type="hidden" name="n1[]" value=" <?php echo $ftch_req->feild_name; ?>"></td>
                    
                    <td></td>
                  <?php 
                    if(isset($_GET['e_id']))
                    {
                      ?>
                          <td><input type="text" class="form-control amount" name="chng_cost[]" id="chng_cost"value="<?php echo $ftch_req->amount; ?>"></td>
                           <input type="hidden" class="form-control" name="hidden_chng_cost[]" id="hidden_chng_cost[]"value="<?php echo $ftch_req->id; ?>" required="required">
                           <td></td>
                           <td></td>
                      <?php
                    }
                    else{
                    ?>
                    <td> <input type="text" name="chng_cost[]" id="chng_cost" class="form-control amount"></td>
                    <input type="hidden" class="form-control" name="hidden_chng_cost[]" id="chng_cost"value="<?php if(isset($_GET['id'])){echo $_GET['id'] ; }?>" required="required">
                    
                    <td><button class="btn btn-primary btn-xs add_field_button">+</button></td>
                    <?php
                  }
                  ?>
                  </tr>
                    
                  
                 <?php
                 $i++;
                }
              }
                ?>

                

<?Php
}
else{

   if(mysqli_num_rows($aid) > 0)
                    
                    {
                      if(isset($_GET['id']))
                    {
                      $id = $_GET['id'];
                        $query1 = mysqli_query($con,"SELECT * FROM `aset_req_other` WHERE `req_id` = '$id'");
                   
                 $i=1;
                  while ($ftch_req = mysqli_fetch_object($query1))
                  {
                    ?>
                   <tr>
                    <td  style="width: 300px;" ><?php echo $i; ?></td>
                    <td style="width:480px;"> <?php echo $ftch_req->feildname; ?><input type="hidden" name="n1[]" value=" <?php echo $ftch_req->feildname; ?>"></td>
                    <td></td>
                    <?php 
                    if(isset($_GET['e_id']))
                    {
                      ?>
                          <td><input type="text" class="form-control amount" name="chng_cost[]" id="chng_cost"value="<?php echo $ftch_req->amount; ?>"></td>
                           <input type="hidden" class="form-control" name="hidden_chng_cost[]" id="hidden_chng_cost[]"value="<?php echo $ftch_req->id; ?>" required="required">
                      <?php
                    }
                    else{
                    ?>
                    <td>  <?php  echo  $ftch_req->amount; ?></td>
                  <?php
                }
                ?>
                    <td></td>
                    <td></td>
                  </tr>
                    
                  
                 <?php
                 $i++;
                }

}
}

else{

                 

   $query1 = mysqli_query($con,"SELECT x.*,y.* FROM aset_req_details x, aset_feild_entry_maintain y WHERE x.id = '$id' AND  x.id = y.aset_id");
                 $i=1;
                  while ($ftch_req = mysqli_fetch_object($query1))
                  {
                    ?>
                   <tr>
                    <td  style="width: 300px;" class="sel_no"><?php echo $i; ?></td>
                    <td style="width:380px;"> <?php echo $ftch_req->feild_name; ?><input type="hidden" name="n1[]" value=" <?php echo $ftch_req->feild_name; ?>"></td>
                    <td></td>
                  
                    <td><input type="text" name="chng_cost[]" id="chng_cost" class="form-control amount"></td>
                     <input type="hidden" class="form-control" name="hidden_chng_cost[]" id="chng_cost[]"value="<?php if(isset($_GET['id'])){echo  $ftch->id; }?>" required="required">
                    
                    <td><button type="button"class="btn btn-primary btn-xs add_field_button">+</button></td>
                  </tr>
                    
                  
                 <?php
                 $i++;
                }

}
}

                  ?>

                  </tbody>
                </table>
              </div>
              </div>
                
                
            </fieldset>
         <!--  <fieldset>
             <legend><h5></h5></legend> -->
                <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                              
                                              
                                               
                                            </tr> 
                                        </thead>
                                        <tbody>
                                          
                        <tr  style="color: red;">
                           
                       <?php
                        $aid = mysqli_query($con,"SELECT * FROM `aset_req_update` WHERE req_id = '$id'") ;
                   
                    $fetch_req = mysqli_fetch_object($aid); 
                      if(mysqli_num_rows($aid) > 0)
                    
                    {
                      ?>
                          <td style="width: 77%;"><h5>Total Cost</h5></td>
                        
                       <?php
                     }
                     else{
                     ?>
                      <td style="width: 75%;"><h5>Total Cost</h5></td>
                       <?php
                     }
                      $aid = mysqli_query($con,"SELECT * FROM `aset_req_update` WHERE req_id = '$id'") ;
                   
                    $fetch_req = mysqli_fetch_object($aid); 
                            if(mysqli_num_rows($aid) > 0)
                    
                    {
                      ?>
                      <?php 
                      
                       if(isset($_GET['e_id']))
                    {
                    ?>
                    <td><h5> <input type="text" name="estimated_cost" id="estimated_cost" class="form-control" value="<?php echo $fetch_req->total_cost; ?>" readonly></h5></td>
                    <?php 
                  }
                  else{
                    ?>
                    
                      <td><h5><?php echo $fetch_req->total_cost; ?> </h5></td>
                      <?php
                    }
                    }
                    else{

                      ?>
                          <td><h5> <input type="text" name="estimated_cost" id="estimated_cost" class="form-control" readonly="readonly"></h5></td>
                            <?php
                          }
                          ?>
                          
                        </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
          <!-- </fieldset> -->

                      <?php
                   $aid = mysqli_query($con,"SELECT * FROM `aset_req_update` WHERE req_id = '$id'") ;
                   
                    $fetch_req = mysqli_fetch_object($aid); 
                            if(mysqli_num_rows($aid) > 0)
                    
                    {
                      ?>
                    <fieldset>
                       <div class="row">
                <div class="col-lg-4">
                  <label for="maintain_req">Request to</label>
                 <?php
                      if(isset($_GET['id']))
                      {
                        $id = $_GET['id'];
                      $req_name = mysqli_query($con,"SELECT x.*,y.fullname FROM .aset_req_update x, mstr_emp y WHERE x.req_to = y.id and x.req_id = '$id'");
                      $fetch_name = mysqli_fetch_object($req_name);
                     echo $fetch_name->fullname;
                    }
                    ?>
                  </div>
                </div>
                 </fieldset>
                 <?php
                  if(isset($_GET['e_id']))
                    {
                      ?>
                     <fieldset>
                       
                       <div class="row">
                               <div class="col-lg-4">
                                <label for="message_level">Message</label>
                              
            <div class="form-group">
        <!--   <label for="message_level">Message</label> -->
           <textarea name="message_level" id="message_level" class="form-control" rows="2" ></textarea>
        </div>
        </div>
      </div>
                  </fieldset>
                  <?php

          if(isset($_GET['id']))
          {
            $id = $_GET['id'];
            $a_id = $_GET['a_id'];
            $query = mysqli_query($con, "SELECT * FROM  aset_req_update WHERE   req_id = '$id' AND status = '0' ");
            while ($fetch_id = mysqli_fetch_object($query)) {


                        // $req_to= $fetch_id->req_by;
                        $approve_req = $fetch_id->req_to;
                        if($_SESSION['ERP_SESS_ID'] == $approve_req)
                        {
                          ?>

                           <div class="row">
                        <div class="col-lg-12">
                       
                        <input type="submit"class="btn btn-primary btn-xs" style="font-weight: bold; float: right;" name="esubmit" id="esubmit" value="submit">
                   

                 
                 
                      <?php
                        }

                        }
                         }
                  }
                }
                  else{
                      ?>
                      <fieldset>
                       <div class="row">
                <div class="col-lg-4">
                  <label for="maintain_req">Request to</label>  
                  <select class="form-control" id="maintain_req" name="maintain_req">
                    <option value="0">--SELECT--</option>
                    <?php
                     $query = mysqli_query($con, "SELECT * FROM `mstr_emp` WHERE id IN ('16', '74') ORDER BY `id` ASC");
                              if(mysqli_num_rows($query) > 0)
                      {
                              while($fetch_id = mysqli_fetch_object($query))
                              {
                              
                     echo "<option value='".$fetch_id->id."'>".$fetch_id->fullname."</option>";
                   }
                   
                  }
                  ?>
                  </select>
                </div>
              </div>
                    </fieldset>
                    <fieldset>
                       
                       <div class="row">
                               <div class="col-lg-4">
                                <label for="message_level">Message</label>
                              
            <div class="form-group">
        <!--   <label for="message_level">Message</label> -->
           <textarea name="message_level" id="message_level" class="form-control" rows="2" ></textarea>
        </div>
        </div>
      </div>
      <?php
                        $query1 = mysqli_query($con,"SELECT * FROM `aset_req_update` WHERE `req_id` = '$id'");
                        if(mysqli_num_rows($query1) == 0)
                        {
                        ?>

      <div class="row">
                        <div class="col-lg-12">
                              <button type="submit" class="btn btn-primary btn-xs" style="font-weight: bold; float: right;" name="pupdte" id="pupdte">Update</button>
                            </div>
                          </div>
                    </fieldset>
                   
                  
           
<?php
}

}
  ?>
    
                  
                     <!--   <fieldset> -->
                
        <!--                  <div class="row">
                        <div class="col-lg-12">
                        <input type="button" name="history" id="history"
           value="history" class="btn btn-success mr-2" style="float:left;">
                     </div>
                   </div>
                    <div class="row">              
         <div id='maintain_history'></div>

           </div>
      -->
            <div class="row">
                            <!-- <div class="col-lg-12"> -->
                          <div id="approve_section"></div>
                        </div>
                        <div class="row">
                          <div id="msg_box"></div>
                        </div>

                        <!-- </div> -->
                        
                      


                     
          </form>
        
        <p style="padding-top:20px;">&nbsp;</p>
              
         <!-- //Body Ends Here -->      
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        <?php require_once('../../footer.php'); ?>
        </div>
        <!-- /#wrapper -->

       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>
   
<script type="text/javascript">
          $(document).ready(function(){
            $("#reject").css("visibility", "hidden");
            $("#approve").css("visibility", "hidden");
             $("#preject").click(function(){
                 var r = confirm("Are you sure you want to reject?");
                 if (r == true) {
              $.post( "pr_msg.php", function( data ) {
 
             $( "#msg_box" ).html( data );
               $("#preject").css("visibility", "hidden");
              $("#edit").css("visibility", "hidden");
              $("#approve").css("visibility", "hidden");
             $("#reject").css("visibility", "visible");
               $("#approveing").css("visibility", "hidden");

            });
            }

             });
                 $("#approveing").click(function(){
                 // var r = confirm("Are you sure you want to reject?");
                 // if (r == true) {
              $.post( "pr_msg.php", function( data ) {
 
             $( "#msg_box" ).html( data );
               $("#preject").css("visibility", "hidden");
               $("#reject").css("visibility", "hidden");
              $("#edit").css("visibility", "hidden");
              $("#approveing").css("visibility", "hidden");
             $("#approve").css("visibility", "visible");

            });
            
             });
          });
        </script>
        <script type="text/javascript">
    $(document).ready(function(){

    $("#pupdte").click(function(){


var vec_oil = $("#vec_cost_oil").val();
var vec_tyre = $("#vec_cost_tyre").val();
var changes = $("#chng_cost").val();

var req_to = $("#maintain_req").val();
var msg = $("#message_level").val();

// if( req_by ==''){
// $('#req').css("border","2px solid #ec1313");
// alert("");
// $('#req').focus();
// return false;
// }
if( vec_oil ==''){
$('#vec_cost_oil').css("border","2px solid #ec1313");

alert("Please mention the oil change amount");
$('#vec_cost_oil').focus();
return false;
}
if( vec_tyre ==''){
$('#vec_cost_tyre').css("border","2px solid #ec1313");
$('#vec_cost_oil').css("border","1px solid #D3D3D3");

alert("Please mention the tyre change amount");
$('#vec_cost_tyre').focus();
return false;
}
if( changes ==''){
$('#chng_cost').css("border","2px solid #ec1313");
$('#vec_cost_oil, #vec_cost_tyre').css("border","1px solid #D3D3D3");

alert("Please mention the change feild amount");
$('#chng_cost').focus();
return false;
}
if( req_to =='0'){
  $('#vec_cost_oil, #vec_cost_tyre, #chng_cost').css("border","1px solid #D3D3D3");
  
$('#maintain_req').css("border","2px solid #ec1313");
alert("Provide name of person whom the request is sent ");
$('#maintain_req').focus();
return false;
}
if( msg ==''){
  $('#vec_cost_oil, #vec_cost_tyre, #chng_cost, #maintain_req').css("border","1px solid #D3D3D3");
  

$('#message_level').css("border","2px solid #ec1313");
alert("Provide the message");
$('#message_level').focus();
return false;
}


});
  });
    </script>
    <script type="text/javascript">
            $(document).ready(function(){

      
           $("#reject").click(function(){
             var message = $("#message_level").val();

            if(  message ==''){
            $('#message_level').css("border","2px solid #ec1313");

            alert("Please mention message for your decline");
            $('#message_level').focus();
            return false;
}

  });

});
         </script>
         <script type="text/javascript">
            $(document).ready(function(){

      
           $("#approve").click(function(){
             var message = $("#message_level").val();

            if(  message ==''){
            $('#message_level').css("border","2px solid #ec1313");

            alert("Please mention message ");
            $('#message_level').focus();
            return false;
}

  });

});
         </script>

    <script type="text/javascript">
$(document).ready(function() 
    {
        var max_fields      = 10; //Maximum input boxes allowed
        var wrapper1        = $(".append_feild"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
       
        var x = '<?php  echo $i; ?>';

      
        
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
              //text box increment
              
               $(wrapper1).append('<tr id="append"><td>'+x+'</td><td><input type="text" name="n1[]" id="n1 '+x+'" class="form-control " required></td>  <td></td> <td> <input type="text" name="chng_cost[]" id="chng_cost'+x+'" class="form-control amount" required></td> <td><button class="btn btn-danger btn-xs remove_field" style="margin-top:3px;">X</button></td></tr>'); //add input box
                 x++; 
    } 
    
   
    
      $(".amount").keyup(function(){
             getTotal();
            
         });
    });
   
    $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).closest('#append').remove(); x--;
    })
});
</script>
        <?php
      }
      
      ?>
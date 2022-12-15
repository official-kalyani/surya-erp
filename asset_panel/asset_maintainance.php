<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['submit']))
 
{
  $asset_no= $_POST['aname'];
  $qu = "SELECT id FROM aset_req_details ORDER BY id DESC LIMIT 1";
                        $qu_con = mysqli_query($con, $qu);
                        $fetch_ser = mysqli_fetch_object($qu_con);
                        $ser_id = $fetch_ser->id + 1;
                        $string = "ASTRM00";
                        $auto_ser = $string . $ser_id;
                        $req_by = $_SESSION['ERP_SESS_ID'];
                        $total_cost = mysqli_real_escape_string($con,$_POST['estimated_cost']);
                        $created = date('Y-m-d');
  $sql3=  "INSERT INTO aset_req_details (`asset_id`,`asset_req_no`, `req_by`,`total_amount`,`date`) VALUES ('$asset_no', '$auto_ser','$req_by', '$total_cost', '$created')";
              // echo "INSERT INTO aset_pr_detail (`pr_to_id`, `aset_name`, `uom`, `qty`, `description`) VALUES ('$pr_to', ' $add_aset_item', '$add_item_uom', '$add_item_qty', '$add_item_desc')";

              $sql4 = mysqli_query($con, $sql3);  
               $req_id = mysqli_insert_id($con); 
               $msg = mysqli_real_escape_string($con, $_POST['message_level']) ;
               $created_on = date('Y-m-d H:i:s');
               $mess_age =  mysqli_query($con,"INSERT INTO  aset_req_msg (`req_id`, `message`, `message_by`, `created_on`, `status`) VALUES ('$req_id','$msg', '$req_by','$created_on', '1')");

                $req_to = $_POST['forto'] ; 
                $created_on = date('Y-m-d H:i:s');              
  $sql8=  "INSERT INTO  aset_req_to (`req_id`, `req_by`,`req_to`, `date`) VALUES ('$req_id', '$req_by','$req_to', '$created_on')";
              // echo "INSERT INTO aset_pr_detail (`pr_to_id`, `aset_name`, `uom`, `qty`, `description`) VALUES ('$pr_to', ' $add_aset_item', '$add_item_uom', '$add_item_qty', '$add_item_desc')";
              $sql9 = mysqli_query($con, $sql8);  
  $total = count($_POST['changes_required']);
  for($i = 0; $i < $total; $i++) {
     $feild_name = $_POST['changes_required'][$i];
     // echo $feild_name;
     $amount = mysqli_real_escape_string($con,$_POST['amount'][$i]);
     // echo $amount;

  // if(isset($_POST['changes_required'][$i]) ){
 if(($_POST['changes_required'][$i] )!="" && ($_POST['amount'][$i])!="" ){
$created_on = date('Y-m-d');
  $sql5=  "INSERT INTO aset_feild_entry_maintain (`aset_id`,`feild_name`, `amount`, `date`) VALUES ('$req_id', '$feild_name','$amount', '$created_on')";
              // echo "INSERT INTO aset_pr_detail (`pr_to_id`, `aset_name`, `uom`, `qty`, `description`) VALUES ('$pr_to', ' $add_aset_item', '$add_item_uom', '$add_item_qty', '$add_item_desc')";
              $sql6 = mysqli_query($con, $sql5);
    if( $sql6){
      $msg="Maintenance request created successfully";
      header("Location: asset_maintainance.php?msg=$msg");

  }
  else {
       $msgel="Unsuccessfull in creating maintenance request...retry again";
}
               
  }


// }
}



if(isset($_POST['oil_change']))

{
  $oil_change = $_POST['oil_change'];

if(isset($_POST['oil_change'])!= '')
{
  $reading_km = $_POST['present_r_km'];
  $amount_km = $_POST['amount_oil'];
  $reading_dt = $_POST['present_r_dt'];
  $amount_dt = $_POST['amount_oil_dt'];
  $created_on = date('Y-m-d');

  $sql=  "INSERT INTO aset_maintainance_req (`asset_id`,`change_type`, `reading_km`,`amount_km`,`reading_dt`,`amount_dt`,`current_date`) VALUES ('$req_id', '$oil_change','$reading_km' , '$amount_km', '$reading_dt', '$amount_dt', '$created_on')";
  // echo "INSERT INTO aset_maintainance_req (`asset_id `,`change_type`, `reading_km`,`amount_km`,`reading-dt`,`amount_dt`) VALUES ('$asset_no', '$oil_change','$reading_km' , '$amount_km', '$reading_dt', '$amount_dt')";
              // echo "INSERT INTO aset_pr_detail (`pr_to_id`, `aset_name`, `uom`, `qty`, `description`) VALUES ('$pr_to', ' $add_aset_item', '$add_item_uom', '$add_item_qty', '$add_item_desc')";
              $sql2 = mysqli_query($con, $sql);

}
}
if(isset($_POST['tyre_change']))
{
  $tyre_change = $_POST['tyre_change'];
  $reading_km = $_POST['present_r_km_tyre'];
  $amount_km = $_POST['amount_tyre'];
  $reading_dt = $_POST['present_r_dt_tyre'];
  $amount_dt = $_POST['amount_tyre_dt'];
  $sql1=  "INSERT INTO aset_maintainance_req (`asset_id`,`change_type`, `reading_km`,`amount_km`,`reading_dt`,`amount_dt`,`current_date`) VALUES ('$req_id', '$tyre_change','$reading_km' , '$amount_km', '$reading_dt', '$amount_dt', '$created_on')";
   $sql2 = mysqli_query($con, $sql1);
}

}

  ?>

<?php
if(isset($_GET['id'])){


if(isset($_POST['update']))
{
  //print_r($_POST);exit();
  $id_fetch = $_GET['id'];
  // echo $id_fetch;
  $asset_no= $_POST['aname'];
  $created_on = date('Y-m-d');
  $total_cost = $_POST['estimated_cost'];
 $abc = mysqli_query($con, "UPDATE aset_req_details SET asset_id ='$asset_no',total_amount = '$total_cost' WHERE id = '$id_fetch'") ;
 $total = count($_POST['changes_required']);
  for($i = 0; $i < $total; $i++)
         { 
        
          if(isset($_POST['changes_required_hidden'][$i]))
          {
            $add_item = mysqli_real_escape_string($con, $_POST['changes_required'][$i]);
            $amount = mysqli_real_escape_string($con, $_POST['amount'][$i]);
          // hidden value
            $total_entry = mysqli_real_escape_string($con, $_POST['changes_required_hidden'][$i]);
            // echo $total_entry;

            $query1 = "UPDATE `aset_feild_entry_maintain` SET `feild_name`='$add_item',`amount`='$amount' WHERE id ='$total_entry'";

            $sql1 = mysqli_query($con, $query1);
          }
          else{

         
          
            $add_item = mysqli_real_escape_string($con, $_POST['changes_required'][$i]);
            
            

            $vw_details = mysqli_query($con,"SELECT * FROM `aset_feild_entry_maintain` WHERE `feild_name` ='$add_item'") ;
             if(mysqli_num_rows($vw_details) > 0) 
             {

         $amount = $_POST['amount'][$i];
          $total_cost = $_POST['estimated_cost'];

            $total_cost =   $total_cost - $amount;
              $abc = mysqli_query($con, "UPDATE aset_req_details SET total_amount = '$total_cost' WHERE id = '$id_fetch'") ;
 
             }
             else{
              if(isset($_POST['changes_required'][$i]))
              {
              if(($_POST['changes_required'][$i] )!="")
              {
     //             $feild_name = $_POST['changes_required'][$i];
     // // echo $feild_name;
             $amount = $_POST['amount'][$i];
            $sql=  "INSERT INTO aset_feild_entry_maintain (`aset_id`,`feild_name`, `amount`, `date`) VALUES ('$id_fetch', '$add_item','$amount', '$created_on')";
            $sql2 = mysqli_query($con, $sql);
            // if($sql2) { $upmsg=" Your data is updated."; }
          }
         
          }
        }
      }
        }


       
          if(isset($_POST['oil_change']))
          {
          $oil_change = $_POST['oil_change'];
          echo $oil_change;
          $reading_km = $_POST['present_r_km'];
          $amount_km = $_POST['amount_oil'];
          $reading_dt = $_POST['present_r_dt'];
          $amount_dt = $_POST['amount_oil_dt'];
           $created_on = date('Y-m-d');
             $abc = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$id_fetch' AND `change_type` = '1' ");
        if(mysqli_num_rows($abc) > '0' )
        {
 $abc = mysqli_query($con, "UPDATE aset_maintainance_req SET reading_km ='$reading_km', amount_km = '$amount_km', reading_dt = '$reading_dt', amount_dt = '$amount_dt' , status ='1' WHERE asset_id = '$id_fetch' AND change_type = '1'") ;
          // echo "UPDATE aset_maintainance_req SET reading_km ='$reading_km',amount_km = '$amount_km', reading_dt = '$reading_dt', amount_dt = '$amount_dt'  WHERE asset_id = '$id_fetch' AND change_type = '1'";
        }
        else{
          $sql=  "INSERT INTO aset_maintainance_req (`asset_id`,`change_type`, `reading_km`,`amount_km`,`reading_dt`,`amount_dt`,`current_date`,`status`) VALUES ('$id_fetch', '$oil_change','$reading_km' , '$amount_km', '$reading_dt', '$amount_dt', '$created_on','1')";
          // 
           $sql_co = mysqli_query($con, $sql);
        }
        }
        else{
         $abc = mysqli_query($con, "UPDATE aset_maintainance_req SET status ='0' WHERE asset_id = '$id_fetch' AND change_type = '1'") ;
       }
     
      if(isset($_POST['tyre_change']))
       {
        $tyre_change = $_POST['tyre_change'];
          $reading_km = $_POST['present_r_km_tyre'];
          $amount_km = $_POST['amount_tyre'];
          $reading_dt = $_POST['present_r_dt_tyre'];
          $amount_dt = $_POST['amount_tyre_dt'];
           $created_on = date('Y-m-d');
           $abcde = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE `asset_id` = '$id_fetch' AND `change_type` = '2'");
            if(mysqli_num_rows($abcde) > 0)
        { 

           $abc = mysqli_query($con, "UPDATE aset_maintainance_req SET reading_km ='$reading_km',amount_km = '$amount_km', reading_dt = '$reading_dt', amount_dt = '$amount_dt',status='1'  WHERE asset_id = '$id_fetch' AND change_type = '2'") ;
        }
        else{
           $sql1=  "INSERT INTO aset_maintainance_req (`asset_id`,`change_type`, `reading_km`,`amount_km`,`reading_dt`,`amount_dt`,`current_date`,`status`) VALUES ('$id_fetch', '$tyre_change','$reading_km' , '$amount_km', '$reading_dt', '$amount_dt', '$created_on','1')";
   $sql2 = mysqli_query($con, $sql1);
        }


       }
       else{
         $abc = mysqli_query($con, "UPDATE aset_maintainance_req SET status ='0' WHERE asset_id = '$id_fetch' AND change_type = '2'") ;
       }
        
        

        if($abc)
        {
         $msger="Maintenance request updated successfully";
        
      header("Location: asset_maintainance.php?msg=$msger&id=$id_fetch&asset_id=$asset_no");

  }
  else {
       $msgelu="Unsuccessfull in updating maintenance request...retry again";
}

               
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
<!-- DATETIMEPICKER CDNs -->

        <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

       

       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

     

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

        <!-- DATETIMEPICKER CDNs -->
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
          
               $(wrapper).append('<div id="append" class = "row"><div class="col-lg-3"></div><div class="col-lg-6"><div class="form-group"><input type="text" name="changes_required[]" id="changes_required" class="form-control" required ></div></div><div class="col-lg-2"><div class="form-group"><input type="text" name="amount[]" id="amount" class="form-control amount" required ></div></div> <button class="btn btn-danger btn-xs remove_field">x</button></div>'); //add input box
    } 
    
   
    
      $(".amount").keyup(function(){
             getTotal();
            
         });
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#append').remove(); x--;
    })
});
</script>
    <script type="text/javascript">
      $(document).ready(function () {
      $('#aname').selectize({
      sortField: 'text'
      });
      });
    </script> 
    <script type="text/javascript">
       $(document).ready(function () {
        $("#aname").change(function(){
          var ass_name = $("#aname").val();
          // console.log(ass_name);

                 if( ass_name != '')
          {

              $.ajax({
                      url:"asset_details.php",
                      data:{s_id:ass_name},
                      type:'POST',
                      success:function(data) { 
                        var sd = $.trim(data);
                        $('#asset_details').html(sd);
                        
                      }

                    });
              $.ajax({
                      url:"aset_maintainance_req.php",
                      data:{s_d:ass_name},
                      type:'POST',
                      success:function(data) { 
                        var sd = $.trim(data);
                        $('#asset_maintainance_req').html(sd);

                        
                      }

                    });
              
          }
        });
       });
    </script>
    <script type="text/javascript">
     $(document).ready(function () {
      $("#history").click(function(){
         var asset_name = $("#aname").val();
          console.log(asset_name);
          $.ajax({
                      url:"histry_maintain.php",
                      data:{s_d:asset_name},
                      type:'POST',
                      success:function(data) { 
                        var sd = $.trim(data);
                        $('#maintain_history').html(sd);

                        
                      }

                    });
              
        });
     }); 
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
    <script type="text/javascript">
       $(document).ready(function () {
         $('#present_r_dt').datetimepicker({

                                               format:'YYYY-MM-DD',
                                          
                                          widgetPositioning:{
                                            horizontal: 'auto',
                                            vertical: 'bottom'
                                           
                                        }
                                        });
         $('#present_r_dt_tyre').datetimepicker({

                                               format:'YYYY-MM-DD',
                                          
                                          widgetPositioning:{
                                            horizontal: 'auto',
                                            vertical: 'bottom'
                                           
                                        }
                                        });

              
       });
    </script>
    <?php
    if(!isset($_GET['id']))
    {
    ?> 
    
    <script type="text/javascript">
      $(document).ready(function () {
       $("#history").hide(); 
        $("#aname").change(function(){
          $("#history").show();
        });

      });
    </script>
    <?php
  }
  ?>
    <?php
      if(isset($_GET['id']))
      {
        ?>
    <script type="text/javascript">

        $(document).ready(function () {

var ass_name = $("#aname").val();
console.log(ass_name);
           $.ajax({
                      url:"aset_maintainance_req.php",
                      data:{s_id:ass_name},
                      type:'POST',
                      success:function(data) { 
                        var sd = $.trim(data);
                        $('#asset_maintainance_req').html(sd);

                        
                      }

                    });

        });
    </script>

    <script type="text/javascript">
      
    </script>
   <?php
 }
 ?>
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
                        <h4 class="page-header"> Maintenance Request Form</h4>
                        
           
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
         
                <!-- /.row -->
                <div class="row">
                <!-- Body Starts Here -->  
                 <div class="col-lg-12">
        <span style="float:right;">
          <button onClick='javascript:location.href="aset_maintain_view.php"' class="btn btn-warning btn-xs" style="font-weight: bold; margin-bottom: 10px;">Back To List</button>
        </span>
       <?php
            if(isset($_GET['msger'])) { 
                   $msg = $_GET['msger'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                   <?php if(isset($msgelu)) { echo "<i style=color:#D71313;>".$msgelu."</i>"; } ?> 
     
        <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                   <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?>  
     </div>
                 </div>
                         
          <form name="form" method="post" class="forms-sample" >
       <fieldset>
                          <legend>Maintenance</legend>
                          <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group">
                             <?php
                             if(isset( $_SESSION['ERP_SESS_ID']))
                             {
                             $id = $_SESSION['ERP_SESS_ID'];
                             // echo $id;
                              }
                             ?>
                             <?php
                             if(isset($_GET['id']))
                             {
                              $id_ftch = $_GET['id'];
                              
                            
                             $pq = "SELECT x.*,y.*,z.name FROM aset_req_details x,aset_stock_entry y,aset_item_creation z WHERE x.asset_id = y.auto_serial AND y.item_name = z.id AND x.id = '$id_ftch'"; 
                                        $pfq=mysqli_query($con,$pq);
                                     $pgq = mysqli_fetch_object($pfq);
                               }         

                             ?>
                              
                                <?php if(isset($_GET['id'])) {?>
                                  <label for="ass_no">Asset Name</label>
                              <select name="aname" id="aname" class="form-control">
                                <option selected value="<?Php echo $pgq->auto_serial; ?>"><?Php echo $pgq->description; ?></option>
                                <?php
                                $pq = "SELECT x.* ,x.id as xid, y.*,y.id as yid,z.name FROM aset_stock_assaignment x,aset_stock_entry y,aset_item_creation z WHERE x.asset_no = y.auto_serial AND  y.item_name = z.id AND x.assaign_to = '$id' "; 
                                        $pfq=mysqli_query($con,$pq);
                                        while ($pgq = mysqli_fetch_object($pfq))
                                        { 
                                        echo '<option value="'. $pgq->auto_serial . '">' . $pgq->description."(".$pgq->auto_serial.")" .'</option>';
                                        }

                                        ?>
                              <?php }

                               else{ ?>
                                <label for="ass_no">Asset Name</label>
                              <select name="aname" id="aname" class="form-control name">
                                  <option selected value="">--Select Asset Name--</option>
                                        <?php

                                        $pq = "SELECT x.* ,x.id as xid, y.*,y.id as yid,z.name FROM aset_stock_assaignment x,aset_stock_entry y,aset_item_creation z WHERE x.asset_no = y.auto_serial AND  y.item_name = z.id AND x.assaign_to = '$id'  AND x.status = '1'"; 
                                        $pfq=mysqli_query($con,$pq);
                                        while ($pgq = mysqli_fetch_object($pfq))
                                        { 
                                        echo '<option value="'. $pgq->auto_serial . '">' . $pgq->description ."(".$pgq->auto_serial.")" .'</option>';
                                        }
                                        $assetID = array("2","74","316","215","1","55","330");

                                      if (in_array($_SESSION['ERP_SESS_ID'], $assetID)){
                                        $admin_data = mysqli_query($con,"SELECT  y.*,y.id as yid,z.name FROM aset_stock_entry y,aset_item_creation z WHERE  y.item_name = z.id AND y.asset_type = 'Admin'  AND y.status = '1'");
                                        if(mysqli_num_rows($admin_data)>0)
                                        {
                                           while ($admin_assign = mysqli_fetch_object($admin_data))
                                        { 
                                        echo '<option value="'. $admin_assign->auto_serial . '">' . $admin_assign->description ."(".$admin_assign->auto_serial.")" .'</option>';
                                        }
                                        }
                                      }

                                      }
                                        ?>
                              </select>
                             
                            </div>
                          </div>
                        </div>

                        <div class="row">
                
                            <div id="asset_details"></div>
                          </div>
                        </fieldset>
                        <?php if(isset($_GET['id']))

                        {
                          ?>
                          <fieldset>
                            <legend>Changes Field</legend>
                             <div class="input_fields_wrap">
                             <div class="row">

                              
                                              
                            
                         
                                              <div class="col-lg-3">
                                                <div class="form-group">
                                                <label for = 'changes_required' style="margin-top: 20px;">Changes Required</label>
                                                </div>
                                              </div>
                                             
                                                <div class="col-lg-6">
                                                <div class="form-group">
                                                   <?php
                          $id_ftch = $_GET['id'];
                          $asset = $_GET['asset_id'];
                          $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry_maintain` WHERE `aset_id` = '$id_ftch'");

                                      while($ftch = mysqli_fetch_object($vet))
                                      {
                                        $total = count($ftch->feild_name);
                                      
                                            for($i = 0; $i < $total; $i++) { 
                                              ?>
                                                <input type="text" name="changes_required[]" id="changes_required" class="form-control" style="margin-top: 20px;" value="<?php echo $ftch->feild_name;?>">
                                                <input type="hidden" name="changes_required_hidden[]" id="changes_required" class="form-control" style="margin-top: 20px;" value="<?php echo $ftch->id;?>">
                                                  <?php
                        }
                        }

              

                        ?>
                                                </div>
                                                </div>
                                                <div class="col-lg-2">
                                                <div class="form-group">
                                                   <label for="amount">Amount</label>
                                               
                                                 <?php
                          $id_ftch = $_GET['id'];
                          $asset = $_GET['asset_id'];
                          $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry_maintain` WHERE `aset_id` = '$id_ftch'");

                                      while($ftch = mysqli_fetch_object($vet))
                                      {
                                        $total = count($ftch->amount);
                                      
                                            for($i = 0; $i < $total; $i++) { 
                                              ?>
                                              
                                                <input type="text" name="amount[]" id="amount" class="form-control amount" value="<?php echo $ftch->amount;?>" style="margin-bottom:20px;">
                                                <input type="hidden" name="amount_hidden[]" id="amount" class="form-control " value="<?php echo $ftch->id;?>" style="margin-bottom:20px;">
                                                <?php
                        }
                        }

              

                        ?>
                                                </div>
                                              </div>
                                                

                                               
                                    
                                              
                                            <div class="col-lg-1">
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-xs add_field_button">+</button>
                                            </div>
                                        </div>    
                                         
                                        </div>
                                      </div>
                                      
                                             <!--  <div id="asset_maintainance_req"></div> -->

                        
                                              
                        <div id="asset_maintainance_req"></div>
                        </fieldset>
                        <?php
                      
                        }
                        else{
                        ?>

                         <fieldset>
                          <legend>Maintenace Required</legend>
                          
                          <div class="input_fields_wrap">
                          <div class="row">
                            <div class="col-lg-3" style="margin-top: 20px;">
                              <label for="changes_required">Changes Required:</label>
                            </div>
                           
                            <div class="col-lg-6">
                              <div class="form-group">
                                 <input type="text" name="changes_required[]" id="changes_required" class="form-control" style="margin-top: 20px;">
                             </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="form-group">
                               <label for="amount">Amount</label>
                                <input type="text" name="amount[]" id="amount" class="form-control amount">
                             </div>
                           </div>
                           <div class="col-lg-1">
                        <div class="form-group">
                            <button class="btn btn-primary btn-xs add_field_button">+</button>
                        </div>
                    </div>
                         </div>
                        </div>
                                    
                         
                                     

                                            <div id="asset_maintainance_req"></div>
                                         
                         <div class="row">
                      <!--     <div class="col-lg-3">
                             <div class="form-group">
                             <label for="last_r_dt"></label>
                              <input type="hidden"  class="form-control"  disabled>
                             </div>
                           </div>
                           <div class="col-lg-3">
                             <div class="form-group">
                              <label for="last_r_dt"></label>
                              <input type="hidden"  class="form-control"  disabled> 
                             </div>
                           </div>
                           <div class="col-lg-3">
                             <div class="form-group">
                              <label for="last_r_dt"></label>
                              <input type="hidden"  class="form-control"  disabled>
                             </div>
                           </div> -->
                           <div class="col-lg-3">
                             <div class="form-group">
                              <label for="estimated_cost">Total cost</label>
                            </div>
                          </div>
                           <div class="col-lg-3">
                             <div class="form-group">
                             
                            </div>
                          </div>
                           <div class="col-lg-3">
                             <div class="form-group">
                              
                            </div>
                          </div>
                          <div class="col-lg-3">
                             <div class="form-group">
                              <input type="text" name="estimated_cost" id="estimated_cost" class="form-control" > 
                             </div>
                           </div>
                           
                         </div>   

                        </fieldset>
                       
                        <fieldset>
                            <div class="row">
                               <div class="col-lg-3">
                                <label for="message_level">Message</label>
                              </div>
                              <div class="col-lg-4">
            <div class="form-group">
        <!--   <label for="message_level">Message</label> -->
           <textarea name="message_level" id="message_level" class="form-control" rows="2" ></textarea>
        </div>
        </div>
      </div>
       
                              <div class="row">
                              <div class="col-lg-3">
                                 <label for="forto">Request To</label>
                              </div>
       <div class="col-lg-4">
           
           
          
                      
                           <select name="forto" id="forto" class="form-control-select" >
                              <option selected value="">--Select Employee Name--</option>
                              <?php
                        $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' AND `id`!='".$_SESSION['ERP_SESS_ID']."' order by `fullname` ASC";
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
        </div>                
               </fieldset> 
                <?php
                         }
                         if(isset($_GET['id']))
                         {
                          $abc = mysqli_query($con,"SELECT * FROM `aset_req_details` WHERE `id` = '$id_ftch' ");
                          $fetch_cost = mysqli_fetch_object($abc);
                          ?>
                          <div class="row">
                          <div class="col-lg-3">
                             <div class="form-group">
                              <label for="estimated_cost">Total cost:</label>
                            </div>
                          </div>
                           <div class="col-lg-3">
                             <div class="form-group">
                              
                            </div>
                          </div>
                           <div class="col-lg-3">
                             <div class="form-group">
                             </div>
                          </div>
                          <div class="col-lg-3">
                             <div class="form-group">
                              <input type="text" name="estimated_cost" id="estimated_cost" class="form-control"  value =" <?php echo $fetch_cost->total_amount; ?>"> 
                             </div>
                           </div>
                         </div>
                          <?php
                         }
                        ?>                        
                                  
        <!-- <div class="row"> -->
<!--           <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width:580px;">
                  Total Estimated Cost:
                </td>
                <td></td>
                <td></td>

                <td><input type="text" name="estimated_cost" id="estimated_cost" class="form-control" ></td>
                
                <td></td>
              </tr>
            </tbody>
          </table> -->
        
                        
                          <div class="row">
<!--        <div class="col-lg-4"> -->
         
   <!--      </div> -->
      <!--   <div class="col-lg-8"> -->
         <?php
          if(isset($_GET['id']))
          {
             ?>
          <input type="button" name="history" id="history"
           value="history" class="btn btn-success mr-2" style="float:left;">
       
<?php
}
else{
  ?>
   <input type="button" name="history" id="history"
           value="history" class="btn btn-success mr-2" style="float:left;">
<?php
}
?>
</div> 
     <div class="row">              
         <div id='maintain_history'></div>

           </div>
           <?php
          if(isset($_GET['id']))
          {
             ?>
          
<div class="row">
<!--        <div class="col-lg-4"> -->
         
   <!--      </div> -->
      <!--   <div class="col-lg-8"> -->
          <input type="submit" name="update" id="update"
           value="update" class="btn btn-success mr-2" style="float:right;">
       
<!-- </div>  
         -->                 
         

           </div>


            <?php
          }
          
        
          else{
          ?>
<div class="row">
<!--        <div class="col-lg-4"> -->
         
   <!--      </div> -->
      <!--   <div class="col-lg-8"> -->
          <input type="submit" name="submit" id="submit"
           value="submit" class="btn btn-success mr-2" style="float:right;">
       
<!-- </div>  
         -->                 
         

           </div>

<?php }
?>
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
    <!-- <script type="text/javascript">
    
      $('#reset').click({
        $('.form').load();
});
</script> -->
</html>
<script type="text/javascript">
    $(document).ready(function(){
    
$("#submit").click(function(){
    
var aname = $("#aname").val();
var changes_required = $("#changes_required").val();
var amount = $("#amount").val();
// var amount = $("#amount").val();
var oil = $('#oil_change').is(':checked');
var last_r_km = $("#last_r_km").val();

var present_r_km = $("#present_r_km").val();
var amount_oil = $("#amount_oil").val();
var last_r_dt = $("#last_r_dt").val();
var present_r_dt = $("#present_r_dt").val();
var amount_oil_dt = $("#amount_oil_dt").val();
var tyre_change = $('#tyre_change').is(':checked');
var last_r_km_tyre = $("#last_r_km_tyre").val();
var present_r_km_tyre = $("#present_r_km_tyre").val();
var amount_tyre = $("#amount_tyre").val();
var last_r_dt_tyre = $("#last_r_dt_tyre").val();
var present_r_dt_tyre = $("#present_r_dt_tyre").val();
var amount_tyre_dt = $("#amount_tyre_dt").val();
var estimated_cost = $("#estimated_cost").val();
var req_to = $("#forto").val();
var msg = $("#message_level").val();
// var amount = $("#amount").val();

// var tname = $("#tname").val();

// Checking for Blank Fields.

if( aname ==''){
 
$('.name').css("border","2px solid #ec1313");
alert("Provide asset name ");
$('.name').focus();
return false;
}
if( changes_required ==''){
$('#changes_required').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
alert("Provide your changes required");
$('#changes_required').focus();
return false;
}

if( amount ==''){
$('#amount').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required').css("border","1px solid #D3D3D3");
alert("Please set the amount for changes required");
$('#amount').focus();
return false;
}
if(oil)
{
if(present_r_km ==''){
$('#present_r_km').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount').css("border","1px solid #D3D3D3");

alert("Please set the km reading of your vehicle");
$('#present_r_km').focus();
return false;
}
if( amount_oil ==''){
$('#amount_oil').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km').css("border","1px solid #D3D3D3");

alert("Please set your expected amount for oil change ");
$('#amount_oil').focus();
return false;
}

if( present_r_dt ==''){
$('#present_r_dt').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil').css("border","1px solid #D3D3D3");

alert("Please choose the date of oil change request");
$('#present_r_dt').focus();
return false;
}
if( amount_oil_dt ==''){
$('#amount_oil_dt').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt').css("border","1px solid #D3D3D3");

alert("Please choose the amount of oil change request");
$('#amount_oil_dt').focus();
return false;
}
// if( tyre_change ==''){
// $('#tyre_change').css("border","2px solid #ec1313");
// alert("Please select asset no.");
// $('#tyre_change').focus();
// return false;
// }
}

if(tyre_change)
{
if(  present_r_km_tyre ==''){
$('#present_r_km_tyre').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt,#amount_oil_dt').css("border","1px solid #D3D3D3");

alert("Please set the km reading of your vehicle");
$('#present_r_km_tyre').focus();
return false;
}
if( amount_tyre ==''){
$('#amount_tyre').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt,#amount_oil_dt,#present_r_km_tyre').css("border","1px solid #D3D3D3");

alert("Please set your expected amount for tyre change ");
$('#amount_tyre').focus();
return false;
}
if( present_r_dt_tyre ==''){
$('#present_r_dt_tyre').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt,#amount_oil_dt,#present_r_km_tyre,#amount_tyre').css("border","1px solid #D3D3D3");

alert("Please choose the date of tyre change request");
$('#present_r_dt_tyre').focus();
return false;
}
if( amount_tyre_dt ==''){
$('#amount_tyre_dt').css("border","2px solid #ec1313");
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt,#amount_oil_dt,#present_r_km_tyre,#amount_tyre,#present_r_dt_tyre').css("border","1px solid #D3D3D3");

alert("Please choose the amount of tyre change request");
$('#amount_tyre_dt').focus();
return false;
}
}
if( msg ==''){
  $('.name').css("border","1px solid #D3D3D3");
// $('#message_level').css("border","2px solid #ec1313");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt,#amount_oil_dt,#present_r_km_tyre,#amount_tyre,#present_r_dt_tyre,#amount_tyre_dt').css("border","1px solid #D3D3D3");

    
$('#message_level').css("border","2px solid #ec1313");
alert("Provide a message whom the request is sent ");
$('#message_level').focus();
return false;
}
if( req_to ==''){
$('.name').css("border","1px solid #D3D3D3");
$('#aname,#changes_required,#amount,#present_r_km,#amount_oil,#present_r_dt,#amount_oil_dt,#present_r_km_tyre,#amount_tyre,#present_r_dt_tyre,#amount_tyre_dt').css("border","1px solid #D3D3D3");

    
$('.form-control-select').css("border","2px solid #ec1313");
alert("Provide name of person whom the request is sent ");
$('.form-control-select').focus();
return false;
}

// if( estimated_cost ==''){
// $('#estimated_cost').css("border","2px solid #ec1313");
// alert("Please select asset no.");
// $('#estimated_cost').focus();
// return false;
// }
else {
    return true;
}

});
});

</script>
   



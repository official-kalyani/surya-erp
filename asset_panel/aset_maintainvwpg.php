<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $a_id = $_GET['a_id'];
      
     

     // $name = $ftch->item_name;
     // $subtype = $ftch->sub_type;
 
 if(isset($_POST['reqsubmit']))
{
$msg = $_POST['message_level'];
if($_SESSION['ERP_SESS_ID']!='1')
{
$req_to = $_POST['forto'];
}
else{
  $req_to = '0';
}
$abc = mysqli_query($con,"SELECT * FROM `aset_req_to` WHERE req_id = '$id' AND status = '0'");
$require = mysqli_fetch_object($abc);
$req_to_level = $require->req_to;
// echo $req_to_level;
$created_on = date('Y-m-d H:i:s');
$date = date('Y-m-d ');

$update = mysqli_query($con,"UPDATE `aset_req_to` SET `status` = '1' WHERE `req_id` = '$id'");
$inser =  mysqli_query($con,"INSERT INTO aset_req_to (`req_id`, `req_by`, `req_to`,`date`, `status`) VALUES ('$id','$req_to_level','$req_to','$created_on', '0')");
$query = mysqli_query($con,"SELECT * FROM `aset_req_to` WHERE req_id = '$id'");

while($ftcher = mysqli_fetch_object($query))
{
  // echo $ftcher->req_by;
if($ftcher->req_by == '1')
{
   $ter = mysqli_query($con,"UPDATE aset_req_details SET status ='1' WHERE id = '$id'");
}
else{
  $ter = mysqli_query($con,"UPDATE aset_req_details SET status ='0' WHERE id = '$id'");
}
}


$mess_age =  mysqli_query($con,"INSERT INTO  aset_req_msg (`req_id`, `message`, `message_by`, `created_on`, `status`) VALUES ('$id','$msg', '$req_to_level','$created_on', '1')");
if( $inser && $mess_age){
      $msg="Maintenance request approved successfully";
      // header("Location:vwpg_pr_data.php?msg=$msg");
       if(isset($_GET['pg'])){
        $pgid = $_GET['pg']; }else{ $pgid='main'; }
      if($pgid == 'pndng'){
    ?>
          <script>window.location.href = "<?php echo SITE_URL; ?>/basic/approvals/pendingapprovals.php";</script>
      <?php
    }else{
         $msg = "Maintenance request approved successfully";
        $pgid ='main';
        header("Location:aset_maintainvwpg.php?id=$id");
    }
  }
  else {
       $msgel="Unsuccessfull in approving maintenance request...retry again";
}

                          
                        

}

   if(isset($_POST['prreject'])){

   $msg = $_POST['message_level'];
$abc = mysqli_query($con,"SELECT * FROM `aset_req_to` WHERE req_id = '$id' AND status = '0'");
$require = mysqli_fetch_object($abc);

$req_to_level = $require->req_to;

$created_on = date('Y-m-d H:i:s');

$update = mysqli_query($con,"UPDATE `aset_req_to` SET `status` = '2' WHERE `req_id` = '$id' AND `req_to` = '$req_to_level'");
// echo "UPDATE `aset_pr_req_to` SET `status` = '2' WHERE `pr_id` = '$id' AND `req_to` = '$req_to_level'";

$mess_age =  mysqli_query($con,"INSERT INTO aset_req_msg (`req_id`, `message`, `message_by`, `created_on`, `status`) VALUES ('$id','$msg', '$req_to_level','$created_on', '1')");
$query = mysqli_query($con,"SELECT * FROM `aset_req_to` WHERE req_id = '$id'");
 while($ftcher = mysqli_fetch_object($query))
// $id = $ftch_data->pr_id;
                            // echo $id;
 {
                            if($ftcher->status == '2')
                            {
                                $ter = mysqli_query($con,"UPDATE aset_req_details SET status ='2' WHERE id = '$id'");
                                // echo "UPDATE aset_pr SET status="2" WHERE id = '".$ftch_data->pr_id."'";
                               
                        }
                           //  }
                           
                           else 
                           {
                                    $ter = mysqli_query($con,"UPDATE aset_req_details SET status ='0' WHERE id = '$id'");
                                                               
                                                               }
                                                             }
      if($update && $mess_age){
      $msgdel="Maintenance request rejected successfully";
      // header("Location:vwpg_pr_data.php?msg=$msg");
          if(isset($_GET['pg'])){
        $pgid = $_GET['pg']; }else{ $pgid='main'; }
      if($pgid == 'pndng'){
    ?>
          <script>window.location.href = "<?php echo SITE_URL; ?>/basic/approvals/pendingapprovals.php";</script>
      <?php
    }else{
         $msg = "Maintenance request rejected successfully";
        $pgid ='main';
        header("Location:aset_maintainvwpg.php?id=$id");
    }
  }
  else {
       $msgel="Unsuccessfull in rejecting maintenance request ...try again";
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
        <!-- Added by kalyani 1-9-22 -->
        <script src="../../js/custom-menu.js"></script>
        <!-- Added by kalyani 1-9-22 -->
        <!-- New added css by kalyani 1-9-22-->
        <link href="../../css/custom-menu.css" rel="stylesheet" type="text/css">
        <link href="../../css/responcive.css" rel="stylesheet" type="text/css">
        <!-- New added css by kalyani 1-9-22-->
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
            <?php if(isset($_GET['pg']) && $_GET['pg'] == 'pndng'){ ?>
                    <span style="float:right;">
                    <button onClick='javascript:location.href="<?php echo SITE_URL; ?>/basic/approvals/pendingapprovals.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
                   </span>
                    <?php }
                     else if(isset($pgid) && $pgid == 'main'){
                    ?>
                   <span style="float:right;">
                 <button onClick='javascript:location.href="aset_maintain_view.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
               </span> 
                    <?php
                    }else{ ?>
              <span style="float:right;">
                 <button onClick='javascript:location.href="aset_maintain_view.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
               </span> 
             <?php } ?>
      <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   }
                  if(isset($msg)){ 
                   $msg1 = $msg;
                  echo "<i style=color:#33D15B;>".$msg1."</i>";
                   } 
          
                 if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; }
                 if(isset($_GET['msger'])) { 
                   $msg = $_GET['msger'];
                  echo "<i style=color:#D71313;>".$msg."</i>";
                   } ?>
                 </div>
              <form name="form" method="post" class="forms-sample" enctype="multipart/form-data">
           
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
                         <?php if(mysqli_num_rows( $query) > 0) {echo $ftch->asset_req_no;} ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Date:</label>
                         <?php if(mysqli_num_rows( $query) > 0){ echo $ftch->date; }?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Requested By:</label>
                       
                         <?php  if(mysqli_num_rows( $query) > 0){ echo $ftch->fullname; }?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Asset Name:</label>
                       
                         <?php  if(mysqli_num_rows( $query) > 0){  echo $ftch->description; }?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Serial No:</label>
                       
                         <?php  if(mysqli_num_rows( $query) > 0){ echo $ftch->serial_no;} ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Warrenty:</label>
                       
                         <?php  if(mysqli_num_rows( $query) > 0){  echo $ftch->warrenty; } ?>
                      </div>
                  </div>
                  <?php
                   $query = mysqli_query($con,"SELECT x. *,y.fullname FROM aset_stock_assaignment x, mstr_emp y WHERE x.asset_no  = '$a_id' AND  x.assaign_to = y.id  ORDER BY x. id DESC LIMIT 1");
                $ftch = mysqli_fetch_object($query);
                  ?>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Used By:</label>
                       
                         <?php  if(mysqli_num_rows($query) > 0){ echo $ftch->fullname; }?>
                      </div>
                  </div>
                 </div>
            </fieldset>
            <?php 
           if(mysqli_num_rows( $query) > 0){ 
            ?>
            <fieldset>
               <legend><h5><b>Maintenance Required For:</b></h5></legend>
               <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th style="width: 25%;">Slno</th>
                                                <th style="width: 48%;">Field Name</th>
                                                <th></th>
                                                <th></th>
                                                <th>Amount</th>
                                                
                                            </tr> 
                                        </thead>
                                        <tbody>
                                           <?php
                $query1 = mysqli_query($con,"SELECT x.*,y.* FROM aset_req_details x, aset_feild_entry_maintain y WHERE x.id = '$id' AND  x.id = y.aset_id");
                 $i=1;
                  while ($ftch_req = mysqli_fetch_object($query1))
                  {
                    ?>
                   <tr>
                    <td  style="width: 300px;"><?php echo $i; ?></td>
                    <td style="width:380px;"> <?php echo $ftch_req->feild_name; ?></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $ftch_req->amount; ?></td>
                    

                  </tr>
                    
                  
                 <?php
                 $i++;
                }

                  ?>

                  </tbody>
                </table>
              </div>
              </div>
                
                
            </fieldset>
            <?php
          }
             if(mysqli_num_rows( $query) > 0){ 
            $dueryer = mysqli_query($con,"SELECT x.* ,y.sub_type FROM aset_stock_entry x,aset_item_creation y WHERE x.item_name = y.id AND x.auto_serial = '$a_id'");
                  $ftch_aset_no = mysqli_fetch_object($dueryer);

                  if( $ftch_aset_no->sub_type == '6')
                  {
                    ?>
                    
                  
            <fieldset>
               <legend><h5><b>Vehicle maintenance:</b></h5></legend>
               <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Change Type</th>
                                                <th>Reading Km</th>
                                                
                                                <th>Reading dt</th>
                                                <th>Amount</th>
                                                
                                            </tr> 
                                        </thead>
                                        <tbody>
               <?php
                $query1 = mysqli_query($con,"SELECT * FROM `aset_maintainance_req` WHERE asset_id = '$id' AND status = '1'");
                 $i=1;
                  while ($ftch_dtl = mysqli_fetch_object($query1))
                  {
                   
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <?php
                    if($ftch_dtl->change_type == '1')
                    {
                      ?>
                      <td>Oil Change</td>
                      <?php
                    }
                    else if($ftch_dtl->change_type == '2')
                    {
                      ?>
                      <td>Tyre Change</td>
                      <?php
                    }
                    
                    ?>
                    
                    
                    <td><?php echo $ftch_dtl->reading_km; ?></td>
                    <!-- <td><?php echo $ftch_dtl->amount_km; ?></td> -->
                    <td><?php echo $ftch_dtl->reading_dt; ?></td>
                    <td><?php echo $ftch_dtl->amount_dt; ?></td>

                  </tr>
                    
                  
                 <?php
                 $i++;
                }
             
                  ?>
                  </tbody>
                </table>
              </div>
              </div>
            </fieldset>
            <?php 
            }
          }
          ?>
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
                                           <?php
                        $query1 = mysqli_query($con,"SELECT * FROM `aset_req_details` WHERE `id` = '$id'");
                    
                          $ftch_amount = mysqli_fetch_object($query1);
                          
                           
                          ?>
                        <tr  style="color: red;">
                          <td style="width: 83%;"><h5>Total Cost:</h5></td>
                          <td><h5><?php  if(mysqli_num_rows( $query) > 0){ echo $ftch_amount->total_amount; }?></h5></td>
                        </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
          <!-- </fieldset> -->
    
             <fieldset>
                         <legend><h5><b>Message:</b></h5></legend>
                          <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> message</th>
                                                <th>Updated By</th>
                                                <th>Approved Date & Time</th>
                                               
                                            </tr> 
                                        </thead>
                                        <tbody>
                         <?php
                        $query1 = mysqli_query($con,"SELECT x.*,y.* , z.fullname,z.designation FROM aset_req_details x,aset_req_msg y, mstr_emp z WHERE x.id='$id' AND x.id = y.req_id  AND y.message_by = z.id");
                          $i=1;
                          if(mysqli_num_rows($query1) > 0)
                          {
                          while ($ftch_msg = mysqli_fetch_object($query1))
                          {
                           
                          ?>
                        <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ftch_msg->message; ?></td>
                    
                    <td><?php echo $ftch_msg->fullname."(".$ftch_msg->designation.")"; ?></td>
                 


                    <td><?php echo $ftch_msg->created_on; ?></td>
                   

                  </tr>
                        <?php
                             $i++;
                          }
                        }
                          ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                  
                 
                      </fieldset>
                      <fieldset>
                        <legend><h5><b>Requested To:</b></h5></legend>
                        <div class="row">
                        <div class="col-lg-12">
                       <table class="table table-striped">
                                                <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Requested To</th>
                                                <th>Status</th>
                                                <th>Request date & time</th>
                                                <!-- <th>Approved Date & Time</th> -->
                                               
                                            </tr> 
                                        </thead>
                                        <tbody>
                        <?php
                         $puy = "SELECT x.* , y.fullname,y.designation  FROM aset_req_to x, mstr_emp y WHERE x.req_to = y.id AND x.req_id = '$id' AND y.fullname != 'Others'";
                          $puycon=mysqli_query($con,$puy);
                          $i=1;
                          if(mysqli_num_rows($puycon)>0)
                          {
                          while ($ftch_req = mysqli_fetch_object($puycon))
                          {
                        ?><tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ftch_req->fullname."(".$ftch_req->designation.")"; ?></td>
                    <?php
                     $ftch_req->status; 
                     if($ftch_req->status == '1')
                     {

                    ?>
                    <td>approved</td>

                    <?php 

                    
                  }
                  else if($ftch_req->status == '2'){
                    ?>
                    <td>rejected</td>
                    <?php
                  }
                  else{



                    ?>
                    <td>pending</td>
                    <?Php } ?>

                    <td><?php echo $ftch_req->date;?></td>
                    

                  </tr>
                        <?php
                             $i++;
                          }
                        }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                        
                      </fieldset>

                      <fieldset>
                       
                         <div class="row">
                        <div class="col-lg-12">
                           <input type="button" name="history" id="history" value="Maintenance Request History" class="btn btn-success mr-2" style="float:left;">
                   <input type="button" name="upmaintain"  id="upmaintain"
                                      value="Updated Maintenance History" class="btn btn-primary mr-2"  style="margin-left: 10px;">
                     </div>
                   </div>
                    <div class="row">              
         <div id='maintain_history'></div>

           </div>
            <div class="row">
                            <!-- <div class="col-lg-12"> -->
                          <div id="approve_section"></div>
                        </div>
                        <div class="row">
                          <div id="msg_box"></div>
                        </div>

                        <!-- </div> -->
                         <?php
          if(isset($_GET['id']))
          {
            $id = $_GET['id'];
            $a_id = $_GET['a_id'];
            $query = mysqli_query($con, "SELECT * FROM  aset_req_details WHERE   id = '$id' AND status = '0' ");
                        while ($fetch_id = mysqli_fetch_object($query)) {


                        $req_to= $fetch_id->req_by;

                          
                        if($_SESSION['ERP_SESS_ID'] == $req_to )
                  {
             ?>
                      <div class="row">
                        <div class="col-lg-12">
                       <a href="asset_maintainance.php?id=<?php echo $id;?>&asset_id=<?php echo $a_id;?>" style="text-decoration:none; float: right;" class="btn btn-primary btn-xs" ><b>Edit</b></a>
<?php } } } ?>
                       <?php
                        $query = mysqli_query($con, "SELECT * FROM  aset_req_to WHERE   req_id = '$id' AND status = '0'");
                        while ($fetch_id = mysqli_fetch_object($query)) {


                        $req_to= $fetch_id->req_to;

                          
                        if($_SESSION['ERP_SESS_ID'] == $req_to )
                  {
                        ?>
                      
                        
                          
                          <input type="submit" name="prreject"  id="prreject"value="submit" class="btn btn-warning mr-2" style="float:right;">
                          <input type="submit" name="reqsubmit"  id="reqsubmit"value="submit" class="btn btn-success mr-2" style="float:right;">
                           <input type="button" name="reject"  id="reject" value="Reject" class="btn btn-danger mr-2" style="float:right;">
                          <input type="button" name="approve"  id="approve" value="Approve" class="btn btn-success mr-2" style="float:right;margin-right: 10px;">
                      
                         
                        <!-- </div>
                         <div class="col-lg-12"> -->

                      <?php } 
                      } ?>

</div>
                      </div>
                        
                      
                     </fieldset> 

                     
          </form>
        
        <p style="padding-top:20px;">&nbsp;</p>
              
         <!-- //Body Ends Here -->      
                </div>
                <!-- /.row -->
            </div>

            <!-- /#page-wrapper -->
        <?php require_once('../../footer.php'); ?>
       


        <!-- /#wrapper -->

       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>
   <script type="text/javascript">
          $(document).ready(function(){
            $("#prreject").css("visibility", "hidden");
             $("#reqsubmit").css("visibility", "hidden");
            $("#approve").click(function(){
           var idm = $("#hid_id").val();
           // console.log(idm);
               if( idm != ''){

        $.ajax({
        url:"asetreq_to.php",
        data:{s_id:idm},
        type:'POST',
        success:function(data) {

        var sd = $.trim(data);
        $("#approve_section").html(sd);
         $("#reject").css("visibility", "hidden");
              $("#approve").css("visibility", "hidden");
             $("#reqsubmit").css("visibility", "visible");
        // $("#asset_history").show();

        }
        });

    }
              $.post( "pr_msg.php", function( data ) {
 
             $( "#msg_box" ).html( data );
            });
            });

          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#prreject").css("visibility", "hidden");
             $("#reject").click(function(){
                 var r = confirm("Are you sure you want to reject?");
                 if (r == true) {
              $.post( "pr_msg.php", function( data ) {
 
             $( "#msg_box" ).html( data );
              $("#reject").css("visibility", "hidden");
              $("#approve").css("visibility", "hidden");
             $("#prreject").css("visibility", "visible");

            });
            }
             });
          });
        </script>
        </html>
         <script type="text/javascript">
            $(document).ready(function(){

      
           $("#prreject").click(function(){
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
     $(document).ready(function () {
      $("#history").click(function(){
         var asset_name = $("#hid_no").val();
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
      $("#upmaintain").click(function(){
        var asset = $("#hid_no").val();

        if( asset != ''){

        $.ajax({
        url:"mainten_update.php",
        data:{a_id:asset},
        type:'POST',
        success:function(data) {

        var sd = $.trim(data);
        $("#maintain_history").html(sd);
        // $("#asset_history").show();

        }
        });

        }


    });

     }); 
    </script>
         <script type="text/javascript">
            $(document).ready(function(){
                  $("#reqsubmit").click(function(){
            var req_to = $("#forto").val();
            var message = $("#message_level").val();


if( req_to ==''){
  
   
$('.form-control-select').css("border","2px solid #ec1313");
alert("Provide name of person whom the request is sent ");
$('.form-control-select').focus();
return false;
}
if(  message ==''){
$('#message_level').css("border","2px solid #ec1313");
$('.form-control-select').css("border","1px solid #D3D3D3");
alert("Please mention message for your approval");
$('#message_level').focus();
return false;
}

});
            });
         </script>
        <?php
      }
      ?>
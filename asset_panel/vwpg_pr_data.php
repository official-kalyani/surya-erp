<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      
     

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
$abc = mysqli_query($con,"SELECT * FROM `aset_pr_req_to` WHERE pr_id = '$id' AND status = '0'");
$require = mysqli_fetch_object($abc);
$req_to_level = $require->req_to;
// echo $req_to_level;
$created_on = date('Y-m-d H:i:s');
$date = date('Y-m-d ');

$update = mysqli_query($con,"UPDATE `aset_pr_req_to` SET `status` = '1' WHERE `pr_id` = '$id'");
$inser =  mysqli_query($con,"INSERT INTO aset_pr_req_to (`pr_id`, `req_to`, `req_by`,`date`,`time`, `status`) VALUES ('$id','$req_to', '$req_to_level','$date','$created_on', '0')");
$query = mysqli_query($con,"SELECT * FROM `aset_pr_req_to` WHERE pr_id = '$id'");

while($ftcher = mysqli_fetch_object($query))
{
  // echo $ftcher->req_by;
if($ftcher->req_by == '1')
{
   $ter = mysqli_query($con,"UPDATE aset_pr SET status ='1' WHERE id = '$id'");
}
else{
  $ter = mysqli_query($con,"UPDATE aset_pr SET status ='0' WHERE id = '$id'");
}
}


$mess_age =  mysqli_query($con,"INSERT INTO aset_pr_comment (`last_id`, `message`, `message_by`, `created_on`, `status`) VALUES ('$id','$msg', '$req_to_level','$created_on', '1')");
if( $inser && $mess_age){
    
    
        $msg="Procurement request approved successfully";
      // header("Location:vwpg_pr_data.php?msg=$msg");
      if(isset($_GET['pg'])){
        $pgid = $_GET['pg'];}else{ $pgid='main'; }
      //header("Location: vwpg_pr_data.php?msg=$msg&id=$id&pg=$pgid");
      // header("Location: vwpg_pr_data.php");
    if($pgid == 'pndng'){
    ?>
          <script>window.location.href = "<?php echo SITE_URL; ?>/basic/approvals/pendingapprovals.php";</script>
      <?php
    }else{
         $msg = "Procurement request approved successfully";
        $pgid ='main';
        header("Location:vwpg_pr_data.php?id=$id");
    }
   
  }
  else {
       $msgel="Unsuccessfull in approving procurement request...retry again";
}

                          
                        

}

   if(isset($_POST['prreject'])){

   $msg = $_POST['message_level'];
$abc = mysqli_query($con,"SELECT * FROM `aset_pr_req_to` WHERE pr_id = '$id' AND status = '0'");
$require = mysqli_fetch_object($abc);

$req_to_level = $require->req_to;

$created_on = date('Y-m-d H:i:s');

$update = mysqli_query($con,"UPDATE `aset_pr_req_to` SET `status` = '2' WHERE `pr_id` = '$id' AND `req_to` = '$req_to_level'");
// echo "UPDATE `aset_pr_req_to` SET `status` = '2' WHERE `pr_id` = '$id' AND `req_to` = '$req_to_level'";

$mess_age =  mysqli_query($con,"INSERT INTO aset_pr_comment (`last_id`, `message`, `message_by`, `created_on`, `status`) VALUES ('$id','$msg', '$req_to_level','$created_on', '1')");
$query = mysqli_query($con,"SELECT * FROM `aset_pr_req_to` WHERE pr_id = '$id'");
 while($ftcher = mysqli_fetch_object($query))
// $id = $ftch_data->pr_id;
                            // echo $id;
 {
                            if($ftcher->status == '2')
                            {
                                $ter = mysqli_query($con,"UPDATE aset_pr SET status ='2' WHERE id = '$id'");
                                // echo "UPDATE aset_pr SET status="2" WHERE id = '".$ftch_data->pr_id."'";
                               
                        }
                           //  }
                           
                           else 
                           {
                                    $ter = mysqli_query($con,"UPDATE aset_pr SET status ='0' WHERE id = '$id'");
                                                               
                                                               }
                                                             }
      if($update && $mess_age){
      $msgdel="Procurement request rejected successfully";
      // header("Location:vwpg_pr_data.php?msg=$msg");
        if(isset($_GET['pg'])){
        $pgid = $_GET['pg'];}else{ $pgid='main'; }
      //header("Location: SITE_URL/basic/hr/vwpg_pr_data.php?msger=$msgdel&id=$id&pg=$pgid");
          if($pgid == 'pndng'){
    ?>
          <script>window.location.href = "<?php echo SITE_URL; ?>/basic/approvals/pendingapprovals.php";</script>
      <?php
    }else{
         $msg = "Procurement request rejected successfully";
        $pgid ='main';
        header("Location:vwpg_pr_data.php?id=$id");
    }
  }
  else {
       $msgel="Unsuccessfull in rejecting procurement request ...try again";
}

   }    

    

    ?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Procurement Form: Suryam Group</title>

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
<?php 
  $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' AND `id`!='".$_SESSION['ERP_SESS_ID']."' order by `fullname` ASC";
  $efq=mysqli_query($con,$eq);
  $bq = "SELECT * FROM `hr_department` WHERE `status`='1' ORDER BY `id` DESC limit 10";
  $bfq = mysqli_query($con,$bq); 
?>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 5; //Maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
      
           $(wrapper).append('<div id="append" class="row"><div><div class="col-lg-4"><div class="form-group"><select name="taskto[]" id="taskto'+x+'" class="form-control" required><option value="">Type to Select Name</option><?php while ($egq = mysqli_fetch_object($efq))  { echo '<option value="'. $egq->id . '">' . $egq->fullname .'('.$egq->designation.')</option>';} ?></select></div></div> <div class="col-lg-4"><div class="form-group"><select name="Dept[]" id="Dept'+x+'" class="form-control"><option selected value="">--Select Project--</option><?php while ($edq = mysqli_fetch_object($bfq))  { echo '<option value="'. $edq->id . '">' . $edq->dept_name .'</option>';} ?></select></div></div></div><button class="btn btn-danger btn-xs remove_field" style="margin-top:3px;">X</button></div>'); //add input box
    } 
    
    $('#taskto'+x).selectize({
        sortField: 'text'
          });
    $('#Dept'+x).selectize({
        sortField: 'text'
          });
    
    
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#append').remove(); x--;
    })
});
</script>

<?php
$eqd = "SELECT * FROM `aset_item_creation` WHERE `status`='1' order by `name` ASC";
$sql=mysqli_query($con,$eqd);?>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields1      = 5; //Maximum input boxes allowed
    var wrapper1         = $(".append_feild"); //Fields wrapper
    var add_button1      = $(".add_append_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button1).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields1){ //max input box allowed
            x++; //text box increment
           var item = x;
           $(wrapper1).append('<tr id="append"><td>'+x+'</td><td><div class="form-group">  <!-- ID For Who given the Task to TaskToMatchId --><select name="ass_name[]" id="ass_name'+x+'" class="form-control" ><option value="">Type to Select Name</option><?php while ($sql2 = mysqli_fetch_object($sql))  { echo '<option value="'. $sql2->id . '">' . $sql2->name .'</option>';} ?></select></div></td> <td> <div class="form-group"><input type="text" name="uom[]" id="uom" class="form-control"> </div></td> <td> <div class="form-group"><input type="text" name="qty[]" id="qty" class="form-control" > </div></td><td><div class="form-group"><textarea name="itemdesc[]" id="itemdesc" class="form-control" rows="1" ></textarea></div></td> <td><button class="btn btn-danger btn-xs remove_field" style="margin-top:3px;">X</button></td></tr>'); //add input box
    } 
    
    $('#ass_name'+x).selectize({
        sortField: 'text'
          });
    
    
    });
   
    $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).closest('#append').remove(); x--;
    })
});
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
                        <h4 class="page-header">Procurement Request Details</h4>
           
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
                    <button onClick='javascript:location.href="pr_view.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
                   </span> 
                    <?php
                    }else{ ?>
                   <span style="float:right;">
                    <button onClick='javascript:location.href="pr_view.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To Previos Page</button>
                   </span> 
                    <?php } 
                  if(isset($_GET['msg'])){ 
                   $msg1 = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg1."</i>";
                   } 
                  if(isset($msg)){ 
                   $msg1 = $msg;
                  echo "<i style=color:#33D15B;>".$msg1."</i>";
                   } 
                  if(isset($msgel)){ echo "<i style=color:#D71313;>".$msgel."</i>"; } 
                  if(isset($_GET['msger'])) { 
                   $msg = $_GET['msger'];
                  echo "<i style=color:#D71313;>".$msg."</i>";
                   } ?>
                 </div>
              <form name="form" method="post" class="forms-sample" enctype="multipart/form-data">
           
              <fieldset>
                <legend><h5><b></b></h5></legend>
                <?php

                $query = mysqli_query($con,"SELECT x.*,y.fullname, z.pname  FROM aset_pr x, mstr_emp y, prj_project z WHERE x.id = '$id' AND x.req_by = y.id AND x.project = z.id");
                $ftch = mysqli_fetch_object($query);
                ?>
                <div class="row">
                  <input type="hidden" name="hid_id" id="hid_id" value="<?php echo $ftch->id;?>">
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Asset PR No:</label>
                         <?php echo $ftch->aset_pr_no; ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Date:</label>
                         <?php echo $ftch->created_on; ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Requested By:</label>
                       
                         <?php echo $ftch->fullname; ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Project:</label>
                           <?php echo $ftch->pname; ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Location:</label>
                         <?php echo $ftch->godown; ?>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="serial">Purpose:</label>
                         <?php echo $ftch->purpose; ?>
                      </div>
                  </div>
                </div>
            </fieldset> 
           
            <fieldset>
               <legend><h5><b>Required For:</b></h5></legend>
               <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Required For</th>
                                                
                                                <th>Department</th>
                                                
                                            </tr> 
                                        </thead>
                                        <tbody>
                                           <?php
                $query1 = mysqli_query($con,"SELECT x.*,y.fullname,y.designation,z.dept_name FROM aset_pr_to x, mstr_emp y, hr_department z WHERE x.last_id = '$id' AND  x.req_for = y.id AND x.dept = z.id");
                 $i=1;
                  while ($ftch_req = mysqli_fetch_object($query1))
                  {
                    ?>
                   <tr>
                    <td><?php echo $i; ?></td>
                    <td> <?php echo $ftch_req->fullname ."(".$ftch_req->designation.")"; ?></td>
                    <td><?php echo $ftch_req->dept_name; ?></td>
                    

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
            <fieldset>
               <legend><h5><b>Asset Details:</b></h5></legend>
               <div class="row">
                <div class="col-lg-12">
               <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Name</th>
                                                <th>UOM</th>
                                                <th>QTY</th>
                                                <th>Specification</th>
                                                
                                            </tr> 
                                        </thead>
                                        <tbody>
               <?php
                $query1 = mysqli_query($con,"SELECT x.*,y.name FROM aset_pr_detail x,aset_item_creation y WHERE x.last_id = '$id' AND x.aset_name = y.id");
                 $i=1;
                  while ($ftch_dtl = mysqli_fetch_object($query1))
                  {
                   
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ftch_dtl->name; ?></td>
                    <td><?php echo $ftch_dtl->uom; ?></td>
                    <td><?php echo $ftch_dtl->qty; ?></td>
                    <td><?php echo $ftch_dtl->description; ?></td>

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
            $query1 = mysqli_query($con,"SELECT * FROM aset_pr_comment WHERE last_id = '$id'");
            if(mysqli_num_rows($query1) > 0)
            {
    ?>
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
                        
                          $i=1;
                          while ($ftch_msg = mysqli_fetch_object($query1))
                          {
                           
                          ?>
                        <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $ftch_msg->message; ?></td>
                    <?php if($ftch_msg->message_by =='0'){
                    
                      $query2 = mysqli_query($con,"SELECT x.*,y.* , z.fullname,z.designation FROM aset_pr x,aset_pr_comment y, mstr_emp z WHERE x.id='$id' AND x.id = y.last_id AND x.req_by = z.id");
                      $ftch_msg_data = mysqli_fetch_object($query2);
                      ?>
                    <td><?php echo $ftch_msg_data->fullname."(".$ftch_msg_data->designation.")"; ?></td>
                  <?php }
                  else{ 
                   
                    $query2 = mysqli_query($con,"SELECT y.* , z.fullname,z.designation FROM aset_pr_comment y, mstr_emp z WHERE y.id='".$ftch_msg->id."'AND y.message_by = z.id");
                          
                          while ($ftch_msg_data = mysqli_fetch_object($query2))
                          {
                           
                          // $msg_id = $ftch_msg_data->id;
                          // $query3 = mysqli_query($con,"SELECT y.* , z.fullname FROM aset_pr_comment y, mstr_emp z WHERE y.id='$msg_id' AND y.message_by = z.id");
                          // $fetch_msg = mysqli_fetch_object($query3);
                        
                          ?>
                          <td><?php echo $ftch_msg_data->fullname."(".$ftch_msg_data->designation.")"; ?></td>
                          <?php
                          
                         }
                        
                      }
                        ?>
                    

                    <td><?php echo $ftch_msg->created_on; ?></td>
                    

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
                    ?>
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
                         $puy = "SELECT x.* , y.fullname,y.designation  FROM aset_pr_req_to x, mstr_emp y WHERE x.req_to = y.id AND x.pr_id = '$id' AND y.fullname != 'Others'";
                         
                          $puycon=mysqli_query($con,$puy);
                          $i=1;
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

                    <td><?php echo $ftch_req->time;?></td>
                    

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

                      <fieldset>
                        <div class="row">
                            <!-- <div class="col-lg-12"> -->
                          <div id="approve_section"></div>
                        </div>
                        <div class="row">
                          <div id="msg_box"></div>
                        </div>
                        <!-- </div> -->

                      <div class="row">

                       <?php
                        $query = mysqli_query($con, "SELECT * FROM  aset_pr_req_to WHERE status = '0' AND pr_id = '$id'");
                        while ($fetch_id = mysqli_fetch_object($query)) {


                        $req_to= $fetch_id->req_to;

                          
                        if($_SESSION['ERP_SESS_ID'] == $req_to )
                  {
                        ?>
                      
                        <div class="col-lg-12">
                           
                          
                          <input type="submit" name="prreject"  id="prreject"value="submit1" class="btn btn-warning mr-2" style="float:right;">
                          <input type="submit" name="reqsubmit"  id="reqsubmit"value="submit" class="btn btn-success mr-2" style="float:right;">
                           <input type="button" name="reject"  id="reject" value="Reject" class="btn btn-danger mr-2" style="float:right;">
                          <input type="button" name="approve"  id="approve" value="Approve" class="btn btn-success mr-2" style="float:right;">
                      
                         
                        <!-- </div>
                         <div class="col-lg-12"> -->
       
</div>
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
        </div>
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
           var id = $("#hid_id").val();
           // console.log(id);
               if( id != ''){

        $.ajax({
        url:"req_to.php",
        data:{s_id:id},
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
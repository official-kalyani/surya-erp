<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>

<?php
if(isset($_POST['tsksbmt'])) // Add query
{
  $qu = "SELECT id FROM aset_pr ORDER BY id DESC LIMIT 1";
                        $qu_con = mysqli_query($con, $qu);
                        $fetch_ser = mysqli_fetch_object($qu_con);
                        $ser_id = $fetch_ser->id + 1;
                        $string = "ASTPR00";
                        $auto_ser = $string . $ser_id;
                        // echo $auto_ser;

                        $req_by =$_POST['req_by'];
                        $project =$_POST['pname'];
                        $godown = $_POST['godown'];
                        $purpose = $_POST['purpose'];
                        $created_on = date('Y-m-d ');
$sql=  "INSERT INTO aset_pr (`req_by`, `project`, `godown`, `purpose`,`aset_pr_no`, `created_on`, `status`) VALUES ('$req_by ','$project', '$godown', '$purpose', '$auto_ser', '$created_on', '0')";
$sql2 = mysqli_query($con, $sql);
 $last_insert = mysqli_insert_id($con);

 $total = count($_POST['taskto']);


for($i = 0; $i < $total; $i++) {

        $add_item = $_POST['taskto'][$i];
      
        $add_item_dept =  $_POST['Dept'][$i];

        // echo $add_item_dept;
        
         if(isset($_POST['taskto'][$i]) ){

          if(($_POST['taskto'][$i] )!="" && ($_POST['Dept'][$i])!=""){


            


    
              $sql3=  "INSERT INTO aset_pr_to (`last_id`, `req_for`, `dept`, `status`) VALUES ('$last_insert','$add_item', '$add_item_dept', '1')";
              // echo "INSERT INTO aset_pr_to (`req_by`, `req_to`, `dept`, `status`) VALUES (' $req_by','$add_item', '$add_item_dept', '1')";
              $sql4 = mysqli_query($con, $sql3);
              
  }
}
}
  $pr_to = mysqli_insert_id($con);
 
   $total_asset_name = count($_POST['ass_name']);


for($i = 0; $i < $total_asset_name; $i++) {

        $add_aset_item = $_POST['ass_name'][$i];
        // echo $add_aset_item. "<br>";
        $add_item_uom =  $_POST['uom'][$i];
        $add_item_qty =  $_POST['qty'][$i];
        $add_item_desc =  $_POST['itemdesc'][$i];
        // echo $add_item_uom . "<br>";
        // echo $add_item_qty . "<br>";
        // echo $add_item_desc . "<br>";
        
         if(isset($_POST['ass_name'][$i]) ){

          if(($_POST['ass_name'][$i] )!="" && ($_POST['uom'][$i])!="" && ($_POST['qty'][$i])!="" && ($_POST['itemdesc'][$i])!= ""){


            


    
              $sql5=  "INSERT INTO aset_pr_detail (`last_id`, `aset_name`, `uom`, `qty`, `description`) VALUES ('$last_insert',' $add_aset_item', '$add_item_uom', '$add_item_qty', '$add_item_desc')";
              // echo "INSERT INTO aset_pr_detail (`pr_to_id`, `aset_name`, `uom`, `qty`, `description`) VALUES ('$pr_to', ' $add_aset_item', '$add_item_uom', '$add_item_qty', '$add_item_desc')";
              $sql6 = mysqli_query($con, $sql5);
            }
          }
           
}

// $message = $_POST['message'];
$created_on = date('Y-m-d H:i:s');
$date = date('Y-m-d ');
// $sql7 = "INSERT INTO aset_pr_comment (`last_id`, `message`, `created_on`) VALUES ('$last_insert','$message', '$created_on')";
// $sql8 = mysqli_query($con, $sql7);
$req_to = $_POST['forto'];
$sql9 = "INSERT INTO aset_pr_req_to (`pr_id`,`req_to`,`date`,`time`, `status`) VALUES ('$last_insert','$req_to','$date', '$created_on', '0')";
$sql10 = mysqli_query($con, $sql9);
    if( $sql10){
      $msg= "Procurement request created successfully";
      header("Location:aset_pr_form.php?msg=$msg");

  }
  else {
       $msgel="Unsuccessfull in creating procurement request...retry again";
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
  $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' order by `fullname` ASC";
  $efq=mysqli_query($con,$eq);
  $bq = "SELECT * FROM `hr_department` WHERE `status`='1' ORDER BY `id` ";
  $bfq = mysqli_query($con,$bq); 
?>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 15; //Maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
      
           $(wrapper).append('<div id="append" class="row"><div><div class="col-lg-4"><div class="form-group"><select name="taskto[]" id="taskto'+x+'" class="form-control" required><option value="">Type to Select Name</option><?php while ($egq = mysqli_fetch_object($efq))  { echo '<option value="'. $egq->id . '">' . $egq->fullname .'('.$egq->designation.')</option>';} ?></select></div></div> <div class="col-lg-4"><div class="form-group"><select name="Dept[]" id="Dept'+x+'" class="form-control" Required><option selected value="">--Select Project--</option><?php while ($edq = mysqli_fetch_object($bfq))  { echo '<option value="'. $edq->id . '">' . $edq->dept_name .'</option>';} ?></select></div></div></div><button class="btn btn-danger btn-xs remove_field" style="margin-top:3px;">X</button></div>'); //add input box
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
    var max_fields1      = 100; //Maximum input boxes allowed
    var wrapper1         = $(".append_feild"); //Fields wrapper
    var add_button1      = $(".add_append_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button1).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields1){ //max input box allowed
            x++; //text box increment
           var item = x;
           $(wrapper1).append('<tr id="append"><td>'+x+'</td><td><div class="form-group">  <!-- ID For Who given the Task to TaskToMatchId --><select name="ass_name[]" id="ass_name'+x+'" class="form-control ass_name" onchange="getuom('+x+');" Required><option value="">Type to Select Name</option><?php while ($sql2 = mysqli_fetch_object($sql))  { echo '<option value="'. $sql2->id . '">' . $sql2->name .'</option>';} ?></select></div></td> <td> <div class="form-group"><input type="text" name="uom[]" id="uom'+x+'" class="form-control uom" Required> </div></td> <td> <div class="form-group"><input type="text" name="qty[]" id="qty" class="form-control" Required > </div></td><td><div class="form-group"><textarea name="itemdesc[]" id="itemdesc" class="form-control" rows="1" Required></textarea></div></td> <td><button class="btn btn-danger btn-xs remove_field" style="margin-top:3px;">X</button></td></tr>'); //add input box
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
                        <h4 class="page-header">Procurement Form</h4>
           
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
         
                <!-- /.row -->
                <div class="row">
                <!-- Body Starts Here -->  
        <span style="float:right;">
          <button onClick='javascript:location.href="pr_view.php"' class="btn btn-warning btn-xs" style="font-weight: bold;">Back To List</button>
        </span> 
      <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } 
                    if(isset($msg)){
                         echo "<i style=color:#33D15B;>".$msg."</i>";
                    }?>
                   <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
                 </div>
                         
          <form name="form" method="post" class="forms-sample" >
        <fieldset>
                    <legend><h5><b>&nbsp;</b></h5></legend> 
                           <div class="row">
                  <input type="hidden" name="req_by" id="req_by" class="form-control" value="<?php echo $_SESSION['ERP_SESS_ID']; ?>" readonly>
                    <div class="col-lg-4">
                      <div class="form-group">

                          
                          
                          <label for="req">Requested By</label>
                          <input type="text" name="req" id="req" class="form-control" value="<?php echo $_SESSION['ERP_SESS_FULLNAME']; ?>" readonly> 

                        </div>
                    </div>
                  
                    <div class="col-lg-4">
                      <div class="form-group">
                        <script type="text/javascript">
                        $(document).ready(function () {
                            $('#pname').selectize({
                                sortField: 'text'
                            });
                        });
                      </script> 
                          <label for="req_by">Project</label>
                          <select name="pname" id="pname" class="form-control-select_project" <?php if(isset($_GET['id'])){echo "readonly";} ?> >
                      <option selected value="">--Select Project--</option>
                      <?php
                       
                        $pq = "SELECT * FROM `prj_project` WHERE `status`='1' ORDER BY `id` DESC"; 
                        $pfq=mysqli_query($con,$pq);
                        while ($pgq = mysqli_fetch_object($pfq))
                            { 
                          echo '<option value="'. $pgq->id . '">' . $pgq->pname .'</option>';
                            }
                          
                      ?>
            </select>
                             

                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                      <div class="form-group">

                          <label for="godown">Location</label>
                          
                            <input type="text" name="godown" id="godown" class="form-control" autocomplete="off" > 

                        </div>
                    </div>
                       </div>
                       <div class="row"> 
                    <div class="col-lg-4">
                      <div class="form-group">

                          <label for="purpose">Purpose</label>
                          
                            <input type="text" name="purpose" id="purpose" class="form-control" autocomplete="off" > 

                        </div>
                    </div>
              </div>
        
      
              <div class="input_fields_wrap">
        
        <div class="row">
        <!--  <div class="col-lg-6">
                    <div class="form-group"> -->
                    <!--   <label for="taskbyname">Task By </label> -->
                      <input type="hidden" class="form-control" name="taskbyname" id="taskbyname" value="<?php echo $_SESSION['ERP_SESS_FULLNAME']; ?>" readonly>
            <input type="hidden" name="taskby" value="<?php echo $_SESSION['ERP_SESS_ID']; ?>"> <!-- ID For Who given the Task -->
        <!--  </div>
          </div> -->
<!-- Used For Auto Typing Search -->          
<script type="text/javascript">
  $(document).ready(function () {
      $('#taskto').selectize({
          sortField: 'text'
      });
  });
</script> 
 

<!-- //Used For Auto Typing Search -->        
          <div class="col-lg-4">

          <div class="form-group">  
                      <label for="taskto">Required For</label>
               


                            
            <input type="hidden" name="matchid" id="matchid" value="<?php echo rand(10,99).time().rand(100,999); ?>"> <!-- ID For Who given the Task to TaskToMatchId -->
            <select name="taskto[]" id="taskto" class="form-control-select_req" required>
                    <option value=''>Type to Select Name</option>
                    <?php
                      
                        $eq = "SELECT * FROM `mstr_emp` WHERE `status`='1' order by `fullname` ASC";
                        $efq=mysqli_query($con,$eq); 

                        while ($egq = mysqli_fetch_object($efq))
                            { 
                          echo '<option value="'. $egq->id . '">' . $egq->fullname .'('.$egq->designation.')</option>';
                            }
                          
                      ?>
            </select>
           
          </div>
          </div>
           <div class="col-lg-4">
            <script type="text/javascript">
  $(document).ready(function () {
      $('#Dept').selectize({
          sortField: 'text'
      });

  });
</script>
                        <div class="form-group">

                            <label for="Dept">Dept</label>
                             
                            <!-- <input type="text" name="Dept[]" id="Dept" class="form-control" >  -->
                             <select name="Dept[]" id="Dept" class="form-control-select_dept" required>
                      <option selected value="">--Select Project--</option>
                      <?php
                         
                        
                        $pq = "SELECT * FROM `hr_department` WHERE `status`='1' ORDER BY `id`"; 
                        $pfq=mysqli_query($con,$pq);
                        while ($pgq = mysqli_fetch_object($pfq))
                            { 
                          echo '<option value="'. $pgq->id . '">' . $pgq->dept_name .'</option>';
                            }
                          
                      ?>
            </select>
             

                        </div>
                      </div>
          
          <div class="col-lg-2">
                    <div class="form-group">
                        <button class="btn btn-primary btn-xs add_field_button">+</button>
          </div>
          </div>
        </div>
        
        </div>

        

        <!-- </div> -->
         <div>
        
        <div class="row">
        <!--  <div class="col-lg-6">
                    <div class="form-group"> -->
                    <!--   <label for="taskbyname">Task By </label> -->
                     
<script type="text/javascript">
  $(document).ready(function () {
 
      $('#ass_name1').selectize({
          sortField: 'text'
      });
    });

</script>   
<!-- //Used For Auto Typing Search -->     

                                <div class="table-responsive" style="overflow: unset;">
                                    <table class="table table-striped append_feild">
                                        <thead> 
                                            <tr> 
                                               <th>Slno</th>
                                                <th> Name</th>
                                                <th>UOM</th>
                                                <th>QTY</th>
                                                <th>Specification</th>
                                                <th><button class="btn btn-primary btn-xs add_append_button">+</button></th>
                                            </tr> 
                                        </thead>
                                       
                                        <tbody>
                                          <tr id="append">
                                            <td>1</td>
                                          <td>
                                            <div class="form-group">  
                                           <!--  <label for="ass_name">Name:</label> -->
                                            <!-- ID For Who given the Task to TaskToMatchId -->
                                            <select name="ass_name[]" id="ass_name1" class="form-control-select_name ass_name" >
                                            <option value=''>Select</option>
                                            <?php
                                            $eq = "SELECT * FROM `aset_item_creation` WHERE `status`='1' order by `name` ASC";
                                            $efq=mysqli_query($con,$eq); 

                                            while ($egq = mysqli_fetch_object($efq))
                                            { 
                                            echo '<option value="'. $egq->id . '">' . $egq->name .'</option>';
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        </td>
                                          <td> 
                                              <div class="form-group">

                                            <!-- <label for="uom">UOM:</label> -->

                                            <input type="text" name="uom[]" id="uom1" class="form-control uom"autocomplete="off" value="" > 

                                            </div>
                                          </td>
                                          <td> 
                                            <div class="form-group">

                                            <!-- <label for="qty">QTY:</label> -->

                                            <input type="text" name="qty[]" id="qty" class="form-control" autocomplete="off" required> 

                                            </div>
                                          </td>
                                          <td> 
                                            <div class="form-group">
                                            <!-- <label for="itemdesc">Specification</label> -->
                                            <textarea name="itemdesc[]" id="itemdesc" class="form-control" rows="1" required></textarea>


                                            </div>
                                          </td>
                                         
                                          </tr>
                                        </tbody>
                                        
                                      </table>


        </div>
      </div>
      </div>
         
        <!-- <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
          <label for="message">Message</label>
           <textarea name="message" id="message" class="form-control" rows="2" ></textarea>
        </div>
        </div>
        </div> -->

         <div class="row">
       <div class="col-lg-4">
            <label for="forto">Request To</label>
           
          
                      
                           <select name="forto" id="forto" class="form-control-select" >
                              <option selected value="">--Select Project--</option>
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
     <div class="row">
<!--        <div class="col-lg-4"> -->
         
   <!--      </div> -->
      <!--   <div class="col-lg-8"> -->
          <input type="reset" name="reset" id="reset"
           value="Reset" class="btn btn-warning mr-2" style="float:right; ">
       <input type="submit" name="tsksbmt"  id="tsksbmt"
     value="Submit" class="btn btn-success mr-2" style="float:right;margin-right: 10px;">
<!-- </div>  
         -->                 
         

           </div>
          <!--  </div>
           <div class="4"> -->
        
        

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
        $("#tasksbmt").click(function(){

          var asset_no = $("#ass_no").val();
          if( asset_no ==''){
            $('#ass_no').css("border","2px solid #ec1313");
            alert("Please provide the asset no.");
            $('#ass_no').focus();
            return false;
}


        });

       });
    </script>
    <script type="text/javascript">
       $(document).ready(function(){
        $(".ass_name").change(function(){
           var str=1;
          getuom(str);
        });

       });
       function getuom(str)
       {
        var asset_name = $('#ass_name'+str).val();
          // console.log(asset_name);
          
           if( asset_name != '')
          {

              $.ajax({
                      url:"pr_uom_fetch.php",
                      data:{s_id:asset_name},
                      type:'POST',
                      success:function(data) { 
                        var sd = $.trim(data);
                        $('#uom'+str).val(sd);
                        
                      }

                    });
          }
       }
    </script>
     <script type="text/javascript">
    $(document).ready(function(){

    $("#tsksbmt").click(function(){


var req_by = $("#req").val();
var project = $("#pname").val();
var godown = $("#godown").val();

var purpose = $("#purpose").val();
var taskto = $("#taskto").val();
var dept = $("#Dept").val();
var name = $("#ass_name1").val();
var uom = $("#uom1").val();
var qty = $("#qty").val();
var itemdesc = $("#itemdesc").val();

var message = $("#message").val();
var req_to = $("#forto").val();

// if( req_by ==''){
// $('#req').css("border","2px solid #ec1313");
// alert("");
// $('#req').focus();
// return false;
// }
if( project ==''){
$('.form-control-select_project').css("border","2px solid #ec1313");

alert("Please mention project for which asset is required");
$('.form-control-select_project').focus();
return false;
}
if( godown ==''){
$('#godown').css("border","2px solid #ec1313");
$('#pname').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");
alert("Please mention godown");
$('#godown').focus();
return false;
}
if( purpose ==''){
$('#purpose').css("border","2px solid #ec1313");
$('#pname, #godown').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");

alert("Please mention your purpose");
$('#purpose').focus();
return false;
}
if( taskto ==''){
  $('#pname, #godown, #purpose').css("border","1px solid #D3D3D3");
  $('.form-control-select_project').css("border","1px solid #D3D3D3");

$('.form-control-select_req').css("border","2px solid #ec1313");
alert("Provide name of person whom the request is sent ");
$('.form-control-select_req').focus();
return false;
}
if( dept ==''){
  $('#pname, #godown, #purpose').css("border","1px solid #D3D3D3");
  $('.form-control-select_req').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");

$('.form-control-select_dept').css("border","2px solid #ec1313");
alert("Provide dept of person whom the request is sent ");
$('.form-control-select_dept').focus();
return false;
}
if( name ==''){
  $('#pname, #godown, #purpose').css("border","1px solid #D3D3D3");
  $('.form-control-select_dept').css("border","1px solid #D3D3D3");
  $('.form-control-select_project').css("border","1px solid #D3D3D3");

$('.ass_name').css("border","2px solid #ec1313");
alert("Provide name of asset  ");
$('.ass_name').focus();
return false;
}
if(  uom ==''){
$('. uom').css("border","2px solid #ec1313");
$('#pname, #godown, #purpose').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");

  $('.form-control-select_req').css("border","1px solid #D3D3D3");
  $('.form-control-select_dept').css("border","1px solid #D3D3D3");
$('.form-control-select_name').css("border","1px solid #D3D3D3");

alert("Please provide uom no for asset required");
$('. uom').focus();
return false;
}
if(  qty ==''){
$('#qty').css("border","2px solid #ec1313");
$('#pname,#godown, #purpose,#uom').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");

  $('.form-control-select_req').css("border","1px solid #D3D3D3");
  $('.form-control-select_dept').css("border","1px solid #D3D3D3");
$('.form-control-select_name').css("border","1px solid #D3D3D3");
alert("Please mention Qty of asset required");
$('#qty').focus();
return false;
}
if( itemdesc ==''){
$('#itemdesc').css("border","2px solid #ec1313");
$('#pname, #godown, #purpose,#uom,#qty').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");

  $('.form-control-select_req').css("border","1px solid #D3D3D3");
  $('.form-control-select_dept').css("border","1px solid #D3D3D3");
$('.form-control-select_name').css("border","1px solid #D3D3D3");
alert("Please mention specification of asset");
$('#itemdesc').focus();
return false;
}

if(  message ==''){
$('#message').css("border","2px solid #ec1313");
$('#pname, #godown, #purpose').css("border","1px solid #D3D3D3");
$('.form-control-select_project').css("border","1px solid #D3D3D3");

  $('.form-control-select_req').css("border","1px solid #D3D3D3");
  $('.form-control-select_dept').css("border","1px solid #D3D3D3");
$('.form-control-select_name').css("border","1px solid #D3D3D3");
alert("Please mention message for your apply");
$('#message').focus();
return false;
}
if( req_to ==''){
  $('#pname, #godown, #purpose,#message,#qty,#itemdesc').css("border","1px solid #D3D3D3");
  $('.form-control-select_project').css("border","1px solid #D3D3D3");

    $('.form-control-select_req').css("border","1px solid #D3D3D3");
  $('.form-control-select_dept').css("border","1px solid #D3D3D3");
$('.form-control-select_name').css("border","1px solid #D3D3D3");
$('.form-control-select').css("border","2px solid #ec1313");
alert("Provide name of person whom the request is sent ");
$('.form-control-select').focus();
return false;
}

});
  });
    </script>
    <script type="text/javascript">
     $(document).ready(function(){
      $("#reset").on("click", function () {
     window.location.href = "aset_pr_form.php";
});
     }); 
    </script>
   



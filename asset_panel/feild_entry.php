<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
 <?php
if(isset($_POST['tsksbmt'])) // Add query
{    # code...

$subtype = $_POST['itemtype'];
$total = count($_POST['feildentry']);

for($i = 0; $i < $total; $i++) { 
        $add_item = mysqli_real_escape_string($con, $_POST['feildentry'][$i]);
        
         if(isset($_POST['feildentry'][$i])){

          if(($_POST['feildentry'][$i] )!=""){


            $vw_details = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE`feild_name` ='$add_item'") ;
             if(mysqli_num_rows($vw_details) > 0) 
             {

              echo '<script>alert(" Field already exsist..")</script>';
             }


    
$sql=  "INSERT INTO `aset_feild_entry` (`sub_type_id`, `feild_name`, `status`) VALUES ('$subtype ','$add_item', '1')";
$sql2 = mysqli_query($con, $sql);
}
 if($sql2) { 
  //include_once('TelegramTask.php'); // Telegram Notification
  $msg="Field entered successfully"; 
  header("Location: feild_entry.php?msg=$msg");
  }


else {
  $msgel="Unsuccessfull in entering field...retry again";
}

}
}
  // echo $add_item;
}

?>


<?php
      if(isset($_GET['id'])){
              $id = $_GET['id'];
            
           

              $vw = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE id=$id "); 
              $ftch_dtl = mysqli_fetch_object($vw);
              if(isset($_POST['reqsubmit'])) // Add query
      {
        $subtype = $ftch_dtl->sub_type_id;
        // echo $subtype;
        $total = count($_POST['feildentry']);


        for($i = 0; $i < $total; $i++)
         { 
        
          if(isset($_POST['hidden_feild_entry'][$i]))
          {
            $add_item = mysqli_real_escape_string($con, $_POST['feildentry'][$i]);
          // hidden value
            $total_entry = mysqli_real_escape_string($con, $_POST['hidden_feild_entry'][$i]);

            $query1 = "UPDATE `aset_feild_entry` SET `sub_type_id`='$subtype',`feild_name`='$add_item' WHERE id =$total_entry";

            $sql1 = mysqli_query($con, $query1);
         
              if($sql1) { $upmsg=" Your data is updated."; }
 }
          else{

         
          
            $add_item = mysqli_real_escape_string($con, $_POST['feildentry'][$i]);
            
            

            $vw_details = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE`feild_name` ='$add_item'") ;
             if(mysqli_num_rows($vw_details) > 0) 
             {

              echo '<script>alert(" Field already exsist")</script>';
             }
             else{
              if(isset($_POST['feildentry'][$i]))
              {
              if(($_POST['feildentry'][$i] )!="")
              {
            $sql=  "INSERT INTO `aset_feild_entry` (`sub_type_id`, `feild_name`, `status`) VALUES ('$subtype ','$add_item', '1')";
            $sql2 = mysqli_query($con, $sql);
            if($sql2) { $upmsg=" Your data is updated."; }
          }
         
          }
        }

        }

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
       
        <title>Add Asset Item Field: Suryam Group</title>

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
          
               $(wrapper).append('<div id="append" class = "row"><div class="col-lg-3"><div class="form-group"><input type="text" class="form-control" name="feildentry[]" id="feild" placeholder="Enter feild name" ></div></div> <button class="btn btn-danger btn-xs remove_field">x</button></div>'); //add input box
    } 
    
    $('#feildlabel'+x).selectize({
        sortField: 'text'
          });
    
    
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#append').remove(); x--;
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
                        <h4 class="page-header">Field Entry</h4>
                       <span><button onClick='javascript:location.href="view.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                </span>
              
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                    
        <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
         
        <?php if(isset($upmsg)) { echo "<i style=color:#33D15B;>".$upmsg."</i>"; } ?>
        <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?>

          <form name="form" method="post" class="forms-sample">
                <fieldset>
                        <legend><h5><b>Asset Field Entry:</b></h5></legend> 
                  <div class="row">
                  
                    <div class="col-lg-6">
                      <div class="form-group">

                          <label for="itemtype">Under Sub Type</label>

                              <select name="itemtype" id="itemtype" class="form-control" value="" <?php if (isset($_GET['id'])) {

                                echo " disabled='disabled'";
                              } ?> >
                                <option value="">--Select Sub-Type--</option>
                                          <?php

                                            $eq = "SELECT * FROM `fin_grouping_subtype` WHERE `status`='1' AND   `undergrp` = 'TYPE' AND `grptypnm` = '1'";
                                            $efq=mysqli_query($con,$eq); 

                                            while ($egq = mysqli_fetch_object($efq))
                                                {
                                                  $select='';
                                                  if($egq->id==$ftch_dtl->sub_type_id){
                                                  $select='selected';
                                                } 
                                                   echo '<option value="'. $egq->id . '"'.$select.'>'.$egq->subtypenm.'</option>';
                                                }
                                        ?>
                                </select>

                        </div>
                    </div>
                
                
               </div>
               <div class="col-lg-12">
                        <div id="field_entry"></div>
                      </div>
                      <div class="col-lg-12">
                        <div id="field_entry_vechile"></div>
                      </div>
                      <div class="col-lg-12">
                        <div id="field_add"></div>
                      </div>

               
            <?php
                                if(isset($_GET['id'])){
                                  ?>
             <div class="input_fields_wrap">
             <div class="row">
                     
                <div class="col-lg-3">
                  <div class="form-group">
                          

                    <label for="feildlabel">Add Additional Information:</label>
           
                             
          
         <?php

                                      $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '".$ftch_dtl->sub_type_id."' "); 
                                      while($ftch = mysqli_fetch_object($vet))
                                      {
                                        $total = count($ftch->feild_name);
                                            for($i = 0; $i < $total; $i++) { 


                              ?>             
                          <input type="text" class="form-control" name="feildentry[]" id="feild[]" value="<?php if(isset($_GET['id'])){echo  $ftch->feild_name; }?>" placeholder="Enter field name"  required="required"><br>
                          <input type="hidden" class="form-control" name="hidden_feild_entry[]" id="feild[]"value="<?php if(isset($_GET['id'])){echo  $ftch->id; }?>" required="required">
                          <?php 

                                                                               }
                                      }
                                                        

                                                   ?>
                          <!-- ID For Who given the Task -->
                        </div>
                      </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <button class="btn btn-primary btn-xs add_field_button">+</button>
                        </div>
                    </div>
              </div>
          </div> 
            
<?php } ?>
            
            </fieldset>

        <div class="col-lg-12">
            <input type="submit" name="<?php if(isset($_GET['id'])){echo 'reqsubmit';} else{echo 'tsksbmt';}?>"  id="<?php if(isset($_GET['id'])){echo 'reqsubmit';} else{echo 'tsksbmt';}?>"
                   value="<?php if(isset($_GET['id'])) { echo 'UPDATE';} else { echo 'SUBMIT' ;} ?>" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >  
        </div>                   
                    
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

        <script type="text/javascript">
  
  
    $(document).ready(function() {
        $("#tsksbmt").css("visibility", "hidden");
  $("#itemtype").change(function(){

   // var state = $(this).val();
    var subtype = $("#itemtype").val();

 

    if( subtype != ''){

          $.ajax({
            url:"feil_entry1.php",
            data:{s_id:subtype},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#field_entry").html(sd);
               
            }
          });
          $.ajax({
            url:"add_field.php",
            data:{s_t:subtype},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#field_add").html(sd);
               
            }
          });
           if( subtype == '6'){

          $.ajax({
            url:"field_entry2.php",
            data:{s_ty:subtype},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#field_entry_vechile").html(sd);
               // loaddate();
            }
          });
    }
    else{
       $("#field_entry_vechile").html('');
    }
    $("#tsksbmt").css("visibility", "visible");
        }
        
      });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    

    var subtype = $("#itemtype").val();


    if( subtype != ''){

          $.ajax({
            url:"feil_entry1.php",
            data:{s_id:subtype},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#field_entry").html(sd);
               
            }
          });
          
           if( subtype == '6'){

          $.ajax({
            url:"field_entry2.php",
            data:{s_ty:subtype},
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);
              $("#field_entry_vechile").html(sd);
               // loaddate();
            }
          });
    }
    else{
       $("#field_entry_vechile").html('');
    }
    
        }
  });

</script>



    </body>
    <script type="text/javascript">
    $(document).ready(function(){
    
$("#tsksbmt").click(function(){
    
var subtype = $("#itemtype").val();
var feild_name = $("#feildentry").val();

// var tname = $("#tname").val();

// Checking for Blank Fields.

if( subtype ==''){
$('#itemtype').css("border","2px solid #ec1313");
alert("Please select sub-type");
$('#itemtype').focus();
return false;
}
if( feild_name ==''){
$('#feildentry').css("border","2px solid #ec1313");
alert("Provide your desired feild");
$('#feildentry').focus();
return false;
}


else {
    return true;
}

});
});

</script>
</html>

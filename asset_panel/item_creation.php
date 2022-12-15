<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['itemsbmt']))
{

    $name = $_POST['item_name'];
  $matid = $_POST['itemname'];
    $UOM = $_POST['itemno'];
    $HSN = $_POST['itemcode'];
      $subtype = $_POST['itemtype'];
      $consumable = $_POST['consumable'];
    $description = $_POST['itemdesc'];
    $asset_type = $_POST['usertype'];
    if($asset_type == 'Admin')
    {
      $asset_code = $_POST['asetcode'];
    }
    else
    {
      $asset_code = '';
    }


   //echo $sub_category = $_POST['sub_category'];
  
    //$inrtqry="INSERT INTO `aset_item_creation` (`name`, `uom`, `hsn`, `sub_type`,`consumable`,`description`,`asset_type`,`asset_code`,`status`) VALUES ('$name', '$UOM','$HSN','$subtype','$consumable', '$description','$asset_type','$asset_code', '1')";
  $inrtqry="INSERT INTO `aset_item_creation` (`name`, `uom`, `hsn`, `sub_type`,`consumable`,`description`,`asset_type`,`asset_code`,`prj_matid`,`status`) VALUES ('$name', '$UOM','$HSN','$subtype','$consumable', '$description','$asset_type','$asset_code', '$matid', '1')";


    $sqlqry = mysqli_query($con , $inrtqry);
    $last_id = mysqli_insert_id($con);
   echo $category = count($_POST['category']);
   for($i = 0; $i < $category ; $i++ )
   {
    $k = $i+1;
   //echo $i;
     $category_item = mysqli_real_escape_string($con, $_POST['category'][$i]);
     if($category_item != '')
     {
   if(isset($_POST['sub_category'.$k]))
   {
   $subcategory = count($_POST['subcategory'.$k]);
   for($j = 0; $j < $subcategory; $j++)
   {
    

    $subcategory_item = mysqli_real_escape_string($con, $_POST['subcategory'.$k][$j]);

   if($subcategory_item != '')
   {
      $category_insert = mysqli_query($con,"INSERT INTO `asset_category` (`asset_id`, `category`, `sub_category`,`status`) VALUES ('$last_id ','$category_item', '$subcategory_item','1')");
      //echo "INSERT INTO `asset_category` (`asset_id`, `category`, `sub_category`,`status`) VALUES ('$last_id ','$category_item', '$subcategory_item','1')";
    }
    
   }
 }
 else
 {
   $category_insert = mysqli_query($con,"INSERT INTO `asset_category` (`asset_id`, `category`,`status`) VALUES ('$last_id ','$category_item','1')");
      //echo "INSERT INTO `asset_category` (`asset_id`, `category`,`status`) VALUES ('$last_id ','$category_item','1')";
 }
}
}
  

if($sqlqry ){
      
      $msg="Field entered successfully";
      header("Location: item_creation.php?msg=$msg");
  }
  else {

       $msgel="Unsuccessfull in entering field...retry again";
}


}
// if(isset($_POST['itemview']))
// {
//     header("Location: listing.php"); 
// }


?>
<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $vw = mysqli_query($con,"SELECT * FROM `aset_item_creation` WHERE id=$id "); 
        $ftch_dtl = mysqli_fetch_object($vw);
if(isset($_POST['upreqsubmit'])) // Add query
{
  $item_type = $_POST['consumable'];
$name = $_POST['item_name'];

  $matid = $_POST['itemname'];
    $UOM = $_POST['itemno'];
    $HSN = $_POST['itemcode'];
    $subtype = $_POST['itemtype'];
    $description = $_POST['itemdesc'];
     $asset_type = $_POST['usertype'];
    if($asset_type == 'Admin')
    {
      $asset_code = $_POST['asetcode'];
    }
    else
    {
      $asset_code = '';
    }

// hidden value
    




//$query1 = "UPDATE `aset_item_creation` SET `consumable`='$item_type', `name`='$name',`UOM`='$UOM',`hsn`='$HSN',`sub_type`='$subtype',`description`='$description',`asset_type`='$asset_type',`asset_code`='$asset_code',`status`='1' WHERE id = $id ";
$query1 = "UPDATE `aset_item_creation` SET `consumable`='$item_type', `name`='$name',`UOM`='$UOM',`hsn`='$HSN',`sub_type`='$subtype',`description`='$description',`asset_type`='$asset_type',`asset_code`='$asset_code', `prj_matid`='$matid',`status`='1' WHERE id = $id ";

$sql1 = mysqli_query($con, $query1);
     
    $total = count($_POST['category']);
   // $fetch_category = mysqli_query($con,"SELECT * FROM `asset_category` WHERE `asset_id` = '$id' AND `status`='1' GROUP BY `category` ORDER BY `id`");
    for($e = 0; $e < $total; $e++)
    {
  

  
// $category_item = mysqli_real_escape_string($con, $_POST['category'][$f]);
 if(!isset($_POST['hidden_category'][$e]))
 {
$f = $e+1;
  $category_item = mysqli_real_escape_string($con, $_POST['category'][$e]);
  if($category_item != '')
  {

   if(isset($_POST['sub_category'.$f]))
   {
   $subcategory = count($_POST['subcategory'.$f]);
   for($j = 0; $j < $subcategory; $j++)
   {
    

    $subcategory_item = mysqli_real_escape_string($con, $_POST['subcategory'.$f][$j]);

   if($subcategory_item != '')
   {
      $category_insert = mysqli_query($con,"INSERT INTO `asset_category` (`asset_id`, `category`, `sub_category`,`status`) VALUES ('$id','$category_item', '$subcategory_item','1')");
      //echo "INSERT INTO `asset_category` (`asset_id`, `category`, `sub_category`,`status`) VALUES ('$id','$category_item', '$subcategory_item','1')";
    }
    
   }
 }
  else
 {
   $category_insert = mysqli_query($con,"INSERT INTO `asset_category` (`asset_id`, `category`,`status`) VALUES ('$id','$category_item','1')");
     // echo "INSERT INTO `asset_category` (`asset_id`, `category`,`status`) VALUES ('$id','$category_item','1')";
 }
}
 }
 else{
  $h = $e+100;
  if(isset($_POST['hidden_category'][$e]))
  {
     $category_item = mysqli_real_escape_string($con, $_POST['category'][$e]);
    $hidden_category = mysqli_real_escape_string($con,$_POST['hidden_category'][$e]);

    $check_update = mysqli_query($con,"SELECT * FROM `asset_category` WHERE `asset_id` = '$id' AND `id`='$hidden_category'");
    $check_value = mysqli_fetch_object($check_update);
    $check_group = mysqli_query($con,"UPDATE `asset_category` SET `category`='$category_item' WHERE `category` ='$check_value->category' AND  `asset_id` = '$id'");

    $subcategory = count($_POST['subcategory'.$h]);

   
    for($k = 0; $k < $subcategory; $k++)
   {
    if(!isset($_POST['hidden_subcategory'.$h][$k]))
    {
      $subcategory_item = mysqli_real_escape_string($con, $_POST['subcategory'.$h][$k]);
     if($subcategory_item != '')
     {
       
     
      $hidden_subcategory = mysqli_real_escape_string($con, $_POST['hidden_subcategory'.$h][$k]);
      if($k == 0)
      {
     $category_update = mysqli_query($con,"UPDATE `asset_category` SET `sub_category`='$subcategory_item' WHERE id =$hidden_category ");
     //echo "UPDATE `asset_category` SET `sub_category`='$subcategory_item' WHERE id =$hidden_category";
}
else
{
   $category_insert = mysqli_query($con,"INSERT INTO `asset_category` (`asset_id`, `category`, `sub_category`,`status`) VALUES ('$id','$category_item', '$subcategory_item','1')");
   //echo "INSERT INTO `asset_category` (`asset_id`, `category`, `sub_category`,`status`) VALUES ('$id','$category_item', '$subcategory_item','1')";
}
    }
  }
    else {
       $subcategory_item = mysqli_real_escape_string($con, $_POST['subcategory'.$h][$k]);
      $hidden_subcategory = mysqli_real_escape_string($con, $_POST['hidden_subcategory'.$h][$k]);
     $category_update = mysqli_query($con,"UPDATE `asset_category` SET `sub_category`='$subcategory_item' WHERE id =$hidden_subcategory ");

    }
    
  }



 }
    }
  }
    // exit();



if($sql1) { 

 
  $upmsg=" Your data is updated."; 
  header("Location: item_creation.php?msg=$upmsg&id=$id");

}


}
        //echo $ftch_dtl->fullname;
      }
     ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title> Asset Item Creation : Suryam Group</title>

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
    <script src="../../js/clock.js" type="text/javascript"></script>
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
$(document).ready(function() {
      var max_fields      = 5;//Maximum input boxes allowed
    var wrapper         = $(".categorycon"); //Fields wrapper
    var add_button      = $(".add_field_button"); 
    //Add button ID

 
   
if($('#hidden_count').val() != '')
{
  var count = parseInt($('#hidden_count').val());
  var x = parseInt(count) + parseInt("1");

  // var max_fields = parseInt(x)+parseInt("5");
  // alert(max_fields);
  
}
else{
   var x = 1;
  
}
var w =1;
  
   
   //initlal text box count
     //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(w < max_fields){ //max input box allowed
            //text box increment
w++;
if($('#hidden_count').val() == '')
{
  x++;
}

           $(wrapper).append('<div id="append" class="col-lg-10" style="border-style: double; padding:5px; margin-top:5px;" ><div class="col-lg-5"><div class="form-group"><label for="category">Category:</label><input type="text" class="form-control" name="category[]" id="category" placeholder="Enter category name" ></div></div><div class="col-lg-5"><div class="form-group"><label for="subcategory">Is Sub-Category Required?</label><input type="checkbox" id="sub_category'+x+'" name="sub_category'+x+'" value="subcategory'+x+'" data-id="'+x+'"><div id="subcategorycon'+x+'" ><div class="col-lg-10"><div class="form-group"><label for="subcategory">Sub-Category:</label><input type="text" class="form-control" name="subcategory'+x+'[]" id="subcategory'+x+'" placeholder="Enter subcatergory name" ></div></div><div class="col-lg-2"> <div class="form-group"><button type="button" class="btn btn-primary btn-xs" id="subcat'+x+'" data-id="'+x+'">+</button></div></div></div> </div></div><button type="button" class="btn btn-warning" id="rmv_tbl">X</button></div>'); //add input box


 
    } 
 
      //Sub 

//Fields wrapper


  
    
        
     //on add input button click
        e.preventDefault();

    $('#subcategorycon'+x).hide();
        $('#sub_category'+x).click(function () {
          var chid=$(this).data('id');
           $('#subcategorycon'+chid).hide();
            if ($(this).is(":checked")) {
              
             
                $('#subcategorycon'+chid).show();

            } 
            else {
             // alert(chid);
                $('#subcategorycon'+chid).hide();
                // $('#subcategorycon'+chid).css('display','none');
               // $('#subcategorycon'+x).hide();
            }
        

    if($('#hidden_count').val() != '')
{
x++;
}


        var y = 1;
        var wrapper_sub = $("#subcategorycon"+chid); 
          $("#subcat"+chid).click(function(e){
        if(y < max_fields){ //max input box allowed
            y++; //text box increment
            
         

           $(wrapper_sub).append('<div id="sub_append" class="col-lg-12"><div class="col-lg-10" ><div class="form-group"><input type="text" class="form-control" name="subcategory'+chid+'[]" id="subcategory" placeholder="enter subcategory name" ></div></div> <button type="button" class="btn btn-danger btn-xs remove_field_subcategory" id="sub_remove" style="margin-left:25px;">x</button></div>'); //add input box
    } 
    
    /*$('#feildlabel'+x).selectize({
        sortField: 'text'
          });*/
    
    
    });
     $(wrapper_sub).on("click","#sub_remove", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#sub_append').remove(); y--;
    })
    
   
   
    
   }); 





        
   


   
 

   });
     $(wrapper).on("click","#rmv_tbl", function(e){ //user click on remove text
          $(this).parent('#append').remove(); x--;
        });
  
  
      
});
</script>  
<?php
if(isset($_GET['id']))
{
?>      
 <script type="text/javascript">
   $(document).ready(function() {
    
     //Maximum input boxes allowed
    var add_button_subcategory= $(".add_field_button_sub_category_getid"); //Add button ID
      //Fields wrapper
  
     //initlal text box count
      
    $(add_button_subcategory).click(function(e){
       var getid=$(this).data('id');
       
       var y=1;
     
    var max_fields = 5;
     //alert(getid);
     var wrapper_sub         = $("#subcategorycon"+getid);

     //on add input button click
        e.preventDefault();
        if(y < max_fields){ //max input box allowed
            //text box increment
            var dataid=$(this).data('id');
         
         y++;

           $(wrapper_sub).append('<div id="sub_append" class="col-lg-12"><div class="col-lg-4" style="margin-left:410px;"><div class="form-group"><input type="text" class="form-control" name="subcategory'+getid+'[]" id="subcategory" placeholder="enter subcategory name" ></div></div> <button type="button" class="btn btn-danger btn-xs remove_field_subcategory" >x</button></div>'); //add input box
    } 
    
    /*$('#feildlabel'+x).selectize({
        sortField: 'text'
          });*/
     $(wrapper_sub).on("click",".remove_field_subcategory", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#sub_append').remove(); y--;
    })
    
    });
     
   
   
});
 </script>
 <?php
}

?>

<script type="text/javascript">
$(document).ready(function() {
    var max_fields = 5; //Maximum input boxes allowed
    var add_button_subcategory= $(".add_field_button_sub_category"); //Add button ID
     var wrapper_sub         = $("#subcategorycon1"); //Fields wrapper
   
    var y = 1; //initlal text box count
    $(add_button_subcategory).click(function(e){ 
    //on add input button click
        e.preventDefault();
        if(y < max_fields){ //max input box allowed
            y++; //text box increment
            var dataid=$(this).data('id');
            //alert(dataid);
         

           $(wrapper_sub).append('<div id="sub_append" class="col-lg-12"><div class="col-lg-10"><div class="form-group"><input type="text" class="form-control" name="subcategory1[]" id="subcategory" placeholder="enter subcategory name" ></div></div> <button type="button" class="btn btn-danger btn-xs remove_field_subcategory" style="margin-left:25px;">x</button></div>'); //add input box
    } 
    
    /*$('#feildlabel'+x).selectize({
        sortField: 'text'
          });*/
    
    
    });
   
    $(wrapper_sub).on("click",".remove_field_subcategory", function(e){ //user click on remove text
        e.preventDefault(); 
    $(this).parent('#sub_append').remove(); y--;
    })
  $('#itemname').selectize({
        sortField: 'text'
          });
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
                        <h4 class="page-header">Item Creation</h4>
                       <span><button onClick='javascript:location.href="listing.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                </span>
                <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                        <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
                        <?php if(isset($upmsg)) { echo "<i style=color:#33D15B;>".$upmsg."</i>"; } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
               
                <!-- /.row -->
                <div class="row">

                     <form name="form" method="post" class="forms-sample" >
                      
                <fieldset>
                    <legend><h5><b>&nbsp;</b></h5></legend>  
            <div class="input_fields_wrap">
              
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="consumable">Item Type</label>
                   <select name="consumable" id="consumable" class="form-control" >
                    <option value="">--Select Variety Type--</option>
                     
                       <option value="Asset" <?php if(isset($_GET['id'])){if($ftch_dtl->consumable == 'Asset'){echo "selected";}}?>>Asset</option>
                     <option value="Consumable" <?php if(isset($_GET['id'])){ if($ftch_dtl->consumable == 'Consumable'){echo "selected";}}?>>Consumable</option>
                     
                    

                   </select>

                </div>
              </div>
                <div class="col-lg-3">
                    <div class="form-group">
                      <label for="itemname">Item Name</label>
                      <?php $query = "SELECT `prj_matid` as zz FROM `aset_item_creation`";
            $result = mysqli_query($con, $query);
            while($matfq=mysqli_fetch_object($result)){ 

            $mat_id_ref[] = "'".$matfq->zz."'";
            $rfrn = implode(",",$mat_id_ref);

}?>
<?php if(isset($_GET['id'])){
	$sql_fetchs = mysqli_query($con,"SELECT * FROM `prj_material` WHERE status='1' AND `id` =".$ftch_dtl->prj_matid);

              $fetch = mysqli_fetch_object($sql_fetchs);
				  ?>
<select name="itemname" class="form-control" required="">
  <option value='<?php echo $ftch_dtl->prj_matid;?>'><?php echo $fetch->material_name;?></option>
  </select>
  <?php } else {?>
              <select name="itemname" class="form-control" id="itemname" required="">
                            <option value="">--Select Material--</option>
                            
          <?php 
          $sql_fetchs = mysqli_query($con,"SELECT * FROM `prj_material` WHERE status='1' AND `id` NOT IN(".$rfrn.") ");

              while ($fetch = mysqli_fetch_object($sql_fetchs)) {
                ?>
                 <option value='<?php echo $fetch->id;?>'><?php echo $fetch->material_name;?></option>
<?php                
               }
                 ?>
                 
                          </select>
  <?php }?>           
                      <input type="hidden" name="item_name" id="item_name" value="<?php if(isset($_GET['id'])){echo $fetch->material_name; }?>"  >
                      <!-- ID For Who given the Task -->
                    </div>
                  </div>
                 <div class="col-lg-3">
                    <div class="form-group">
                      <label for="itemno">UOM</label>
                      <input type="text" class="form-control" name="itemno" id="itemno" readonly value="<?php if(isset($_GET['id'])){echo $ftch_dtl->UOM; }?>"   >
                      <!-- ID For Who given the Task -->
                    </div>
                  </div>
                    <div class="col-lg-3">
                    <div class="form-group">
                      <label for="itemcode">HSN Code:</label>
                      <input type="text" class="form-control" name="itemcode" id="itemcode" readonly value="<?php if(isset($_GET['id'])){echo $ftch_dtl->hsn; }?>"   >
                      <!-- ID For Who given the Task -->
                    </div>
                  </div>
                        <div class="col-lg-3" style="clear: both;">  
                                <div class="form-group"> 
                                        <label for="itemtype">Under Sub Type</label>
                                        <select name="itemtype" id="itemtype" class="form-control" value=""  >
                                            <option value="">--Select Sub-Type--</option>
                                            <?php
                                            
                        $eq = "SELECT * FROM `fin_grouping_subtype` WHERE `status`='1' AND   `undergrp` = 'TYPE' AND `grptypnm` = '1'";
                        $efq=mysqli_query($con,$eq); 

                        while ($egq = mysqli_fetch_object($efq))
                            {
                              $select='';
                            if($egq->id==$ftch_dtl->sub_type){
                              $select='selected';
                            } 
                          echo '<option value="'. $egq->id . '"'.$select.'>'.$egq->subtypenm.'</option>';
                            }
                      ?>
                                        </select> 
                                </div>               
                    </div>
                      <div class="col-lg-3">    
                    
                    <div class="form-group">
                      <label for="itemdesc">Description</label>
                       <textarea name="itemdesc" id="itemdesc" class="form-control" rows="2" ><?php if(isset($_GET['id'])){echo $ftch_dtl->description; }?></textarea>

                       <!-- <input type="text" name="itemdesc" id="itemdesc" class="form-control" rows="2" value="<?php if(isset($_GET['id'])){echo $ftch_dtl->description; }?>" > -->
                       </div>
                    </div>
                         <div class="col-lg-3">
                <div class="form-group">
                  <label for="usertype">User Type</label>
                   <select name="usertype" id="usertype" class="form-control" >
                    <option value="">--Select User Type--</option>
                     
                       <option value="Admin" <?php if(isset($_GET['id'])){if($ftch_dtl->asset_type == 'Admin'){echo "selected";}}?>>Admin</option>
                     <option value="User" <?php if(isset($_GET['id'])){ if($ftch_dtl->asset_type == 'User'){echo "selected";}}?>>User</option>
                     
                    

                   </select>

                </div>
              </div>                    
              <?php
              if(isset($_GET['id']))
              {
              if( $ftch_dtl->asset_type == 'Admin') 
              {
              ?>
              <div id="load_code">
               <div class="col-lg-3" >
                 <div class="form-group">

               <label for="asetcode">Asset Code</label>
               <input type="text" class="form-control" name="asetcode" id="asetcode" value="<?php if(isset($_GET['id'])){echo $ftch_dtl->asset_code; }?>"   >
              </div>
              </div>
            </div>
           
              <?php
            }
          }
            else{
              ?>
              <div class="col-lg-3" id="show_cde">
                 <div class="form-group">
               <label for="asetcode">Asset Code</label>
                      <input type="text" class="form-control" name="asetcode" id="asetcode" value="<?php if(isset($_GET['id'])){echo $ftch_dtl->hsn; }?>"   >
              </div>
              </div>
            
              <?php
            }
              ?>

            
            <?php
            $asset_code_list = array();
            $asset_code = mysqli_query($con,"SELECT `asset_code` FROM `aset_item_creation` WHERE `status` = '1' AND `asset_type` = 'Admin'");
            if(mysqli_num_rows($asset_code)>0)
            {
              while($fetch_code = mysqli_fetch_object($asset_code))
              {
                $asset_code_list[] = $fetch_code->asset_code;
              }
   
            }

            ?>
            <?php
             if(isset($_GET['id']))
             {
              $got_id = $_GET['id'];
              $fetch_id = mysqli_query($con,"SELECT * FROM `asset_category` WHERE `asset_id` = '$got_id' AND `status`='1' GROUP BY `category` ORDER BY `id`");
              //echo "SELECT * FROM `asset_category` WHERE `asset_id` = '$got_id' AND `status`='1' GROUP BY `category` ORDER BY `id`";
              
                // $fetch_data = mysqli_fetch_object($fetch_id);
                ?>
                <div class="col-lg-12">
                   <div class="form-group">
                <label for="category">Is Category Required?</label>
                <input type="checkbox" id="category" name="category" value="category" <?php if(mysqli_num_rows($fetch_id)>0){?>checked="checked"<?php } ?>>
              </div>
            </div>
            <?php
            if(mysqli_num_rows($fetch_id)>0)
            {
              ?>
            
               <div class="col-lg-10" style="border-style: double; padding: 5px;">
                <div class="form-group">
                    <label for="category">Category:</label>
                  </div>
                            <?php
                    $d=100;
                    $count_total = mysqli_num_rows($fetch_id);
                 while($fetch_category = mysqli_fetch_object($fetch_id))
                 {


                    ?>
                         <div class="col-lg-5">
                    <input type="text" class="form-control" name="category[]" id="category" value="<?php echo $fetch_category->category ;?>" style="margin-bottom: 10px;">
                    <input type="hidden" name="hidden_category[]" id="hidden_category[]" class="form-control" value="<?php echo $fetch_category->id;?>">

                  </div>
                    <div class="col-lg-5">
              <div class="form-group">
                <label for="subcategory">Is Sub-Category Required?</label>
                <input type="checkbox" id="sub_category<?php echo $d; ?>" name="sub_category<?php echo $d; ?>" value="subcategory" <?php if($fetch_category->sub_category != ''){echo "checked ";}?>>
                </div>
              </div>
                <div class="col-lg-1">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-xs add_field_button_sub_category_getid" id=" add_field_button_sub_category_getid" data-id="<?php echo $d; ?>">+</button>
                        </div>
                      </div>
                 <?php
                if($fetch_category->sub_category != '')
                {
                $sub_cat_name = mysqli_query($con,"SELECT * FROM `asset_category` WHERE `asset_id` = '$got_id' AND `status`='1' AND `category` = '$fetch_category->category'");
                $c=1;
                while($subcat = mysqli_fetch_object($sub_cat_name))
                {



                ?>
                <div class="col-lg-4" style="margin-left: 420px;">

              
                 <input type="text" class="form-control" name="subcategory<?php echo $d;?>[]" id="subcategory" placeholder="Enter subcatergory name" value="<?php echo $subcat->sub_category; ?>" style="margin-bottom: 10px;" >
                 <input type="hidden" class="form-control" name="hidden_subcategory<?php echo $d;?>[]" id="hidden_subcategory" value="<?php echo $subcat->id; ?>" >
               </div>

                  
            
              

                <?php
                $c++;
              }
              ?>
               <div id="subcategorycon<?php echo $d; ?>" class="subcategorycon" > </div>
              <?php
            }
            else
            {
              ?>
              <div class="col-lg-4" style="margin-left: 420px;" id="showsubcategory<?php echo $d;?>" >
                 <div class="form-group">
                   <!--  <label for="subcategory">Sub-Category:</label> -->
                  <input type="text" class="form-control" name="subcategory<?php echo $d;?>[]" id="subcategory" placeholder="Enter subcatergory name"  >
                </div>
              </div>
              <div id="subcategorycon<?php echo $d; ?>" class="subcategorycon" > </div>
              
             
                     
                   
                
              
          
                    <?php
                  }
                    $d++;

                   }
                    ?>
               </div>
             </div>
                   <div class="col-lg-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-xs add_field_button">+</button>
                            <input type="hidden" name="hidden_count" id="hidden_count" value="<?php echo $count_total; ?>">
                        </div>
                    </div>
                     <div id="categorycon" class="categorycon" ></div>
              
                <?php
}
else
{
  ?>
                <div id="categorycon" class="categorycon" >

                  <div class="col-lg-10" style="border-style: double; ">
                   <div class="col-lg-5">
                  <div class="form-group">
                    <label for="category">Category:</label>
                  <input type="text" class="form-control" name="category[]" id="category" placeholder="Enter category name" >
                </div>
              </div>
               
                    <div class="col-lg-5">
              <div class="form-group">
                <label for="subcategory">Is Sub-Category Required?</label>
                <input type="checkbox" id="sub_category" name="sub_category1" value="subcategory">
                <div id="subcategorycon1" class="subcategorycon" >
                   <div class="col-lg-10" style="border-color: grey;">
                  <div class="form-group">
                    <label for="subcategory">Sub-Category:</label>
                  <input type="text" class="form-control" name="subcategory1[]" id="subcategory" placeholder="Enter subcatergory name"  >
                </div>
              </div>
                <div class="col-lg-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-xs add_field_button_sub_category" data-id="1">+</button>
                            
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-xs add_field_button">+</button>
                            <input type="hidden" name="hidden_count" id="hidden_count" value="">
                        </div>
                    </div>
                    </div>
  <?php

}
              
             }
             else
             {
            ?>
            <div class="col-lg-12">
           <!--  <div class="col-lg-4"> -->
              <div class="form-group">
                <label for="category">Is Category Required?</label>
                <input type="checkbox" id="category" name="category" value="category">
              </div>
                <div id="categorycon" class="categorycon" >

                  <div class="col-lg-10" style="border-style: double; ">
                   <div class="col-lg-5">
                  <div class="form-group">
                    <label for="category">Category:</label>
                  <input type="text" class="form-control" name="category[]" id="category" placeholder="Enter category name" >
                </div>
              </div>
               
                    <div class="col-lg-5">
              <div class="form-group">
                <label for="subcategory">Is Sub-Category Required?</label>
                <input type="checkbox" id="sub_category" name="sub_category1" value="subcategory">
                <div id="subcategorycon1" class="subcategorycon" >
                   <div class="col-lg-10" style="border-color: grey;">
                  <div class="form-group">
                    <label for="subcategory">Sub-Category:</label>
                  <input type="text" class="form-control" name="subcategory1[]" id="subcategory" placeholder="Enter subcatergory name"  >
                </div>
              </div>
                <div class="col-lg-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-xs add_field_button_sub_category" data-id="1">+</button>
                            <input type="hidden" name="hidden_count" id="hidden_count" value="">
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
                      <div class="col-lg-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-xs add_field_button">+</button>
                        </div>
                    </div>
                    </div>

              
             
           
         <!--      </div> -->
            
          
          <?php
        }
        ?>
                      

                    
                 
                <div class="col-lg-12" >
                
                  <input type="submit" name="<?php if(isset($_GET['id'])){echo 'upreqsubmit';} else{echo 'itemsbmt';}?>"  id="itemsbmt"
                   value="<?php if(isset($_GET['id'])) { echo 'UPDATE';} else { echo 'SUBMIT' ;} ?>" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;margin-top: 10px;" >  
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

    <script>
// Form Validation
$(document).ready(function(){
  
  $("#itemname").change(function() { 
                var mat_id = $(this).val();       
                
                  $.ajax({
                    url:"get_mtrls_aset.php",
                    data:{matid:mat_id},
                    type:'POST',
          dataType: "json",
                    success:function(response) {
            
                      
                      $("#item_name").val(response.material);
            $("#itemno").val(response.uom);
            $("#itemcode").val(response.hsn);

                    }
                  });
              


              });
    
$("#itemsbmt").click(function(){
var item_type = $("#consumable").val();    
var name = $("#itemname").val();
var UOM = $("#itemno").val();
var HSN = $("#itemcode").val();
var select = $('#itemtype').val();
var desc = $("#itemdesc").val();
var usertype = $("#usertype").val();
var assetcode = $("#asetcode").val();
// Checking for Blank Fields.
if(item_type == 0)
{
  $('#consumable').css("border","2px solid #ec1313");
alert("Please provide item type");
$('#consumable').focus();
return false;
}
if( name ==''){
  $('#consumable').css("border","1px solid #D3D3D3");
$('#itemname').css("border","2px solid #ec1313");
alert("Please provide item name");
$('#itemname').focus();
return false;
}
if( UOM ==''){
  $('#itemname').css("border","1px solid #D3D3D3");
$('#itemno').css("border","2px solid #ec1313");
alert("Provide UOM ");
$('#itemno').focus();
return false;
}
if( HSN ==''){
  $('#consumable').css("border","1px solid #D3D3D3");
   $('#itemname, #itemno').css("border","1px solid #D3D3D3");
$('#itemcode').css("border","2px solid #ec1313");
alert("Provide HSN code");
$('#itemcode').focus();
return false;
}
if( select ==''){
  $('#consumable').css("border","1px solid #D3D3D3");
   $('#itemname, #itemno, #itemcode').css("border","1px solid #D3D3D3");
$('#itemtype').css("border","2px solid #ec1313");
alert("Select sub type");
$('#itemname').focus();
return false;
}
if( desc ==''){
  $('#consumable').css("border","1px solid #D3D3D3");
     $('#itemname, #itemno, #itemcode, #itemtype').css("border","1px solid #D3D3D3");

$('#itemdesc').css("border","2px solid #ec1313");
alert("Provide description ");
$('#itemdesc').focus();
return false;
}
if( usertype ==''){
  $('#consumable').css("border","1px solid #D3D3D3");
     $('#itemname, #itemno, #itemcode, #itemtype,#itemdesc').css("border","1px solid #D3D3D3");

$('#usertype').css("border","2px solid #ec1313");
alert("Provide its user type");
$('#usertype').focus();
return false;
}
if( assetcode =='' && usertype =='Admin'){
  $('#consumable').css("border","1px solid #D3D3D3");
     $('#itemname, #itemno, #itemcode, #itemtype,#itemdesc,#usertype').css("border","1px solid #D3D3D3");

$('#asetcode').css("border","2px solid #ec1313");
alert("Provide the asset code for the admin listed asset ");
$('#asetcode').focus();
return false;
}

else {
    return true;
}

});
});

</script>
<?php
if(isset($_GET['id']))
{
?>
<script type="text/javascript">
  $(document).ready(function(){
  var usertype = $("#usertype").val();
   if(usertype == 'Admin')
    {
      $("#load_code").show();
      $("#usertype").change(function(){
        
          var usertype = $("#usertype").val();
          
           if(usertype == 'User')
            {
              $("#load_code").hide();
            } 

       });
    } 
    else{
       $("#load_code").hide();
       $("#usertype").change(function(){
    var usertype = $("#usertype").val();
    
    
    if(usertype == 'Admin')
    {
       $.ajax({
            url:"admin_asset_code.php",
           
            type:'POST',
            success:function(data) {
             
              var sd = $.trim(data);

              $("#load_code_inner").html(sd);
             
            }
          });
    }
  });

    }
  });
</script>
<?php
}
?>
<script type="text/javascript">
   $(document).ready(function(){
    $("#show_cde").hide();
  $("#usertype").change(function(){
    var usertype = $("#usertype").val();
    
    if(usertype == 'Admin')
    {
      $("#show_cde").show();

    }
    else
    {
      $("#show_cde").hide();
    }
   
});
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    if(!$("#asetcode").val()==''){
  $("#asetcode").blur(function(){
    asst = $(this).val();
    var lower_case = asst.toLowerCase();
    var jqueryarray = <?php echo json_encode($asset_code_list); ?>;
    //alert(lower_case);
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    if(jqueryarray.includes(lower_case)){
      alert("This already exists");

    }else if(format.test(asst)){
      alert('Special characters should not be included');   
    } 
  });
    //var asetcode = $('#asetcode').val();
        //
    }
  });
</script>
<?php
 if(!isset($_GET['id']))
              {
                ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#categorycon").hide();
        $("#category").click(function () {
            if ($(this).is(":checked")) {
                $("#categorycon").show();
            } else {
                $("#categorycon").hide();
            }
        });
      });
 
</script>

 <script type="text/javascript">
$(document).ready(function(){
  $("#subcategorycon1").hide();
        $("#sub_category").click(function () {
            if ($(this).is(":checked")) {
                $("#subcategorycon1").show();
            } else {
                $("#subcategorycon1").hide();
            }
        });
      });
 
</script>
    
<?php
}
else
{
$got_id = $_GET['id'];
$fetch_id = mysqli_query($con,"SELECT * FROM `asset_category` WHERE `asset_id` = '$got_id' AND `status`='1' GROUP BY `category` ORDER BY `id`");
  if(mysqli_num_rows($fetch_id)== 0)
  {
  ?>
  <script type="text/javascript">
$(document).ready(function(){
  $("#categorycon").hide();
        $("#category").click(function () {
            if ($(this).is(":checked")) {
                $("#categorycon").show();
            } else {
                $("#categorycon").hide();
            }
        });
      });
 
</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#subcategorycon1").hide();
        $("#sub_category").click(function () {
            if ($(this).is(":checked")) {
                $("#subcategorycon1").show();
            } else {
                $("#subcategorycon1").hide();
            }
        });
      });
 
</script>



   
  <?php
}
else
{
  $n =0;
  while($fetch_data_detail = mysqli_fetch_object($fetch_id))
  {
    if($fetch_data_detail->sub_category == '')
    {
      $p = $n+100;
      ?>
      <input type="hidden" name="var_value" id="var_value" value="<?php echo $p;?>">
       <script type="text/javascript">
$(document).ready(function(){
  value = $('#var_value').val();
  $("#showsubcategory"+value).hide();
        $("#sub_category"+value).click(function () {
            if ($(this).is(":checked")) {
                $("#showsubcategory"+value).show();
            } else {
                $("#showsubcategory"+value).hide();
            }
        });
      });
 
</script>
      <?php
    }

$n++;
  }
}
}
?>
</html>
   
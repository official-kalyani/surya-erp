<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      
     

        $vw = mysqli_query($con,"SELECT x.*,y.subtypenm FROM `aset_feild_entry` x, `fin_grouping_subtype` y WHERE  x.`id`='$id'and x.`sub_type_id` = y.`id` "); 
        $ftch_dtl = mysqli_fetch_object($vw);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>  </title>

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

   <style type="text/css">
       
       table,tr,td {
        text-align: center;
        
 

}
   </style>

 
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
                        <h4 class="page-header">Stock Details</h4>
                       <span><button onClick='javascript:location.href="view.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                </span>
              
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 
       

          <form>
              <div class="row">
                  

                       <div class="col-lg-6">
                      <div class="form-group">
                        <label for="itemname"> Sub Type:</label>
                         <?php echo $ftch_dtl->subtypenm; ?>
                         </div>
                    </div>
              </div>
              <input type="hidden" name="hidd_id" id="hidd_id" value="<?php echo $ftch_dtl->sub_type_id; ?>">
              <div class="col-lg-12">
                        <div id="field_entry"></div>
                      </div>
                      <div class="col-lg-12">
                        <div id="field_entry_vechile"></div>
                      </div>

              <div class="row">
                  

                       <div class="col-lg-6">
                      <div class="form-group">
                        <label for="itemname"> Field Name </label>
                        <ol>
                        <?php
                         if(isset($_GET['id'])){
      
     

        $vet = mysqli_query($con,"SELECT * FROM `aset_feild_entry` WHERE sub_type_id = '".$ftch_dtl->sub_type_id."' "); 
        // $ftch_data = mysqli_fetch_object($vet);
        while($ftch = mysqli_fetch_object($vet))
        {
          $total = count($ftch->feild_name);
for($i = 0; $i < $total; $i++) { 
   
                              // <!-- $ftch->feild_name; --> 
                              echo '<li>'. $ftch->feild_name . '</li>' ;


                         }
                    }
                    
                }
                    ?>
                    </ol>
                         </div>
                    </div>
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

    </body>
    <script type="text/javascript">
      $(document).ready(function() {

   // var state = $(this).val();
    var subtype = $("#hidd_id").val();

 

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
    </script>
</html>
    
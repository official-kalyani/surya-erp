<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      
     
$query = mysqli_query($con,"SELECT y.*,y.id as yid,z.* FROM  aset_stock_entry y,aset_stock_entry_vechile z WHERE  y.id = z.name_id AND y.id = '$id'  order by z.id");
$ftch = mysqli_fetch_object($query);
     // $name = $ftch->item_name;
     // $subtype = $ftch->sub_type;
 // $ider = $ftch->id;
 // echo $ider;
 //        $vw = mysqli_query($con,"SELECT y.*,y.id as yid,z.* FROM  aset_stock_entry y,aset_stock_entry_vechile z WHERE  y.id = z.name_id AND y.id = '$id'  order by z.id"); 
 //        $ftch_dtl = mysqli_fetch_object($vw);

 //    }

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Asset Update : Suryam Group</title>

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
<!-- <script type="text/javascript" src="../../calendar/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../../calendar/datepicker.css"/> -->
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
              <h4 class="page-header">View Insurance</h4>
                <span><button onClick='javascript:location.href="insurance.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
                  </span>
                  <?php if(isset($_GET['msg'])) { 
                   $msg = $_GET['msg'];
                  echo "<i style=color:#33D15B;>".$msg."</i>";
                   } ?>
                   <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
                         
              </div>
                    <!-- /.col-lg-12 -->
          </div>
          <div class="row">
           
            <form name="form" method="post" class="forms-sample" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-4">
          <div class="form-group">

                      <label for="ins_no">Asset No:</label>

                        <?php echo $ftch->auto_serial; ?>          
                    </div>
          </div>
           <div class="col-lg-3">
          <div class="form-group">

                      <label for="ins_no">Item Name:</label>

                        <?php echo $ftch->description; ?>          
                    </div>
          </div>
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="ins_no">Serial No:</label>

                        <?php echo $ftch->serial_no; ?>          
                    </div>
          </div>
          
                <div class="col-lg-4">
          <div class="form-group">

                      <label for="ins_no">Name of person assigned:</label>
                       <?php
                        $assaign = $ftch->auto_serial;
                        // echo $assaign;
                        $query1 = mysqli_query($con,"SELECT x.*,y.*,z.fullname,w.* FROM aset_stock_assaignment x,aset_stock_entry_vechile y,mstr_emp z,aset_stock_entry w WHERE x.assaign_to = z.id AND x.asset_no = w.auto_serial AND y.name_id = w.id AND w.auto_serial = '$assaign' ORDER BY x.id DESC LIMIT 1");

                        $fetch_name = mysqli_fetch_object($query1);
                        if(mysqli_num_rows($query1)>0 )
                        {
                        echo $fetch_name->fullname; 
                      }
                      else{
                        echo "Not assigned";
                      }
                        ?>         
                      
                    </div>
          </div>
           <div class="col-lg-3">
          <div class="form-group">

                      <label for="ins_no">Renew Date:</label>
                      <?php  
                        if(mysqli_num_rows($query1)>0 )
                        {
                        echo $fetch_name->assaign_dt; 
                      }
                      else{
                        echo "Not assigned";
                      }
                        ?>         
                    </div>
          </div>
           <?php
                       if($ftch->ins_comp != '')
                       {
                        ?> 
               <div class="col-lg-3">
          <div class="form-group">
            

                      <label for="ins_no">Insurance Company:</label>
                      <?php
                        echo $ftch->ins_comp;
                        ?>

                    </div>
          </div> 
                                  <?php

                       }
                       ?> 
                <div class="col-lg-4">
          <div class="form-group">

                      <label for="ins_no">Valid Upto:</label>

                        <?php echo $ftch->ins_valid; ?>          
                    </div>
          </div>
   
          <?php
if($ftch->ins_file != '')
{
?>
        
          <div class="col-lg-3">
          <div class="form-group">

                      <label for="att_ins">Attached Document:</label>

                            <a href="ve_ins/<?php echo $ftch->ins_file; ?>" target="_blank"><?php echo $ftch->ins_file; ?></a>         
                    </div>
          </div>
        <?php
        }
        ?>  
          
              </div>
            </form>
            </div>


      </div>

      
  
            <!-- /#page-wrapper -->
        <?php require_once('../../footer.php'); ?>
        </div>
        <!-- /#wrapper -->

       

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>
        <script src="../../js/startmin.js"></script>
        
        </html>

        <?php
      }
      ?>
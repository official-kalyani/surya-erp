<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>


<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      
     
$query = mysqli_query($con,"SELECT * FROM `aset_stock_entry` WHERE  id = '$id'");
while ($ftch = mysqli_fetch_object($query)) {
     // $name = $ftch->item_name;
     // $subtype = $ftch->sub_type;
 $ider = $ftch->id;
 echo $ider;
        $vw = mysqli_query($con,"SELECT x.*,z.name,z.sub_type,w.subtypenm FROM aset_stock_entry  x, aset_item_creation z,fin_grouping_subtype w WHERE x.id = '$ider'AND x.item_name = z.id AND z.sub_type = w.id"); 
        $ftch_dtl = mysqli_fetch_object($vw);

    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Add Asset Item Stock : Suryam Group</title>

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
              <h4 class="page-header">Stock Entry</h4>
                <span><button onClick='javascript:location.href="stock_view.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
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
              <fieldset>
                <legend><h5><b>Information:</b></h5></legend>  
      
                 
                <div class="row">

                     <div class="col-lg-4">
                      <div class="form-group">
                        <label for="serial">Serial No:</label>
                         <?php echo $ftch_dtl->auto_serial; ?>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Item Name:</label>
                         <?php echo $ftch_dtl->name; ?>
                      <!-- ID For Who given the Task -->
                      </div>
                    </div>
                        <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Name Of Asset:</label>
                         <?php echo $ftch_dtl->description; ?>
                      </div>
                    </div>
                     
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">QTY:</label>
                         <?php echo $ftch_dtl->qty; ?>
                      </div>
                  </div>
                   
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Sub Type:</label>
                         <?php echo $ftch_dtl->subtypenm; ?>
                      </div>
                    </div>
                     <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Date Of Purchase:</label>
                         <?php echo $ftch_dtl->date_purchase; ?>
                      </div>
                    </div>
                
                 
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Inv no:</label>
                         <?php echo $ftch_dtl->inv_no; ?>
                      </div>
                    </div>
                     <?PHP
                    if($ftch_dtl->att_inv != '')
                    {
                      ?>
                       <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname"> Inv. No Attached Data:</label>
                         <!-- <img src="attinv/<?php echo $ftch_dtl->att_inv; ?>" style = "width: 100%; height: 350px;"> -->
                         <a href="attinv/<?php echo $ftch_dtl->att_inv; ?>" target="_blank"><?php echo $ftch_dtl->att_inv; ?></a>
                         </div>
                    </div>
              
               
                       <?PHP
                    }
                    ?>
                
                        <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Supplier:</label>
                         <?php echo $ftch_dtl->supplier; ?>
                      </div>
                    </div>
                     <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Godown:</label>
                         <?php echo $ftch_dtl->godowo; ?>
                      </div>
                    </div>
                    
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Warranty:</label>
                         <?php echo $ftch_dtl->warrenty; ?>
                      </div>
                    </div>
                    <?PHP
                    if($ftch_dtl->att_war != '')
                    {
                      ?>
                    
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Warranty Attached Data:</label>
                         <!-- <img src="attwar/<?php echo $ftch_dtl->att_war; ?>" style = "width: 100%; height: 350px;"> -->
                         <a href="attwar/<?php echo $ftch_dtl->att_war; ?>" target="_blank"><?php echo $ftch_dtl->att_war; ?></a>
                      </div>
                    </div>
                      <?PHP
                    }
                    ?>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">Asset Serial No:</label>
                         <?php echo $ftch_dtl->serial_no; ?>
                      </div>
                    </div>
                    </div>
            </fieldset> 
            <?php
                    $sub_type = $ftch_dtl->sub_type;

                    if($ftch_dtl->sub_type == '6')
                    {
                        $que = "SELECT * FROM `aset_stock_entry_vechile` WHERE name_id = '$id'";
                        $que_co = mysqli_query($con, $que);
                        $ftch_vechile = mysqli_fetch_object($que_co);
                   
        
            ?>
            <fieldset>
               <legend><h5><b>Additional Information</b></h5></legend>

                <div class="row">
                <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">RC Name:</label>
                        <?php echo $ftch_vechile->rc_name; ?>

                     </div>
                  </div>
                   <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Chasis No.:</label>
                        <?php echo $ftch_vechile->chasis; ?>

                     </div>
                  </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Engine No.:</label>
                        <?php echo $ftch_vechile->engie; ?>

                     </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">RC date.:</label>
                        <?php echo $ftch_vechile->rc_date; ?>

                     </div>
                  </div>
                    
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Valid Upto:</label>
                        <?php echo $ftch_vechile->rc_valid; ?>

                     </div>
                  </div>
                  <?php 
                  if($ftch_vechile->rc_file != "")
                  {
                  ?>
                  <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">RC Attached File:</label>
                       <!-- <img src="ve_rc/<?php echo $ftch_vechile->rc_file; ?>" style = "width: 100%; height: 200px;"> -->
                       <a href="ve_rc/<?php echo $ftch_vechile->rc_file; ?>" target="_blank"><?php echo $ftch_vechile->rc_file; ?></a>
                     </div>
                  </div>
                  <?php
                }
                ?>
              </div>
                   <div class="row">
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">INS No:</label>
                        <?php echo $ftch_vechile->ins_no; ?>

                     </div>
                  </div>
                    
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Valid Upto:</label>
                        <?php echo $ftch_vechile->ins_valid; ?>

                     </div>
                  </div>
                   <?php 
                  if($ftch_vechile->ins_file != "")
                  {
                  ?>
                  <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">INS Attached File:</label>
                      <!--  <img src="ve_ins/<?php echo $ftch_vechile->ins_file; ?>" style = "width: 100%; height: 200px;"> -->
                      <a href="ve_ins/<?php echo $ftch_vechile->ins_file; ?>" target="_blank"><?php echo $ftch_vechile->ins_file; ?></a>
                     </div>
                  </div>
                  <?php
                }
                ?>
              </div>
                   <div class="row">
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Poc No:</label>
                        <?php echo $ftch_vechile->poc_no; ?>

                     </div>
                  </div>
                    
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Valid Upto:</label>
                        <?php echo $ftch_vechile->poc_valid; ?>

                     </div>
                  </div>
                   <?php 
                  if($ftch_vechile->poc_file != "")
                  {
                  ?>
                  <div class="col-lg-4">
                      <div class="form-group">
                        <label for="itemname">POC Attached File:</label>
                       <!-- <img src="ve_poc/<?php echo $ftch_vechile->poc_file; ?>" style = "width: 100%; height: 200px;"> -->
                       <a href="ve_poc/<?php echo $ftch_vechile->poc_file; ?>" target="_blank"><?php echo $ftch_vechile->poc_file; ?></a>
                     </div>
                  </div>
                  <?php
                }
                ?>
              </div>
            </fieldset>
            <fieldset>
               <?php 
              if($ftch_vechile->maintain == '2')
                        {
                            
                             $query2 = "SELECT * FROM `aset_stock_entry_maintain` WHERE name_id = '$id'";
                        $query_co = mysqli_query($con, $query2);
                        $ftch_maintain = mysqli_fetch_object($query_co);
                      }
                            ?>
                             <legend><h5><b>Maintainance Required:</b></h5></legend> 

                              <div class="row">
                  <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname">Maintainance:</label>
                        <?php if($ftch_vechile->maintain == '2'){ echo "Yes";} else { echo "No";} ?>
                      </div>
                    </div>
                    </div>
                    <?php 
              if($ftch_vechile->maintain == '2')
                        {
                          ?>
                  <div class="row">
                      <div class="col-lg-3">
                            <div class="form-group">
                            <label for="itemname">Duration[In Days]:</label>
                            <?php echo $ftch_maintain->duration; ?>

                            </div>
                        </div>
                        <!-- <div class="col-lg-3">
                            <div class="form-group">
                            <label for="itemname">Present Reading:</label>
                            <?php echo $ftch_maintain->days_interval; ?>

                            </div>
                        </div> -->
                         <!--   <div class="col-lg-3">
                            <div class="form-group">
                            <label for="itemname">OR:</label>
                            <?php echo $ftch_maintain->or; ?>

                            </div>
                        </div> -->
                         <!-- <div class="col-lg-3">
                            <div class="form-group">
                            <label for="itemname">QTY:</label>
                            <?php echo $ftch_maintain->qty; ?>

                            </div>
                        </div> -->
                        <div class="col-lg-3">
                            <div class="form-group">
                            <label for="itemname">Reading[In Km]:</label>
                            <?php echo $ftch_maintain->km_interval; ?>

                            </div>
                        </div>
                       <!--   <div class="col-lg-3">
                            <div class="form-group">
                            <label for="itemname">Present Reading Date:</label>
                            <?php echo $ftch_maintain->present_reading_date; ?>

                            </div>
                        </div> -->
                      </div>
                        <?php

                       }
                       ?> 
            </fieldset>
            <?php 
           
                           
                            $but = mysqli_query($con,"SELECT x.*, y.value FROM  aset_feild_entry x, aset_stock_entry_other y  WHERE y.stock_entry_id = '$id'AND x.id = y.feild_name");
                            // $ftch_feild = mysqli_fetch_object($qut);
                            if(mysqli_num_rows($but) > 0)
                            {
                              ?>
    
             <fieldset>
                         <legend><h5><b>Fields:</b></h5></legend>
                        <?php
                      if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $sub_type = $ftch_dtl->sub_type;
                                // echo $sub_type;
                              
                               
                           
                            $vet = mysqli_query($con,"SELECT x.*, y.value FROM  aset_feild_entry x, aset_stock_entry_other y  WHERE y.stock_entry_id = '$id' AND y.feild_id='$sub_type' AND  x.id = y.feild_name"); 
        while($ftch_label = mysqli_fetch_object($vet))
        {
          
                ?>  
                
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname"><?php echo $ftch_label->feild_name; ?>:</label>
                        <?php echo $ftch_label->value; ?>

                     </div>
                  </div>
                 <?php
                          }
                      }
                    
                      ?>
                      </fieldset>
            <?php
    }
  }
    else{
              if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $sub_type = $ftch_dtl->sub_type;
                                // echo $sub_type;
                              
                               
                           
                            $qut = mysqli_query($con,"SELECT x.*, y.value FROM  aset_feild_entry x, aset_stock_entry_other y  WHERE y.stock_entry_id = '$id'AND x.id = y.feild_name");
                            // $ftch_feild = mysqli_fetch_object($qut);
                            if(mysqli_num_rows($qut) > 0)
                            {
    

                      ?>
                      <fieldset>
                         <legend><h5><b>Fields:</b></h5></legend>
                        <?php
                      if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $sub_type = $ftch_dtl->sub_type;
                                // echo $sub_type;
                              
                               
                           
                            $vet = mysqli_query($con,"SELECT x.*, y.value FROM  aset_feild_entry x, aset_stock_entry_other y  WHERE y.stock_entry_id = '$id' AND y.feild_id='$sub_type' AND  x.id = y.feild_name"); 
        while($ftch_label = mysqli_fetch_object($vet))
        {
          
                ?>  
                
                      <div class="col-lg-3">
                      <div class="form-group">
                        <label for="itemname"><?php echo $ftch_label->feild_name; ?>:</label>
                        <?php echo $ftch_label->value; ?>

                     </div>
                  </div>
                 <?php
                          }
                      }
                    
                      ?>
                      </fieldset>
                      <?php
                    }
                  }
                  }
                    ?>
    
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

        

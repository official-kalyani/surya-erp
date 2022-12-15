<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php
if(isset($_POST['s_id'])) {

$asset_no = $_POST['s_id'];



$query = mysqli_query($con, "SELECT x.*,x.id as xid,y.*,z.sub_type  FROM vw_aset_stock_assaignment  x, aset_stock_entry y, aset_item_creation z Where x.asset_no = '$asset_no'  AND x.asset_no = y.auto_serial AND y.item_name = z.id order by x.id DESC LIMIT 1");
if(mysqli_num_rows($query) > 0)
{

 $ftch_dtl = mysqli_fetch_object($query);


 ?>
						 	
            				<div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"  autocomplete="off" value="<?php echo $ftch_dtl->description; ?>" readonly>
                                </div>
                              </div>
                            <!-- </div>
                            <div class="row"> -->
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="serial_no">Asset Serial No</label>
                                    <input type="text" class="form-control" name="serial_no" id="serial_no"  autocomplete="off" value="<?php echo $ftch_dtl->serial_no; ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="Used_Person">Used To Person</label>
                                    <input type="text" class="form-control" name="Used_Person" id="Used_Person"  autocomplete="off"  value="<?php echo $ftch_dtl->fullname; ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="Fdate">From Date</label>
                                    <input type="text" class="form-control" name="Fdate" id="Fdate"  autocomplete="off"   value="<?php echo $ftch_dtl->assaign_dt; ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="Tdate">To Date</label>
                                    <input type="text" class="form-control" name="Tdate" id="Tdate"  autocomplete="off" value="<?php $date = date('Y-m-d');
                                    echo $date;?>" readonly>
                                </div>
                              </div>
                               <div class="col-lg-4" >
                                <div class="form-group">
                                    <label for="p_site">Project Site</label>
                                    <input type="text" class="form-control" name="p_site" id="p_site"  autocomplete="off" value="<?php echo $ftch_dtl->project_site; ?>" readonly>
                                </div>
                              </div>
                             <!--  -->
                             <div class="col-lg-12" >
                                  <div class="form-group">
                                 <!--  <label>&nbsp;</label> -->
                                      <input type="button" name="hstryshow"  id="hstryshow"
                                      value="View History" class="btn btn-primary mr-2" style="margin-top: 20px;" >
                                      <input type="button" name="matainshow"  id="matainshow"
                                      value="View Maintenance History" class="btn btn-success mr-2" style="margin-top: 20px;" >
                                      <input type="button" name="upmaintain"  id="upmaintain"
                                      value="Updated Maintenance History" class="btn btn-primary mr-2" style="margin-top: 20px;" >
                                     <!--  <input type="button" name="cancel"  id="cancel"
                                      value="Cancel" class="btn btn-danger mr-2" style="margin-top: 20px;" > -->
                                  </div>
                              </div>
                               <div class="col-lg-12">
                               <div id="asset_history"></div>
                             </div> 
                             <div class="col-lg-12">
                               <div id="asset_maintainance"></div>
                             </div>
                            <?php
                            }
							// else{
							// 		echo "<i style=color:#D71313;>"."YOUR ASSET NUMBER PROVIDED IS INCORRECT"."</i>";
							// 	}
					                 	}                 
                          ?>
                  <script type="text/javascript">

                  $(document).ready(function(){

                      $("#hstryshow").click(function(){
                          var asset = $("#ass_no").val();

                          if( asset != ''){

                              $.ajax({
                              url:"viewhistory.php",
                              data:{s_id:asset},
                              type:'POST',
                              success:function(data) {

                              var sd = $.trim(data);
                              $("#asset_history").html(sd);

                              }
                              });

                          }


                      });
                      $("#matainshow").click(function(){
                      var asset = $("#ass_no").val();

                        if( asset != ''){

                            $.ajax({
                            url:"viewmaintain.php",
                            data:{s_d:asset},
                            type:'POST',
                            success:function(data) {

                            var sd = $.trim(data);
                            $("#asset_history").html(sd);

                            }
                            });

                        }


                      });

$("#upmaintain").click(function(){
        var asset = $("#ass_no").val();

        if( asset != ''){

        $.ajax({
        url:"aset_updated_mainten_history.php",
        data:{a_id:asset},
        type:'POST',
        success:function(data) {

        var sd = $.trim(data);
        $("#asset_history").html(sd);
        // $("#asset_history").show();

        }
        });

        }


    });


                  });
                  </script>
                         
                          <!--  <script type="text/javascript">
       $(document).ready(function(){
        $("#cancel").click(function(){

          $("#asset_history").hide();
           $("#asset_maintainance").hide();


           $("#hstryshow").click(function(){
            $("#asset_history").show();

           });


        });

       });
    </script> -->
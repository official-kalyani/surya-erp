<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>

<?php
if(isset($_GET['id']))
{
  $id = $_GET['id'];

  $query = mysqli_query($con,"SELECT y.*,y.id as yid,z.* FROM  aset_stock_entry y,aset_stock_entry_vechile z WHERE  y.id = z.name_id AND y.id = '$id'  order by z.id");
  $ftch = mysqli_fetch_object($query);
  if (isset($_POST['update']))
  {
    $poc_no =$_POST['poc_no'];
    $date = $_POST['ren_date'];
    $poc_valid =$_POST['validins'];
    $updated_by = $_SESSION['ERP_SESS_ID'];
    // $attach = $_POST['att_ins'];
    $fname2 = pathinfo($_FILES['att_ins']['name'], PATHINFO_FILENAME); // Returns Filename without extention  a
    $exn2 = pathinfo($_FILES['att_ins']['name'], PATHINFO_EXTENSION); // Returns extention without Filename   jpg
    if($_FILES['att_ins']['name'] == '')
    {
      $docs3 =  '';
    }
    else
    {
      $docs3 = $fname2.'-'.time().'.'.$exn2;
    }
    $target3 = "ve_poc/";
    $target = $target3 . $docs3;
    $pic=($_FILES['att_ins']['name']);
    if(move_uploaded_file($_FILES['att_ins']['tmp_name'], $target)) {
        //Tells you if its all ok
      echo "The file ". basename( $_FILES['att_ins']['name']). " has been uploaded, and your information has been added to the directory of ins";
    } else {
        //Gives and error if its not
      echo "Sorry, there was a problem uploading your file of ins.";
    }
    $query = mysqli_query($con,"INSERT INTO `aset_poc_update` (`name_id`, `date`,`valid_date`, `attach`, `poc_no`,`updated_by`,`status`) VALUES ('$id','$date', '$poc_valid', '$docs3', '$poc_no','$updated_by','1')");
    $query2 = mysqli_query($con,"UPDATE aset_stock_entry_vechile SET`poc_valid` = '$poc_valid',`poc_file` = '$docs3',`poc_no` = '$poc_no',`date` = '$date' WHERE `name_id`= '$id'");
    if($query && $query2)
    {
      $msg="Pollution data updated successfully";
      header("Location: poc_edit.php?msg=$msg&id=$id");
    }
    else 
    {
      $msgel="Unsuccessfull in updating insurance data...retry again";
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

      <!-- jQuery -->
      <script src="../../js/jquery.min.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="../../js/bootstrap.min.js"></script>

      <link rel="shortcut icon" href="../../images/favicon.png" />

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

        $(document).ready(function(){

          $('#ren_date,#validins').datetimepicker({

            format:'YYYY-MM-DD',

            widgetPositioning:{
              horizontal: 'auto',
              vertical: 'bottom'
            }

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
              <h4 class="page-header">Edit Pollution</h4>
              <button onClick='javascript:location.href="pollution.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;">Back to List</button>
              <?php 
              if(isset($_GET['msg'])) 
              { 
                $msg = $_GET['msg'];
                echo "<i style=color:#33D15B;>".$msg."</i>";
              } 
              ?>
              <?php if(isset($msgel)) { echo "<i style=color:#D71313;>".$msgel."</i>"; } ?> 
            </div>
          </div>
          <div class="row">
            <form name="form" method="post" class="forms-sample" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="ins_no">Date:</label>
                    <input type="text" class="form-control" name="ins_no" id="ins_no" value="<?php if($ftch->date != '0000-00-00'){echo $ftch->date;}?>"  disabled > 
                    <input type="hidden" class="form-control" name="poc_id" id="poc_id" value="<?php echo $ftch->name_id;?>" disabled>           
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="ins_no">Poc No:</label>
                    <input type="text" class="form-control" name="poc_no" id="poc_no" value = '<?php if($ftch->poc_no != ' '){echo $ftch->poc_no;}?>'>           
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="valid_ins">Valid upto:</label>
                    <input type="text" class="form-control" name="valid_ins" id="valid_ins" placeholder="YYYY-MM-DD" value = '<?php if($ftch->ins_valid != ' '){echo $ftch->ins_valid;}?>' disabled>           
                  </div>
                </div>
                <?php
                if($ftch->poc_file != '')
                {
                  ?>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="att_ins">Attached Document:</label>
                      <a href="ve_poc/<?php echo $ftch->poc_file; ?>" target="_blank"><?php echo $ftch->poc_file; ?></a>         
                    </div>
                  </div>
                  <?php
                }
                ?>  
              </div>
              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="ins_no">Renew Date:</label>
                    <input type="text" class="form-control" name="ren_date" id="ren_date"  >           
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="valid_ins">Valid upto:</label>
                    <input type="text" class="form-control" name="validins" id="validins" placeholder="YYYY-MM-DD"  >           
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="att_ins">Attach:</label>
                    <input type="file" class="form-control" name="att_ins" id="att_poc"  >           
                  </div>
                </div>
              </div>
              <div class="col-lg-12" >
                <input type="submit" name="update"  id="update" value="update" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: right;" >
                <input type="button" name="pol_history"  id="pol_history" value="history" class="btn btn-success mr-2"  class="btn btn-success mr-2" style="float: left;" >    
              </div> 
            </form>
            <div class="col-lg-12" style="margin-top: 10px;">
              <div id="poc_history"></div>
            </div>
          </div>

        </div>
        <!-- /#page-wrapper -->
        <?php require_once('../../footer.php'); ?>

      </div>
      <!-- /#wrapper -->
    </body>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../js/metisMenu.min.js"></script>
    <script src="../../js/startmin.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        $("#pol_history").click(function(){
          var idm = $("#poc_id").val();

          if( idm != '')
          {
            $.ajax({
              url:"poc_history.php",
              data:{s_id:idm},
              type:'POST',
              success:function(data) 
              {
                var sd = $.trim(data);
                $("#poc_history").html(sd);
              }
            });
          }
        });

      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){

        $("#update").click(function(){
          var date = $('#ren_date').val();
          var valid = $('#validins').val();
          console.log(valid);
          console.log(date);

          if(date ==  '')
          {
            $('#ren_date').css("border","2px solid #ec1313");
            alert("Please provide the renew date");
            $('#ren_date').focus();
            return false;
          } 
          if(valid ==  '')
          {
            console.log(valid);
            $('#validins').css("border","2px solid #ec1313");
            $('#ren_date').css("border","1px solid #D3D3D3");
            alert("Please provide the valid upto date");
            $('#validins').focus();
            return false;
          } 

          else 
          {
            return true;
          }
        });

      });
    </script>
  </html>
<?php
}
?>
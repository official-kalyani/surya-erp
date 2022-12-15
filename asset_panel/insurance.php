<?php require_once('../../auth.php'); ?>
<?php require_once('../../config.php'); ?>
<?php $emp = $_SESSION['ERP_SESS_ID'];?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Insurance Update : Suryam Group</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../css/startmin.css" rel="stylesheet">
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
            <script src="https://oss.maxcdn.com/libs/respond.../js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery -->
        <script src="../../js/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.min.js"></script>

        <link rel="shortcut icon" href="../../images/favicon.png" />
        <!--Clock-->
        <script src="../../js/clock.js" type="text/javascript"></script>
        <!--//Clock-->

        <!-- Used For Auto Typing Search -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />    
        <!-- // Used For Auto Typing Search--> 

        <script>
            $(document).ready(function() { 
              startclock ();
                $('#erp_fullname').selectize({
                    sortField: 'text'
                });
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
                        <h4 class="page-header">Insurance Field Update</h4>
                        <button onClick='javascript:location.href="vechiledataupdate.php"' class="btn btn-warning mr-2" style="font-weight: bold; float: right;margin-bottom: 10px;">Back to List</button>
                    </div>
                </div>

                <!-- /.row -->
                <div class="row">
                    <!-- Body Starts Here -->    
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="height: 60px;">
                                <div>
                                    <form name='search' method='get' class="row-flex">
                                        <?php 
                                        if ($emp=='55') 
                                        {
                                            $sql_empname= mysqli_query($con,"SELECT x.id AS xids, x.fullname, y.id AS yids, y.emp_id, y.emp_type FROM mstr_emp x, mstr_emp_type y WHERE x.id=y.emp_id AND y.emp_type='0'");
                                        ?>
                                            <div class="col-md-3">
                                                <select class="form-control col-md-3" name="erp_fullname" id="erp_fullname">
                                                    <option value="">Select Name</option>
                                                    <?php
                                                    while($fetch_empname = mysqli_fetch_object($sql_empname))
                                                    { 
                                                    ?>
                                                        <option value="<?php echo $fetch_empname->emp_id;?>"><?php echo $fetch_empname->fullname;?></option>
                                                    <?php 
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                        <?php
                                        }
                                        ?>
                                        <div class="col-md-3">
                                            <input type='text' class="form-control" name='spname' placeholder='Search Asset-number' autocomplete='off' <?php if ($emp!=='55') 
                                        {echo "required";}?> >
                                        </div>
                                        <div class="col-md-2">
                                                <select class="form-control col-md-3" name="ins_status" id="ins_status">
                                                    <option value="">Select Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                   
                                                </select>
                                            </div>
                                        <div class="col-md-2">
                                            <input type='submit' value='Search' class="btn btn-success">
                                            <?php 
                                            if( isset($_GET['spname']) )    
                                            {                                           // Show Only if Search Action Performed 
                                            ?>
                                                <a href="insurance.php" class="btn btn-primary">Refresh</a>
                                            <?php 
                                            } 
                                            ?>
                                        </div>
                                        
                                        <?php
                                         $concate='';
                                        if ($emp=='55') 
                                        {
                                            if ( isset($_GET['erp_fullname']) && isset($_GET['spname']) ) 
                                            {
                                                $concate.='?site_fullname='.$_GET['erp_fullname'].'&asset_no='.$_GET['spname'];
                                            }
                                            else
                                            {
                                                $concate.='';
                                            }
                                        }
                                        else
                                        {
                                            if ( isset($_GET['spname']) ) 
                                            {
                                                $concate.='?asset_no='.$_GET['spname'];
                                            }
                                            else
                                            {
                                                $concate.='';
                                            }
                                        }

                                        if ($concate!=='') 
                                        {
                                           $op='&';
                                        }
                                        else
                                        {
                                            $op='?';
                                        }
                                        
                                        ?>
                                        <!-- for download options-->
                                        <div class="col-md-2" style="float: right;">
                                            <a href="download_insurance.php<?php echo $concate.$op;?>pdf=pdf_download" class="btn btn-info">PDF</a>
                                            <a href="download_insurance.php<?php echo $concate.$op;?>excel=excel_download" class="btn btn-primary">EXCEL</a>
                                        </div>

                                    </form>
                                </div>

                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead> 
                                            <tr> 
                                                <th>Slno</th>
                                                <th>Asset No</th>
                                                <th>Item</th> 
                                                <th>Serial No</th>
                                                <th>Name</th>
                                                <th>Insurance Company</th>
                                                <th>Valid Upto</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <?php
                                                if ($emp==55) 
                                                {
                                                    ?>
                                                    <th>Renew</th>
                                                    <?php
                                                }
                                                ?>
                                            </tr> 
                                        </thead> 
                                        <tbody>
                                            <?php
                                                // Pagination
                                                $query1 =  mysqli_query($con, "SELECT COUNT(*) as `num`  FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERE x.asset_no = y.auto_serial AND y.id = z.name_id ");
                                                $total_pages = mysqli_fetch_array($query1);
                                                $total_pages = $total_pages['num'];
                                                $limit = 30;   // How many items to show per page
                                                if(isset($_GET['page'])) 
                                                { 
                                                    $page = $_GET['page'];
                                                } 
                                                else 
                                                {
                                                    $page = 0;
                                                }
            
                                                if($page) 
                                                    $start = ($page - 1) * $limit;          // First item to display on this page
                                                else
                                                    $start = 0;                             // If no page var is given, set start to 


                                                /* Setup page vars for display. */
                                                if ($page == 0) $page = 1;                  // If no page var is given, default to 1.
                                                $prev = $page - 1;                          // Previous page is page - 1
            
                                                $first_number = $prev+1;                    // Mid Portion 
                                                $showing_limit = $first_number+2;           // Pagination
            
                                                $next = $showing_limit + 1;                 // Next page is page + 1
            
                                                $lastpage = ceil($total_pages/$limit);      // Lastpage is = total pages / items per page, rounded up.
                                                $last_number = $lastpage-2;

                                                $pagination = "";

                                                if($lastpage > 1)
                                                {   
                                                    $pagination .= "<div class=\"pagination\">";

                                                    // Previous button
                                                    if ($page > 1) 
                                                    {
                                                        $pagination.= "<a href=\"?page=1\">|« First</a> &nbsp;&nbsp;&nbsp;"; // First Page Link
                                                        $pagination.= "<a href=\"?page=$prev\">« Previous</a> &nbsp;&nbsp;&nbsp;";
                                                    }
                                                    else
                                                    {
                                                        $pagination.= "<span class=\"disabled\">|« First</span> &nbsp;&nbsp;&nbsp;"; 
                                                        $pagination.= "<span class=\"disabled\">« Previous</span> &nbsp;&nbsp;&nbsp;"; 

                                                    }
                
                                                    if ($page > $last_number)
                                                    {
                                                        for($i = $last_number; $i <= $last_number+2; $i++)
                                                        {
                                                            $pagination .= '<a href="?page='.$i.'">'.$i.'</a> &nbsp;&nbsp;&nbsp;';
                                                        }
                                                    }
                                                    else
                                                    {
                                                        for($i = $first_number; $i <= $showing_limit; $i++)
                                                        {
                                                            $pagination .= '<a href="?page='.$i.'">'.$i.'</a> &nbsp;&nbsp;&nbsp;';
                                                        }
                                                    }

                                                    // Next button
                                                    if ($page < $last_number)
                                                    {
                                                        $pagination.= "<a href=\"?page=$next\">Next »</a> &nbsp;&nbsp;&nbsp;";
                                                        $pagination.= "<a href=\"?page=$lastpage\">Last »|</a>";
                                                    }
                                                    else
                                                    {
                                                        $pagination.= "<span class=\"disabled\">Next »</span> &nbsp;&nbsp;&nbsp;";
                                                        $pagination.= "<span class=\"disabled\">Last »|</span>";
                                                    }

                                                    $pagination.= "</div>\n";       
                                                }

                                                /*if(isset($_GET['spname'])) // For Search
                                                {
                                                    $spname = mysqli_real_escape_string($con,$_GET['spname']); // Prevent SQL-Injection

                                                    // Prevent SQL-Injection
                                                    if ($emp=='55') 
                                                    {
                                                        $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND x.status = '1'"); 
                                                    }
                                                    else
                                                    {
                                                        $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$emp' AND y.auto_serial = '$spname' AND x.status = '1'"); 
                                                    }
                                                } */
                                                // date=GETDATE()
                                                if ($emp=='55') 
                                                {
                                                    if(isset($_GET['spname']) && isset($_GET['erp_fullname']) && isset($_GET['ins_status']))
                                                    {
                                                        $spname = mysqli_real_escape_string($con,$_GET['spname']); // Prevent SQL-Injection
                                                        $erp_fullname = mysqli_real_escape_string($con,$_GET['erp_fullname']); // Prevent SQL-Injection
                                                        $ins_status = mysqli_real_escape_string($con,$_GET['ins_status']); // Prevent SQL-Injection

                                                        if ($spname!=='' && $erp_fullname!=='' && $ins_status!=='') 
                                                        {
                                                            if ($ins_status == 'inactive') {
                                                            $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe ins_valid < cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND  x.assaign_to = '$erp_fullname' AND x.status = '1'");
                                                            }else{
                                                                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe ins_valid > cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND  x.assaign_to = '$erp_fullname' AND x.status = '1'");
                                                            }
                                                        }

                                                        if ($spname!=='' && $erp_fullname=='' && $ins_status=='') 
                                                        {
                                                            $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND x.status = '1'");
                                                            
                                                        }

                                                        if ($spname=='' && $erp_fullname!=='' && $ins_status=='') 
                                                        {
                                                            $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$erp_fullname' AND x.status = '1'");
                                                        }

                                                        if ($spname=='' && $erp_fullname =='' && $ins_status=='') 
                                                        {
                                                            $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.status = '1'"); 
                                                        }
                                                        //New condition for active or inactive
                                                        if ($spname=='' && $erp_fullname =='' && $ins_status!=='') 
                                                        {
                                                            if ($ins_status == 'inactive') {
                                                                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERE ins_valid < cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND x.status = '1'");
                                                            }else{
                                                                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERE ins_valid > cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND x.status = '1'");
                                                            }
                                                             
                                                        }
                                                        if ($spname=='' && $erp_fullname!=='' && $ins_status!=='') 
                                                        {
                                                            if ($ins_status == 'inactive') {
                                                            $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe ins_valid < cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$erp_fullname' AND x.status = '1'");
                                                            }else{
                                                                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe ins_valid > cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$erp_fullname' AND x.status = '1'");
                                                            }
                                                        }
                                                        if ($spname!=='' && $erp_fullname=='' && $ins_status!=='') 
                                                        {
                                                            if ($ins_status == 'inactive') {
                                                                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe ins_valid < cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND x.status = '1'");
                                                            }else{
                                                                $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe ins_valid > cast(now() as date) AND x.asset_no = y.auto_serial AND y.id = z.name_id AND y.auto_serial = '$spname' AND x.status = '1'");
                                                            }
                                                            
                                                        }
                                                        //New condition for active or inactive filter
                                                    }
                                                    else
                                                    {
                                                        $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.status = '1'"); 
                                                    }
                                                }
                                                else
                                                {
                                                    if(isset($_GET['spname']))
                                                    {
                                                        $spname = mysqli_real_escape_string($con,$_GET['spname']); // Prevent SQL-Injection

                                                        $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$emp' AND y.auto_serial = '$spname' AND x.status = '1'"); 
                                                    }
                                                    else
                                                    {
                                                        $result = mysqli_query($con,"SELECT x.*,y.*,y.id as yid,z.* FROM aset_stock_assaignment x,aset_stock_entry y,aset_stock_entry_vechile z  WHERe x.asset_no = y.auto_serial AND y.id = z.name_id AND x.assaign_to = '$emp' AND x.status = '1'");
                                                    }
                                                }

                                                $total_results = mysqli_num_rows($result);
                                                if($total_results == 0) // Set For Record Not Found 
                                                {
                                                    $Error_message="NO RECORDS FOUND.";
                                                }

                                                $i = $start;
                                                while($fetch= mysqli_fetch_object($result))
                                                {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $fetch->auto_serial?></td>
                                                        <td><?php echo $fetch->description; ?></td>
                                                        <td><?php echo $fetch->serial_no; ?></td>
                                                        <td>
                                                            <?php
                                                                $assaign = $fetch->auto_serial;
                                                                $queryan = mysqli_query($con,"SELECT x.*,y.fullname  from aset_stock_assaignment x,mstr_emp y WHERE x.assaign_to = y.id AND x.asset_no = '$assaign' AND x.status = '1' ORDER BY x.id DESC LIMIT 1");
                                                                $fetch_name = mysqli_fetch_object($queryan);
                                                                if(mysqli_num_rows($queryan)>0 )
                                                                {
                                                                    echo $fetch_name->fullname;
                                                                }
                                                                else
                                                                {
                                                                    echo "Not assaigned";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($fetch->ins_comp != '')
                                                                {
                                                                    echo $fetch->ins_comp; 
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $fetch->ins_valid; ?></td>
                                                        <td>
                                                            <?php
                                                                $date = $fetch->ins_valid;
                                                                $today = date('Y-m-d');
                                                                if ($today > $date) 
                                                                {
                                                                    echo "Inactive"; 
                                                                }
                                                                else
                                                                {
                                                                    echo "Active"; 
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><a href="ins_view.php?id=<?php echo $fetch->yid;?>" style="text-decoration:none;" class="btn btn-primary btn-xs" ><b>View</b></a></td>
                                                        <?php
                                                        if ($emp==55) 
                                                        {
                                                            ?>
                                                            <td><a href="ins_edit.php?id=<?php echo $fetch->yid;?>" style="text-decoration:none;" class="btn btn-success btn-xs" ><b>Edit</b></a></td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                            ?>

                                            <?php // Error Message For Record Not Found.
                                                if(isset($Error_message))
                                                {
                                                    echo "<tr align='center'><td colspan='12'> $Error_message </td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php 
                                        //Displaying Pagination. 
                                        if(!isset($_GET['spname']))
                                        {
                                            echo $pagination;
                                        } 
                                    ?>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>                          
                    <!-- //Body Ends Here -->      
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
            <?php require_once('../../footer.php'); ?>
        </div>
        <!-- /#wrapper -->
        <!-- Added by kalyani 1-9-22 -->
        <script src="../../js/custom-menu.js"></script>
        <!-- Added by kalyani 1-9-22 -->
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

    </body>
</html>

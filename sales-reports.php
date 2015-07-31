<?php
require_once('classes/database.php');
if(empty($_SESSION['logged_in'])) {
    header('location:index.php');
}
if($_SESSION['role']=="employee") {
    header('location:home.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chanchal Garments</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/jquery.gritter.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/datepicker3.css" rel="stylesheet">
</head>
<style type="text/css">
    @media print {
        .printable {
            display:block;
            width:100%;
        }
        .no-print {
            display: none;
        }
    }
</style>
<body>
<div id="wrapper">
    <nav id="no_print1" class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" class="img-circle" src="assets/img/user.jpg" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold"><?php echo $_SESSION['username']; ?></strong>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="password.php">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        CG+
                    </div>
                </li>
                <li class="">
                    <a href="home.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                </li>
                <?php if($_SESSION['role']=='admin') {
                    ?>
                    <li>
                        <a href="add-company.php"><i class="fa fa-pencil-square"></i><span class="nav-label">Add New Company</span></a>
                    </li>
                    <li>
                        <a href="add-stock.php"><i class="fa fa-pencil-square"></i> <span class="nav-label">Add Stock</span></a>
                    </li>
                    <li class="">
                        <a href="edit-article.php"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Edit Article Details</span></a>
                    </li>
                    <li>
                        <a href="barcode_details.php"><i class="fa fa-barcode"></i> <span class="nav-label">Generate Barcode</span></a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Reports</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="true">
                            <li class=""><a href="company-reports.php">Company Reports</a></li>
                            <li><a href="product-reports.php">Product Reports</a></li>
                            <li claas="active"><a href="sales-reports.php">Sales Reports</a></li>
                            <li><a href="approval-reports.php">Approval Reports</a></li>
                        </ul>
                    </li>
                <?php }  ?>
                <li class="">
                    <a href="#"><i class="fa fa-check"></i> <span class="nav-label">Approval Section</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <li class=""><a href="for_approval.php">For Approval</a></li>
                        <li><a href="view-approval-bill.php">Approval Status</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Billing Section</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <li class=""><a href="create-bill.php">Create Bill</a></li>
                        <li><a href="view-bill.php">View Bill</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-rupee"></i> <span class="nav-label">Credit Section</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <!--                        <li class=""><a href="#">Create Bill</a></li>-->
                        <li><a href="credit-bill.php">View Credit Bill</a></li>
                    </ul>
                </li>
                <?php if($_SESSION['role']=='admin') {
                    ?>
                    <li>
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Employee</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="true">
                            <li class=""><a href="add-employee.php">Add New Employee </a></li>
                            <li><a href="employee-details.php">Employee Details</a></li>
                        </ul>
                    </li>
                <?php }  ?>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div id="no_print2" class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div id="no_print3" class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Reports</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Sales Reports</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div id="no_print4" class="ibox-title">
                            <h5>View Sales  Report</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="" class="form-horizontal" action="#">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Select Date</label>
                                    <div class="input-daterange input-group col-sm-5">
                                        <input type="text" class="input-sm form-control" name="start" id="start" placeholder="select date from">
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control" name="end" id="end" placeholder="select date to">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Search With</label>
                                    <div class="col-sm-5">
                                        <?php
                                        $db = new Database();
                                        $employees = $db->getAllUser();
                                        ?>
                                        <select class="form-control" name="employee_name" id="employee_name">
                                            <option>Search By Employee</option>
                                            <?php
                                            foreach($employees as $user) {
                                                echo "<option value='$user[username]'>$user[username]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div id="no_print5" class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" name="btn_search_sales_details" id="btn_search_sales_details" type="button">Search</button>
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                    </div>
                                </div>
                                <div class="custom-dashed-hr"></div>
                                <div class="sales-details hidden">
                                    <table class="table table-striped table-bordered table-hover " >
                                        <thead>
                                        <tr >
                                            <th rowspan="2" class="text-center ">Bill No.</th>
                                            <th rowspan="2" class="text-center ">Name</th>
                                            <th rowspan="2" class="text-center" >Date</th>
                                            <th rowspan="2" class="text-center" >Payment Mode</th>
                                            <th rowspan="2" class="text-center" >Sell By</th>
                                            <th rowspan="2" class="text-center" >Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body-sales">
                                        <tr class="table-row-sales hidden">
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group " id="grand_total">
                                    <label class="col-sm-2 col-sm-offset-8 control-label">Total Sales</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="grand_total_value" class="form-control" readonly/>
                                    </div>
                                </div>
                                <div class="form-group hidden" id="btn_print">
                                    <div class="col-sm-2 col-sm-offset-10">
                                        <a class="btn btn-primary" name="" id="btn_print_click" target="_blank" >Print</a>
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> Chanchal Garments &copy; 2014-2015
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-2.1.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.jeditable.js"></script>
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('.input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format:'dd-mm-yyyy'
        });
        $('#btn_search_sales_details').click(function(){
            var $start=$('#start').val();
            var $end=$('#end').val();
            var $employee_name=$('#employee_name').val();
            $.ajax({
                url:'jquery-data.php',
                type:'GET',
                dataType:'JSON',
                data:{search_sales_details:1,Employee_name:$employee_name,Start:$start,End:$end},
                success:function(data){
                    var grand_total = 0;
                    if(data.length>0) {
                        $('.sales-details').removeClass('hidden');
                        $(".table-body-sales .append").remove();
                        for(var i=0;i<data.length;i++) {
                            var $template=$('.table-body-sales .table-row-sales').clone();
                            $template.removeClass('table-row-sales');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data[i].id);
                            $template.find('td').eq(1).html(data[i].name);
                            $template.find('td').eq(2).html(data[i].date);
                            $template.find('td').eq(3).html(data[i].payment_mode);
                            $template.find('td').eq(4).html(data[i].sell_by);
                            $template.find('td').eq(5).html(data[i].grand_total);
                            grand_total+=parseInt(data[i].grand_total);
                            $('.table-body-sales').append($template);
                        }
                    }
                    else {
                        $(".table-body-sales .append").remove();
                    }
                    $("#grand_total_value").val(grand_total);
                    $('#btn_print').removeClass('hidden');
                }
            });

        });
        $('#btn_print_click').click(function(){
            var $employee_name=$('#employee_name').val();
            var $start=$('#start').val();
            var $end=$('#end').val();
            window.open('view-sales-reports.php?employee_name='+$employee_name+'&start='+$start+'&end='+$end,'_blank');
        });
    });
</script>
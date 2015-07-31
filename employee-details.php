<?php
require_once('classes/database.php');
if(empty($_SESSION['logged_in'])){
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
    <!-- Data Tables -->
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="assets/css/dataTables.responsive.css" rel="stylesheet">
    <link href="assets/css/dataTables.tableTools.min.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
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
                    <li class="">
                        <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Reports</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="true">
                            <li class=""><a href="company-reports.php">Company Reports</a></li>
                            <li><a href="product-reports.php">Product Reports</a></li>
                            <li><a href="sales-reports.php">Sales Reports</a></li>
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
                    <li claas="active">
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Employee</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="true">
                            <li class=""><a href="add-employee.php">Add New Employee </a></li>
                            <li claas="active"><a href="employee-details.php">Employee Details</a></li>
                        </ul>
                    </li>
                <?php }  ?>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
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
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Welcome To Chanchal Garments</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Employee Details</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> <i class="fa fa-bar-chart"></i>Employee Details</h5>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" >
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"> Name</label>
                                    <div class="col-sm-5">
                                        <?php
                                        $db= new Database();
                                        $employee_names = $db->getEmployeeName();
                                        ?>
                                        <select class="form-control" name="employee_name" id="employee_name">
                                            <option>Select Employee Name</option>
                                            <?php
                                            foreach($employee_names as $employee_name) {
                                                echo "<option  value='$employee_name[username]'>$employee_name[username]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover hidden" id="employee_details">
                                    <thead>
                                    <tr>
                                        <th >
                                            Name
                                        </th>
                                        <th >
                                            Password
                                        </th>
                                        <th>
                                            Address
                                        </th>
                                        <th>
                                            Contact No.
                                        </th>
                                        <th>
                                            Total Commision
                                        </th>
                                        <th class="text-center">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="invoice_search_table_body" class="editable-table">

                                    <tr class="table-row ">
                                        <td id="name" class="col-sm-1"></td>
                                        <td id="password" class="col-sm-2"></td>
                                        <td id="address"class="col-sm-3"></td>
                                        <td id="contact_no" class="col-sm-2"></td>
                                        <td id="commision" class="col-sm-2"></td>
                                        <td class="col-sm-2">
                                            <button type="button" class="btn btn-primary adjust-amount red-stripe"><i class="fa fa-rupee"></i>&nbsp;Pay Commision</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/jquery.gritter.min.js"></script>
<script src="assets/js/pace.min.js"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#employee_name').change(function () {
            $employee_name=$('#employee_name').val();
            $.ajax({
                url:'jquery-data.php',
                type:'GET',
                dataType:'JSON',
                data:{Employee_details:1,Employee_name:$employee_name},
                success:function(data){
                    $('#employee_details').removeClass('hidden');
                    $('#name').html(data.username);
                    $('#password').html(data.password);
                    $('#address').html(data.address);
                    $('#contact_no').html(data.contact_no);
                    $('#commision').html(data.total_commision);
                }

            });
            editTableInitialize();
        });
        function editTableInitialize() {
            $(".adjust-amount").click(function() {
                var self = $(this);
                var td_value = self.parent().parent().find("#commision").html();
                var textfield = self.parent().parent().find("#commision");
                if(textfield.find("input").length==0) {
                    textfield.html("<input value='"+0+"' />");
                    initializeInputEnter();
                    textfield.find("input").focus();
                    self.addClass("disabled");
                }
            });
        }
        function initializeInputEnter() {
            $(".editable-table tr td input").keyup(function(e) {
                var self = $(this);
                var parent_td  = self.parent();
                console.log(self.val());
                if(e.which==13) {
                    e.preventDefault();
                    var commision = parent_td.parent().find("#commision").val();
                    var name = parent_td.parent().find("#name").html();
                    $.ajax({
                        url:"jquery-data.php",
                        type:"GET",
                        dataType: "JSON",
                        data:{
                            pay_commision:1,
                            name:name,
                            commision:commision
                        },
                        success: function(data) {
                            var commision = parent_td.parent().find("#commision").html();
                            var total_paid_commision=data.total_paid_commision;
                            var remaining_commision=commision-total_paid_commision;
                            parent_td.html(remaining_commision);
                            parent_td.parent().find("td").eq(5).find("button").removeClass("disabled");
                        }
                    });
                }
            });
        }
    });
</script>

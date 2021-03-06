<?php
require_once('classes/database.php');
if(empty($_SESSION['logged_in'])){
    header('location:index.php');
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
    <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="assets/css/dataTables.responsive.css" rel="stylesheet">
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
                <li class="active">
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
                <li class="active">
                    <a href="#"><i class="fa fa-check"></i> <span class="nav-label">Approval Section</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <li class=""><a href="for_approval.php">For Approval</a></li>
                        <li claas="active"><a href="view-approval-bill.php">Approval Status</a></li>
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
                        <strong>View Approval Bill</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> <i class="fa fa-search"></i> Search Approval Bill</h5>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" >
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Bill No.</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="search_bill_no" id="search_bill_no" class="form-control" placeholder="Enter Bill No."/>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="search_name" id="search_name" class="form-control" placeholder="Enter Person/Company Name"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" type="button" name="btn_bill_search" id="btn_bill_search">Search</button>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th class="text-center" >
                                            Bill Number
                                        </th>
                                        <th class="text-center" >
                                            Name
                                        </th>
                                        <th class="text-center">
                                            Invoice Date
                                        </th>
                                        <th class="text-center">
                                            Total Amount
                                        </th>
                                        <th class="text-center">
                                            Approval By
                                        </th>
                                        <th class="text-center">
                                            Status
                                        </th>
                                        <th style="width:30%;" class="text-center">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="invoice_search_table_body">

                                    <tr class="table-row hidden bill-rows">
                                        <td id="bill_no"></td>
                                        <td id="name"></td>
                                        <td id="date"></td>
                                        <td id="total_amount"></td>
                                        <td id="approval_by"></td>
                                        <td id="status"></td>
                                        <td>
                                            <a class="btn btn-primary edit red-stripe" target="_blank" href="edit-approval-bill.php?bill_no="><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                            <a class="btn btn-primary view red-stripe" target="_blank" href="show_bill_approval.php?bill_no="><i class="fa fa-bars"></i>&nbsp;View</a>
                                            <button type="button" class="btn btn-primary adjust_approval red-stripe" ><i class="fa fa-times"></i> Adjust Approval</button>
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
        $('#btn_bill_search').click(function(){
            $search_bill_no=$('#search_bill_no').val();
            $search_name=$('#search_name').val();
            $.ajax({
                url:'jquery-data.php',
                type:'GET',
                dataType:'JSON',
                data:{
                    Approval_bill_search:1,
                    Search_bill_no:$search_bill_no,
                    Search_name:$search_name
                },
                success:function(data){
                    $('#invoice_search_table_body .append').remove();
                    for(var i=0;i<data.length;i++){
                        var $template=$('.table-row').clone();
                        $('#invoice_search_table_body').append($template);
                        $template.removeClass('table-row');
                        $template.removeClass('hidden');
                        $template.addClass('append');
                        $template.find('td').eq(0).html(data[i].id);
                        $template.find('td').eq(1).html(data[i].name);
                        $template.find('td').eq(2).html(data[i].date);
                        $template.find('td').eq(3).html(data[i].grand_total);
                        $template.find('td').eq(4).html(data[i].approval_by);
                        $template.find('td').eq(5).html(data[i].status);
                        if(data[i].status!="archived") {
                            $template.find('.view').attr('href',"show_bill_approval.php?bill_no="+data[i].id);
                            $template.find('.edit').attr('href',"edit-approval-bill.php?bill_no="+data[i].id);
                            $template.find('.adjust_approval').attr('data-bill-no',data[i].id);
                        }
                        else {
                            $template.find('.view').attr('href',"show_bill_approval.php?bill_no="+data[i].id);
                            $template.find('.edit').addClass('hidden');
                            $template.find('.adjust_approval').addClass('hidden');
                        }
                        initializeAdjustApprovalBill();
                    }
                }
            });
        });

        function initializeAdjustApprovalBill() {
            $('.adjust_approval').click(function() {
                var bill_no=$(this).attr("data-bill-no");
                var button = $(this);
                $.ajax({
                    url:'jquery-data.php',
                    type:'POST',
                    dataType:'JSON',
                    data:{
                        adjust_approval_bill:true,
                        bill_no:bill_no
                    },
                    success:function(data){
                        if(data.status==200) {
                            $.gritter.add({
                                title: data.title,
                                text: data.msg,
                                time: 2000
                            });
                            var parent = button.closest(".bill-rows");
                            parent.find('td').eq(5).html("archived");
                            parent.find('.edit').addClass('hidden');
                            button.addClass('hidden');
                        }
                    }
                });
            });
        }

    });
</script>
<script>
    $(document).ready(function(){

    });
</script>

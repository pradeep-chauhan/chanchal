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
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" id="no_print1" role="navigation">
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
                <?php if($_SESSION['role']=='admin') { ?>
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
                        <li class="active"><a href="company-reports.php">Company Reports</a></li>
                        <li><a href="product-reports.php">Product Reports</a></li>
                        <li><a href="sales-reports.php">Sales Reports</a></li>
                        <li><a href="approval-reports.php">Approval Reports</a></li>
                    </ul>
                </li>
                <?php  } ?>
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
                <?php if($_SESSION['role']=='admin') { ?>
                <li class="">
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Employee</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <li class=""><a href="add-employee.php">Add New Employee </a></li>
                        <li><a href="employee-details.php">Employee Details</a></li>
                    </ul>
                </li>
                <?php } ?>
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
                        <strong>Company Reports</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div id="no_print4" class="ibox-title">
                            <h5>Search Company Stock</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" id="print">
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
                                    <label class="col-sm-2 control-label">Company Name</label>
                                    <div class="col-sm-5">
                                        <?php
                                        $db = new Database();
                                        $companies = $db->getAllCompanies();
                                        ?>
                                        <select class="form-control" name="company_id" id="company_id">
                                            <option>Select Company</option>
                                            <?php
                                            foreach($companies as $company) {
                                                echo "<option value='$company[id]'>$company[company_name]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div id="no_print5"class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary" name="btn_search_company_stock" id="btn_search_company_stock" type="button">Search</button>
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                    </div>
                                </div>
                                <div class="custom-dashed-hr"></div>
                                <div class="jeans-details hidden">
                                    <table class="table table-striped table-bordered table-hover " >
                                        <thead>
                                            <tr >
                                                <th rowspan="2" class="text-center ">Product</th>
                                                <th rowspan="2" class="text-center" >Article No.</th>
                                                <th colspan="7" class="text-center" >Details</th>
                                                <th rowspan="2" class="text-center" >Total</th>
                                            </tr>
                                            <tr >
                                                <th class="text-center">28</th>
                                                <th class="text-center">30</th>
                                                <th class="text-center">32</th>
                                                <th class="text-center">34</th>
                                                <th class="text-center">36</th>
                                                <th class="text-center">38</th>
                                                <th class="text-center">40</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body-jeans">
                                            <tr class="table-row-jeans hidden">
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
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
                                <div class="shirt-details hidden ">
                                    <table class="table table-striped table-bordered table-hover " >
                                        <thead>
                                        <tr >
                                            <th rowspan="2" class="text-center ">Product</th>
                                            <th rowspan="2" class="text-center" >Article No.</th>
                                            <th colspan="6" class="text-center" >Details</th>
                                            <th rowspan="2" class="text-center" >Total</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">S</th>
                                            <th class="text-center">M</th>
                                            <th class="text-center">L</th>
                                            <th class="text-center">XL</th>
                                            <th class="text-center">XXL</th>
                                            <th class="text-center">XXXL</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body-shirt">
                                        <tr class="table-row-shirt hidden">
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="capri-details hidden ">
                                    <table class="table table-striped table-bordered table-hover " >
                                        <thead>
                                        <tr >
                                            <th rowspan="2" class="text-center ">Product</th>
                                            <th rowspan="2" class="text-center" >Article No.</th>
                                            <th colspan="7" class="text-center" >Details</th>
                                            <th rowspan="2" class="text-center" >Total</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">28</th>
                                            <th class="text-center">30</th>
                                            <th class="text-center">32</th>
                                            <th class="text-center">34</th>
                                            <th class="text-center">36</th>
                                            <th class="text-center">38</th>
                                            <th class="text-center">40</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body-capri">
                                        <tr class="table-row-capri hidden">
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="under-garments-details hidden">
                                    <table class="table table-striped table-bordered table-hover " >
                                        <thead>
                                        <tr >
                                            <th rowspan="2" class="text-center ">Product</th>
                                            <th rowspan="2" class="text-center" >Article No.</th>
                                            <th colspan="7" class="text-center" >Details</th>
                                            <th rowspan="2" class="text-center" >Total</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">75</th>
                                            <th class="text-center">80</th>
                                            <th class="text-center">85</th>
                                            <th class="text-center">90</th>
                                            <th class="text-center">95</th>
                                            <th class="text-center">100</th>
                                            <th class="text-center">105</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body-under-garments">
                                        <tr class="table-row-under-garments hidden">
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="others-details hidden">
                                    <table class="table table-striped table-bordered table-hover " >
                                        <thead>
                                        <tr >
                                            <th rowspan="2" class="text-center ">Product</th>
                                            <th rowspan="2" class="text-center" >Article No.</th>
                                            <th rowspan="2" class="text-center" >Total</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-body-others">
                                        <tr class="table-row-others hidden">
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <div class="form-group " id="grand_total">
                                    <label class="col-sm-2 col-sm-offset-8 control-label">Grand Total</label>
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
        $('#btn_search_company_stock').click(function(){
            $company_id=$('#company_id').val();
            var $start=$('#start').val();
            var $end=$('#end').val();
            $.ajax({
                url:'jquery-data.php',
                type:'GET',
                dataType:'JSON',
                data:{search_company_details:1,Company_id:$company_id,Start:$start,End:$end},
                error: function(data) {
                    console.log(data);
                },
                success:function(data) {
                    console.log(data);
                    var grand_total = 0;
                    if(data.Jeans.length>0) {
                        $('.jeans-details').removeClass('hidden');
                        for(var i=0;i<data.Jeans.length;i++) {
                            var $template=$('.table-body-jeans .table-row-jeans').clone();
                            $template.removeClass('table-row-jeans');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data.Jeans[i].product);
                            $template.find('td').eq(1).html(data.Jeans[i].article_no);
                            $template.find('td').eq(2).html(data.Jeans[i].twenty_eight);
                            $template.find('td').eq(3).html(data.Jeans[i].thirty);
                            $template.find('td').eq(4).html(data.Jeans[i].thirty_two);
                            $template.find('td').eq(5).html(data.Jeans[i].thirty_four);
                            $template.find('td').eq(6).html(data.Jeans[i].thirty_six);
                            $template.find('td').eq(7).html(data.Jeans[i].thirty_eight);
                            $template.find('td').eq(8).html(data.Jeans[i].forty);
                            $template.find('td').eq(9).html(data.Jeans[i].row_sum);
                            grand_total+=parseInt(data.Jeans[i].row_sum);
                            $('.table-body-jeans').append($template);
                        }
                    }
                    else {
                        $(".table-body-jeans .append").remove();
                        $('.jeans-details').addClass('hidden');
                    }
                    if(data.Shirt.length>0) {
                        $('.shirt-details').removeClass('hidden');
                        for(var i=0;i<data.Shirt.length;i++) {
                            var $template=$('.table-body-shirt .table-row-shirt').clone();
                            $template.removeClass('table-row-shirt');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data.Shirt[i].product);
                            $template.find('td').eq(1).html(data.Shirt[i].article_no);
                            $template.find('td').eq(2).html(data.Shirt[i].s);
                            $template.find('td').eq(3).html(data.Shirt[i].m);
                            $template.find('td').eq(4).html(data.Shirt[i].l);
                            $template.find('td').eq(5).html(data.Shirt[i].xl);
                            $template.find('td').eq(6).html(data.Shirt[i].xxl);
                            $template.find('td').eq(7).html(data.Shirt[i].xxxl);
                            $template.find('td').eq(8).html(data.Shirt[i].row_sum);
                            grand_total+=parseInt(data.Shirt[i].row_sum);
                            $('.table-body-shirt').append($template);
                        }
                    }
                    else {
                        $(".table-body-shirt .append").remove();
                        $('.shirt-details').addClass('hidden');
                    }
                    if(data.capri.length>0) {
                        $('.capri-details').removeClass('hidden');
                        for(var i=0;i<data.capri.length;i++) {
                            var $template=$('.table-body-capri .table-row-capri').clone();
                            $template.removeClass('table-row-capri');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data.Capri[i].product);
                            $template.find('td').eq(1).html(data.Capri[i].article_no);
                            $template.find('td').eq(2).html(data.Capri[i].twenty_eight);
                            $template.find('td').eq(3).html(data.Capri[i].thirty);
                            $template.find('td').eq(4).html(data.Capri[i].thirty_two);
                            $template.find('td').eq(5).html(data.Capri[i].thirty_four);
                            $template.find('td').eq(6).html(data.Capri[i].thirty_six);
                            $template.find('td').eq(7).html(data.Capri[i].thirty_eight);
                            $template.find('td').eq(8).html(data.Capri[i].forty);
                            $template.find('td').eq(9).html(data.Capri[i].row_sum);
                            grand_total+=parseInt(data.Capri[i].row_sum);
                            $('.table-body-capri').append($template);
                        }
                    }
                    else {
                        $(".table-body-capri .append").remove();
                        $('.capri-details').addClass('hidden');
                    }
                    if(data.under_garments.length>0) {
                        $('.under-garments-details').removeClass('hidden');
                        for(var i=0;i<data.under_garments.length;i++) {
                            var $template=$('.table-body-under-garments .table-row-under-garments').clone();
                            $template.removeClass('table-row-under-garments');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data.under_garments[i].product);
                            $template.find('td').eq(1).html(data.under_garments[i].article_no);
                            $template.find('td').eq(2).html(data.under_garments[i].seventy_five);
                            $template.find('td').eq(3).html(data.under_garments[i].eighty);
                            $template.find('td').eq(4).html(data.under_garments[i].eighty_five);
                            $template.find('td').eq(5).html(data.under_garments[i].ninety);
                            $template.find('td').eq(6).html(data.under_garments[i].ninety_five);
                            $template.find('td').eq(7).html(data.under_garments[i].hundred);
                            $template.find('td').eq(8).html(data.under_garments[i].one_hundred_five);
                            $template.find('td').eq(9).html(data.under_garments[i].row_sum);
                            grand_total+=parseInt(data.under_garments[i].row_sum);
                            $('.table-body-under-garments').append($template);
                        }
                    }
                    else {
                        $(".table-body-under-garments .append").remove();
                        $('.under-garments-details').addClass('hidden');
                    }
                    if(data.others.length>0) {
                        $('.others-details').removeClass('hidden');
                        for(var i=0;i<data.others.length;i++) {
                            var $template=$('.table-body-others .table-row-others').clone();
                            $template.removeClass('table-row-others');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data.others[i].product);
                            $template.find('td').eq(1).html(data.others[i].article_no);
                            $template.find('td').eq(2).html(data.others[i].quantity);
                            grand_total+=parseInt(data.others[i].quantity);
                            $('.table-body-others').append($template);
                        }
                    }
                    else {
                        $('.table-body-others .append').remove();
                        $('.others-details').addClass('hidden');
                    }
                    if(data.T_Shirt.length>0) {
                        $('.shirt-details').removeClass('hidden');
                        for(var i=0;i<data.T_Shirt.length;i++) {
                            var $template=$('.table-body-shirt .table-row-shirt').clone();
                            $template.removeClass('table-row-shirt');
                            $template.removeClass('hidden');
                            $template.addClass('append');
                            $template.find('td').eq(0).html(data.T_Shirt[i].product);
                            $template.find('td').eq(1).html(data.T_Shirt[i].article_no);
                            $template.find('td').eq(2).html(data.T_Shirt[i].s);
                            $template.find('td').eq(3).html(data.T_Shirt[i].m);
                            $template.find('td').eq(4).html(data.T_Shirt[i].l);
                            $template.find('td').eq(5).html(data.T_Shirt[i].xl);
                            $template.find('td').eq(6).html(data.T_Shirt[i].xxl);
                            $template.find('td').eq(7).html(data.T_Shirt[i].xxxl);
                            $template.find('td').eq(8).html(data.T_Shirt[i].row_sum);
                            grand_total+=parseInt(data.T_Shirt[i].row_sum);
                            $('.table-body-shirt').append($template);
                        }
                    }
                    else {
                        $(".table-body-shirt .append").remove();
                        $('.shirt-details').addClass('hidden');
                    }
                    $("#grand_total_value").val(grand_total);
                    $('#btn_print').removeClass('hidden');
                }
            });

        });
        $('#btn_print_click').click(function(){
            var $company_id=$('#company_id').val();
            var $start=$('#start').val();
            var $end=$('#end').val();
            window.open('view-company-reports.php?company_id='+$company_id+'&start='+$start+'&end='+$end,'_blank');
        });

    });
</script>
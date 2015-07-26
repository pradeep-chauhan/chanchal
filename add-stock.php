<?php
include_once('classes/database.php');
if(empty($_SESSION['logged_in'])){
    header('location:index.php');
}
if($_SESSION['role']=="employee") {
    header('location:home.php');
}
$flag= false;
if(isset($_POST['btn_add_products'])) {
    $db = new Database();
    $check_product=$_POST['product_category_id'];
    if($check_product==1)
    {
        $info = array(
            'company_id'=>$_POST['company_id'],
            'product_category_id'=>$_POST['product_category_id'],
            'article_no'=>$_POST['jeans_article_no'],
            'article_price'=>$_POST['jeans_article_price'],
            'our_price'=>$_POST['jeans_our_price'],
            'total_quantity'=>$_POST['jeans_total_quantity'],
            'qty_jeans_28'=>$_POST['qty_jeans_28'],
            'qty_jeans_30'=>$_POST['qty_jeans_30'],
            'qty_jeans_32'=>$_POST['qty_jeans_32'],
            'qty_jeans_34'=>$_POST['qty_jeans_34'],
            'qty_jeans_36'=>$_POST['qty_jeans_36'],
            'qty_jeans_38'=>$_POST['qty_jeans_38'],
            'qty_jeans_40'=>$_POST['qty_jeans_40']
        );
    }
    if($check_product==2 || $check_product==6)
    {
        $info = array(
            'company_id'=>$_POST['company_id'],
            'product_category_id'=>$_POST['product_category_id'],
            'article_no'=>$_POST['shirt_article_no'],
            'article_price'=>$_POST['shirt_article_price'],
            'our_price'=>$_POST['shirt_our_price'],
            'total_quantity'=>$_POST['shirt_total_quantity'],
            'qty_shirt_s'=>$_POST['qty_shirt_s'],
            'qty_shirt_m'=>$_POST['qty_shirt_m'],
            'qty_shirt_l'=>$_POST['qty_shirt_l'],
            'qty_shirt_xl'=>$_POST['qty_shirt_xl'],
            'qty_shirt_xxl'=>$_POST['qty_shirt_xxl'],
            'qty_shirt_xxxl'=>$_POST['qty_shirt_xxxl']
        );
    }
    if($check_product==3)
    {
        $info = array(
            'company_id'=>$_POST['company_id'],
            'product_category_id'=>$_POST['product_category_id'],
            'article_no'=>$_POST['capri_article_no'],
            'article_price'=>$_POST['capri_article_price'],
            'our_price'=>$_POST['capri_our_price'],
            'total_quantity'=>$_POST['capri_total_quantity'],
            'qty_capri_28'=>$_POST['qty_capri_28'],
            'qty_capri_30'=>$_POST['qty_capri_30'],
            'qty_capri_32'=>$_POST['qty_capri_32'],
            'qty_capri_34'=>$_POST['qty_capri_34'],
            'qty_capri_36'=>$_POST['qty_capri_36'],
            'qty_capri_38'=>$_POST['qty_capri_38'],
            'qty_capri_40'=>$_POST['qty_capri_40']
        );

    }
    if($check_product==4)
    {
        $info = array(
            'company_id'=>$_POST['company_id'],
            'product_category_id'=>$_POST['product_category_id'],
            'article_no'=>$_POST['under_garments_article_no'],
            'article_price'=>$_POST['under_garments_article_price'],
            'our_price'=>$_POST['under_garments_our_price'],
            'total_quantity'=>$_POST['under_garments_total_quantity'],
            'qty_under_garments_75'=>$_POST['qty_under_garments_75'],
            'qty_under_garments_80'=>$_POST['qty_under_garments_80'],
            'qty_under_garments_85'=>$_POST['qty_under_garments_85'],
            'qty_under_garments_90'=>$_POST['qty_under_garments_90'],
            'qty_under_garments_95'=>$_POST['qty_under_garments_95'],
            'qty_under_garments_100'=>$_POST['qty_under_garments_100'],
            'qty_under_garments_105'=>$_POST['qty_under_garments_105']
        );
    }
    if($check_product==5)
    {
        $info = array(
            'company_id'=>$_POST['company_id'],
            'product_category_id'=>$_POST['product_category_id'],
            'article_no'=>$_POST['others_article_no'],
            'article_price'=>$_POST['others_article_price'],
            'our_price'=>$_POST['others_our_price'],
            'total_quantity'=>$_POST['others_total_quantity'],
            'product_name'=>$_POST['others_product_name'],
        );
    }
    $response = $db->addProducts($info);
    $flag = true;
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
                <li>
                    <a href="home.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                </li>
                <?php if($_SESSION['role']=='admin') { ?>
                <li>
                    <a href="add-company.php"><i class="fa fa-pencil-square"></i><span class="nav-label">Add New Company</span></a>
                </li>
                <li class="active">
                    <a href="add-stock.php"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Add Stock</span></a>
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
                <?php } ?>
                <li class="">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Approval Section</span> <span class="fa arrow"></span></a>
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
                <h2>Input Stock</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Input New Stock</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> <i class="fa fa-bar-chart"></i> Enter the Stock</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" id="form_add_stock" class="form-horizontal" action="add-stock.php">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Company Name</label>
                                    <div class="col-sm-5">
                                        <?php
                                        $db = new Database();
                                        $companies = $db->getAllCompanies();
                                        ?>
                                        <select class="form-control" name="company_id">
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
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Product Type</label>
                                    <div class="col-sm-5">
                                        <?php
                                        $db= new Database();
                                        $product_categories = $db->getAllProductCategories();
                                        ?>
                                        <select class="form-control" name="product_category_id" id="product_category_id">
                                            <option>Select Product Category</option>
                                            <?php
                                            foreach($product_categories as $product_category) {
                                                echo "<option  value='$product_category[id]'>$product_category[category_name]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <!-- jeans-->
                                <div class="jeans hidden">
                                    <div class="template-container-jeans ">
                                        <div class="template description-row">
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <label>Jeans Article Number</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Jeans Article Price</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Our Price</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Jeans Total Quantity</label>
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom-0">
                                                <div class="col-sm-3">
                                                    <input type="text" name="jeans_article_no[]" class="form-control" placeholder="Article Number"/>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="jeans_article_price[]" class="form-control" placeholder="Article Price"/>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="jeans_our_price[]" class="form-control" placeholder="Our Price"/>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" name="jeans_total_quantity[]" class="form-control total-qty" readonly  placeholder="Total Quantity" />
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom-0">
                                                <div class="col-sm-12">
                                                    <table class="table product-description-table"> 
                                                        <tr> 
                                                            <td> 
                                                                <input type="text" name="qty_jeans_28[]" class="form-control qty" placeholder="Qty 28"/> 
                                                            </td> 
                                                            <td> 
                                                                <input type="text" name="qty_jeans_30[]" class="form-control qty" placeholder="Qty 30"/>
                                                            </td> 
                                                            <td> 
                                                                <input type="text" name="qty_jeans_32[]" class="form-control qty" placeholder="Qty 32"/> 
                                                            </td>
                                                            <td> 
                                                                <input type="text" name="qty_jeans_34[]" class="form-control qty" placeholder="Qty 34"/> 
                                                            </td> 
                                                            <td> 
                                                                <input type="text" name="qty_jeans_36[]" class="form-control qty" placeholder="Qty 36"/> 
                                                            </td> 
                                                            <td> 
                                                                <input type="text" name="qty_jeans_38[]" class="form-control qty" placeholder="Qty 38"/> 
                                                            </td> 
                                                            <td> 
                                                                <input type="text" name="qty_jeans_40[]" class="form-control qty" placeholder="Qty 40"/> 
                                                            </td> 
                                                            <td> 
                                                                <button type="button" class="btn btn-primary disabled btn-delete-row"><i class="fa fa-times"></i> </button>
                                                            </td> 
                                                        </tr>
                                                    </table> 
                                                </div>
                                            </div>
                                            <div class="custom-dashed-hr"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" id="btn_add_product_details_row_jeans" type="button"><i class="fa fa-plus"></i> Add Rows</button>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <!-- shirt-->
                                <div class="shirt hidden">
                                    <div class="template-container-shirt ">
                                    <div class="template description-row">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label>Article Number</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Article Price</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Our Price</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Total Quantity</label>
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-0">
                                            <div class="col-sm-3">
                                                <input type="text" name="shirt_article_no[]" class="form-control" placeholder="Article Number"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="shirt_article_price[]" class="form-control" placeholder="Article Price"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="shirt_our_price[]" class="form-control" placeholder="Our Price"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="shirt_total_quantity[]" class="form-control total-qty" readonly placeholder="Total Quantity" />
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-0">
                                            <div class="col-sm-12">
                                                <table class="table product-description-table"> 
                                                    <tr> 
                                                        <td> 
                                                            <input type="text" name="qty_shirt_s[]" class="form-control qty" placeholder="Small Qty "/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_shirt_m[]" class="form-control qty" placeholder="Medium Qty"/>
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_shirt_l[]" class="form-control qty" placeholder="L Qty"/> 
                                                        </td>
                                                        <td> 
                                                            <input type="text" name="qty_shirt_xl[]" class="form-control qty" placeholder="XL Qty"/> 
                                                        </td>
                                                        <td> 
                                                            <input type="text" name="qty_shirt_xxl[]" class="form-control qty" placeholder="XXL Qty"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_shirt_xxxl[]" class="form-control qty" placeholder="XXXL Qty"/> 
                                                        </td>  
                                                        <td> 
                                                            <button type="button" class="btn btn-primary disabled btn-delete-row"><i class="fa fa-times"></i> </button>
                                                        </td> 
                                                    </tr>
                                                </table> 
                                            </div>
                                        </div>
                                        <div class="custom-dashed-hr"></div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" id="btn_add_product_details_row_shirt" type="button"><i class="fa fa-plus"></i> Add Rows</button>
                                    </div>
                                </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <!-- capri -->
                                <div class="capri hidden">
                                    <div class="template-container-capri">
                                    <div class="template description-row">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label>Capri Article Number</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Capri Article Price</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Our Price</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Capri Total Quantity</label>
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-0">
                                            <div class="col-sm-3">
                                                <input type="text" name="capri_article_no[]" class="form-control" placeholder="Article Number"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="capri_article_price[]" class="form-control" placeholder="Article Price"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="capri_our_price[]" class="form-control" placeholder="Our Price"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="capri_total_quantity[]" class="form-control total-qty" readonly placeholder="Total Quantity" />
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-0">
                                            <div class="col-sm-12">
                                                <table class="table product-description-table"> 
                                                    <tr> 
                                                        <td> 
                                                            <input type="text" name="qty_capri_28[]" class="form-control qty" placeholder="Qty 28"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_capri_30[]" class="form-control qty" placeholder="Qty 30"/>
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_capri_32[]" class="form-control qty" placeholder="Qty 32"/> 
                                                        </td>
                                                        <td> 
                                                            <input type="text" name="qty_capri_34[]" class="form-control qty" placeholder="Qty 34"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_capri_36[]" class="form-control qty" placeholder="Qty 36"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_capri_38[]" class="form-control qty" placeholder="Qty 38"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_capri_40[]" class="form-control qty" placeholder="Qty 40"/> 
                                                        </td> 
                                                        <td> 
                                                            <button type="button" class="btn btn-primary disabled btn-delete-row"><i class="fa fa-times"></i> </button>
                                                        </td> 
                                                    </tr>
                                                </table> 
                                            </div>
                                        </div>
                                        <div class="custom-dashed-hr"></div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" id="btn_add_product_details_row_capri" type="button"><i class="fa fa-plus"></i> Add Rows</button>
                                    </div>
                                </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <!-- under garments -->
                                <div class="under-garments hidden">
                                    <div class="template-container-under-garments">
                                    <div class="template description-row">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label>Under Garments Article Number</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Under Garments Article Price</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Our Price</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Under Garments Total Quantity</label>
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-0">
                                            <div class="col-sm-3">
                                                <input type="text" name="under_garments_article_no[]" class="form-control" placeholder="Article Number"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="under_garments_article_price[]" class="form-control" placeholder="Article Price"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="under_garments_our_price[]" class="form-control" placeholder="Article Price"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="under_garments_total_quantity[]" class="form-control total-qty" readonly placeholder="Total Quantity" />
                                            </div>
                                        </div>
                                        <div class="form-group margin-bottom-0">
                                            <div class="col-sm-12">
                                                <table class="table product-description-table"> 
                                                    <tr> 
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_75[]" class="form-control qty" placeholder="Qty 75"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_80[]" class="form-control qty" placeholder="Qty 80"/>
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_85[]" class="form-control qty" placeholder="Qty 85"/> 
                                                        </td>
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_90[]" class="form-control qty" placeholder="Qty 90"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_95[]" class="form-control qty" placeholder="Qty 95"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_100[]" class="form-control qty" placeholder="Qty 100"/> 
                                                        </td> 
                                                        <td> 
                                                            <input type="text" name="qty_under_garments_105[]" class="form-control qty" placeholder="Qty 105"/> 
                                                        </td> 
                                                        <td> 
                                                            <button type="button" class="btn btn-primary disabled btn-delete-row"><i class="fa fa-times"></i> </button>
                                                        </td> 
                                                    </tr>
                                                </table> 
                                            </div>
                                        </div>
                                        <div class="custom-dashed-hr"></div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" id="btn_add_product_details_row_under_garments" type="button"><i class="fa fa-plus"></i> Add Rows</button>
                                    </div>
                                </div>
                                    <div class="hr-line-dashed"></div>
                                </div>

                                <!-- others -->
                                <div class="others hidden">
                                    <div class="template-container-others">
                                        <div class="template description-row">
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label>Product Name</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>Article Number</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>Article Price</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>Our Price</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>Total Quantity</label>
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom-0">
                                                <div class="col-sm-2">
                                                    <input type="text" name="others_product_name[]" class="form-control " placeholder="Product Name"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="others_article_no[]" class="form-control " placeholder="Article Number"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="others_article_price[]" class="form-control " placeholder="Article Price"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="others_our_price[]" class="form-control " placeholder="Our Price"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" name="others_total_quantity[]" class="form-control " placeholder="Total Quantity" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" class="btn btn-primary disabled btn-delete-row"><i class="fa fa-times"></i> </button>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" id="btn_add_product_details_row_others" type="submit"><i class="fa fa-plus"></i> Add Rows</button>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" name="btn_add_products" id="btn_add_products" type="submit">Save Details</button>
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
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/jquery.gritter.min.js"></script>
<script src="assets/js/pace.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#product_category_id').change(function(){
            showProductForm(this.value);
        });

        function calculateQuantityTotal () {
            $(".qty").keyup(function() {
                var parent_row = $(this).closest('.description-row');
                var sum =0 ;
                parent_row.find(".qty").each(function(index,val){
                    if($(this).val()!="")
                        sum+=parseInt($(this).val());
                });
                parent_row.find(".total-qty").val(sum);
            });
        }
        calculateQuantityTotal();
        function showProductForm(value) {
            if (value ==1) {
                $('.jeans').removeClass('hidden');
                $('.shirt').addClass('hidden');
                $('.capri').addClass('hidden');
                $('.under-garments').addClass('hidden');
                $('.others').addClass('hidden');
            }
            if (value ==2 || value==6) {
                $('.jeans').addClass('hidden');
                $('.shirt').removeClass('hidden');
                $('.capri').addClass('hidden');
                $('.under-garments').addClass('hidden');
                $('.others').addClass('hidden');
            }
            if (value ==3) {
                $('.jeans').addClass('hidden');
                $('.shirt').addClass('hidden');
                $('.capri').removeClass('hidden');
                $('.under-garments').addClass('hidden');
                $('.others').addClass('hidden');
            }
            if (value ==4) {
                $('.jeans').addClass('hidden');
                $('.shirt').addClass('hidden');
                $('.capri').addClass('hidden');
                $('.under-garments').removeClass('hidden');
                $('.others').addClass('hidden');
            }
            if (value ==5) {
                $('.jeans').addClass('hidden');
                $('.shirt').addClass('hidden');
                $('.capri').addClass('hidden');
                $('.under-garments').addClass('hidden');
                $('.others').removeClass('hidden');
            }
        }

        $("#btn_add_product_details_row_jeans").click(function() {
            $cloned_row = $(".template-container-jeans .template").clone();
            $cloned_row.removeClass('template');
            $cloned_row.find('button').removeClass('disabled');
            $(".template-container-jeans").append($cloned_row);
            $cloned_row.find('input').val("");
            initializeDeleteFunctions();
            calculateQuantityTotal();
        });

        $("#btn_add_product_details_row_shirt").click(function() {
            $cloned_row = $(".template-container-shirt .template").clone();
            $cloned_row.removeClass('template');
            $cloned_row.find('button').removeClass('disabled');
            $(".template-container-shirt").append($cloned_row);
            $cloned_row.find('input').val("");
            initializeDeleteFunctions();
            calculateQuantityTotal();
        });

        $("#btn_add_product_details_row_capri").click(function() {
            $cloned_row = $(".template-container-capri .template").clone();
            $cloned_row.removeClass('template');
            $cloned_row.find('button').removeClass('disabled');
            $(".template-container-capri").append($cloned_row);
            initializeDeleteFunctions();
            calculateQuantityTotal();
        });

        $("#btn_add_product_details_row_under_garments").click(function() {
            $cloned_row = $(".template-container-under-garments .template").clone();
            $cloned_row.removeClass('template');
            $cloned_row.find('button').removeClass('disabled');
            $(".template-container-under-garments").append($cloned_row);
            $cloned_row.find('input').val("");
            initializeDeleteFunctions();
            calculateQuantityTotal();
        });
        $("#btn_add_product_details_row_others").click(function() {
            $cloned_row = $(".template-container-others .template").clone();
            $cloned_row.removeClass('template');
            $cloned_row.find('button').removeClass('disabled');
            $(".template-container-others").append($cloned_row);
            $cloned_row.find('input').val("");
            initializeDeleteFunctions();
            calculateQuantityTotal();
        });

        function initializeDeleteFunctions () {
            $(".btn-delete-row").click(function() {
                $(this).closest('.description-row').remove();
            });
        }

        <?php
        if($flag) {
        ?>
            $.gritter.add({
                title: '<?php echo $response['title']; ?>',
                text: '<?php echo $response['msg']; ?>',
                time: 2000
            });
        <?php
        }
        ?>
        showProductForm();
    });
</script>

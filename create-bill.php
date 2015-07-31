<?php
include_once('classes/database.php');
if(empty($_SESSION['logged_in'])){
    header('location:index.php');
}
$flag= false;
if(isset($_POST['generate_bill'])) {
    $db = new Database();
    $info=$_POST;
//    $info=array(
//        'bill_no'=>$_POST['bill_no'],
//        'name'=>$_POST['name'],
//        'payment_mode'=>$_POST['payment_mode'],
//        'barcode'=>$_POST['barcode'],
//        'available'=>$_POST['available'],
//        'qty'=>$_POST['qty'],
//        'rate'=>$_POST['rate'],
//        'total'=>$_POST['total'],
//        'grand_total'=>$_POST['grand_total']
//    );
    $response = $db->generate_bill($info);
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
                <li class="active">
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Billing Section</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true">
                        <li class="active"><a href="create-bill.php">Create Bill</a></li>
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
                <h2>Bill Details</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Create Bill</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5> <i class="fa fa-bar-chart"></i> Enter the Bill Details</h5>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" action="#" method="post">
                                <div class="form-group">
                                    <?php
                                    $db=new Database();
                                    $get_bill_no=$db->getBill_no();
                                    ?>
                                    <label class="col-sm-2 control-label">Bill No.</label>
                                    <div class="col-sm-4">

                                        <input type="text" name="bill_no" id="bill_no" autocomplete="off" class="form-control" readonly value="<?php echo $get_bill_no; ?>"/>
                                    </div>
                                    <label class="col-sm-2 control-label">Payment Mode</label>
                                    <div class="col-sm-3" id="">
                                        <select class="form-control" name="payment_mode" id="payment_mode">
                                            <option value="">Select Payment Mode</option>
                                            <option  value="cash">Cash</option>
                                            <option  value="credit">Credit</option>
                                            <option  value="debit card">Debit Card</option>
                                            <option  value="credit card">Credit Card</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="name" autocomplete="off" id="name" class="form-control" value=""/>
                                    </div>
                                    <label class="col-sm-2 control-label contact hidden">Contact No:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="contact" autocomplete="off" class="form-control contact hidden" value=""/>
                                    </div>

                                </div>
                                <div class="hr-line-dashed"></div>

                                <!-- jeans-->
                                <div class="product">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Bar Code</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Available</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Qty</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Price(per piece)</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Amount</label>
                                        </div>
                                    </div>
                                    <div class="form-group templete-container-product margin-bottom-0">
                                        <div class="template description-row">
                                            <div class="col-sm-3">
                                                <input type="text" name="barcode[]" autocomplete="off" autocomplete="off" class="form-control barcode_string" value="" />
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="available[]" autocomplete="off" readonly class="form-control available" value=""/>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="qty[]" autocomplete="off" class="form-control qty" value=""/>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="rate[]" autocomplete="off" class="form-control rate" value=""/>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" name="total[]" autocomplete="off" class="form-control total" readonly value=""/>
                                            </div> 
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-primary disabled btn-delete-row"><i class="fa fa-times"></i> </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" id="btn_add_product_sell" type="button"><i class="fa fa-plus"></i> Add Rows</button>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group" id="grand_total">
                                        <label class="col-sm-2 col-sm-offset-8 control-label pay hidden">Pay</label>
                                        <div class="col-sm-2 ">
                                            <input type="text" name="pay" autocomplete="off" id="" class="form-control pay hidden" value="">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group" id="grand_total">
                                        <label class="col-sm-2 col-sm-offset-8 control-label">Grand Total</label>
                                        <div class="col-sm-2 ">
                                            <input type="text" name="grand_total" autocomplete="off" id="" class="form-control grand_total" readonly="" value="">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                                <div class="form-group" id="btn_print">
                                    <div class="col-sm-3 col-sm-offset-9">
                                        <button class="btn btn-primary disabled" type="submit" name="generate_bill" id="generate_bill">Generate Bill</button>
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
<script src="assets/js/inspinia.js"></script>
<script src="assets/js/jquery.gritter.min.js"></script>
<script src="assets/js/pace.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        function amount($parent){
            var total=0;
            var qty=$parent.find($('.qty')).val();
            if(qty=="") qty=0;
            var rate=$parent.find($('.rate')).val();
            if(rate=="") rate=0;
            $parent.find('.total').val(parseInt(qty)*parseFloat(rate));
        }
        function grand_total() {
            var grand_total=0;
            $('.total').each(function(i,data){
                if($(this).val()!='') {
                    grand_total +=parseFloat($(this).val());
                }
                else{
                    $('.grand_total').val(0);
                }
                $('.grand_total').val(grand_total);
            });
        }
        $('#name').keyup(function(){
            check();
        });
        $('#payment_mode').change(function(){
            var mode=$(this).val();
            add_option(mode);
            check();
        });
        function add_option(mode){
            if(mode=="credit"){
                $('.contact').each(function(){
                    $('.contact').removeClass("hidden");
                });
                $('.pay').each(function(){
                    $('.pay').removeClass("hidden");
                });

            }
            else {
                $('.contact').each(function(){
                    $('.contact').addClass("hidden");
                });
                $('.pay').each(function(){
                    $('.pay').addClass("hidden");
                });
            }
        }
        function check() {
            var check_name=$('#name').val();
            var check_grand_total=$('.grand_total').val();
            var check_payment_mode=$('#payment_mode').val();
            console.log(check_payment_mode);
            if((check_name !="") && (check_grand_total !="") && (check_payment_mode !="") && (check_payment_mode !=null)) {
                $('#generate_bill').removeClass('disabled');
            }
            else {
                $('#generate_bill').addClass('disabled');
            }
        }
        check();
        function initialize(){


            $('.rate').keyup(function(){
                var $parent = $(this).closest('.description-row');
                amount($parent);
                grand_total();
                check();
            });
            $(".btn-delete-row").click(function() {
                $(this).closest('.description-row').remove();
                grand_total();
            });

            $(".qty").keyup(function() {
                var $parent = $(this).closest('.description-row');
                amount($parent);
                qty($parent);

            });
            check();
        }

        function qty($parent) {
            $available=parseInt($parent.find($('.available')).val());
            $qty=parseInt($parent.find($('.qty')).val());
            if($qty>$available) {
                $.gritter.add({
                    title: 'warning',
                    text: 'Quantity must be less than available quantity',
                    time: 2000
                });
                $parent.find($('.qty')).val("");
            }
        }

        $("#btn_add_product_sell").click(function() {
            $cloned_row = $(".templete-container-product .template").clone();
            $cloned_row.removeClass('template');
            $cloned_row.find('button').removeClass('disabled');
            $('.templete-container-product').append($cloned_row);
            $cloned_row.find('input').val("");
            initialize();
            initializeKeyUp();
            initializePreventEnter();
        });
        initializeKeyUp();
        initializePreventEnter();

        function initializePreventEnter() {
            $("input").keypress(function(e) {
                if(e.which==13) {
                    e.preventDefault();
                    return;
                }
            });
        }

        function initializeKeyUp () {
            $(".barcode_string").keyup( function(e){
                if(e.which == '10' || e.which=='13') {
                    e.preventDefault();
                    return;
                }
                var barcode=$(this).val();
                var self = $(this);
                $.ajax({
                    url:'jquery-data.php',
                    type:'GET',
                    dataType:'JSON',
                    data:{Search_barcode:1,Barcode:barcode},
                    success:function(data,textStatus,jqXHR) {
                        if(data.count==1) {
                            if(data.quantity==0) {
                                self.closest(".description-row").find('.available').val(data.quantity);
                                self.closest(".description-row").find('.qty').attr('readonly',true);
                                self.closest(".description-row").find('.rate').attr('readonly',true);
                            }
                            else if (data.quantity >0 ) {
                                self.closest(".description-row").find('.available').val(data.quantity);
                                self.closest(".description-row").find('.qty').removeAttr('readonly',false);
                                self.closest(".description-row").find('.rate').removeAttr('readonly',false);
                            }
                            else {
                                self.closest(".description-row").find('.available').val("");
                                self.closest(".description-row").find('.qty').removeAttr('readonly',false);
                            }
                            self.closest(".description-row").find('.qty').focus();
                        }
                        else {
                            self.closest(".description-row").find('.available').val("");
                            self.closest(".description-row").find('.qty').val("");
                            self.closest(".description-row").find('.rate').val("");
                            self.closest(".description-row").find('.total').val("");
                            grand_total();
                        }
                    }
                });
            });
        }
        initialize();
        check();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        <?php
        if($flag) {
        ?>
        window.location.assign("show_bill.php?bill_no="+<?php echo $bill_no?>);
        <?php
        }
        ?>
    });
</script>

<?php
include_once('classes/database.php');
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
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <style type="text/css">
        body
        {
            font-size: 13px;
        }
        span.block{
            display: block;
        }

        span.large
        {
            font-size: 14px;
        }

        span.bold{
            font-weight: bold;
        }

        body{
            font-family: 'Open Sans';
        }

        p.footer-para {
            text-align: center;
            width: 100%;
        }


        @media print {

            p.footer-para {
                padding-left: 150px;
            }

            .footer{
                width: 100%;
            }
            .add-table{
                width: 100%;
            }

            .print-hide{
                display: none;
            }

        }
    </style>

</head>
<body class='page-header-fixed'>
<div class='container' style="margin-top: 50px;">
    <div class="row">
        <h1 class="text-center">Company Reports</h1>
        <div class="col-md-12">
            <table class="company-info">
                <tr>
                    <td class="col-sm-3">Company Name :</td>
                    <?php
                        $db=new Database();
                        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
                        $stmt=$dbobject->prepare("select * from `companies` where `id`=:company_id");
                        $stmt->bindParam("company_id",$_GET['company_id']);
                        $stmt->execute();
                        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <td class="col-sm-5"><?php echo $row['company_name']; ?></td>
                </tr><br/>
                <tr>
                    <td class="col-sm-1 ">From:</td>
                    <td class=""><?php echo $_GET['start'];?></td>
                    <td class="col-sm-1">To:</td>
                    <td class=""><?php echo $_GET['end'];?></td>
                </tr>
            </table>
        </div>
        <div class="hr-line-dashed"></div>
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
        <!-- others -->
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
        <div class="form-group print-hide" >
            <div class="col-sm-2 col-sm-offset-10">
                <a class="btn btn-primary" name="" id="btn_print" style="margin-top: 10px;" >Print</a>
                <button class="btn btn-white" type="submit" style="margin-top: 10px;" >Cancel</button>
            </div>
        </div>
    </div>

</div>
</body>
</html>

<script src="assets/js/jquery-2.1.1.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
            var $company_id="<?php echo $_GET['company_id']?>";
            var $start="<?php echo $_GET['start']?>";
            var $end="<?php echo $_GET['end']?>";
            $.ajax({
                url:'jquery-data.php',
                type:'GET',
                dataType:'JSON',
                data:{search_company_details:1,Company_id:$company_id,Start:$start,End:$end},
                success:function(data){
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
                    $("#grand_total_value").val(grand_total);
                }
            });
        $('#btn_print').click(function(){
            window.print();
        });

    });
</script>
<?php
include_once('classes/database.php');
if(empty($_SESSION['logged_in'])){
    header('location:index.php');
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
        <div class="col-md-12">
            <h1 class="text-center">Approval Reports</h1>
            <table class="company-info">
                <tr>
                    <td class="col-sm-3">Employee Name :</td>
                    <?php
                    $db=new Database();
                    $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
                    $stmt=$dbobject->prepare("select * from `Approval_product`where `approval_by`=:employee_name");
                    $stmt->bindParam("employee_name",$_GET['employee_name']);
                    $stmt->execute();
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <td class="col-sm-5"><?php echo $row['approval_by']; ?></td>
                </tr><br/>
                <tr>
                    <td class="col-sm-1 ">From:</td>
                    <td class=""><?php echo $_GET['start'];?></td>
                    <td class="col-sm-1">To:</td>
                    <td class=""><?php echo $_GET['end'];?></td>
                </tr>
            </table>
        </div>
        <div class="sales-details hidden">
            <table class="table table-striped table-bordered table-hover " >
                <thead>
                <tr >
                    <th rowspan="2" class="text-center ">Bill No.</th>
                    <th rowspan="2" class="text-center ">Name</th>
                    <th rowspan="2" class="text-center" >Date</th>
                    <th rowspan="2" class="text-center" >Contact No.</th>
                    <th rowspan="2" class="text-center" >Approval By</th>
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
        var $employee_name="<?php echo $_GET['employee_name'] ?>";
        var $start="<?php echo $_GET['start']?>";
        var $end="<?php echo $_GET['end']?>";
        $.ajax({
            url:'jquery-data.php',
            type:'GET',
            dataType:'JSON',
            data:{search_sales_details:1,Employee_name:$employee_name,Start:$start,End:$end},
            success:function(data){
                var grand_total = 0;
                if(data.length>0) {
                    $('.sales-details').removeClass('hidden');
                    for(var i=0;i<data.length;i++) {
                        var $template=$('.table-body-sales .table-row-sales').clone();
                        $template.removeClass('table-row-sales');
                        $template.removeClass('hidden');
                        $template.addClass('append');
                        $template.find('td').eq(0).html(data[i].id);
                        $template.find('td').eq(1).html(data[i].name);
                        $template.find('td').eq(2).html(data[i].date);
                        $template.find('td').eq(3).html(data[i].contact_no);
                        $template.find('td').eq(4).html(data[i].approval_by);
                        $template.find('td').eq(5).html(data[i].grand_total);
                        grand_total+=parseInt(data[i].grand_total);
                        $('.table-body-sales').append($template);
                    }
                }
                $("#grand_total_value").val(grand_total);
                $('#btn_print').removeClass('hidden');
            }
        });

        $('#btn_print').click(function(){
            window.print();
        });
    });
</script>
<?php
require_once('classes/database.php');
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
            font-size:7px;
        }
        span.block{
            display: block;
        }

        span.large
        {
            font-size:9px;
        }

        span.bold{
            font-weight: bold;
        }

        body{
            font-family: 'Open Sans';
        }

        p.footer-para {
            text-align: center;
            width: 580px;
            height:840px;
        }


        @media print {

            p.footer-para {
                padding-left: 50px;
            }

            .footer{
                width: 580px;
                height:840px;
            }
            .add-table{
                width: 580px;
                height:840px;
            }

            .print-hide{
                display: none;
            }

        }
    </style>

</head>
<body class='page-header-fixed'>
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <table>
                <tr >
                    <td style="padding-bottom: 20px;">
                        <span class='bold block' style="font-size: 18pt">Chanchal Garments</span>
                                <span class='' style="font-size: 10pt">Zinc Smelter Choraha, Debari,Udaipur(Rajasthan)<br/>
                                Mo.- (+91) 09602230361</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php 
    $bill_no=$_GET['bill_no'];
    $db=new Database();
    $bill_details=$db->getBillDetails($bill_no);
function convert_number_to_words($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?>
    <div class="row" style="padding-top: 15px;">
        <div class="col-md-12">
            <table>
                <tr>
                    <td class="col-md-4" ><span class='block bold'>Bill No : &nbsp;&nbsp;<?php echo $bill_details['id']; ?></span></td>
                    <td class="col-md-4 " ><span class='block bold'>Date: &nbsp;&nbsp;<?php echo $bill_details['date']; ?>&nbsp;&nbsp;<?php echo $bill_details['time']; ?></span></td>
                </tr>
                <tr >
                    <td class="col-md-6" style="padding-top: 25px;"><span class='bold'>M/S  &nbsp;&nbsp;&nbsp;&nbsp;   :&nbsp;&nbsp;<?php echo $bill_details['name']; ?></span></td>
                    <td class="col-md-4" style="padding-top: 25px;"><span class='bold'>Payment Mode :&nbsp;&nbsp;<?php echo $bill_details['payment_mode']; ?></span></td>
                </tr>
            </table>
        </div>
    </div>
    <hr/>
    <div class='row' style='margin-top:10px;'>
        <div class='col-md-12'>
            <table class="table table-bordered table-hover" width='550px'>
                <thead>
                <tr>
                    <th>
                        Sr. No.
                    </th>
                    <th>
                        Particular
                    </th>
                    <th>
                        Qty
                    </th>
                    <th>
                        Price/peice
                    </th>
                    <th>
                        Amount
                    </th>
                </tr>
                </thead>
                <?php
                $bill_details_info=$db->getBill_details($bill_no);
                $i=1;
                foreach($bill_details_info as $bill_info)
                {
                    echo "<tr><td > $i</td>
                        	<td >$bill_info[company_name] &nbsp;&nbsp;$bill_info[category_name] &nbsp;&nbsp;$bill_info[article_no]</td>
                        	<td>$bill_info[qty]</td>
                        	<td>$bill_info[rate]</td>
                        	<td><i class='fa fa-rupee'></i>&nbsp;$bill_info[total]</td>
                        </tr>" ;
                    $i++;
                } ?>
                <tbody>
                <tr>
                    <td colspan='4' style='text-align:right;'>
                        Net Amount :
                    </td>
                    <td >
                        <i class='fa fa-rupee'></i>&nbsp;<?php echo $bill_details['grand_total']; ?>
                    </td>
                <tr>
                    <td colspan='5'>
                        <span class='block'>Amount Chargable (In words)</span>
                        <span style='text-transform:capitalize;' class='bold'><?php echo convert_number_to_words($bill_details['grand_total']); ?> &nbsp; Rupees</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <span class="bold">TIN No:&nbsp;</span><span>08683962289</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <span class="block bold">Term And Conditions:</span>
                        <span class="block">1. Subject to udaipur jurisdiction only.</span>
                        <span class="block">2. If payment not made in within 7 days, Interest @24% p.a will be charged extra.</span>

                    </td>
                    <td>
                        For chanchal Garments
                        <br>
                        <br>
                        Authorised Signatory
                    </td>
                </tr>
                <tr class='print-hide'>
                    <td style='text-align:center;' colspan='5'>
                        <button class='btn btn-success' id='print_invoce'>Print Invoice</button>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;" colspan="5">
                        This is a computer generated invoice.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<script src="assets/js/jquery-2.1.1.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#print_invoce").click(function() {
            window.print();
        });
    });
</script>

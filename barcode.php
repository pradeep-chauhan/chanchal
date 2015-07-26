<?php include_once('classes/database.php'); ?>
<!doctype html>
<html>
<head>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<style>
    @media print {
        .print-hide{
            display: none;
        }

    }
</style>
<body>
<?php
$info=array(
    'company_id'=>$_GET['company_id'],
    'product_category_id'=>$_GET['product_category_id'],
    'article_no'=>$_GET['article_no']
);

$array_product_categories = array(1=>"Jeans",2=>"Shirt",3=>"Capri",4=>"UG");
$dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
$array_json = array();
$total_article=count($info['article_no']);
$stmt=$dbobject->prepare("select * from `companies` WHERE `id`=:company_id");
$stmt->bindParam(":company_id",$info['company_id']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$company_name=$row['company_name'];
for($i=0;$i<$total_article;$i++) {
    $stmt= $dbobject->prepare("select `product_details`.`id`,`product_details`.`our_price`,`product_details`.`article_no` from `products` INNER JOIN `companies` ON `products`.`company_id`=`companies`.`id` INNER  JOIN `product_details` ON `product_details`.`product_id`=`products`.`id` where `products`.`product_category_id`=:product_category_id and `products`.`company_id`=:company_id and `product_details`.`id`=:article_no");
    $stmt->bindParam(":product_category_id",$info['product_category_id']);
    $stmt->bindParam(":company_id",$info['company_id']);
    $stmt->bindParam(":article_no",$info['article_no'][$i]);
    $stmt->execute();
    $col_counter = 0;
    while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
        $our_price=$row['our_price'];
        $array_single_row = array();
        $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
        $stmt2->bindParam(":product_details_id",$row['id']);
        $stmt2->execute();

        ?>
        <?php
        while( $row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
            for($j=1;$j<=$row_details_explained['quantity'];$j++) {
                ?>
                <div style="text-align: center; display: inline-block; margin-top: 3%; margin-bottom: 3%; margin-left: 2.5%; width: 20%;">
                    <p><?php echo $company_name; ?>&nbsp;&nbsp;<?php echo $row['article_no']; ?></p>
                    <img alt="12345" src="barcodegen/test_1D.php?text=<?php echo $row_details_explained['bar_code']; ?>"/>
                    <p><?php echo $row_details_explained['bar_code'] ; ?>&nbsp;<?php echo $array_product_categories[$info['product_category_id']]." ".$row_details_explained['size']; ?></p>
                    <p><?php echo $our_price; ?>/-</p>
                </div>
            <?php
            }
        }
        ?>
        <?php
    }
}
?>
    <div class='print-hide col-md-12'>
        <div style="text-align: center;">
            <button class='btn btn-success' id='print_invoice'>Print Bar Codes</button>
        </div>
    </div>
</body>
</html>
<script src="assets/js/jquery-2.1.1.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#print_invoice").click(function(){
            window.print();
        });
    });
</script>


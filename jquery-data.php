<?php
require_once('classes/database.php');

if(isset($_GET['search_company_details'])){
    $db= new Database();
    $info=array(
    'company_id'=> $_GET['Company_id'],
    'start'=> $_GET['Start'],
    'end'=> $_GET['End']
    );
    $response = $db->search_company_stock($info);
    echo json_encode($response);

}
elseif(isset($_GET['search_sales_details'])){
    $db= new Database();
    $info=array(
        'employee_name'=> $_GET['Employee_name'],
        'start'=> $_GET['Start'],
        'end'=> $_GET['End']
    );
    $response = $db->search_sales_details($info);
    echo json_encode($response);

}

elseif(isset($_GET['Employee_details'])){
    $db= new Database();
        $employee_name= $_GET['Employee_name'];
    $response = $db->employee_info($employee_name);
    echo json_encode($response);

}

elseif(isset($_GET['search_approval_details'])){
    $db= new Database();
    $info=array(
        'employee_name'=> $_GET['Employee_name'],
        'start'=> $_GET['Start'],
        'end'=> $_GET['End']
    );
    $response = $db->search_approval_details($info);
    echo json_encode($response);

}
elseif(isset($_GET['search_product_details'])){
    $db= new Database();
    $info=array(
        'product_category_id'=> $_GET['Product_category_id'],
        'start'=> $_GET['Start'],
        'end'=> $_GET['End']
    );
    $response = $db->search_product_stock($info);
    echo json_encode($response);

}
elseif(isset($_GET['Generate_bill'])){
    $db= new Database();
    $info=array(
        'bill_no'=>$_GET['Bill_no'],
        'name'=>$_GET['Name'],
        'payment_mode'=>$_GET['Payment_mode'],
        'barcode'=>$_GET['Barcode'],
        'available'=>$_GET['Available'],
        'qty'=>$_GET['Qty'],
        'rate'=>$_GET['Rate'],
        'total'=>$_GET['Total'],
        'grand_total'=>$_GET['Grand_total']
    );
    $response=$db->generate_bill($info);

}

elseif(isset($_GET['Update_bill'])){
    $db= new Database();
    $info=array(
        'bill_no'=>$_GET['Bill_no'],
        'name'=>$_GET['Name'],
        'payment_mode'=>$_GET['Payment_mode'],
        'barcode'=>$_GET['Barcode'],
        'available'=>$_GET['Available'],
        'qty'=>$_GET['Qty'],
        'rate'=>$_GET['Rate'],
        'total'=>$_GET['Total'],
        'grand_total'=>$_GET['Grand_total']
    );
    $response=$db->update_bill($info);

}

elseif(isset($_GET['For_approval'])){
    $db= new Database();
    $info=array(
        'bill_no'=>$_GET['Bill_no'],
        'name'=>$_GET['Name'],
        'contact_no'=>$_GET['Contact_no'],
        'barcode'=>$_GET['Barcode'],
        'available'=>$_GET['Available'],
        'qty'=>$_GET['Qty'],
        'rate'=>$_GET['Rate'],
        'total'=>$_GET['Total'],
        'grand_total'=>$_GET['Grand_total']
    );
    $response=$db->generate_bill_for_approval($info);

}

elseif(isset($_GET['Search_barcode'])){
    $db=new Database();
    $barcode=$_GET['Barcode'];
    $search_barcode_values=$db->barcode_search($barcode);
    echo json_encode($search_barcode_values);
}
elseif(isset($_GET['Bill_search']))
{
    $db=new Database();
    $search_bill_no=$_GET['Search_bill_no'];
    $search_name=$_GET['Search_name'];
    $response=$db->search_bill($search_bill_no,$search_name);
    echo json_encode($response);
}
elseif(isset($_GET['pay_amount']))
{
    $db=new Database();
    $bill_no=$_GET['bill_no'];
    $name=$_GET['name'];
    $amount=$_GET['amount'];
    $response=$db->updateCreditInfo($bill_no,$name,$amount);
    echo json_encode($response);
}
elseif(isset($_GET['credit_bill_search']))
{
    $db=new Database();
    $search_bill_no=$_GET['Search_bill_no'];
    $search_name=$_GET['Search_name'];
    $search_mobile=$_GET['Search_mobile'];
    $response=$db->searchCredit_bill($search_bill_no,$search_name,$search_mobile);
    echo json_encode($response);
}
elseif(isset($_GET['Approval_bill_search']))
{
    $db=new Database();
    $search_bill_no=$_GET['Search_bill_no'];
    $search_name=$_GET['Search_name'];
    $response=$db->search_bill_approval($search_bill_no,$search_name);
    echo json_encode($response);
}
elseif(isset($_GET['ArticleDetails']))
{
    $db=new Database();
    $product_details_id=$_GET['product_details_id'];
    $product_category_id=$_GET['Product_id'];
    $response=$db->SearchArticleDetails($product_details_id,$product_category_id);
    echo json_encode($response);
}
elseif(isset($_GET['Article_no']))
{
    $db=new Database();
    $company_id=$_GET['Company_id'];
    $product_category_id=$_GET['Product_category_id'];
    $response=$db->getSearch_article_no($company_id,$product_category_id);
    echo json_encode($response);
}
elseif(isset($_POST['cancel_bill'])) {
    $db = new Database();
    $response=$db->cancelBill($_POST['bill_no']);
    echo json_encode($response);
}
elseif(isset($_POST['adjust_approval_bill'])) {
    $db = new Database();
    $response=$db->adjustApprovalBill($_POST['bill_no']);
    echo json_encode($response);
}
?>


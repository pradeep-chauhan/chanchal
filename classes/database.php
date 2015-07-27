<?php
session_start();
class Config {
//    static $dbUser='chanchalgarments';
//    static $dbPassword='Whypass@123';
//    static $dbHost='chanchalgarments.db.12055437.hostedresource.com';
//    static $dbType='mysql';
//    static $dbName="chanchalgarments";


    static $dbUser='root';
    static $dbPassword='root';
    static $dbHost='localhost';
    static $dbType='mysql';
    static $dbName="chanchalgarments";

}
class Database {

    function getBillDetails($bill_no) {
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select * from `sell_product` where `id`=:bill_no");
        $stmt->bindParam(':bill_no',$bill_no);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $bill_details=$row;
        $dbobject=null;
        return $bill_details;
    }

    function checkLogin($info){
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `user` where `username`=:login_username and `password`=:login_password");
        $stmt->bindParam(':login_username', $info['login_username']);
        $stmt->bindParam(':login_password', $info['login_password']);
        $stmt->execute();
        if($stmt->rowCount()>0) {
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username']=$row['username'];
            $_SESSION['logged_in']=true;
            $_SESSION['role']=$row['role'];
            $response['status']=200;
            $response['redirect_url']='home.php';
        }
        else {
            $response['status']=401;
            $response['msg'] = "Incorrect username or password";
        }
        $dbobject = null;
        return $response;
    }
    function registerCompany($info) {
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" insert into `companies` (`company_name`,`contact_person_name`,`contact_number`,`address`) values(:company_name,:contact_person_name,:contact_number,:address)");
        $stmt->bindParam(':company_name', $info['company_name']);
        $stmt->bindParam(':contact_person_name', $info['contact_person_name']);
        $stmt->bindParam(':contact_number', $info['contact_number']);
        $stmt->bindParam(':address', $info['address']);
        if($stmt->execute()) {
            $response['title'] = "Info";
            $response['msg'] = "Company added successfully";
        }
        else {
            $response['title'] = "Error";
            $response['msg'] = "Internal error occurred";
        }
        $dbobject = null;
        return $response;
    }
    function addProductCategory($info) {
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" insert into `product_category` (`product_name`) values(:product_name)");
        $stmt->bindParam(':product_name', $info['product_name']);
        if($stmt->execute()) {
            $response['title'] = "Info";
            $response['msg'] = "Product added successfully";
        }
        else {
            $response['title'] = "Error";
            $response['msg'] = "Internal error occurred";
        }
        $dbobject = null;
        return $response;
    }
    function addProducts($info) {
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" insert into `products` (`company_id`,`product_category_id`,`stock_entry_date`) values(:company_id,:product_category_id,:stock_entry_date)");
        $stmt->bindParam(':company_id', $info['company_id']);
        $stmt->bindParam(':product_category_id', $info['product_category_id']);
        date_default_timezone_set("Asia/Kolkata");
        $stock_entry_date = date('Y-m-d');
        $stmt->bindParam(':stock_entry_date', $stock_entry_date);
        if($stmt->execute()) {
            $products_id = $dbobject->lastInsertId();
            $total_rows = count($info['article_no']);
            for($i=0;$i<$total_rows;$i++) {
                $stmt=$dbobject->prepare(" insert into `product_details` (`product_id`,`article_no`,`article_price`,`single_piece_price`,`our_price`,`added_on`) values(:product_id,:article_no,:article_price,:single_piece_price,:our_price,:added_on)");
                $stmt->bindParam(':product_id', $products_id);
                $stmt->bindParam(':article_no', $info['article_no'][$i]);
                $stmt->bindParam(':article_price', $info['article_price'][$i]);
                $stmt->bindParam(':our_price', $info['our_price'][$i]);
                $single_piece_price = $info['article_price'][$i]/$info['total_quantity'][$i];
                $stmt->bindParam(':single_piece_price', $single_piece_price);
                $added_on = date("Y-m-d");
                $stmt->bindParam(':added_on', $added_on);
                $stmt->execute();
                $product_details_id = $dbobject->lastInsertId();

                if($info['product_category_id']==1) {
                    for($size=28;$size<=40;$size=$size+2) {
                        $stmt=$dbobject->prepare(" insert into `product_details_explained` (`product_details_id`,`quantity`,`size`,`bar_code`) values(:product_details_id,:quantity,:size,:bar_code)");
                        $stmt->bindParam(':product_details_id', $product_details_id);
                        $stmt->bindParam(':quantity', $info["qty_jeans_$size"][$i]);
                        $stmt->bindParam(':size', $size);
                        $bar_code = $size.time();
                        $bar_code = md5($bar_code);
                        $bar_code = $bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)];
                        $stmt->bindParam(':bar_code', $bar_code);
                        $stmt->execute();
                    }
                }
                elseif($info['product_category_id']==2 || $info['product_category_id']==6) {
                    $array_sizes = array('s','m','l','xl','xxl','xxxl');
                    foreach($array_sizes as $size) {
                        $stmt=$dbobject->prepare(" insert into `product_details_explained` (`product_details_id`,`quantity`,`size`,`bar_code`) values(:product_details_id,:quantity,:size,:bar_code)");
                        $stmt->bindParam(':product_details_id', $product_details_id);
                        $stmt->bindParam(':quantity', $info["qty_shirt_$size"][$i]);
                        $stmt->bindParam(':size', $size);
                        $bar_code = $size.time();
                        $bar_code = md5($bar_code);
                        $bar_code = $bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)];
                        $stmt->bindParam(':bar_code', $bar_code);
                        $stmt->execute();
                    }
                }
                elseif($info['product_category_id']==3) {
                    for($size=28;$size<=40;$size=$size+2) {
                        $stmt=$dbobject->prepare(" insert into `product_details_explained` (`product_details_id`,`quantity`,`size`,`bar_code`) values(:product_details_id,:quantity,:size,:bar_code)");
                        $stmt->bindParam(':product_details_id', $product_details_id);
                        $stmt->bindParam(':quantity', $info["qty_capri_$size"][$i]);
                        $stmt->bindParam(':size', $size);
                        $bar_code = $size.time();
                        $bar_code = md5($bar_code);
                        $bar_code = $bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)];
                        $stmt->bindParam(':bar_code', $bar_code);
                        $stmt->execute();
                    }
                }
                elseif($info['product_category_id']==4) {
                    for($size=75;$size<=105;$size=$size+5) {
                        $stmt=$dbobject->prepare(" insert into `product_details_explained` (`product_details_id`,`quantity`,`size`,`bar_code`) values(:product_details_id,:quantity,:size,:bar_code)");
                        $stmt->bindParam(':product_details_id', $product_details_id);
                        $stmt->bindParam(':quantity', $info["qty_under_garments_$size"][$i]);
                        $stmt->bindParam(':size', $size);
                        $bar_code = $size.time();
                        $bar_code = md5($bar_code);
                        $bar_code = $bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)];
                        $stmt->bindParam(':bar_code', $bar_code);
                        $stmt->execute();
                    }
                }
                elseif($info['product_category_id']==5) {
                    $total_rows=count($info['article_no']);
                    for($i=0;$i<$total_rows;$i++) {
                        $stmt=$dbobject->prepare(" insert into `product_details_explained` (`product_details_id`,`quantity`,`bar_code`,`product`) values(:product_details_id,:quantity,:bar_code,:product_name)");
                        $stmt->bindParam(':product_details_id', $product_details_id);
                        $stmt->bindParam(':quantity', $info['total_quantity'][$i]);
                        $stmt->bindParam(':product_name', $info['product_name'][$i]);
                        $bar_code = rand(1,100).time();
                        $bar_code = md5($bar_code);
                        $bar_code = $bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)].$bar_code[rand(1,10)];
                        $stmt->bindParam(':bar_code', $bar_code);
                        $stmt->execute();
                    }
                }
            }
            $response['title'] = "Info";
            $response['msg'] = "Product added successfully";
        }
        else {
            $response['title'] = "Error";
            $response['msg'] = "Internal error occurred";
        }
        $dbobject = null;
        return $response;
    }
    function updateArticle($info) {
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare("update `product_details` set `article_no`=:article_no , `article_price`=:article_price,`single_piece_price`=:single_piece_price ,`our_price`=:our_price where `id`=:id");
        $stmt->bindParam(':article_no', $info['article_no']);
        $stmt->bindParam(':article_price', $info['article_price']);
        $single_piece_price = $info['article_price']/$info['total_quantity'];
        $stmt->bindParam(':single_piece_price', $single_piece_price);
        $stmt->bindParam(':our_price', $info['our_price']);
        $stmt->bindParam(':id', $info['product_details_id']);
        if($stmt->execute()) {
            $stmt=$dbobject->prepare("select `id` from `product_details_explained` where `product_details_id`= :product_details_id order by `id` ASC ");
            $stmt->bindParam(':product_details_id', $info['product_details_id']);
            $stmt->execute();
            if($info['product_category_id']==1) {
                $i=0;
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id= $row['id'];
                    $stmt_update=$dbobject->prepare(" update `product_details_explained` set `quantity`=:updated_quantity where `id`=:id");
                    $stmt_update->bindParam(':updated_quantity', $info['jeans_qty'][$i++]);
                    $stmt_update->bindParam(':id', $id);
                    $stmt_update->execute();
                }
            }
            else if($info['product_category_id']==2) {
                $i=0;
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id= $row['id'];
                    $stmt_update=$dbobject->prepare(" update `product_details_explained` set `quantity`=:updated_quantity where `id`=:id");
                    $stmt_update->bindParam(':updated_quantity', $info['shirt_qty'][$i++]);
                    $stmt_update->bindParam(':id', $id);
                    $stmt_update->execute();
                }
            }
            else if($info['product_category_id']==3) {
                $i=0;
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id= $row['id'];
                    $stmt_update=$dbobject->prepare(" update `product_details_explained` set `quantity`=:updated_quantity where `id`=:id");
                    $stmt_update->bindParam(':updated_quantity', $info['capri_qty'][$i++]);
                    $stmt_update->bindParam(':id', $id);
                    $stmt_update->execute();
                }
            }
            else if($info['product_category_id']==4) {
                $i=0;
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id= $row['id'];
                    $stmt_update=$dbobject->prepare(" update `product_details_explained` set `quantity`=:updated_quantity where `id`=:id");
                    $stmt_update->bindParam(':updated_quantity', $info['under_garments_qty'][$i++]);
                    $stmt_update->bindParam(':id', $id);
                    $stmt_update->execute();
                }
            }
            else if($info['product_category_id']==5) {
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                $id= $row['id'];
                $stmt_update=$dbobject->prepare(" update `product_details_explained` set `quantity`=:updated_quantity , `product`=:product_name where `id`=:id");
                $stmt_update->bindParam(':updated_quantity', $info['total_quantity']);
                $stmt_update->bindParam(':product_name', $info['product_name']);
                $stmt_update->bindParam(':id', $id);
                $stmt_update->execute();
            }
            $response['status']=200;
            $response['title']="INFO";
            $response['msg']="Article Updated Successfully";
        }
        $dbobject = null;
        return $response;
    }
    function getAllCompanies() {
        $companies = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `companies` ORDER BY `id` DESC ");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $companies[] = $row;
        }
        $dbobject = null;
        return $companies;
    }
    function getAllUser() {
        $employee = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `user` ");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $employee[] = $row;
        }
        $dbobject = null;
        return $employee;
    }
    function getAllProductCategories() {
        $product_category = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `product_category` ");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_category[] = $row;
        }
        $dbobject = null;
        return $product_category;
    }
    function getBarcodeProductCategories($product) {
        $product_category = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `product_category` ");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_category[] = $row;
        }
        $dbobject = null;
        return $product_category;
    }
    function search_product_stock($info) {
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $array_json = array();
        if($info['start']!="" && $info['end']!="") {
            $start_date = date_format(date_create_from_format('d-m-Y', $info['start']), 'Y-m-d');
            $end_date = date_format(date_create_from_format('d-m-Y', $info['end']), 'Y-m-d');
            $stmt= $dbobject->prepare("select `products`.`id` from `products` INNER JOIN `companies` ON `products`.`company_id`=`companies`.`id` where `products`.`product_category_id`=:product_category_id and `products`.`stock_entry_date` BETWEEN :start_date and :end_date");
            $stmt->bindParam(":start_date",$start_date);
            $stmt->bindParam(":end_date",$end_date);
        }
        else {
            $stmt= $dbobject->prepare("select `products`.`id` from `products` INNER JOIN `companies` ON `products`.`company_id`=`companies`.`id` where `products`.`product_category_id`=:product_category_id");
        }
        $stmt->bindParam(":product_category_id",$info['product_category_id']);
        $stmt->execute();
        $products_id=array();
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products_id[] = $row['id'];
        }
        $products_id_string = implode(",",$products_id);
        $stmt= $dbobject->prepare("select `companies`.`company_name`,`product_details`.`article_no`,`product_details`.`id` from `product_details` INNER JOIN `products` ON `products`.`id`=`product_details`.`product_id` INNER  JOIN `companies` ON `products`.`company_id`=`companies`.`id` where `product_details`.`product_id` IN ($products_id_string) ORDER BY `companies`.`company_name`");
        $stmt->execute();
        $array_jeans = array();
        if($info['product_category_id']==1) {
            $sizes = array(28=>"twenty_eight",30=>"thirty",32=>"thirty_two",34=>"thirty_four",36=>"thirty_six",38=>"thirty_eight",40=>"forty");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['company_name']=$row['company_name']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $array_single_row['product']="Jeans"; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while( $row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 28;$size<=40;$size=$size+2) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_jeans[]=$array_single_row;
            }
            $array_json['Jeans'] = $array_jeans;
        }
        else {
            $array_json['Jeans'] = array();
        }
        if($info['product_category_id']==2 || $info['product_category_id']==6) {
            $sizes=array("s","m","l","xl","xxl","xxxl");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['company_name']=$row['company_name']; // cal
                $array_single_row['product']='Shirt'; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$row_details_explained['size']]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];

                }
                foreach($sizes as $size) {
                    if($array_single_row[$size]==0) {
                        $array_single_row[$size]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_shirt[]=$array_single_row;
            }
            $array_json['Shirt'] = $array_shirt;
        }
        else {
            $array_json['Shirt'] = array();
        }
        if($info['product_category_id']==3) {
            $sizes = array(28=>"twenty_eight",30=>"thirty",32=>"thirty_two",34=>"thirty_four",36=>"thirty_six",38=>"thirty_eight",40=>"forty");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['company_name']=$row['company_name']; // cal
                $array_single_row['product']="Capri"; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while( $row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 28;$size<=40;$size=$size+2) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_capri[]=$array_single_row;
            }
            $array_json['Capri'] = $array_capri;
        }
        else {
            $array_json['Capri'] = array();
        }
        if($info['product_category_id']==4) {
            $sizes = array(75=>"seventy_five",80=>"eighty",85=>"eighty_five",90=>"ninety",95=>"ninety_five",100=>"hundred",105=>"one_hundred_five");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['company_name']=$row['company_name']; // cal
                $array_single_row['product']="Under Garments"; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while( $row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                    echo $array_single_row[$row_details_explained['size']];
                }
                for($size = 75;$size<=105;$size=$size+5) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_under_garments[]=$array_single_row;
            }
            $array_json['under_garments'] = $array_under_garments;
        }
        else {
            $array_json['under_garments'] = array();
        }
        if($info['product_category_id']==5) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['company_name']=$row['company_name']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                while($row_details_explained=$stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row['product_name']=$row_details_explained['product'];
                    $array_single_row['quantity']=$row_details_explained['quantity'];
                }
                $array_others[]=$array_single_row;
            }
            $array_json['others']=$array_others;
        }
        else {
            $array_json['others']=array();
        }
        return $array_json;
    }
    function search_company_stock($info) {
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $array_json = array();
        if($info['start']!="" && $info['end']!="") {
            $start_date = date_format(date_create_from_format('d-m-Y', $info['start']), 'Y-m-d');
            $end_date = date_format(date_create_from_format('d-m-Y', $info['end']), 'Y-m-d');
            $stmt= $dbobject->prepare("select DISTINCT `product_category_id` from `products` where `company_id`=:company_id and (`stock_entry_date` BETWEEN :start_date and :end_date)");
            $stmt->bindParam(":start_date",$start_date);
            $stmt->bindParam(":end_date",$end_date);
        }
        else {
            $stmt= $dbobject->prepare("select DISTINCT `product_category_id` from `products` where `company_id`=:company_id");
        }
        $stmt->bindParam(":company_id",$info['company_id']);
        $stmt->execute();
        $product_category_ids = array();
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product_category_ids[] = $row['product_category_id'];
        }
        if(in_array(1,$product_category_ids)) {
            $stmt= $dbobject->prepare("select `id` from `products` where `company_id`=:company_id and `product_category_id`=:product_category_id");
            $stmt->bindParam(":company_id",$info['company_id']);
            $product_category_id = 1;
            $stmt->bindParam(":product_category_id",$product_category_id);
            $stmt->execute();
            $products_id = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products_id[] = $row['id'];
            }
            $products_id_string = implode(",",$products_id);
            $stmt= $dbobject->prepare("select * from `product_details` where `product_id` IN ($products_id_string)");
            $stmt->execute();
            $array_jeans = array();
            $sizes = array(28=>"twenty_eight",30=>"thirty",32=>"thirty_two",34=>"thirty_four",36=>"thirty_six",38=>"thirty_eight",40=>"forty");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['product']='Jeans'; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 28;$size<=40;$size=$size+2) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_jeans[]=$array_single_row;
            }
            $array_json['Jeans'] = $array_jeans;
        }
        else {
            $array_json['Jeans'] = array();
        }
        if(in_array(2,$product_category_ids)) {
            $stmt= $dbobject->prepare("select `id` from `products` where `company_id`=:company_id and `product_category_id`=:product_category_id");
            $stmt->bindParam(":company_id",$info['company_id']);
            $product_category_id = 2;
            $stmt->bindParam(":product_category_id",$product_category_id);
            $stmt->execute();
            $products_id = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products_id[] = $row['id'];
            }
            $products_id_string = implode(",",$products_id);
            $stmt= $dbobject->prepare("select * from `product_details` where `product_id` IN ($products_id_string)");
            $stmt->execute();
            $array_shirt = array();
            $sizes = array("s","m","l","xl","xxl","xxxl");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['product']='Shirt'; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$row_details_explained['size']]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];

                }
                foreach($sizes as $size) {
                    if($array_single_row[$size]==0) {
                        $array_single_row[$size]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_shirt[]=$array_single_row;
            }
            $array_json['Shirt'] = $array_shirt;
        }
        else {
            $array_json['Shirt'] = array();
        }

        if(in_array(3,$product_category_ids)) {
            $stmt= $dbobject->prepare("select `id` from `products` where `company_id`=:company_id and `product_category_id`=:product_category_id");
            $stmt->bindParam(":company_id",$info['company_id']);
            $product_category_id = 3;
            $stmt->bindParam(":product_category_id",$product_category_id);
            $stmt->execute();
            $products_id = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products_id[] = $row['id'];
            }
            $products_id_string = implode(",",$products_id);
            $stmt= $dbobject->prepare("select * from `product_details` where `product_id` IN ($products_id_string)");
            $stmt->execute();
            $array_jeans = array();
            $sizes = array(28=>"twenty_eight",30=>"thirty",32=>"thirty_two",34=>"thirty_four",36=>"thirty_six",38=>"thirty_eight",40=>"forty");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['product']='Capri'; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 28;$size<=40;$size=$size+2) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_capri[]=$array_single_row;
            }
            $array_json['capri'] = $array_capri;
        }
        else {
            $array_json['capri'] = array();
        }
        if(in_array(4,$product_category_ids)) {
            $stmt= $dbobject->prepare("select `id` from `products` where `company_id`=:company_id and `product_category_id`=:product_category_id");
            $stmt->bindParam(":company_id",$info['company_id']);
            $product_category_id = 4;
            $stmt->bindParam(":product_category_id",$product_category_id);
            $stmt->execute();
            $products_id = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products_id[] = $row['id'];
            }
            $products_id_string = implode(",",$products_id);
            $stmt= $dbobject->prepare("select * from `product_details` where `product_id` IN ($products_id_string)");
            $stmt->execute();
            $array_jeans = array();
            $sizes = array(75=>"seventy_five",80=>"eighty",85=>"eighty_five",90=>"ninety",95=>"ninety_five",100=>"hundred",105=>"one_hundred_five");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['product']='Under Garments'; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 75;$size<=105;$size=$size+5) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_under_garments[]=$array_single_row;
            }
            $array_json['under_garments'] = $array_under_garments;
        }
        else {
            $array_json['under_garments'] = array();
        }
        if(in_array(5,$product_category_ids)) {
            $stmt= $dbobject->prepare("select `id` from `products` where `company_id`=:company_id and `product_category_id`=:product_category_id");
            $stmt->bindParam(":company_id",$info['company_id']);
            $product_category_id = 5;
            $stmt->bindParam(":product_category_id",$product_category_id);
            $stmt->execute();
            $products_id = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products_id[] = $row['id'];
            }
            $products_id_string = implode(",",$products_id);
            $stmt= $dbobject->prepare("select * from `product_details` where `product_id` IN ($products_id_string)");
            $stmt->execute();
            $array_others = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row['product']=$row_details_explained['product'];
                    $array_single_row['quantity']=$row_details_explained['quantity'];
                }
                $array_others[]=$array_single_row;
            }
            $array_json['others'] = $array_others;
        }
        else {
            $array_json['others'] = array();
        }
        if(in_array(6,$product_category_ids)) {
            $stmt= $dbobject->prepare("select `id` from `products` where `company_id`=:company_id and `product_category_id`=:product_category_id");
            $stmt->bindParam(":company_id",$info['company_id']);
            $product_category_id = 6;
            $stmt->bindParam(":product_category_id",$product_category_id);
            $stmt->execute();
            $products_id = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products_id[] = $row['id'];
            }
            $products_id_string = implode(",",$products_id);
            $stmt= $dbobject->prepare("select * from `product_details` where `product_id` IN ($products_id_string)");
            $stmt->execute();
            $array_shirt = array();
            $sizes = array("s","m","l","xl","xxl","xxxl");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['product']='T-Shirt'; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$row_details_explained['size']]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];

                }
                foreach($sizes as $size) {
                    if($array_single_row[$size]==0) {
                        $array_single_row[$size]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_shirt[]=$array_single_row;
            }
            $array_json['T_Shirt'] = $array_shirt;
        }
        else {
            $array_json['T_Shirt'] = array();
        }
        $dbobject=null;
        return $array_json;
        //return implode(",",$product_category_ids);
    }
    function search_sales_details($info) {
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        if($info['start']!="" && $info['end']!="") {
            $start_date = date_format(date_create_from_format('d-m-Y', $info['start']), 'Y-m-d');
            $end_date = date_format(date_create_from_format('d-m-Y', $info['end']), 'Y-m-d');
            $stmt=$dbobject->prepare("select * from `sell_product` where `sell_by`=:employee_name OR (`date` BETWEEN :start_date and :end_date) ORDER BY `id` DESC ");
            $stmt->bindParam(":start_date",$start_date);
            $stmt->bindParam(":end_date",$end_date);
        }
        else {
            $stmt=$dbobject->prepare("select * from `sell_product` where `sell_by`=:employee_name ORDER BY `id` DESC ");

        }
        $stmt->bindParam(':employee_name',$info['employee_name']);
        $stmt->execute();
        $sales_details_info=array();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
            $sales_details_info[]=$row;
        }
        $dbobject=null;
        return $sales_details_info;
    }
    function search_approval_details($info) {
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        if($info['start']!="" && $info['end']!="") {
            $start_date = date_format(date_create_from_format('d-m-Y', $info['start']), 'Y-m-d');
            $end_date = date_format(date_create_from_format('d-m-Y', $info['end']), 'Y-m-d');
            $stmt=$dbobject->prepare("select * from `approval_product` where `approval_by`=:employee_name OR (`date` BETWEEN :start_date and :end_date) ORDER BY `id` DESC ");
            $stmt->bindParam(":start_date",$start_date);
            $stmt->bindParam(":end_date",$end_date);
        }
        else {
            $stmt=$dbobject->prepare("select * from `approval_product` where `approval_by`=:employee_name ORDER BY `id` DESC ");

        }
        $stmt->bindParam(':employee_name',$info['employee_name']);
        $stmt->execute();
        $sales_details_info=array();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
            $sales_details_info[]=$row;
        }
        $dbobject=null;
        return $sales_details_info;
    }
    function  barcode_search($barcode){
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select * from product_details_explained where `bar_code`=:bar_code ORDER BY `id`");
        $stmt->bindParam("bar_code",$barcode);
        $stmt->execute();
        if($stmt->rowCount()>0) {
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
            $response['count']=1;
        }
        else {
            $response['count']=0;
        }
        $dbobject=null;
        return $response;
    }
    function generate_bill($info){
        date_default_timezone_set('Asia/Kolkata');
        $date=date("d-M-Y");
        $time=date('h:i A');
        $commision=((1/100)*$info['grand_total']);
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $payment_status=$info['payment_mode'];
        $pay=$info['pay'];
        if($pay==""){
            $pay=0;
        }
        else {
            $pay=$info['pay'];
        }
        if($payment_status=="credit"){
            $stmt=$dbobject->prepare("insert into `credit_list`(`bill_no`, `name`,`amount`, `date`, `given_by`) values(:bill_no,:name,:amount,'$date',:given_by)");
            $stmt->bindParam(':bill_no',$info['bill_no']);
            $stmt->bindParam(':name',$info['name']);
            $stmt->bindParam(':amount',$pay);
            $stmt->bindParam(':given_by',$_SESSION['username']);
            $stmt->execute();
        }
        $stmt=$dbobject->prepare("insert into `sell_product` (`name`,`mobile`,`grand_total`,`date`,`time`,`sell_by`,`payment_mode`,`commision`,`status`) values(:name,:mobile,:grand_total,'$date','$time','$_SESSION[username]',:payment_mode,:commision,:status)");
        $stmt->bindParam(':name',$info['name']);
        $stmt->bindParam(':mobile',$info['contact']);
        $stmt->bindParam(':grand_total',$info['grand_total']);
        $stmt->bindParam(':commision',$commision);
        $stmt->bindParam(':payment_mode',$info['payment_mode']);
        $status = "active";
        $stmt->bindParam(':status',$status);
        if($stmt->execute()) {
            $bill_no=$dbobject->lastInsertId();
            $total_barcode=count($info['barcode']);
            for($i=0;$i<$total_barcode;$i++){
                if($info['barcode'][$i]!="" && $info['qty'][$i]!="" && $info['total'][$i]!="" && $info['total'][$i]!=0) {
                    $stmt=$dbobject->prepare("insert into `sell_product_description`(`bill_no`,`barcode`,`qty`,`rate`,`total`) values(:bill_no,:barcode,:qty,:rate,:total)");
                    $stmt->bindParam(':bill_no',$bill_no);
                    $stmt->bindParam(':barcode',$info['barcode'][$i]);
                    $stmt->bindParam(':qty',$info['qty'][$i]);
                    $stmt->bindParam(':rate',$info['rate'][$i]);
                    $stmt->bindParam(':total',$info['total'][$i]);
                    if($stmt->execute()){
                        $update_qty=$info['available'][$i]-$info['qty'][$i];
                        $barcode=$info['barcode'][$i];
                        $stmt=$dbobject->prepare("update `product_details_explained` set `quantity`='$update_qty' where `bar_code`='$barcode'");
                        $stmt->execute();
                    }
                }
            }
            $response['status']="success";
        }
        else {
            $response['status'] = "error";
        }
        $dbobject = null;
        return $response;
    }
    function update_bill($info)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("d-M-Y");
        $time = date('h:i A');
        $dbobject = new PDO(Config::$dbType . ":host=" . Config::$dbHost . ";dbname=" . Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `sell_product` INNER JOIN `sell_product_description` ON `sell_product`.`id`=`sell_product_description`.`bill_no` where `sell_product`.`id`=:bill_no ");
        $stmt->bindParam(':bill_no', $info['bill_no']);
        if($stmt->execute()) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                $stmt_adding_stock=$dbobject->prepare("update `product_details_explained` set `quantity`=`quantity`+:bill_quantity where `bar_code`=:bar_code");
                $stmt_adding_stock->bindParam(":bill_quantity",$row['qty']);
                $stmt_adding_stock->bindParam(":bar_code",$row['barcode']);
                $stmt_adding_stock->execute();
            }
        }
        $total_barcode = count($info['barcode']);
        $stmt=$dbobject->prepare("update `sell_product` set `date`='$date',`time`='$time',`grand_total`='$info[grand_total]' where `id`='$info[bill_no]'");
        if($stmt->execute()) {
            $stmt_delete = $dbobject->prepare("DELETE FROM `sell_product_description` WHERE `bill_no`=:bill_no");
            $stmt_delete->bindParam(':bill_no', $info['bill_no']);
            if($stmt_delete->execute()) { // Deletion from sell_product_description
                for ($i = 0; $i < $total_barcode; $i++) {
                    $barcode = $info['barcode'][$i];
                    $stmt=$dbobject->prepare("select `quantity` from `product_details_explained` where `bar_code`=:barcode");
                    $stmt->bindParam(":barcode",$barcode);
                    $stmt->execute();
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $dbobject->prepare("insert into `sell_product_description` (`bill_no`,`barcode`,`qty`,`rate`,`total`) values(:bill_no,:barcode,:qty,:rate,:total)");
                    $stmt->bindParam(':bill_no', $info['bill_no']);
                    $stmt->bindParam(':barcode', $info['barcode'][$i]);
                    $stmt->bindParam(':qty', $info['qty'][$i]);
                    $stmt->bindParam(':rate', $info['rate'][$i]);
                    $stmt->bindParam(':total', $info['total'][$i]);
                    if ($stmt->execute()) {
                        $stmt = $dbobject->prepare("update `product_details_explained` set `quantity`=`quantity`-:required_quantity where `bar_code`=:barcode");
                        $stmt->bindParam(":required_quantity",$info['qty'][$i]);
                        $stmt->bindParam(":barcode",$info['barcode'][$i]);
                        $stmt->execute();
                    }
                }
            }
            $response['status'] = "success";
        }
        else {
            $response['status'] = "error";
        }
        $dbobject = null;
        return $response;
    }
    function update_approval_bill($info)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("d-M-Y");
        $time = date('h:i A');
        $dbobject = new PDO(Config::$dbType . ":host=" . Config::$dbHost . ";dbname=" . Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `approval_product` INNER JOIN `approval_product_description` ON `approval_product`.`id`=`approval_product_description`.`bill_no` where `approval_product`.`id`=:bill_no ");
        $stmt->bindParam(':bill_no', $info['bill_no']);
        if($stmt->execute()) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                $stmt_adding_stock=$dbobject->prepare("update `product_details_explained` set `quantity`=`quantity`+:bill_quantity where `bar_code`=:bar_code");
                $stmt_adding_stock->bindParam(":bill_quantity",$row['qty']);
                $stmt_adding_stock->bindParam(":bar_code",$row['barcode']);
                $stmt_adding_stock->execute();
            }
        }
        $total_barcode = count($info['barcode']);
        $stmt=$dbobject->prepare("update `approval_product` set `date`='$date',`time`='$time',`grand_total`='$info[grand_total]' where `id`='$info[bill_no]'");
        if($stmt->execute()) {
            $stmt_delete = $dbobject->prepare("DELETE FROM `approval_product_description` WHERE `bill_no`=:bill_no");
            $stmt_delete->bindParam(':bill_no', $info['bill_no']);
            if($stmt_delete->execute()) { // Deletion from sell_product_description
                for ($i = 0; $i < $total_barcode; $i++) {
                    $barcode = $info['barcode'][$i];
                    $stmt=$dbobject->prepare("select `quantity` from `product_details_explained` where `bar_code`=:barcode");
                    $stmt->bindParam(":barcode",$barcode);
                    $stmt->execute();
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $dbobject->prepare("insert into `approval_product_description` (`bill_no`,`barcode`,`qty`,`rate`,`total`) values(:bill_no,:barcode,:qty,:rate,:total)");
                    $stmt->bindParam(':bill_no', $info['bill_no']);
                    $stmt->bindParam(':barcode', $info['barcode'][$i]);
                    $stmt->bindParam(':qty', $info['qty'][$i]);
                    $stmt->bindParam(':rate', $info['rate'][$i]);
                    $stmt->bindParam(':total', $info['total'][$i]);
                    if ($stmt->execute()) {
                        $stmt = $dbobject->prepare("update `product_details_explained` set `quantity`=`quantity`-:required_quantity where `bar_code`=:barcode");
                        $stmt->bindParam(":required_quantity",$info['qty'][$i]);
                        $stmt->bindParam(":barcode",$info['barcode'][$i]);
                        $stmt->execute();
                    }
                }
            }
            $response['status'] = "success";
        }
        else {
            $response['status'] = "error";
        }
        $dbobject = null;
        return $response;
    }
    function generate_bill_for_approval($info){
        $bill_info=array();
        date_default_timezone_set('Asia/Kolkata');
        $date=date("d-M-Y");
        $time=date('h:i A');
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("insert into `approval_product`(`name`,`grand_total`,`date`,`time`,`approval_by`,`contact_no`,`status`) values(:name,:grand_total,'$date','$time','$_SESSION[username]',:contact_no,:status)");
        $stmt->bindParam(':name',$info['name']);
        $stmt->bindParam(':grand_total',$info['grand_total']);
        $stmt->bindParam(':contact_no',$info['contact_no']);
        $status = "active";
        $stmt->bindParam(':status',$status);
        if($stmt->execute()) {
            $bill_no=$dbobject->lastInsertId();
            $total_barcode=count($info['barcode']);
            echo $total_barcode;
            for($i=0;$i<$total_barcode;$i++){
                $stmt=$dbobject->prepare("insert into `approval_product_description`(`bill_no`,`barcode`,`qty`,`rate`,`total`) values(:bill_no,:barcode,:qty,:rate,:total)");
                $stmt->bindParam(':bill_no',$bill_no);
                $stmt->bindParam(':barcode',$info['barcode'][$i]);
                $stmt->bindParam(':qty',$info['qty'][$i]);
                $stmt->bindParam(':rate',$info['rate'][$i]);
                $stmt->bindParam(':total',$info['total'][$i]);
                if($stmt->execute()){
                    $update_qty=$info['available'][$i]-$info['qty'][$i];
                    $barcode=$info['barcode'][$i];
                    echo $update_qty;
                    $stmt=$dbobject->prepare("update `product_details_explained` set `quantity`='$update_qty' where `bar_code`='$barcode'");
                    $stmt->execute();
                }
            }
            $response['status']="success";
        }
        else {
            $response['status'] = "error";
        }
        $dbobject = null;
        return $response;
    }
    function getBill_no(){
        $dbobject=new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select * from `sell_product` ORDER BY `id` DESC limit 1");
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $bill_no=$row['id'];
        if($bill_no=="")
        {
            $get_bill_no=1;
        }
        else{
            $get_bill_no=$bill_no+1;
        }
        $dbobject = null;
        return $get_bill_no;
    }
    function getApprovalBill_no(){
        $dbobject=new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select * from `approval_product` ORDER BY `id` DESC limit 1");
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $bill_no=$row['id'];
        if($bill_no=="")
        {
            $get_bill_no=1;
        }
        else{
            $get_bill_no=$bill_no+1;
        }
        $dbobject = null;
        return $get_bill_no;
    }
    function searchCredit_bill($search_bil_no,$search_name,$search_mobile){
        $search_bill_details=array();
        $dbobject=new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        if($search_bil_no=="" && $search_name=="" && $search_mobile==""){
            $stmt=$dbobject->prepare("select * from `sell_product` WHERE `payment_mode`='credit' ORDER BY `id` DESC");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $stmt2=$dbobject->prepare("select * from `credit_list`  WHERE `bill_no`=:bill_no ORDER BY `id` DESC");
                //$bill_no=$row['id'];
                $stmt2->bindParam(":bill_no",$row['id']);
                $stmt2->execute();
                $total_pay=0;
                while($row1=$stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $total_pay +=$row1['amount'];

                }
            }
            $row['total_pay']=$total_pay;
            $search_bill_details[]=$row;
        }
        else {
            $stmt=$dbobject->prepare("select * from `sell_product`  where (`id` LIKE '$search_bil_no' OR `name` LIKE '$search_name' OR `mobile` LIKE '$search_mobile') and (`payment_mode`='credit') ORDER BY `id` DESC");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $search_bill_details[]=$row;
                $stmt=$dbobject->prepare("select `amount` from `credit_list`  WHERE `bill_no`=:bill_no ORDER BY `id` DESC");
                $stmt->bindParam(":bill_no",$row['bill_no']);
                $total_pay=0;
                while($row1=$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $total_pay +=$row1['amount'];
                }

            }
            $search_bill_details['total_pay']=$total_pay;
            $search_bill_details[]=$row;
        }
        $dbobject = null;
        return $search_bill_details;
    }
    function updateCreditInfo($bill_no,$name,$amount){
        $total_pay=array();
        date_default_timezone_set('Asia/Kolkata');
        $date = date("d-M-Y");
        $dbobject=new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("insert into `credit_list`(`bill_no`, `name`,`amount`, `date`, `given_by`) values(:bill_no,:name,:amount,'$date',:given_by)");
        $stmt->bindParam(':bill_no',$bill_no);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':amount',$amount);
        $stmt->bindParam(':given_by',$_SESSION['username']);
        if($stmt->execute()) {
            $stmt=$dbobject->prepare("select * from `credit_list` where `bill_no`='$bill_no'");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $total_pay['total_amount'] +=$row['amount'];
            }
        }
        $dbobject=null;
        return $total_pay;
    }
    function search_bill($search_bil_no,$search_name){
        $search_bill_details=array();
        $dbobject=new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        if($search_bil_no=="" and $search_name==""){
            $stmt=$dbobject->prepare("select * from `sell_product` ORDER BY `id` DESC");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $search_bill_details[]=$row;
            }
        }
        else {
            $stmt=$dbobject->prepare("select * from `sell_product` where `id` LIKE '$search_bil_no' OR `name` LIKE '$search_name'");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $search_bill_details[]=$row;
            }
        }
        $dbobject = null;
        return $search_bill_details;
    }
    function search_bill_approval($search_bill_no,$search_name){
        $search_bill_details=array();
        $dbobject=new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        if($search_bill_no=="" and $search_name==""){
            $stmt=$dbobject->prepare("select * from `approval_product` ORDER BY `id` DESC ");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $search_bill_details[]=$row;
            }
        }
        else {
            $stmt=$dbobject->prepare("select * from `approval_product` where `id` LIKE '$search_bill_no' OR `name` LIKE '$search_name'");
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $search_bill_details[]=$row;
            }
        }

        $dbobject = null;
        return $search_bill_details;
    }
    function getBill_details($bill_no){
        //$db=new Database();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt1=$dbobject->prepare("select `sell_product_description`.`id`,`sell_product_description`.`qty`,`sell_product_description`.`rate`,`sell_product_description`.`total`, `product_details_explained`.`product_details_id`,`product_details`.`product_id`,`product_details`.`article_no`,`products`.`company_id`,`products`.`product_category_id`,`companies`.`company_name`,`product_category`.`category_name` from `sell_product_description` INNER JOIN `product_details_explained` ON `sell_product_description`.`barcode`=`product_details_explained`.`bar_code` INNER JOIN `product_details` ON `product_details_explained`.`product_details_id`=`product_details`.`id` INNER JOIN `products` ON `product_details`.`product_id`=`products`.`id` INNER JOIN `companies` ON `products`.`company_id`=`companies`.`id` INNER JOIN `product_category` ON `products`.`product_category_id`=`product_category`.`id` where `sell_product_description`.`bill_no`=:bill_no ORDER BY `sell_product_description`.`id`");
        $stmt1->bindParam(':bill_no',$bill_no);
        $stmt1->execute();
        $bill_details_info=array();
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)) {
            $bill_details_info[]=$row1;
        }
        $dbobject=null;
        return $bill_details_info;
    }
    function Show_bill_details($bill_no){
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt1=$dbobject->prepare("select * from  `sell_product_description` WHERE `bill_no`=:bill_no ");
        $stmt1->bindParam(':bill_no',$bill_no);
        $stmt1->execute();
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)) {
            $show_bill_details_info[]=$row1;
            $stmt=$dbobject->prepare("select `quantity` from  `product_details_explained` WHERE `bar_code`=:barcode ");
            $stmt->bindParam(':barcode',$row1['barcode']);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            //$show_bill_details_info['available']=$row['quantity'];
        }
        $dbobject=null;
        return $show_bill_details_info;
    }
    function Show_approval_bill_details($bill_no){
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt1=$dbobject->prepare("select * from  `approval_product_description` WHERE `bill_no`=:bill_no ");
        $stmt1->bindParam(':bill_no',$bill_no);
        $stmt1->execute();
        $bill_details_info=array();
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)) {
            $show_approval_bill_details_info[]=$row1;
        }
        $dbobject=null;
        return $show_approval_bill_details_info;
    }
    function getApprovalBill_details($bill_no){
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt1=$dbobject->prepare("select `approval_product_description`.`id`,`approval_product_description`.`qty`,`approval_product_description`.`rate`,`approval_product_description`.`total`, `product_details_explained`.`product_details_id`,`product_details`.`product_id`,`product_details`.`article_no`,`products`.`company_id`,`products`.`product_category_id`,`companies`.`company_name`,`product_category`.`category_name` from `approval_product_description` INNER JOIN `product_details_explained` ON `approval_product_description`.`barcode`=`product_details_explained`.`bar_code` INNER JOIN `product_details` ON `product_details_explained`.`product_details_id`=`product_details`.`id` INNER JOIN `products` ON `product_details`.`product_id`=`products`.`id` INNER JOIN `companies` ON `products`.`company_id`=`companies`.`id` INNER JOIN `product_category` ON `products`.`product_category_id`=`product_category`.`id` where `approval_product_description`.`bill_no`=:bill_no ORDER BY `approval_product_description`.`id`");
        $stmt1->bindParam(':bill_no',$bill_no);
        $stmt1->execute();
        $bill_details_info=array();
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)) {
            $bill_details_info[]=$row1;
        }
        $dbobject=null;
        return $bill_details_info;
    }
    function getEmployeeName(){
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt1=$dbobject->prepare("select * from `user`");
        $stmt1->execute();
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)) {
            $employee_name[]=$row1;
        }
        $dbobject=null;
        return $employee_name;
    }
    function employee_info($employee_name){
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select * from `user` where `username`='$employee_name'");
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $employee_info=$row;
        $total_commision=0;
        $stmt=$dbobject->prepare("select * from `sell_product` where `sell_by`='$employee_name' ");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
            $total_commision += $row['commision'];
        }
        $old_commision=$row['got_commision'];
        $employee_info['total_commision']=$total_commision-$old_commision;
        $dbobject=null;
        return $employee_info;
    }
    function getSearch_article_no($company_id,$product_category_id) {
        $article_details= array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select `products`.`id`,`product_details`.`added_on`,`product_details`.`article_no`,`product_details`.`id` from `products` INNER JOIN `product_details` ON `product_details`.`product_id`=`products`.`id` where `company_id`=:company_id and `product_category_id`=:product_category_id ORDER BY `product_details`.`id` DESC ");
        $stmt->bindParam(':company_id',$company_id);
        $stmt->bindParam(':product_category_id',$product_category_id);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = date_create($row['added_on']);
            $row['added_on'] = date_format($date, 'd-F-Y');
            $article_details[]=$row;
        }
        $dbobject = null;
        return $article_details;
    }
    function changepassword($info) {
        $response=array();
        $dbobject= new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName,Config::$dbUser,Config::$dbPassword);
        $stmt=$dbobject->prepare("select `password` from `user` WHERE `username`='$_SESSION[username]'");
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $check_password=$row['password'];
        $old_password=$info['old_password'];
        if($check_password==$old_password) {
            $stmt=$dbobject->prepare("update `user` set `password`=:confirm_password where `username`='$_SESSION[username]'");
            $stmt->bindParam(':confirm_password',$info['confirm_password']);
            if($stmt->execute()) {
                $response['title'] = "Info";
                $response['msg'] = "Password change successfully";
            }
        }
        else {
            $response['title'] = "Info";
            $response['msg'] = "Old password not match";
        }
        $dbobject=null;
        return $response;
    }
    function addEmployee_details($info) {
        $response = array();
        $role="employee";
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" insert into `user` (`username`,`password`,`role`,`address`,`contact_no`) values(:name,:password,:role,:address,:contact_number)");
        $stmt->bindParam(':name', $info['name']);
        $stmt->bindParam(':password', $info['password']);
        $stmt->bindParam(':contact_number', $info['contact_number']);
        $stmt->bindParam(':address', $info['address']);
        $stmt->bindParam(':role',$role);
        if($stmt->execute()) {
            $response['title'] = "Info";
            $response['msg'] = "Employee added successfully";
        }
        else {
            $response['title'] = "Error";
            $response['msg'] = "Internal error occurred";
        }
        $dbobject = null;
        return $response;
    }
    function SearchArticleDetails($product_details_id,$product_category_id){
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        if($product_category_id==1) {
            $array_jeans = array();
            $sizes = array(28=>"twenty_eight",30=>"thirty",32=>"thirty_two",34=>"thirty_four",36=>"thirty_six",38=>"thirty_eight",40=>"forty");
            $stmt= $dbobject->prepare("select * from `product_details` where `id`='$product_details_id'");
            $stmt->execute();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['our_price']=$row['our_price']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $array_single_row['article_price']=$row['article_price']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 28;$size<=40;$size=$size+2) {
                    if($array_single_row[$sizes[$size]]=="") {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_jeans[]=$array_single_row;
            }
            $array_json['jeans'] = $array_jeans;
        }
        else {
            $array_json['jeans'] = array();
        }
        if($product_category_id==2) {
            $array_shirt = array();
            $sizes = array("s","m","l","xl","xxl","xxxl");
            $stmt= $dbobject->prepare("select * from `product_details` where `id`='$product_details_id'");
            $stmt->execute();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['our_price']=$row['our_price']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $array_single_row['article_price']=$row['article_price']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$row_details_explained['size']]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];

                }
                foreach($sizes as $size) {
                    if($array_single_row[$size]==0) {
                        $array_single_row[$size]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_shirt[]=$array_single_row;
            }
            $array_json['shirt'] = $array_shirt;
        }
        else {
            $array_json['shirt'] = array();
        }
        if($product_category_id==3) {
            $array_capri=array();
            $stmt= $dbobject->prepare("select * from `product_details` where `id`='$product_details_id'");
            $stmt->execute();
            $sizes = array(28=>"twenty_eight",30=>"thirty",32=>"thirty_two",34=>"thirty_four",36=>"thirty_six",38=>"thirty_eight",40=>"forty");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['our_price']=$row['our_price']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $array_single_row['article_price']=$row['article_price']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 28;$size<=40;$size=$size+2) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_capri[]=$array_single_row;
            }
            $array_json['capri'] = $array_capri;
        }
        else {
            $array_json['capri'] = array();
        }
        if($product_category_id==4) {
            $stmt= $dbobject->prepare("select * from `product_details` where `id`='$product_details_id'");
            $stmt->execute();
            $array_under_garments = array();
            $sizes = array(75=>"seventy_five",80=>"eighty",85=>"eighty_five",90=>"ninety",95=>"ninety_five",100=>"hundred",105=>"one_hundred_five");
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['our_price']=$row['our_price']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $array_single_row['article_price']=$row['article_price']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                $sum = 0;
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row[$sizes[$row_details_explained['size']]]=$row_details_explained['quantity'];
                    $sum+=$row_details_explained['quantity'];
                }
                for($size = 75;$size<=105;$size=$size+5) {
                    if($array_single_row[$sizes[$size]]==0) {
                        $array_single_row[$sizes[$size]]=0;
                    }
                }
                $array_single_row['row_sum'] = $sum;
                $array_under_garments[]=$array_single_row;
            }
            $array_json['under_garments'] = $array_under_garments;
        }
        else {
            $array_json['under_garments'] = array();
        }
        if($product_category_id==5) {
            $stmt= $dbobject->prepare("select * from `product_details` where `id`='$product_details_id'");
            $stmt->execute();
            $array_others = array();
            while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) {
                $array_single_row = array();
                $array_single_row['our_price']=$row['our_price']; // cal
                $array_single_row['article_no']=$row['article_no']; // cal
                $array_single_row['article_price']=$row['article_price']; // cal
                $stmt2= $dbobject->prepare("select * from `product_details_explained` where `product_details_id`=:product_details_id");
                $stmt2->bindParam(":product_details_id",$row['id']);
                $stmt2->execute();
                while($row_details_explained= $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $array_single_row['product']=$row_details_explained['product'];
                    $array_single_row['quantity']=$row_details_explained['quantity'];
                }
                $array_others[]=$array_single_row;
            }
            $array_json['others'] = $array_others;
        }
        else {
            $array_json['others'] = array();
        }
        $dbobject=null;
        return $array_json;
    }
    function cancelBill($bill_no) {
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `sell_product` INNER JOIN `sell_product_description` ON `sell_product`.`id`=`sell_product_description`.`bill_no` where `sell_product`.`id`=:bill_no ");
        $stmt->bindParam(':bill_no', $bill_no);
        if($stmt->execute()) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                $stmt_adding_stock=$dbobject->prepare("update `product_details_explained` set `quantity`=`quantity`+:bill_quantity where `bar_code`=:bar_code");
                $stmt_adding_stock->bindParam(":bill_quantity",$row['qty']);
                $stmt_adding_stock->bindParam(":bar_code",$row['barcode']);
                $stmt_adding_stock->execute();
            }
            $stmt_archive_bill = $dbobject->prepare("update `sell_product` set `status`=:status,`commision`=0 where `id`=:bill_no");
            $status = "archived";
            $stmt_archive_bill->bindParam(':status', $status);
            $stmt_archive_bill->bindParam(':bill_no', $bill_no);
            if($stmt_archive_bill->execute()) {
                $response['status']=200;
                $response['title'] = "Info";
                $response['msg'] = "Bill Canceled Successfully";
            }
            else {
                $response['status']=500;
                $response['title'] = "Error";
                $response['msg'] = "Error in Saving Information";
            }
        }
        else {
            $response['status']=500;
            $response['title'] = "Error";
            $response['msg'] = "Error in Saving Information";
        }
        $dbobject = null;
        return $response;
    }
    function adjustApprovalBill($bill_no) {
        $response = array();
        $dbobject = new PDO(Config::$dbType.":host=".Config::$dbHost.";dbname=".Config::$dbName, Config::$dbUser, Config::$dbPassword);
        $stmt=$dbobject->prepare(" select * from `approval_product` INNER JOIN `approval_product_description` ON `approval_product`.`id`=`approval_product_description`.`bill_no` where `approval_product`.`id`=:bill_no ");
        $stmt->bindParam(':bill_no', $bill_no);
        if($stmt->execute()) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                $stmt_adding_stock=$dbobject->prepare("update `product_details_explained` set `quantity`=`quantity`+:bill_quantity where `bar_code`=:bar_code");
                $stmt_adding_stock->bindParam(":bill_quantity",$row['qty']);
                $stmt_adding_stock->bindParam(":bar_code",$row['barcode']);
                $stmt_adding_stock->execute();
            }
            $stmt_archive_bill = $dbobject->prepare("update `approval_product` set `status`=:status where `id`=:bill_no");
            $status = "archived";
            $stmt_archive_bill->bindParam(':status', $status);
            $stmt_archive_bill->bindParam(':bill_no', $bill_no);
            if($stmt_archive_bill->execute()) {
                $response['status']=200;
                $response['title'] = "Info";
                $response['msg'] = "Approval Adjusted Successfully";
            }
            else {
                $response['status']=500;
                $response['title'] = "Error";
                $response['msg'] = "Error in Saving Information";
            }
        }
        else {
            $response['status']=500;
            $response['title'] = "Error";
            $response['msg'] = "Error in Saving Information";
        }
        $dbobject = null;
        return $response;
    }
}
?>

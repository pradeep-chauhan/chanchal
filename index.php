<?php
include_once('classes/database.php');
$login_error=false;
if(isset($_POST['btn_login_user'])) {
    $db=new Database();
    $info=array(
        'login_username'=>$_POST['username'],
        'login_password'=>$_POST['password']
    );
    $response = $db->checkLogin($info);
    if($response['status']==200)
    {
        header("location:$response[redirect_url]");
    }
    else{
        $login_error=true;
    }

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
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <div class="logo-name"><img src="assets/img/logo2.png"></div>

            </div>
            <h3>Welcome to Chanchal Garments</h3>
            <form class="m-t login-form" role="form" method="post" action="index.php">
                <?php
                if($login_error) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="login_error_alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <strong></strong>&nbsp;&nbsp;Username or Password is wrong.
                    </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="username" name="username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b login" name="btn_login_user">Login</button>

                <a href="#" id="forgot_password"><small>Forgot password?</small></a>
            </form>
            <form class="m-t forgot-form hidden" role="form" method="post" action="index.php">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b forgot-password">Submit</button>

                <a href="#" id="login_form"><small>Back To Login</small></a>
            </form>
            <p class="m-t"> <small>Design And Developed By  &copy; <a href="http://www.webkreators.in/" target="_blank">Web Kreators Infotech </a></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.1.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
<script>
    $(document).ready(function(){
        $('#forgot_password').click(function(){
            $('.forgot-form').removeClass('hidden');
            $('.login-form').addClass('hidden');

        });
        $('#login_form').click(function(){
            $('.login-form').removeClass('hidden');
            $('.forgot-form').addClass('hidden');

        });

</script>

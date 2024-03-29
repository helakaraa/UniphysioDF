<?php
$url="../index.php";
session_start();
if(isset($_SESSION['islogin']))
    header("Location:../index.php");
require_once('_con.php');
require_once("functions.php");


$err=true;
$postback=false;
$errmsg='';
if(isset($_POST['save']) ){
    $postback=true;
    $user=$_POST['name'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $aaddress=$_POST['address'];
    $pass=base64_encode($_POST['password']) ;
if(emailExist($email)){
    $errmsg = "Email Already Exist";

}else {
    $sql = "INSERT INTO `logins`(`login_name`, `login_password`, `login_type`,  `login_active`, `login_fname`, `login_phone`, `login_address`) VALUES ('$email', '$pass', '2',  '1', '$user', '$tel', '$aaddress')";
    $result = $conn->query($sql);
    if ($result) {
        $errmsg = "Registre-se com sucesso";

        $err = false;
    } else {
        $errmsg = "Detalhes de login invalidos, tente novamente";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <title>Registrar -Ferreira Alves Fisioterapia</title>
    <link rel="icon" type="image/ico" href="favicon.ico"/>

   
        <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 10]>
    <link href="css/ie.css" rel="stylesheet" type="text/css"   />
     <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
    <![endif]-->


</head>
<body>

<div id="loader"><img src="img/loader.gif"/></div>

<div class="login">

    <div class="page-header">
        <div class="icon">
            <span class="ico-arrow-right"></span>
        </div>
         <hgroup>
        <h1>Ferreira Alves Fisioterapia-Registro de conta</h1>
         </hgroup>
    </div>

    <form id="validate" method="POST" action="#">
        <div class="row-fluid">
            <?php
            if($err && $postback){
                ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> <?php echo $errmsg; ?>
                </div>
            <?php
            }
            if(!$err && $postback){
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> <?php echo $errmsg; ?>
                </div>
            <?php
            }
            ?>
            <div class="data-fluid">

                <div class="group">
                    <input type="text" class="validate[required,minSize[5],maxSize[150]]" placeholder="Nome" name="name"/>
                </div>

                <div class="group">
                        <input type="text" class="validate[required,custom[email],maxSize[150]]" placeholder="Email" name="email"/>
                                   </div>
                <div class="group">
                        <input type="password" class="validate[required,minSize[5],maxSize[150]]" id="password" name="password" placeholder="Senha"/>
                </div>
                <div class="group">
                        <input type="password" class="validate[required,equals[password]]" placeholder="confirme Senha"/>

                </div>
                <div class="group">
                    <input type="text" class="validate[required,minSize[8],maxSize[12]]" placeholder="Numero de telefone" name="tel"/>

                </div>
                <div class="group">
                    <textarea class="validate[required,minSize[20],maxSize[250]]" placeholder="Endereco postal" name="address"></textarea>

                </div>
                <div class="group">

                </div>

                <div class="group">
                    <button class="button buttonBlue" type="submit" name="save">Registrar<span class="icon-ok icon-white"></span></button>
                    <a class="btn btn-info" href="../index.php">Home <span class="icon-home icon-white"></span></a>
                    <a class="btn" href="login.php">Login <span class="icon-user icon-white"></span></a>

                </div>


            </div>
    </form>

</div><script type='text/javascript' src='js/plugins/jquery/jquery-1.9.1.min.js'></script>
<script type='text/javascript' src='js/plugins/jquery/jquery-ui-1.10.1.custom.min.js'></script>
<script type='text/javascript' src='js/plugins/jquery/jquery-migrate-1.1.1.min.js'></script>
<script type='text/javascript' src='js/plugins/jquery/globalize.js'></script>
<script type='text/javascript' src='js/plugins/other/excanvas.js'></script>

<script type='text/javascript' src='js/plugins/other/jquery.mousewheel.min.js'></script>

<script type='text/javascript' src='js/plugins/bootstrap/bootstrap.min.js'></script>

<script type='text/javascript' src='js/plugins/cookies/jquery.cookies.2.2.0.min.js'></script>

<script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>

<script type='text/javascript' src="js/plugins/uniform/jquery.uniform.min.js"></script>
<script type='text/javascript' src="js/plugins/select/select2.min.js"></script>
<script type='text/javascript' src='js/plugins/tagsinput/jquery.tagsinput.min.js'></script>
<script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>
<script type='text/javascript' src='js/plugins/multiselect/jquery.multi-select.min.js'></script>

<script type='text/javascript' src='js/plugins/validationEngine/languages/jquery.validationEngine-en.js'></script>
<script type='text/javascript' src='js/plugins/validationEngine/jquery.validationEngine.js'></script>

<script type='text/javascript' src='js/plugins/shbrush/XRegExp.js'></script>

<script type='text/javascript' src='js/plugins.js'></script>
<script type='text/javascript' src='js/charts.js'></script>
<script type='text/javascript' src='js/actions.js'></script>


</body>
     <footer> <p style="color:#fff">Made with love by <a href="http://www.meuwebi.com/" target="_blank" style="color:#87f30a">Meuwebi</a></p>
</footer>
</html>

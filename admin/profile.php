<?php
require_once("aut.php");

$err=false;
$postback=false;
$profile=false;
$errmsg="";

$name="Profile";
if(isset($_POST['save']) ){
    $uid=base64_decode($_POST['uid']);
    $l_type=$_POST['type'];
    $postback=true;
    $user=$_POST['name'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $aaddress=$_POST['address'];
    $ppass=$_POST['password'];
    $pass="";
    if($ppass!=""){
        $pass=",`login_password`='".base64_encode($_POST['password'])."'";

    }
    $act=isset($_POST['enable'])?1:0;
    //$pass=ltrim($_POST['password'])==""?base64_encode($_POST['password']) ;
    $sql = "UPDATE `logins` SET `login_name`='$email' $pass ,`login_type`='$l_type',`login_active`='$act',`login_fname`='$user',`login_phone`='$tel',`login_address`='$aaddress' WHERE `logins_id`='$uid'";

    $result = $conn->query($sql);
    if($result){
        $errmsg="Atualizado com sucesso";
        $err=false;
    }else{
        $errmsg="Detalhes de login invalidos, tente novamente";
    }

}
if(isset($_GET['user'])){
    $login_id=base64_decode($_GET['user']);

}
else
{
    $login_id=$_SESSION['UID'];
}
$sql="SELECT  `login_name`, `login_type`, `login_create`, `login_active`, `login_fname`, `login_phone`, `login_address` FROM `logins` WHERE `logins_id`='$login_id'";
$result = $conn->query($sql);
if($result->num_rows==1){
    $profile=true;
    $row=$result->fetch_assoc();
    $name=$row['login_fname'];
    $email=$row['login_name'];
    $type=intval($row['login_type']);
    $member=$row['login_create'];
    $phone=$row['login_phone'];
    $address=$row['login_address'];
    $act=intval($row["login_active"])==1?"checked":"";
}
require_once("header.php");
?>
    <div class="page-header">
        <div class="icon">
            <span class="ico-user"></span>
        </div>
        <h1>Perfil <small>Detalhes do perfil</small></h1>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <div class="block">
                <?php
                if($err && $postback){
                    ?>
                    <div class="alert alert-error alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Erro!</strong> <?php echo $errmsg; ?>
                    </div>
                <?php
                }
                if(!$err && $postback){
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Successo!</strong> <?php echo $errmsg; ?>
                    </div>
                <?php
                }
                ?>
                <div class="head blue">
                    <div class="icon"><span class="ico-user"></span></div>
                    <h2><?php echo $name;?></h2>
                </div>
                <div class="data-fluid">
        <?php if($profile){?>
            <form  id="validate" method="post">
           <input type="hidden" name="uid" value="<?php echo base64_encode($login_id);?>"/>
                <div class="data-fluid">

            <div class="row-form">
                <div class="span3">Nome :</div>
                <div class="span6"><input type="text" class="validate[required,minSize[5],maxSize[150]]" placeholder="Name" name="name" value="<?php echo $name;?>"/></div>
            </div>

            <div class="row-form">
                <div class="span3">Email :</div>
                <div class="span6">
                    <input type="text" class="validate[required,custom[email],maxSize[150]]" placeholder="Email" name="email" value="<?php echo $email;?>"/>
                </div>
            </div>
            <div class="row-form">
                <div class="span3">Senha :</div>
                    <div class="span6">
                     <input type="password" class="validate[minSize[5],maxSize[150]]" id="password" name="password" placeholder="Password"/>
                    </div>
            </div>
            <div class="row-form">
                <div class="span3">Confirme a Senha :</div>
                <div class="span6">
                <input type="password" class="validate[equals[password]]" placeholder="Confirm Password" />
                </div>
            </div>
            <div class="row-form">
                <div class="span3">Mobile :</div>
                <div class="span6">
                <input type="text" class="validate[required,minSize[11],maxSize[15]]" placeholder="Phone Number" name="tel" value="<?php echo $phone;?>"/>
                    </div>
            </div>
            <div class="row-form">
                <div class="span3">Endereco :</div>
                <div class="span6">
                <textarea class="validate[required,minSize[20],maxSize[250]]" placeholder="Postal Address" name="address" ><?php echo $address;?></textarea>
                    </div>

            </div>
            <div class="row-form">

                <div class="span3">Membro desde :</div>
                <div class="span6">
                <input type="text" class="disabled"  value="<?php echo $member;?>"/>
                    </div>
            </div>
            <div class="row-form">
                <div class="span3">
                    Tipo de membro:
                </div>
                <div class="span3">
                    <select name="type">
                        <option value="1" <?php echo $type==1?"selected":""; ?>>Administrador</option>
                        <option value="2" <?php echo $type==2?"selected":""; ?>>Usuario</option>
                    </select>
                </div>
                <div class="span4">
                    <input type="checkbox"  name="enable" value="1" <?php echo $act; ?>/> Activo
                </div>
            </div>
            <div class="row-form">

            </div>
                    <div class="row-form">
                        <button class="btn btn-lg" type="submit" name="save">Atualizar <span class="icon-ok icon-white"></span></button>

                    </div>

        </div>
    </form>
<?php }
else{?>
    <div class="alert alert-error alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> <br>Profile not found<br>

        <a href="dashboard.php" class="btn btn-warning ">Va para Home</a>

    </div>
    <div class="row-fluid">

        <a href="dashboard.php" class="btn btn-warning ">Va para Home</a>
    </div>
<?php }?>
                </div>


            </div>
    </div>
    </div>
<?php
require_once("footer.php");
?>

<script type='text/javascript' src='js/plugins/jquery/jquery-1.9.1.min.js'></script>
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
<script type='text/javascript' src='js/plugins/shbrush/shCore.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shBrushXml.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shBrushJScript.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shBrushCss.js'></script>

<script type='text/javascript' src='js/plugins.js'></script>
<script type='text/javascript' src='js/charts.js'></script>
<script type='text/javascript' src='js/actions.js'></script>
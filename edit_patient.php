<?php
require("aut.php");
require("header.php");
$err=true;
$postback=false;
$errmsg="";
 function status($type, $data = 0)
    {
        $success = "<div class='alert alert-success'> <strong>Done!</strong>";
        $fail = "<div class='alert alert-warning'><strong>Sorry!</strong>";
        $end = '</div>';

        switch ($type) {
            case 'record-success':
                return "$success New record created successfully! $end";
                break;
            case 'record-fail':
                return "$fail New record creation failed. $end";
                break;
            case 'record-dup':
                return "$fail Duplicate record exists. $end";
                break;
            case 'no-match':
                return "$fail Record did not match. $end";
                break;
            case 'con-failed':
                return "$fail connection Failed! $end";
                break;
            case 'appointment-success':
                return "$success Your appointment is booked successfully! Your appointment no is $data $end";
                break;
            case 'appointment-fail':
                return "$fail Failed to book your appointment Failed! $end";
                break;
            case 'update-success':
                return "$success New record updated successfully! $end";
                break;
            case 'update-fail':
                return "$fail Failed to update data! $end";
                break;
            default:
                // code...
                break;
        }
    }

   function secure($unsafe_data)
    {
        return htmlentities($unsafe_data);
    }
 function enter_patient_info($full_name_unsafe, $age_unsafe, $Convenio_unsafe, $phone_no_unsafe, $address_unsafe)
  {
      global $conn, $error_flag,$result;

      $full_name = ucfirst(secure($full_name_unsafe));
      $age = secure($age_unsafe);
      $Convenio = secure($Convenio_unsafe);
      $patient=base64_decode($_GET['order']);
      $phone_no = secure($phone_no_unsafe);
      $address = secure($address_unsafe);

      $sql = "UPDATE `patient_info` SET full_name='$full_name', DOB=$age, convenio='$Convenio', phone_no='$phone_no', address='$address' WHERE `patient_id`=$patient";

      if ($conn->query($sql) === true) {
          echo status('record-success');

          return $conn->insert_id;
      } else {
          echo status('record-fail');

          return 0;
      }
  }

$id_change=0;
if(isset($_GET['order'])){
 
    $id_change=base64_decode($_GET['order']);
 
    
    $sql1="SELECT full_name, DOB, convenio, phone_no, address FROM `patient_info` WHERE `patient_id`=$id_change";

    $r=$conn->query($sql1);



    if($r->num_rows==1){
         $row=$r->fetch_assoc(); 
         $nome1=$row['full_name'];
         $DOB1=$row['DOB'];
         $convenio1=$row['convenio'];
         $phone1=$row['phone_no'];
         $address1=$row['address'];   
    }
     
    else
        {
        $id_change=0;}

}

?>
<div class="page-header">
    <div class="icon">
        <span class="ico-user"></span>
    </div>
    <h1>Patientes <small>Gerencie o perfil do patientes</small></h1>
    <?php

  
                  if(isset($_POST['apfullname'])){
                    $i = enter_patient_info($_POST['apfullname'],$_POST['apAge'],$_POST['apConvenio'],$_POST['apphone_no'],$_POST['apaddress']);
                    unset($_POST['apfullname']); //unset all post variables
                    if (isset($_POST['apfullname'])){
                      echo '<script type="text/javascript">location.reload();</script>';
                    }

                  }


                ?>
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
                    <strong>Successo!</strong> <?php echo $msg; ?>
                </div>
            <?php
            }
            ?>
            <div class="head yellow">
                <div class="icon"><span class="ico-user"></span></div>
                <h2>Detalhes do Patiente</h2>
            </div>
            <?php if($id_change!=0){?>
            <form id="validate" method="POST" enctype="multipart/form-data">
                <div class="data-fluid">
                                 
                    <div class="row-form">
                        <div class="span2">Nome completo:</div>
                        <div class="span6">
                       <input type="text" class="form-control" id="usr" name="apfullname" value="<?php echo $nome1; ?>" required>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Idade:</div>
                        <div class="span6">
                      <input type="number" class="form-control" id="pwd" name="apAge" min="1" max="200" value="<?php echo $DOB1; ?>" required>
                        </div>
                    </div>
                  
                    <div class="row-form">
                        <div class="span2">Convenio:</div>
                        <div class="span6">
              <input type="tel" class="form-control" id="pwd" name="apConvenio" value="<?php echo $convenio1; ?>"  required>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Telefone - Celular e fixo:</div>
                        <div class="span6">
              <input type="tel" class="form-control" id="pwd" name="apphone_no" value="<?php echo $phone1; ?>" required>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Endereco:</div>
                        <div class="span6">
                           <textarea class="form-control" id="pwd" name="apaddress" required><?php echo $address1; ?></textarea>

                        </div>
                    </div>
                   
                    <div class="row-form">

                    </div>

                    <div class="toolbar bottom tar">
                        <div class="btn-group">
                            <button class="btn" type="submit" name="save">Salvar Membro</button>
                        </div>
                    </div>

                </div>
            </form>
   <?php }
            ?>
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

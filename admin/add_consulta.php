<?php
require_once("aut.php");
require_once("header.php");
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
      $phone_no = secure($phone_no_unsafe);
      $address = secure($address_unsafe);

      $sql = "INSERT INTO `patient_info` VALUES (NULL, '$full_name', $age, '$Convenio', '$phone_no','$address');";

      if ($conn->query($sql) === true) {
          echo status('record-success');

          return $conn->insert_id;
      } else {
          echo status('record-fail');

          return 0;
      }
  }

    function appointment_booking($patient_id_unsafe, $specialist_unsafe,$specialist_corpo_unsafe, $medical_condition_unsafe)
    {
        global $conn;
        $patient_id = secure($patient_id_unsafe);
        $specialist = secure($specialist_unsafe);
        $corpo = secure($specialist_corpo_unsafe);
        $medical_condition = secure($medical_condition_unsafe);

        $sql = "INSERT INTO appointments (`appointment_no`, `patient_id`, `speciality`, `corpo`, `medical_condition`, `doctors_suggestion`,`payment_amount`, `case_closed`) VALUES (NULL, $patient_id, '$specialist', '$corpo', '$medical_condition', NULL, NULL, 'no')";

        if ($conn->query($sql) === true) {
            echo status('appointment-success', $conn->insert_id);
        } else {
            echo status('appointment-fail');
            echo 'Error: '.$sql.'<br>'.$conn->error;
        }
    }

?>


<div class="page-header">
    <div class="icon">
        <span class="ico-user"></span>
    </div>
    <h1>Consultas <small>Adicionar uma Consulta</small></h1>
    <?php
                  if(isset($_POST['apfullname'])){
                    $i = enter_patient_info($_POST['apfullname'],$_POST['apAge'],$_POST['apConvenio'],$_POST['apphone_no'],$_POST['apaddress']);
                    appointment_booking($i, $_POST['apSpecialist'],$_POST['apCorpo'] ,$_POST['apCondition']);
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
 <form action="add_consulta.php" method="POST">

            <div class="row-form" >
              <label for="usr">Nome Completo:</label>
              <input type="text" class="form-control" id="usr" name="apfullname" required>
            </div>

            <div class="row-form">
              <label for="pwd">Idade:</label>
              <input type="number" class="form-control" id="pwd" name="apAge" min="1" max="200" required>
            </div>
            <div class="row-form">
              <label for="pwd">Convenio:</label>
              <input type="tel" class="form-control" id="pwd" name="apConvenio"  required>
            </div>
            <div class="row-form">
              <label for="pwd">Telefone - Celular e fixo:</label>
              <input type="tel" class="form-control" id="pwd" name="apphone_no" required>
            </div>
            <div class="row-form">
              <label for="pwd">Endereco:</label>
              <textarea class="form-control" id="pwd" name="apaddress"  required></textarea>
            </div>

            <div class="row-form">
              <label for="pwd">Especialidade de Fisioterapia:</label>
              <select required value=1 name="apSpecialist">
                <option value="Fisioterapia geriátrica" class="option">Fisioterapia geriátrica</option>
                <option value="Fisioterapia ortopédica" class="option">Fisioterapia ortopédica</option>
                <option value="Osteopatia" class="option">Osteopatia</option>
                <option value="Método McKenzie" class="option">Método McKenzie</option>
                <option value="Acupuntura" class="option">Acupuntura</option>
                <option value="Ventosaterapia" class="option">Ventosaterapia</option>
                <option value="Realidade Virtual" class="option">Realidade Virtual</option>
                <option value="Pilates" class="option">Pilates</option>
                  <option value="Hidroterapia" class="option">Hidroterapia</option>
              </select>
           
              <label for="pwd" style="margin-left: 20px">Membro do corpo:</label>
              <select required value=1 name="apCorpo">
                <option value="Ombro" class="option">Ombro</option>
                <option value="Cotovelo" class="option">Cotovelo</option>
                <option value="Punho e dedos" class="option">Punho e dedos</option>
                <option value="Pescoço" class="option">Pescoço</option>
                <option value="Colona" class="option">Colona</option>
                <option value="Torácica" class="option">Torácica</option>
                <option value="Colona lombar" class="option">Colona lombar</option>

                 <option value="Quadril" class="option">Quadril</option>
                  <option value="Caxa" class="option">Caxa</option>
                   <option value="Joelho" class="option">Joelho</option>
                    <option value="Tornozelo" class="option">Tornozelo</option>
                    <option value="Pé" class="option">Pé</option>
              </select>
            </div>

            <div class="row-form">
              <label for="pwd">Condicao medica/ Proposito da Visita:</label>
              <textarea class="form-control" id="pwd" name="apCondition" required></textarea>
            </div>

            <div class="row-form">
              <input type="submit" value="Salvar" class="btn btn-primary" >
              <input type="reset" value="Reset" class="btn btn-danger">
            </div>
          </form>
</div>
</div>
<?php
  include("footer.php");
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

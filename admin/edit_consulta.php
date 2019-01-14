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
      $patient=base64_decode($_GET['order']);
      $address = secure($address_unsafe);

      $sql = "UPDATE `patient_info` SET full_name='$full_name', DOB=$age, convenio='$Convenio', phone_no='$phone_no', address='$address' WHERE `patient_id`=(Select patient_id FROM appointments where appointment_no=$patient)";


      if ($conn->query($sql) === true) {
          echo status('record-success');

          return $conn->insert_id;
      } else {
          echo status('record-fail');

          return 0;
      }
  }

    function appointment_booking($patient_id_unsafe, $specialist_unsafe,$specialist_corpo_unsafe, $medical_condition_unsafe,$payment_amount_unsafe,$doctors_suggestion_unsafe)
    {
        global $conn;
        $patient_id = secure($patient_id_unsafe);
        $specialist = secure($specialist_unsafe);
        $corpo = secure($specialist_corpo_unsafe);
        $patient=base64_decode($_GET['order']);
        $medical_condition = secure($medical_condition_unsafe);
        $doctors_suggestion = secure($doctors_suggestion_unsafe);
        $payment_amount=secure($payment_amount_unsafe);

        $sql = "UPDATE appointments SET `speciality`='$specialist', `corpo`='$corpo', `medical_condition`='$medical_condition', `doctors_suggestion`='$doctors_suggestion',`payment_amount`='$payment_amount', `case_closed`= 'no',`preconsulta_updatetime`=CURRENT_TIMESTAMP  WHERE appointments.appointment_no=$patient";

        if ($conn->query($sql) === true) {
            echo status('appointment-success', $conn->insert_id);
        } else {
            echo status('appointment-fail');
            echo 'Error: '.$sql.'<br>'.$conn->error;
        }
    }

 $id_change=0;
if(isset($_GET['order'])){
 
    $id_change=base64_decode($_GET['order']);
     
    
    $sql1="SELECT `speciality`, `corpo`, `medical_condition`, `doctors_suggestion`,`payment_amount` FROM patient_info ,appointments WHERE appointments.patient_id=patient_info.patient_Id and appointments.appointment_no=$id_change";

    $r=$conn->query($sql1);



    if($r->num_rows==1){
         $row=$r->fetch_assoc(); 
         $speciality1=$row['speciality'];
         $corpo1=$row['corpo'];
         $medical_condition1=$row['medical_condition'];
         $doctors_suggestion1=$row['doctors_suggestion'];
         $payment_amount1=$row['payment_amount'];   
    }
    else
        {
        $id_change=0;} 

 $sql2="SELECT full_name, DOB, convenio, phone_no, address FROM patient_info ,appointments WHERE appointments.patient_id=patient_info.patient_Id and appointments.appointment_no=$id_change";

    $r1=$conn->query($sql2);


    if($r1->num_rows==1){
         $row1=$r1->fetch_assoc(); 
         $nome1=$row1['full_name'];
         $DOB1=$row1['DOB'];
         $convenio1=$row1['convenio'];
         $phone1=$row1['phone_no'];
         $address1=$row1['address'];   
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
    <h1>Consultas <small>Adicionar uma Consulta</small></h1>
    <?php
                  if(isset($_POST['apfullname'])){
                    $i = enter_patient_info($_POST['apfullname'],$_POST['apAge'],$_POST['apConvenio'],$_POST['apphone_no'],$_POST['apaddress']);
                    appointment_booking($i, $_POST['apSpecialist'],$_POST['apCorpo'] ,$_POST['apCondition'],$_POST['apAmount'],$_POST['apSuggestion']);
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

            <div class="row-form" >
              <label for="usr">Nome Completo:</label>
              <input type="text" class="form-control" id="usr" name="apfullname" value="<?php echo $nome1; ?>" required>
            </div>

            <div class="row-form">
              <label for="pwd">Idade:</label>
              <input type="number" class="form-control" id="pwd" name="apAge" min="1" max="200" value="<?php echo $DOB1; ?>" required>
            </div>
            <div class="row-form">
              <label for="pwd">Convenio:</label>
              <input type="tel" class="form-control" id="pwd" name="apConvenio" value="<?php echo $convenio1; ?> " required>
            </div>
            <div class="row-form">
              <label for="pwd">Telefone - Celular e fixo:</label>
              <input type="tel" class="form-control" id="pwd" name="apphone_no" value="<?php echo $phone1; ?> " required>
            </div>
            <div class="row-form">
              <label for="pwd">Endereco:</label>
              <textarea class="form-control" id="pwd" name="apaddress" required> <?php echo $address1; ?> </textarea>
            </div>

            <div class="row-form">
              <label for="pwd">Especialidade de Fisioterapia:</label>
              <select required value=1 name="apSpecialist">
                <option value="Fisioterapia geriátrica"  class="option">Fisioterapia geriátrica</option>
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
              <textarea class="form-control" id="pwd" name="apCondition"  required><?php echo 
              $medical_condition1; ?></textarea>
            </div>
              <div class="row-form">
              <label for="pwd">Preço do Consulta:</label>
              <input type="number" class="form-control" id="pwd" name="apAmount" min="1" max="200" value="<?php echo $payment_amount1; ?>" required>
            </div>
              <div class="row-form">
              <label for="pwd">sugestões de médicos:</label>
              <textarea class="form-control" id="pwd" name="apSuggestion"  required><?php echo 
              $doctors_suggestion1; ?></textarea>
            </div>
            <div class="row-form">
              <input type="submit" value="Salvar" class="btn btn-primary" >
              <input type="reset" value="Reset" class="btn btn-danger">
            </div>
          </form>
           <?php }?>
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

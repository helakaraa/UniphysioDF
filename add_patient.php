<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<?php
  include("header.php");
  include("library.php");
  
  
?>

<div class="about"> 
<div class="container">
  <h2>Bem-vindo, paciente!</h2>
      <div class='alert alert-info'>
              <strong>Informações!</strong> Caso queira desmarcar o pré agendamento, favor entrar em contato com a recepçãoda clínica.</div>
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
            <form action="add_patient.php" method="POST">

            <div class="form-group" >
              <label for="usr">Nome Completo:</label>
              <input type="text" class="form-control" id="usr" name="apfullname" required>
            </div>

            <div class="form-group">
              <label for="pwd">Idade:</label>
              <input type="number" class="form-control" id="pwd" name="apAge" min="1" max="200" required>
            </div>
            <div class="form-group">
              <label for="pwd">Convênio:</label>
              <input type="tel" class="form-control" id="pwd" name="apConvenio"  required>
            </div>
            <div class="form-group">
              <label for="pwd">Telefone - Celular e fixo:</label>
              <input type="tel" class="form-control" id="pwd" name="apphone_no" required>
            </div>
            <div class="form-group">
              <label for="pwd">Endereço:</label>
              <textarea class="form-control" id="pwd" name="apaddress" required></textarea>
            </div>

            <div class="form-group">
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
                <option value="Colona" class="option">Coluna</option>
                <option value="Torácica" class="option">Torácica</option>
                <option value="Colona lombar" class="option">Colona lombar</option>

                 <option value="Quadril" class="option">Quadril</option>
                  <option value="Caxa" class="option">Coxa</option>
                   <option value="Joelho" class="option">Joelho</option>
                    <option value="Tornozelo" class="option">Tornozelo</option>
                    <option value="Pé" class="option">Pé</option>
              </select>
            </div>
           
            <div class="form-group">
              <label for="pwd">Condição médica/propósito da visita:</label>
              <textarea class="form-control" id="pwd" name="apCondition" required></textarea>
            </div>

            <div class="form-group">
              <input type="submit" value="Salvar" class="btn btn-primary" >
              <input type="reset" value="Reset" class="btn btn-danger">
            </div>
          </form>
</div>
 
</div>
<?php
  include("footer.php");
?>

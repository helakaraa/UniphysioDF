<?php
require_once("aut.php");
require_once("header.php");
$errmsg="";
$msg="";
  $ord=0;
  if(isset($_GET['order'])){
  $ord=base64_decode($_GET['order']);
   //Define the query
  $sql="DELETE FROM `appointments` WHERE `appointment_no`=$ord";
  $r=$conn->query($sql);
    if($r){
         $errmsg.= "O Consulta foi removido.<br>";
        $err=false;
    }
    else
    {
        $err=true; 
        $errmsg.= "O Consulta nao foi removido.<br>";
    }

 }



?>
<div class="page-header">
    <div class="icon">
        <span class="ico-shopping-cart"></span>
    </div>
    <h1>Consultas <small>Gerencie seus Consultas</small></h1>
</div>

 <div class="row-fluid">
        <div class="span12">
            <div class="block">
                <div class="head blue">
                    <div class="icon"><span class="ico-shopping-cart"></span></div>
                    <h2>Ultimas Consultas</h2>
                </div>
                <div class="data-fluid">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table images lcnp">
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" class="checkall"/></th>
                            <th>Consulta No</th>
                            <th>Nome Completo do patiente</th>
                            <th>Medical Condition</th>
                            <th>Parte de corpo</th>
                            <th>Especialidade precisada</th>
                            <th width="80">Acoes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $num_rec_per_page=12;
                        $page=1;
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; }
                        $start_from = ($page-1) * $num_rec_per_page;

                        $slide_sql="SELECT appointment_no, full_name,speciality, medical_condition ,corpo FROM patient_info, appointments where patient_info.patient_id = appointments.patient_id";
                        $slides=$conn->query($slide_sql);
                        if($slides->num_rows>0){
                            while($row=$slides->fetch_assoc()){
                                $id=base64_encode($row['appointment_no']);
                                $nome=$row['full_name'];
                                $condition=$row['medical_condition'];
                                $corpo=$row['corpo'];
                                $speciality=$row['speciality'];
                             
                                
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                    <td><a href="edit_order.php?order=<?php echo $id; ?>"> <?php echo base64_decode($id); ?></a></td>
                                    <td class="info"> <a href= '../payment.php?appointment_no=<?php echo $row['appointment_no']; ?>'>
                                        <?php echo $nome; ?> </a></td>
                                  
                                    <td><?php echo $condition; ?></td>
                                    <td><?php echo $corpo; ?></td>
                                    <td><?php echo $speciality; ?></td>
                                    <td>
                                        <a href="edit_order.php?order=<?php echo $id; ?>" class="button green">
                                            <div class="icon"><span class="ico-pencil"></span></div>
                                        </a>
                                        <a href="delete_consulta.php?order=<?php echo $id; ?>" class="button red">
                                            <div class="icon"><span class="ico-remove"></span></div>
                                        </a>
                                    </td>
                                </tr>
                            <?php }}?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="pagination pagination-centered">
            <ul>
                <?php
                $a="SELECT * FROM `order_summary` ";
                $c= $conn->query($a);
                $total_records=$c->num_rows;
                $total_pages = ceil($total_records / $num_rec_per_page);
                echo "<li><a href='dashboard.php?page=1'>&laquo;</a></li>";
                for ($i=1; $i<=$total_pages; $i++) {
                    if($i==$page)
                        echo "<li class='active'><a href='dashboard.php?page=$i'>$i</a></li>";
                    else
                        echo "<li><a href='dashboard.php?page=$i'>$i</a></li>";

                }
                $i--;
                echo "<li><a href='dashboard.php?page=$i'>&raquo;</i></a></li>";

                ?>
            </ul>
        </div>
    </div>
<?php
require_once("footer.php");
require_once "libs.php";
?>
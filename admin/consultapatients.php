<?php
require_once("aut.php");
require_once("header.php");
?>
<div class="page-header">
    <div class="icon">
        <span class="ico-monitor"></span>
    </div>
    <h1>Consulta Patients <small>Escolha um paciente para comecar</small></h1>
</div>

    <div class="row-fluid">
        <div class="span12">
            <div class="block">
                <div class="head blue">
                    <div class="icon"><span class="ico-shopping-cart"></span></div>
                    <h2>Ultimas Patients</h2>
                </div>
                <div class="data-fluid">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table images lcnp">
                        <thead>
                        <tr>
                            <th width="30"><input type="checkbox" class="checkall"/></th>
                           
                            <th>Nome Completo do patiente</th>
                            <th>Idade</th>
                            <th>Convenio</th>
                            <th>Numero Telephone</th>
                            <th>Endereco</th>
                            <th width="80">Acoes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $num_rec_per_page=12;
                        $page=1;
                        if (isset($_GET["page"])) { $page  = $_GET["page"]; }
                        $start_from = ($page-1) * $num_rec_per_page;

                        $slide_sql="SELECT patient_id, full_name,DOB,convenio ,phone_no, address FROM patient_info";
                        $slides=$conn->query($slide_sql);
                        if($slides->num_rows>0){
                            while($row=$slides->fetch_assoc()){
                                $id=base64_encode($row['patient_id']);
                                $nome=$row['full_name'];
                                $DOB=$row['DOB'];
                                $convenio=$row['convenio'];
                                $phone=$row['phone_no'];
                                $address=$row['address'];
                                
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="checkbox"/></td>
                                  
                                    <td class="info">  <?php echo $nome; ?> </td>
                                  
                                    <td><?php echo $DOB; ?></td>
                                    <td><?php echo $convenio; ?></td>
                                    <td><?php echo $phone; ?></td>
                                    <td><?php echo $address; ?></td>
                                    <td>
                                        <a href="edit_patient.php?order=<?php echo $id; ?>" class="button green">
                                            <div class="icon"><span class="ico-pencil"></span></div>
                                        </a>
                                        <a href="delete_patient.php?order=<?php echo $id; ?>" class="button red">
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
                $a="SELECT * FROM `patient_info` ";
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
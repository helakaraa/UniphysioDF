<?php
require_once("aut.php");
require_once("header.php");
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
            <div class="head red">
                <div class="icon"><span class="ico-shopping-cart"></span></div>
                <h2>Consultas</h2>
            </div>
            <div class="data-fluid">
                <table cellpadding="0" cellspacing="0" width="100%" class="table images lcnp">
                    <thead>
                    <tr>
                        <th width="30"><input type="checkbox" class="checkall"/></th>
                        <th width="60">ID Consulta</th>
                        <th>patiente</th>
                        <th>speciality</th>
                        <th>doctor suggestions</th>
                        <th >Status</th>
                        <th >Tempo</th>
                        <th >Tempo de atualizacao</th>
                        <th width="80">Acoes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num_rec_per_page=12;
                    $page=1;
                    if (isset($_GET["page"])) { $page  = $_GET["page"]; }
                    $start_from = ($page-1) * $num_rec_per_page;

                    $slide_sql="SELECT `appointment_no`,full_name,appointments.`patient_id` as codigo, `speciality`,  `case_closed`,`preconsulta_updatetime`,`preconsulta_time`,`doctors_suggestion` FROM `appointments`,`patient_info` WHERE appointments.patient_id=patient_info.patient_Id ORDER BY `appointment_no` DESC LIMIT $start_from, $num_rec_per_page";
                    $slides=$conn->query($slide_sql);
                    if($slides->num_rows>0){
                        while($row=$slides->fetch_assoc()){
                            $id=base64_encode($row["appointment_no"]);
                            $user_name=$row["full_name"];
                            $speciality=$row["speciality"];

                            $status=$row["case_closed"];
                            $time=$row["preconsulta_time"];
                            $update_time=$row["preconsulta_updatetime"];
                            $doctors_suggestion=$row["doctors_suggestion"];
                            ?>
                            <tr>
                                <td><input type="checkbox" name="checkbox"/></td>
                                <td> <?php echo base64_decode($id); ?></td>
                                <td class="info"><?php echo $user_name; ?></td>
                                <td class="info"><?php echo $speciality; ?></td>
                                 <td class="info"><?php echo $doctors_suggestion; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $update_time; ?></td>
                                <td>
                                    <a href="edit_consulta.php?order=<?php echo $id; ?>" class="button green">
                                        <div class="icon"><span class="ico-pencil"></span></div>
                                    </a>
                                    <a href="delete_order1.php?order=<?php echo $id; ?>" class="button red">
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
            $a="SELECT * FROM `appointments` ";
            $c= $conn->query($a);
            $total_records=$c->num_rows;
            $total_pages = ceil($total_records / $num_rec_per_page);
            echo "<li><a href='orders.php?page=1'>&laquo;</a></li>";
            for ($i=1; $i<=$total_pages; $i++) {
                if($i==$page)
                    echo "<li class='active'><a href='orders.php?page=$i'>$i</a></li>";
                else
                    echo "<li><a href='orders.php?page=$i'>$i</a></li>";

            }
            $i--;
            echo "<li><a href='orders.php?page=$i'>&raquo;</i></a></li>";

            ?>
        </ul>
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

<script type='text/javascript' src="js/plugins/uniform/jquery.uniform.min.js"></script>

<script type='text/javascript' src='js/plugins/shbrush/XRegExp.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shCore.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shBrushXml.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shBrushJScript.js'></script>
<script type='text/javascript' src='js/plugins/shbrush/shBrushCss.js'></script>

<script type='text/javascript' src='js/plugins/fancybox/jquery.fancybox.pack.js'></script>

<script type='text/javascript' src='js/plugins.js'></script>
<script type='text/javascript' src='js/charts.js'></script>
<script type='text/javascript' src='js/actions.js'></script>

<?php
require_once("aut.php");
require_once("header.php");
$errmsg="";
  $id=0;
  if(isset($_GET['user'])){
  $id=base64_decode($_GET['user']);
   //Define the query
  $sql="DELETE FROM `logins`  WHERE `logins_id` =$id";
  $r=$conn->query($sql);
    if($r){
        $msg= "O Usuario foi removido.<br>";
        $err=false;
    }
    else
    {
        $err=true; 
        $errmsg.= "O Usuario nao foi removido.<br>";
    }

 }



?>
<div class="page-header">
    <div class="icon">
        <span class="ico-user"></span>
    </div>
    <h1>Usuarios registrados <small>Todos os usuarios registrados</small></h1>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="block">
         <?php
            if($err){
                ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> <?php echo $errmsg; ?>
                </div>
            <?php
            }
            if(!$err){
                ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Successo!</strong> <?php echo $msg; ?>
                </div>
            <?php
            }
            ?>
            <div class="head blred">
                <div class="icon"><span class="ico-user"></span></div>
                <h2>Resumo de perfis</h2>
            </div>
            <div class="data-fluid">
                <table cellpadding="0" cellspacing="0" width="100%" class="table images lcnp">
                    <thead>
                    <tr>
                        <th width="30"><input type="checkbox" class="checkall"/></th>
                        <th >Usuario</th>
                        <th>email</th>
                        <th>telefone</th>
                        <th>Endereco</th>
                        <th>Post</th>
                        <th width="30">Status</th>
                        <th width="80">Acoes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $num_rec_per_page=10;
                    $page=1;
                    if (isset($_GET["page"])) { $page  = $_GET["page"]; }
                    $start_from = ($page-1) * $num_rec_per_page;

                    $slide_sql="SELECT `logins_id`, `login_name` ,`login_type`,  `login_active`, `login_fname`, `login_phone`, `login_address` FROM `logins`  LIMIT $start_from, $num_rec_per_page";
                    $slides=$conn->query($slide_sql);
                    if($slides->num_rows>0){
                        while($row=$slides->fetch_assoc()){
                            $id=base64_encode($row["logins_id"]);
                            $person=$row["login_fname"];
                            $email=$row["login_name"];
                            $phone=$row["login_phone"];
                            $address=$row["login_address"];
                            $type=intval($row["login_type"]);
                            $active=intval($row["login_active"])==1?"checked":"";
                            ?>
                            <tr>
                                <td><input type="checkbox" name="checkbox"/></td>
                                <td class="info"><a href="<?php echo "profile.php?user=$id"; ?>"><?php echo $person; ?></a> </td>
                                <td class="info"><?php echo $email; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $type==1?"Admin":"User"; ?></td>

                                <td><input type="checkbox" <?php echo $active; ?>/></td>

                                <td>
                                    <a href="profile.php?user=<?php echo $id; ?>" class="button green">
                                        <div class="icon"><span class="ico-pencil"></span></div>
                                    </a>
                                    <a href="delete_profile.php?user=<?php echo $id; ?>" class="button red">
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
            $a="SELECT `logins_id`, `login_name` `login_type`,  `login_active`, `login_fname`, `login_phone`, `login_address` FROM `logins` WHERE 1 ";
            $c= $conn->query($a);
            $total_records=$c->num_rows;
            $total_pages = ceil($total_records / $num_rec_per_page);
            echo "<li><a href='users.php?page=1'>&laquo;</a></li>";
            for ($i=1; $i<=$total_pages; $i++) {
                if($i==$page)
                    echo "<li class='active'><a href='users.php?page=$i'>$i</a></li>";
                else
                    echo "<li><a href='users.php?page=$i'>$i</a></li>";

            }
            $i--;
            echo "<li><a href='users.php?page=$i'>&raquo;</i></a></li>";

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

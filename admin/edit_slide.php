<?php
require_once("aut.php");
if(!isset($_POST['save']) && !isset($_GET['slide'])){
    header("Location:slider.php");

}
require_once("header.php");
$err=true;
$postback=false;
$errmsg="";
$target_dir = "../images/";
$uploadOk = 1;


if(isset($_POST['save'])){
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //error_reporting(E_ERROR | E_PARSE);
    $target_file = $target_dir . "slider_".time().".$imageFileType";
    $postback=true;
    $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $errmsg.= "O arquivo nao e uma imagem.";
        $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 5000000) {

        $errmsg.= "Desculpe, seu arquivo e muito grande.<br>";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $errmsg.= "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF sao permitidos.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $errmsg.= "Desculpe, seu arquivo n�o foi carregado.";
// if everything is ok, try to upload file
    } else {
        if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $uploadOk=0;
        }
    }

    $fileName=$uploadOk==1?basename( $target_file):$_POST['oldImg'];
    $slide=base64_decode($_POST['slide']);
    $cap=$_POST['caption'];
    $s_num=$_POST['number'];
    $act=isset($_POST['enable'])?1:0;
    $sql="UPDATE `slides` SET `slides_image`='$fileName', `slide_caption`='$cap', `slide_number`= $s_num, `slide_active`= $act WHERE `slide_id` =$slide";
    $r=$conn->query($sql);
    if($r){
        $msg= "Slide guardado com sucesso<br>";
        $err=false;
    }
}
$id=0;
if(isset($_GET['slide'])){
$id=base64_decode($_GET['slide']);
    $sql="SELECT `slides_image`, `slide_caption`, `slide_number`, `slide_active` FROM `slides` WHERE `slide_id`='$id'";
    $r=$conn->query($sql);
    if($r->num_rows==1){
        $row=$r->fetch_assoc();
        $img=$row["slides_image"];
        $cap=htmlspecialchars($row["slide_caption"]);
        $s_num=$row["slide_number"];
        $act=$row["slide_active"];
    }
    else
        $id=0;
}
?>
<div class="page-header">
    <div class="icon">
        <span class="ico-image"></span>
    </div>
   <h1>Slider <small>Controle os dados no Slide</small></h1>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="block">
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
                    <strong>Successo!</strong> <?php echo $msg; ?>
                </div>
            <?php
            }
            ?>
            <div class="head green">
                <div class="icon"><span class="ico-picture"></span></div>
              <h2>Slider Detalhes da imagem</h2>
            </div>
            <?php if($id!=0){?>
            <form id="validate" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="slide" value="<?php echo base64_encode($id); ?>"/>
                <input type="hidden" name="oldImg" value="<?php echo $img; ?>"/>
                <div class="data-fluid">
                    <div class="row-form">
                        <div class="span2">Rubrica</div>
                        <div class="span10">
                            <textarea name="caption"  class="validate[required,minSize[5],maxSize[150]]" style="width:100%"><?php echo $cap; ?></textarea>
                        </div>
                    </div>
                    <div class="row-form">
                        <div class="span2">Imagem</div>
                        <div class="span6"><div class="input-append file ">
                                <input type="file" name="fileToUpload" onchange="readURL(this);"/>
                                <input type="text"  />
                                <button class="btn">Browse</button>
                            </div>
                        </div>
                        <div class="span4">
                            <img src="../images/<?php echo $img; ?>" width="150" height="200" id="previewimg" class="img-responsive img-thumbnail"/>

                        </div>
                    </div>

                    <div class="row-form">
                        <div class="span2">Numero do SLide</div>
                        <div class="span2">
                            <input type="text" name="number" class="validate[required,custom[integer],minSize[0]]" value="<?php echo $s_num; ?>"/>
                        </div>
                        <div class="span4">
                            <input type="checkbox"  name="enable" value="1" <?php echo $act==1?"checked":""; ?>/> Activo
                        </div>
                    </div>
                    <div class="row-form">

                    </div>

                    <div class="toolbar bottom tar">
                        <div class="btn-group">
                            <button class="btn" type="submit" name="save">Salvar Slide</button>
                        </div>
                    </div>

                </div>
            </form>
            <?php }
            else{?>
            <div class="alert alert-error alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Error!</strong> <br>Slide not found<br>

                    <a href="slider.php" class="btn btn-warning">Va para Sliders</a>
                    <a href="dashboard.php" class="btn btn-warning ">Va para Home</a>

            </div>
                <div class="row-fluid">
                    <a href="slider.php" class="btn btn-default">Va para Sliders</a>
                    <a href="dashboard.php" class="btn btn-default">Va para Home</a>
                </div>
            <?php }?>
        </div>

    </div>
</div>

<?php
require_once("header.php");
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewimg')
                    .attr('src', e.target.result)

            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <title>Admin Painel De Controle</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/ico" href="favicon.ico"/>

    <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 7]>
    <link href="css/ie.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='js/plugins/other/lte-ie7.js'></script>
    <![endif]-->

</head>
<body>
        <!--header-->
    <div class="header">
        <div class="container">
            <div class="header-logo">
            <!--    <a href="index.html"><img src="img/logo.png" alt="logo"/></a>-->

            <div class="header-info">
            <h4>Ferreira Alves Fisioterapia Admin</h4>
            </div>  
            </div>
            <div class="header-info">
                <p>Serviço de informação:</p>
                <h4>61-1234-1234</h4>
            </div>          
            <div class="clearfix"> </div>
        </div>  
    </div>
    <!--//header-->
<div id="loader"><img src="img/loader.gif"/></div>
<div class="wrapper">

    <div class="sidebar">

        <div class="top">
            <a href="../index.php" class="" style="height: 64px;"></a>

        </div>
        <div class="nContainer">
            <ul class="navigation">
                <li> <a href="../index.php" class="blgreen">Home</a></li>
                <li><a href="dashboard.php" class="blblue">Painel de Controle</a></li>
                <li>
                    <a href="#" class="blyellow">Slider</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="new_slide.php">Novo Slide</a></li>
                        <li><a href="slider.php">Exibir imagens de slide</a></li>
                        <li><a href="edit_slide.php">Alterar Slide</a></li>
                    </ul>
                </li>
                <li><a href="categories.php" class="blgreen">Categorias de Blog</a></li>
                <li>
                    <a href="#" class="blorange">Consultas</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="add_consulta.php">Adicionar nova Consulta</a></li>
                        <li><a href="orders.php">Todos os Consultas</a></li>
                        <li><a href="Add_patient.php">Adicionar novo patiente</a></li>
                        <li><a href="consultapatients.php">Consultas Patientes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="bldblue">Blog</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="new_product.php">Adicionar novo artigo</a></li>
                        <li><a href="edit_product.php">Modificar detalhes do artigo</a></li>
                        <li><a href="products.php">Listar todos os artigos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="blpurple">Testemunho</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="new_testimonial.php">Registre Novo Testemunho</a></li>
                        <li><a href="testimonial.php">Listar todos os Testemunhos</a></li>
                        <li><a href="testimonial.php">Modificar Testemunho</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="blorange">Funcionarios</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="new_staff.php">Adicionar novo funcionario</a></li>
                        <li><a href="edit_staff.php">Modificar detalhes da equipe</a></li>
                        <li><a href="staff.php">Listar toda a equipe</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="blyellow">Clinica</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="about.php">Sobre nos</a></li>
                        <li><a href="contact.php">Detalhes do contato</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="blred">Conta</a>
                    <div class="open"></div>
                    <ul>
                        <li><a href="profile.php">Perfil</a></li>
                        <li><a href="users.php">Todos os usuarios</a></li>
                    </ul>
                </li>
            </ul>
            <a class="close">
                <span class="ico-remove"></span>
            </a>
        </div>
        <div class="widget">
        
            <div id="txtDate" class="datepicker"></div>
        </div>

    </div>
    

    <div class="body">
        <ul class="navigation">
            <li>
                <a href="../index.php" class="button">
                    <div class="icon">
                        <span class="ico-home"></span>
                    </div>
                    <div class="name">Home</div>
                </a>
            </li>
            <li>
                <a href="dashboard.php" class="button green">
                    <div class="icon">
                        <span class="ico-monitor"></span>
                    </div>
                    <div class="name">Painel</div>
                </a>
            </li>

            <li>
                <a href="products.php" class="button purple">
                    <div class="icon">
                        <span class="ico-file"></span>
                    </div>
                    <div class="name">Blog</div>
                </a>
            </li>
            <li>
                <a href="orders.php" class="button bldblue">
                    <div class="icon">
                        <span class="ico-group"></span>
                    </div>
                    <div class="name">Consultas</div>
                </a>
            </li>
            <li>
                <a href="staff.php" class="button yellow">
                    <div class="icon">
                        <span class="ico-user"></span>
                    </div>
                    <div class="name">Funcionarios</div>
                </a>
            </li>
         
            <li>
                <a href="logout.php" class="button red">
                    <div class="icon">
                        <span class="ico-signout"></span>
                    </div>
                    <div class="name">Logout</div>
                </a>
            </li>

        </ul>



        <div class="content">



<?php
    require_once("config/conexion.php");
    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
        require_once("models/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>
<!DOCTYPE html>
<html>

<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>AMPYME::Acceso</title>

        <link rel="apple-touch-icon" sizes="180x180" href="../../public/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href=".../../public/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../public/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../public/favicon/site.webmanifest">
        <link rel="mask-icon" href="../../public/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="../../public/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#00aba9">
        <meta name="msapplication-config" content="../../public/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <link href="../../public/favicon/favicon.ico" rel="shortcut icon">

    <link rel="stylesheet" href="../../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
</head>
<body>
    
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
            
                <form class="sign-box" action="" method="post" id="login_form">
                    
                    <input type="hidden" id="rol_id" name="rol_id" value="1">

                    <div class="sign-avatar">
                        <img src="public/1.jpg" alt="" id="imgtipo">
                    </div>
                    <header class="sign-title" id="lbltitulo">Acceso Usuario</header>

                    <?php
                        if (isset($_GET["m"])){
                            switch($_GET["m"]){
                                case "1";
                                    ?>
                                        <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="font-icon font-icon-warning"></i>
                                            El Usuario y/o Contraseña son incorrectos.
                                        </div>
                                    <?php
                                break;

                                case "2";
                                    ?>
                                        <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="font-icon font-icon-warning"></i>
                                            Los campos estan vacios.
                                        </div>
                                    <?php
                                break;
                            }
                        }
                    ?>

                    <div class="form-group">
                        <input type="text" id="usu_correo" name="usu_correo" class="form-control" placeholder="E-Mail"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <div class="float-right reset">
                            <!-- <a href="reset-password.html">Cambiar Contraseña</a> -->
                        </div>
                        <div class="float-left reset">
                            <a href="#" id="btnsoporte">Acceso Soporte</a>
                        </div>
                    </div>
                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <button type="submit" class="btn btn-rounded">Acceder</button>
                </form>
            </div>
        </div>
    </div>

<script src="../../public/js/lib/jquery/jquery.min.js"></script>
<script src="../../public/js/lib/tether/tether.min.js"></script>
<script src="../../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../../public/js/plugins.js"></script>
<script type="text/javascript" src="../../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
<script>
    $(function() {
        $('.page-center').matchHeight({
            target: $('html')
        });

        $(window).resize(function(){
            setTimeout(function(){
                $('.page-center').matchHeight({ remove: true });
                $('.page-center').matchHeight({
                    target: $('html')
                });
            },100);
        });
    });
</script>
<script src="../../public/js/app.js"></script>

<script type="text/javascript" src="index.js"></script>

</body>
</html>
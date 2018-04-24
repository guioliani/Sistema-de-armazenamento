<?php
require("../../config/conecta.php");
session_start();
require("../../config/protect.php");
protegerUser();

if(isset($_GET["action"]) AND $_GET["action"] == "sair"){
    session_destroy();
    header("Location: ../../index.html");
}

?>

<html>
	<head>
		<title>Painel do usuario</title>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/fw-amb.css"/>
    </head>
    
    <?php 
        $id = $_SESSION['id'];
        $select = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'");
        $row = $select->num_rows;
        $get = $select->fetch_array();

        $nome = $get['nome'];
        $primeiroNome = explode(" ", $nome);
    ?>

	<body>
        <div class="page">
            <div class="sidebar">
                <div class="title">
                    <img src="../../img/default.png" alt="">
                    <p><?php echo $primeiroNome[0]; ?></p>
                </div>

                <ul class="nav">
                    <a href="../../functions/arquivos.php"><li class="nav-item">
                        <img src="../../img/download.png" alt="">
                        <p>Download</p>
                    </li></a>

                    <a href="../../functions/upload.php"><li class="nav-item">
                        <img src="../../img/upload.png" alt="">
                        <p>upload</p>
                    </li></a>

                    <a href="config-pref.php"><li class="nav-item">
                        <img src="../../img/config.png" alt="">
                        <p>config</p>
                    </li></a>

                    <a href="#"><li class="nav-item">
                        <img src="../../img/sair.png" alt="">
                        <p>sair</p>
                    </li></a>

                </ul>
            </div>
        </div>
        <script src="../../js/jquery.js"></script>  
        <script src="../../js/app-menu.js"></script>  
	</body>
</html>
<?php
require("../config/conecta.php");
session_start();
require("../config/protect.php");
require("format.php");
protegerUser();

if(isset($_GET["action"]) AND $_GET["action"] == "sair"){
    session_destroy();
    header("Location: ../../index.html");
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload files</title>
	<meta charset="utf-8">
	<meta name="viweport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/uploadfilemulti.css">
 	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<link rel="stylesheet" type="text/css" href="../css/fw-amb.css"/>
	<script src="../js/jquery.js"></script>  
    <script src="../js/app-menu.js"></script> 
  	<script src="../js/ajax.js"></script>
 	<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php
$id = $_SESSION['id'];
$select = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'");
$row = $select->num_rows;
$get = $select->fetch_array();

$nome = $get['nome'];
$capacidade = $get['capacidade'];
$_SESSION['capacidade'] = $capacidade;

$primeiroNome = explode(" ", $nome);
?> 
		<div class="page">
            <div class="sidebar">
                <div class="title">
                    <img src="../img/default.png" alt="">
                    <p><?php echo $primeiroNome[0]; ?></p>
                </div>

                <ul class="nav">
                    <a href="javascript:history.go(-1)"><li class="nav-item nav-item-upload">
                        <img src="../img/voltar.png" alt="">
                        <p>voltar</p>
                    </li></a>

                    <a href="arquivos.php"><li class="nav-item nav-item-upload">
                        <img src="../img/download.png" alt="">
                        <p>Download</p>
                    </li></a>

                    <a href="../templates/usuario/config-pref.php"><li class="nav-item nav-item-upload">
                        <img src="../img/config.png" alt="">
                        <p>config</p>
                    </li></a>

                    <a href="#"><li class="nav-item nav-item-upload">
                        <img src="../img/sair.png" alt="">
                        <p>sair</p>
                    </li></a>

                </ul>
            </div>
        </div>
<!--
menu
-->
	<div class="container">	
		<div class="jumbotron">
			<h2>Upload</h2>
			 <button type="button" id="mulitplefileuploader">Importar arquivo(s)</button>
		</div>
	</div>
</body>
</html>
<script src="../js/jquery.fileuploadmulti.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*$.ajax({
        type: 'POST',
        url: 'importar.php',
        dataType: 'html',
        data: 'retorna=msg', 
        allowedTypes: "*",
        fileName: "file",
        multiple: true,

        success: function(data){
            $(".jumbotron").html(data);
            console.log(data);
        }
    });*/

    var settings = {
		url: "importar.php",
        type: "POST",
        allowedTypes: "*",
        fileName: "file",
        multiple: true,

		onSuccess:function(files, data, xhr){
            $(".jumbotron").html(data);
            console.log(data);
		},

		afterUploadAll:function(){
			$(".upload-bar").css("animation-play-state", "pause");
		},

		onError:function(files, status, errMsg){
			alert(errMsg);
		}
	}
	$("#mulitplefileuploader").uploadFile(settings);
});

</script>

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
		<title>Configurações</title>
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
                    <a href="javascript:history.go(-1)"><li class="nav-item">
                        <img src="../../img/voltar.png" alt="">
                        <p>voltar</p>
                    </li></a>

                    <a href="../../functions/arquivos.php"><li class="nav-item">
                        <img src="../../img/download.png" alt="">
                        <p>Download</p>
                    </li></a>

                    <a href="../../functions/upload.php"><li class="nav-item">
                        <img src="../../img/upload.png" alt="">
                        <p>upload</p>
                    </li></a>

                    <a href="#"><li class="nav-item">
                        <img src="../../img/sair.png" alt="">
                        <p>sair</p>
                    </li></a>

                </ul>
            </div>
        </div>

        <form id="formulario" method="post">
            <ul id="progress">
                <li class="ativo">Configurações</li>
                <li>Atualizar cadastro</li>
                <li>Detalhes</li>
            </ul>
            <fieldset>
                <h2 class="verde titulo">Configurações da conta</h2>
                <h3 class="verde subtitulo">algumas configs</h3>

                <input type="submit" name="next" class="next acao" value="proximo">
                <input type="submit" name="salvar" class="acao" value="salvar">
            </fieldset>

            <fieldset>
                <h2 class="verde titulo">Atualização da conta</h2>
                <input type="text" name="email" placeholder="email" value="<?php echo $get['email']; ?>">
                <input type="password" name="senha" placeholder="senha" value="<?php echo $get['senha']; ?>">
                <input type="submit" name="prev" class="prev acao" value="anterior">
                <input type="submit" name="next" class="next acao" value="proximo">
                
            </fieldset>

            <fieldset>
                <h2 class="verde titulo">Detalhes</h2>
                
                <p>detalhes sobre o sistema</p>
                <input type="submit" name="prev" class="prev acao" value="anterior">
            </fieldset>
        </form>

        <script src="../../js/jquery.js"></script>  
        <script src="../../js/app-menu.js"></script> 
    </body> 

</html> 
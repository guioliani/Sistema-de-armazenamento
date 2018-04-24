<?php
    require("config/conecta.php");
    session_start();
?>
<html>
	<head>
		<title>Login</title>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/fw-amb.css"/>
	</head>

	<body>
    <div class="page">
        <div class="formulario form bradius">   
            <form action="?acao=logar"method="post">
                <label for="email">E-mail</label><input id="email" type="text" class="txt bradius" name="email" values="" placeholder="Digite seu email"/>
                <label for="senha">Senha</label><input id="senha" type="password" class="txt bradius" name="senha" values="" placeholder="Digite sua senha"/>
                <input type="submit" id="logar" class="sb bradius" value="entrar" name="button"/>
                <input type="submit" id="cadastrar" class="sb bradius" value="cadastrar" name="cadastrar"/>
                <input type="submit" id="home" class="sb bradius" value="home" name="home"/>
            </form>
            </div>
        </div>
    </div>
                    
	</body>
</html>

<?php
if(isset($_POST["button"])){
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    $senha = mysqli_real_escape_string($mysqli, md5($_POST['senha']));

    if($email == "" || $senha == ""){
        echo "
        <div class='aviso-cad yellow'>
            <h2 class='font-media titulo'>Preencha todos os campos!!</h2>
        </div>";
    return true;
    }

    $select = $mysqli->query("SELECT id, email, senha, nivel, status FROM usuarios WHERE email = '$email' AND senha = '$senha'
                                UNION
                            SELECT id, email, senha, nivel, status FROM administrador WHERE email = '$email' AND senha = '$senha'");

    $row = $select->num_rows;
    $get = $select->fetch_array();
    $id = $get['id'];
    $_SESSION['id'] = $id;

    
    $nivel = $get['nivel'];
    $status = $get['status'];

    if($row > 0){
        if($nivel == 1 AND $status == 1){
            session_start();
            $_SESSION["nivel"] = 1;
            echo "
                <div class='aviso-cad green'>
                    <h2 class='font-media titulo'>Logado com sucesso!!</h2>
                </div>
                ";
            sleep(2);
            header('Location: templates/usuario/painel-usuario.php');
        }elseif($nivel == 2 AND $status == 1){
            session_start();
            $_SESSION["nivel"] = 2;
            echo "
                <div class='aviso-cad green'>
                    <h2 class='font-media titulo'>Logado com sucesso!!</h2>
                </div>
            ";
            sleep(2);
            header('Location: templates/usuario/painel-usuario.php');
        }else{
            echo "<div class='aviso-cad yellow'>
                    <h2 class='font-media titulo'>Sua conta foi bloqueada ou ainda nao foi liberada!!</h2>
                </div>";
        }
    }else{
        echo "<div class='aviso-cad red'>
                <h2 class='font-media titulo'>Usuario ou senha incorretos!!</h2>
            </div>";
    }
    
    
}elseif(isset($_POST['cadastrar'])){
    header("Location: cadastro.php");

}elseif(isset($_POST['home'])){
    header("Location: index.php");
}

?>
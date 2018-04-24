<?php
require("config/conecta.php");
require("functions/format.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<title>pagina de cadastro</title>
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/fw-amb.css"/>
</head>

<body>

    <div class="page">
            <div class="formulario form bradius">   
                <form action="?acao=logar"method="post">
                    <label for="nome">Nome</label><input id="nome" type="text" class="txt bradius" name="nome" values="" placeholder="Digite seu nome"/>
                    <label for="email">E-mail</label><input id="email" type="text" class="txt bradius" name="email" values="" placeholder="Digite seu email"/>
                    <label for="senha">Senha</label><input id="senha" type="password" class="txt bradius" name="senha" values="" placeholder="Digite sua senha"/>
                    <input type="submit" id="cadastrar" class="sb bradius" value="cadastrar" name="button"/>
                    <input type="submit" id="login" class="sb bradius" value="login" name="login"/>
                    <input type="submit" id="home" class="sb bradius" value="home" name="home"/>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
if(isset($_POST['button'])){
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $senha = mysqli_real_escape_string($mysqli, $_POST['senha']);

    if($nome == "" || $email == "" || $senha == ""){
        echo "
        <div class='aviso-cad yellow'>
            <h2 class='font-media titulo'>Preencha todos os campos!!</h2>
        </div>";
    return true;
    }

    $select = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'");
    if($select){
        $rows = $select->num_rows;
        if($rows > 0){
            echo "  <div class='aviso-cad yellow'>
            <h2 class='font-media titulo'>Ja existe um usuario cadastrado com esse email!!</h2>
          </div>";
        }else{
            $primeiroNome = explode(" ", $nome);
            $caminho = 'arquivos/'.$primeiroNome[0];
            $insert = $mysqli->query("INSERT INTO `usuarios` (`nome`, `pasta`, `email`, `senha`, `status`, `nivel`, `capacidade`) VALUES ('$nome', '$primeiroNome[0]', '$email', '".md5($senha)."', 0, 1, 5368709120)");
            CriaPasta($caminho);
            if($insert){
                echo "<div class='aviso-cad green'>
                    <h2 class='font-media titulo'>Conta registrada com sucesso!!</h2>
                    </div>";
            }else{
                echo $mysqli->error;
            }
        }
    }else{
        echo $mysqli->error;
    }
}elseif(isset($_POST['login'])){
    header("Location: login.php");

}elseif(isset($_POST['home'])){
    header("Location: index.php");
}

?>
<?php
require("../config/conecta.php");
session_start();
require("../config/protect.php");
protegerUser();

if(isset($_GET["action"]) AND $_GET["action"] == "sair"){
  session_destroy();
  header("Location: ../index.html");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css"/>
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
                <p>Voltar</p>
            </li></a>

            <a href="upload.php"><li class="nav-item nav-item-upload">
                <img src="../img/upload.png" alt="">
                <p>upload</p>
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

<!--tabela-->
<div class="container">
  <h2>Arquivos</h2>                                                                      
  <div class="table-responsive">          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Nome do arquivo</th>
        <th>Tamanho</th>
        <th>Data</th>
        <th>ações</th>
      </tr>
    </thead>
    <tbody id="result">

    </tbody>
  </table>
  </div>
</div>

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
  $.ajax({
    url:"metodos.php",
    type:"POST",
    data:"metodo=Listar_arquivos",
    beforeSend:function(){

    },
    success:function(data){
      $("#result").html(data);//joga dados no id result
    }
  })
})

function excluir_arquivo(id_arquivo){
  $.ajax({
    url:"metodos.php",
    type:"POST",
    data:"metodo=excluir_arquivo&id_arquivo="+id_arquivo,
    beforeSend:function(){

    },
    success:function(data){
      if(data != 0){
        $.ajax({
          url:"metodos.php",
          type:"POST",
          data:"metodo=Listar_arquivos",
          beforeSend:function(){

          },
          success:function(data){
            $("#result").html(data);//joga dados no id result
          }
        })
      }else{
        alert("erro ao deletar");
      }
    }
  })
}


</script>
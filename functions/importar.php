<?php
session_start();
include "../config/conecta.php";
require("format.php");


ini_set('upload_max_filesize', '20000M');
ini_set('post_max_size', '80000M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);



$arquivo = $_FILES["file"]["tmp_name"];
$nome    = $_FILES["file"]["name"];
$tamanho = $_FILES["file"]["size"];

$capacidade = $_SESSION['capacidade'];
$id = $_SESSION['id'];

$select = $mysqli->query("SELECT sum(tamanho) FROM `arquivos` WHERE idUsuario = '$id'");
$row = mysqli_fetch_array($select);
$count = $row['sum(tamanho)'];
$newVal = $count + $tamanho;


echo "total > ".formatBytes($newVal);
echo "\n\n";
echo "capacidade > ".formatBytes($capacidade);
echo "\n\n";
echo "tamanho arquivo > ".formatBytes($tamanho);

if($newVal > $capacidade){
	echo "é maior";
}else{
	$selectUser = $mysqli->query("SELECT * FROM `usuarios` WHERE id = '$id'");
	$rowUsuario = $selectUser->num_rows;
	$get = $selectUser->fetch_array();

	$pasta = $get['pasta'];

	echo $pasta;
	if($pasta == ""){
		echo "nao tem pasta";
	}else{
		$fp = fopen($arquivo, "rb");
		$documento = fread($fp, $tamanho);
		fclose($fp);
		$dados = bin2hex($documento);

		$caminho = "../arquivos/".$pasta."/".$nome;

		move_uploaded_file($arquivo, $caminho);

		$insert = ("INSERT INTO arquivos (idUsuario, nome, tamanho, conteudo, pasta, data) VALUES ('$id' ,'$nome', '$tamanho', '$dados', '$caminho', NOW())");
		$result = $mysqli->query($insert) or die(mysqli_errno($mysqli));
	}
}
?>

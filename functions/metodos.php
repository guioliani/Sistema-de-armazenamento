<?php
include "../config/conecta.php";
require "format.php";
session_start();
error_reporting(0);
ini_set("display_errors", 0);

$metodo = $_POST["metodo"];
$id_arquivo = $_POST["id_arquivo"];

$nivel = $_SESSION['nivel'];
$id = $_SESSION['id'];

switch ($metodo) {
	case 'Listar_arquivos':
		$select = $mysqli->query("SELECT id_arquivo, nome, tamanho, data FROM arquivos WHERE idUsuario = '$id'");
		while($arquivo = mysqli_fetch_object($select)){
			echo "<tr>
				<td>".$arquivo->id_arquivo."</td>
				<td>".$arquivo->nome."</td>
				<td>".$arquivo->tamanho."</td>
				<td>".$arquivo->data."</td>
				<td>
					<a href='visualizar_arquivo.php?acao=visualizar&id_arquivo=".$arquivo->id_arquivo."'target='_blank'><i class='fa fa-external-link fa-2x' aria-hidden='true'></i></a>
					<a href='visualizar_arquivo.php?acao=download&id_arquivo=".$arquivo->id_arquivo."'target='_blank'><i class='fa fa-cloud-download fa-2x' aria-hidden='true'></i></a>
					<a href='#' onclick='excluir_arquivo(".$arquivo->id_arquivo.");'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></a>
				</td>";
		}
	
	break;

	case 'excluir_arquivo':
		$delete = $mysqli->query("DELETE FROM arquivos WHERE id_arquivo = '$id_arquivo'");
		if(mysqli_affected_rows($mysqli) > 0){
			echo 1;
		}else{
			echo 0;
		}
	break;
}
?>
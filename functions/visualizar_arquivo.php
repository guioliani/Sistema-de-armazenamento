<?php
include "../config/conecta.php";

$id_arquivo = $_GET["id_arquivo"];
$acao = $_GET["acao"];

$select = $mysqli->query("SELECT conteudo, nome FROM arquivos WHERE id_arquivo = '$id_arquivo'");
$query = mysqli_fetch_object($select);
$pasta = "../arquivos/".$query->nome;
$dados = converte($query->conteudo);

$arquivo = $query->nome;
$ext = pathinfo($arquivo, PATHINFO_EXTENSION);

if($ext == 'png'){
	$tipo = 'image/png';
}elseif($ext == 'jpg'){
	$tipo = 'image/jpeg';
}elseif($ext == 'pdf'){
	$tipo = 'application/pdf';
}elseif($ext == 'sql'){
	$tipo = 'text/plain';
}else{
	echo "erro ao abrir o arquivo";
}

if(mysqli_num_rows($select) > 0){
	if($acao == "visualizar"){
		if(file_exists($pasta)){
			header('Content-Type: '.$tipo.'');
			header('Content-disposition: inline; filename='.$query->nome);
			readfile($pasta);
		}else{
			header('Pragma: public');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Content-Type: '.$tipo.'');
		    header('Content-disposition: inline; filename='.$query->nome);
		    header('Content-Transfer-Encoding: binary');
		    header('Content-Length: '.strlen($dados));
		    print $dados;
		}
	}

	if($acao == "download"){

		if(file_exists($pasta)){
			header('Content-Type: '.$tipo.'');
			header('Content-disposition: attachment; filename='.$query->nome);
			readfile($pasta);
		}else{
			header('Pragma: public');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Content-Type: '.$tipo.'');
		    header('Content-disposition: attachment; filename='.$query->nome);
		    header('Content-Transfer-Encoding: binary');
		    header('Content-Length: '.strlen($dados));
		    print $dados;
		}
	}

}

function converte($str){
	$bin = "";
	$i = 0;
	do{
		$bin .= chr(hexdec($str{$i}.$str{($i + 1)}));
		$i += 2;
	}while($i < strlen($str));
	return $bin;
}

?>
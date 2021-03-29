<!DOCTYPE html>
<html>
<head>
	<title>Exemplo de API</title>
</head>
	<meta name="author" content="Nicolas L. Araujo"> <!-- Autor -->
	<meta name="reply-to" content="nicolasleitearaujo@gmail.com"> <!-- Email do Autor -->
	<meta charset="UTF-8">
	<!-- Configurações -->
	<!-- HTTP -->
	<meta http-equiv="content-language" content="pt-br"> <!-- Linguagem Português Brasil-->
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"> <!-- Especificando o documento -->
<body>
<?php


//===========================================================================================================================
        //Exemplo de Uso
//===========================================================================================================================
//
//Local

//Declaração
require_once "mask.php";
$api = new API;


//Máscaras

$cpf = '17815329748';
$data = '2021-02-02';
$money = "200,222"; //tanto faz . ou ,
$tel='1399783569';

echo $api->cpf($cpf)==false ? "CPF Inválido" : $api->cpf($cpf) ; //178.153.297-48
echo "<br>";
echo $api->data($data)==false ? "Data Inválida" : $api->data($data) ; // 02/02/2021
echo "<br>";
echo $api->date()['mask']['eua'].'<br>'; //2021-02-02 dia atual
echo $api->date()['mask']['br'].'<br>'; //02/02/2021 dia atual
echo $api->tel($tel).'<br>'; //(13) 9978-3569
echo $api->money("265,9");
echo "<br>";


$data = $api->date();
//Array data

echo "<pre>";
print_r($data);
echo "</pre>";

echo $data['ample']['dia'] . ", dia ".$data['short']['dia']." de " . $data['ample']['mes'] . " de " . $data['long']['ano'];


?>
</body>
</html>
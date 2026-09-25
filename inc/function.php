<?php
ob_start(); //output buffer aberto, para não dar erro de header location

include('../config.php');
include(DBAPI);

$enfermeiros = null;
$enfermeiro = null;

function formatData($data, $formato)
{
	$dt = new Datetime($data, new DateTimeZone("America/Sao_Paulo"));// "-0300"
	return $dt->format($formato);
}


function telefone($tel)
{
	return "(" . substr($tel, 0, 2) . ")" . substr($tel, 2, 5)
		. "-" . substr($tel, 7, 4);
}

function cep($cep)
{
	return substr($cep, 0, 5) . "-" . substr($cep, 5, 3);
}

function index()
{
	global $enfermeiros;
	$enfermeiros = find("enfermeiros");
}

function view($id = null)
{
	global $enfermeiro;
	$enfermeiro = find('enfermeiros', $id);
}

function add()
{
	if (!empty($_POST['enfermeiro'])) {

		// $today = date_create('now', new DateTimeZone('-0300'));
		$today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

		$enfermeiro = $_POST['enfermeiro'];
		$enfermeiro['modified'] = $enfermeiro['created'] = $today->format("Y-m-d H:i:s");
		//modified e created são posições que serão adiconadas dentro do array $customer

		save('enfermeiros', $enfermeiro); // 'enfermeiros' -> nome da tabela; $enfermeiro -> associative array
		header('location: index.php'); // output buffer
	}
}

function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_POST['enfermeiro'])) {

      $enfermeiro = $_POST['enfermeiro'];
      $enfermeiro['modified'] = $now->format("Y-m-d H:i:s");

      update("enfermeiros", $id, $enfermeiro);
      header("location: index.php");
    } else {

      global $enfermeiro;
      $enfermeiro = find("enfermeiros", $id);
    } 
  } else {
    header("location: index.php");
  }
}


function delete($id = null) {

  global $enfermeiro;
  $enfermeiro = remove('enfermeiros', $id);

  header("location: index.php");
}
function redimensionarImagem($origem, $destino, $larguraMax = 300) {
    $info = getimagesize($origem);
    if (!$info) {
        throw new Exception("Não foi possível ler a imagem.");
    }

    $largura = $info[0];
    $altura  = $info[1];
    $tipo    = $info[2];

    // Se a imagem já for menor que o limite, só copia
    if ($largura <= $larguraMax) {
        copy($origem, $destino);
        return;
    }

    $ratio    = $larguraMax / $largura;
    $novaLarg = $larguraMax;
    $novaAlt  = (int)($altura * $ratio);

    $nova = imagecreatetruecolor($novaLarg, $novaAlt);

    if ($tipo === IMAGETYPE_JPEG) {
        $src = imagecreatefromjpeg($origem);
    } elseif ($tipo === IMAGETYPE_PNG) {
        imagealphablending($nova, false);
        imagesavealpha($nova, true);
        $src = imagecreatefrompng($origem);
    } elseif ($tipo === IMAGETYPE_WEBP) {
        $src = imagecreatefromwebp($origem);
    } elseif ($tipo === IMAGETYPE_GIF) {
        $src = imagecreatefromgif($origem);
    } else {
        throw new Exception("Formato de imagem não suportado. Use JPG, PNG, WEBP ou GIF.");
    }

    imagecopyresampled($nova, $src, 0, 0, 0, 0, $novaLarg, $novaAlt, $largura, $altura);

    if ($tipo === IMAGETYPE_JPEG) {
        imagejpeg($nova, $destino, 85);
    } elseif ($tipo === IMAGETYPE_PNG) {
        imagepng($nova, $destino, 6);
    } elseif ($tipo === IMAGETYPE_WEBP) {
        imagewebp($nova, $destino, 85);
    } elseif ($tipo === IMAGETYPE_GIF) {
        imagegif($nova, $destino);
    }

imagedestroy($src);
    imagedestroy($nova);
}


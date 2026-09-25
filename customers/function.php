<?php
ob_start(); //output buffer aberto, para não dar erro de header location

include('../config.php');
include(DBAPI);

$customers = null;
$customer = null;

/**
 *  Formatar as datas
 */
function formatData($data, $formato)
{
	$dt = new Datetime($data, new DateTimeZone("America/Sao_Paulo"));// "-0300"
	return $dt->format($formato);
}

/**
 *  Formatar os telefones
 */
function telefone($tel)
{ //15999990000
	return "(" . substr($tel, 0, 2) . ")" . substr($tel, 2, 5)
		. "-" . substr($tel, 7, 4);
}

/**
 *  Formatar os cep´s
 */
function cep($cep)
{
	return substr($cep, 0, 5) . "-" . substr($cep, 5, 3);
}

/**
 *  Listagem de Clientes
 */
function index()
{
	global $customers;
	$customers = find_all("customers");
	//find_all e find é a mesma coisa, resulta na mesma coisa
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
	global $customer;
	$customer = find('customers', $id);
}

/**
 *  Cadastro de Clientes
 */
function add()
{
	if (!empty($_POST['customer'])) {

		// $today = date_create('now', new DateTimeZone('-0300'));
		$today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

		$customer = $_POST['customer'];
		$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
		//modified e created são posições que serão adiconadas dentro do array $customer

		save('customers', $customer); // 'customers' -> nome da tabela; $customer -> associative array
		header('location: index.php'); // output buffer
	}
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];
      $customer['modified'] = $now->format("Y-m-d H:i:s");

      update("customers", $id, $customer);
      header("location: index.php");
    } else {

      global $customer;
      $customer = find("customers", $id);
    } 
  } else {
    header("location: index.php");
  }
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $customer;
  $customer = remove('customers', $id);

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
        // Preserva transparência no PNG
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


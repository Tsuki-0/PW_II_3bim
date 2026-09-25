<?php
include 'config.php';
include DBAPI;

include HEADER_TEMPLATE;
$erro = null;
try {
	$db = open_database();
} catch (Exception $e) {
	$erro = $e->getMessage();
}
?>

<h1>Dashboard</h1>
<hr>

<?php if (!$erro): ?>

	<div class="action-grid">
		<a href="customers/add.php" class="action-card action-card--primary">
			<i class="fa-solid fa-user-plus"></i>
			<p>Novo Enfermeiro</p>
		</a>

		<a href="customers" class="action-card">
			<i class="fa-solid fa-user-group"></i>
			<p>Enfermeiros</p>
		</a>
	</div>
	

<?php else: ?>
	<div class="alert alert-danger" role="alert">
		<p><b>ERRO:</b> Não foi possível Conectar ao Banco de Dados!<br>
			<?= $erro ?>
		</p>
	</div>

<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>
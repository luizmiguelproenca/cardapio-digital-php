<?php
include_once 'config/Database.php';
include_once 'class/Pedido.php';

$database = new Database();
$db = $database->getConexao();
$order = new Pedido($db);

include('inc/header.php');
?>


<title>Projeto</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<?php include('inc/container.php'); ?>

<div class="content">
	<div class="container-fluid">
		<div class='row'>
			<?php
			if (isset($_POST['enviar']) && !empty($_GET['order'])) {
				$endereco = $_POST['rua'] . ", " . $_POST['numero'] . " - " . $_POST['bairro'] . " - " . $_POST['cidade'] . "-" . $_POST['uf'] . " " . $_POST['complemento'];
				$nome = $_POST['nome'];
				$contato = $_POST['celular'];
				$total = 0;
				$orderDate = date('Y-m-d');
				if (isset($_SESSION["cart"])) {
					foreach ($_SESSION["cart"] as $keys => $values) {
						$order->item_id = $values["item_id"];
						$order->item_name = $values["item_name"];
						$order->item_price = $values["item_price"];
						$order->quantity = $values["item_quantity"];
						$order->cliente_nome = $nome;
						$order->cliente_contato = $contato;
						$order->cliente_endereco = $endereco;
						$order->cliente_opc_pgt = 1;
						$order->cliente_observacao = "";
						$order->order_date = $orderDate;
						$order->order_id = $_GET['order'];
						$order->insert();
					}
					unset($_SESSION["cart"]);
				}
			?>
				<div class="container">
					<div class="jumbotron">
						<h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Pedido Confirmado.</h1>
					</div>
				</div>
				<br>
				<h2 class="text-center">Seu pedido foi confirmado e já está sendo preparado. Obrigado!</h2>

				<h3 class="text-center"> <strong>Número do seu pedido:</strong> <span style="color: blue;"><?php echo $_GET['order']; ?></span> </h3>

				<h3 class="text-center">Desfrute mais do <a href="index.php">Nosso Cardápio!</a></h3>
			<?php } else { ?>
				<h3 class="text-center">Desfrute mais da <a href="index.php">Nosso Cardápio!</a></h3>
			<?php } ?>
		</div>
	</div>
	<?php include('inc/footer.php'); ?>
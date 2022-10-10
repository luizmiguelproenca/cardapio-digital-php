<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();

include('inc/header.php');
?>
<title>Demo</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<?php include('inc/container.php'); ?>
<div class="content">
	<div class="container-fluid">

		<div class='row'>
			<?php include('top_menu.php'); ?>
		</div>
		<?php
		$cont = 0;
		$orderTotal = 0;
		foreach ($_SESSION["cart"] as $keys => $values) {
			$itens[] = $values['item_name'];
			$precos[] = $values['item_price'];
			$qtd[] = $values['item_quantity'];
			$total = ($values["item_quantity"] * $values["item_price"]);
			$orderTotal = $orderTotal + $total;
			$cont++;
		}


		?>
		<div class='row'>
			<?php
			$randNumber1 = rand(100000, 999999);
			$orderNumber = $randNumber1;
			include('form.php');
			?>
		</div>
	</div>

	<?php include('inc/footer.php'); ?>
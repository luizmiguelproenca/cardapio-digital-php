<?php
include_once 'config/Database.php';
include_once 'class/Produto.php';

$database = new Database();
$db = $database->getConexao();
$food = new Produto($db);

include('inc/header.php');
?>

<title>Projeto</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<?php include('inc/container.php'); ?>

<div class="content">
	<div class="container-fluid">
		<div class='row'>
			<?php include('top_menu.php'); ?>
		</div>
		<div class='row'>
			<?php
			$result = $food->itemsList();
			$count = 0;
			while ($item = $result->fetch_assoc()) {
				if ($count == 0) {
					echo "<div class='row'>";
				}
			?>
				<div class="col-md-3">
					<form method="post" action="cart.php?action=add&id=<?php echo $item["id"]; ?>">
						<div class="mypanel" align="center" ;>
							<img src="images/<?php echo $item["images"]; ?>" class="img-responsive">
							<h4 class="text-dark"><?php echo $item["name"]; ?></h4>
							<h5 class="text-info"><?php echo $item["description"]; ?></h5>
							<h5 class="text-success"><strong>R$ <?php echo $item["price"]; ?></strong></h5>
							<h5 class="text-info">Qtd.: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
							<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
							<input type="hidden" name="item_price" value="<?php echo $item["price"]; ?>">
							<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
							<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add ao carrinho">
						</div>
					</form>
				</div>

			<?php
				$count++;
				if ($count == 4) {
					echo "</div>";
					$count = 0;
				}
			}
			?>
		</div>

	</div>

	<?php include('inc/footer.php'); ?>
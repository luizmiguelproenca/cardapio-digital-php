<?php
include_once 'config/Database.php';
include_once 'class/Produto.php';
include_once 'class/Categoria.php';

$database = new Database();
$db = $database->getConexao();
$food = new Produto($db);
$categoria = new Categoria($db);

include('inc/header.php');
?>

<title>Projeto</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<?php include('inc/container.php'); ?>


<div class="p-3">
	<h4>Categorias</h4>
	<ol class="list-unstyled">
		<?php
		$result = $categoria->categoriasList(); ?>
		<li><a href='index.php'>Todas</a></li>
		<?php
		while ($item = $result->fetch_assoc()) : ?>
			<li><a href='index.php?categoria=<?php echo $item['id'] ?>'><?php echo $item['nome']; ?></a></li>
		<?php endwhile; ?>
	</ol>
	<div>

		<form class="box-search" method="GET">
			<input type="search" name="q" class="form-control w-25" placeholder="Pesquisar">
			<button type="submit" name="pesquisar" value="Pesquisar" class="btn btn-primary">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
				</svg>
			</button>
		</form>

		<div class="content">
			<div class="container-fluid">
				<div class='row'>
					<?php include('top_menu.php'); ?>
				</div>
				<div class='row'>
					<?php
					$count = 0;
					if (isset($_GET['q'])) {
						$result = $food->itemsSearch($_GET['q']);
					} else if (isset($_GET['categoria'])) {
						$result = $food->itemsCategorie($_GET['categoria']);
					} else {
						$result = $food->itemsList();
					}

					while ($item = $result->fetch_assoc()) {
						if ($count == 0) {
							echo "<div class='row'>";
						}
					?>
						<div class="col-md-3">
							<form method="post" action="cart.php?action=add&id=<?php echo $item["id"]; ?>">
								<div class="mypanel" align="center" ;>
									<img src="images/<?php echo $item["images"]; ?>" alt="" class="img-responsive">
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
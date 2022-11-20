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
<title>Cardápio Digital</title>
<?php include('inc/container.php'); ?>


<div class="">
	<h1>Categorias</h1>
	<ol class="">
		<?php
		$result = $categoria->categoriasList(); ?>
		<li><a href='index.php'>Todas</a></li>
		<?php
		while ($item = $result->fetch_assoc()) : ?>
			<li><a href='index.php?categoria=<?php echo $item['id'] ?>'><?php echo $item['nome']; ?></a></li>
		<?php endwhile; ?>
	</ol>
	<div>
		<!-- Buscar  -->
		<form class="form-control" method="GET">
			<div class="input-group">

				<input type="text" name="q" class="" placeholder="Pesquisar" class="input input-bordered" />
				<button name="pesquisar" value="Pesquisar" class="btn btn-square">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
					</svg>
				</button>

			</div>
		</form>

		<!-- top-menu - cardapio/carrinho -->
		<div class=''>
			<?php include('top_menu.php'); ?>
		</div>

		<!-- conteúdo -->
		<div class="flex justify-center items-center min-h-screen">
			<div class="">
				<div class=''>
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
							echo "<div class='flex flex-row gap-10'>";
						}
					?>
						<!-- card -->
						<div class="" style="margin-top: 50px;">
							<form method="post" action="cart.php?action=add&id=<?php echo $item["id"]; ?>">

								<div class="card card-compact w-96 bg-base-100 shadow-xl">
									<figure>
										<img src="images/<?php echo $item["images"]; ?>" alt="" class="card-img-top">
									</figure>
									<div class="card-body">

										<h2 class="card-title"><?php echo $item["name"]; ?></h2>
										<p><?php echo $item["description"]; ?></p>
										<h2 class=""><strong>R$ <?php echo $item["price"]; ?></strong></h2>


										<input type="hidden" name="item_name" value="<?php echo $item["name"]; ?>">
										<input type="hidden" name="item_price" value="<?php echo $item["price"]; ?>">
										<input type="hidden" name="item_id" value="<?php echo $item["id"]; ?>">
										<h2 class="input-number">Qtd.: <input type="number" min="1" max="25" name="quantity" class="" value="1"></h2>
										<div class="card-actions justify-end">
											<button name="add" value="Add ao carrinho" class="btn btn-accent">Add ao carrinho</button>
										</div>

									</div>
								</div>
							</form>
						</div> <!-- fecha o elemento card -->

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
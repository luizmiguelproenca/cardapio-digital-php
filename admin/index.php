<?php
include_once '../config/Database.php';
include_once '../class/Produto.php';
include_once '../class/Categoria.php';
include_once '../class/Admin.php';

$database = new Database();
$db = $database->getConexao();
$categoria = new Categoria($db);
$produto = new Produto($db);
$admin = new Admin($db);

if (!$admin->loggedIn()) {
	header("Location: login.php");
}
include('../inc/header.php');
include('./inc/nav.php'); 
?>



<!-- <h1>LOGADO</h1>
<h2>Aqui irei fazer a página do ADM do cardápio</h2>
<a href="addproduto.php">Adicionar um produto</a>
<br>
<a href="addcategoria.php">Adicionar uma categoria</a>
<br>
<a href="desloga.php">Sair</a> -->

	<div class="container mt-4">
		<?php
		if(isset($_GET['msg'])){
			$msg = $_GET['msg'];
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$msg.'
			<button type="button" class="btn-close" data-bs-dismiss="alert"
			aria-lable="Close"></button></div>';
		}

		?>
		<a href="addproduto.php" class="btn btn-dark mb-3">Adicionar produto</a>

		<table class="table table-hover text-center">
			<thead class="table-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nome</th>
					<th scope="col">Categoria</th>
					<th scope="col">Preço</th>
					<th scope="col">Imagem</th>
					<th scope="col">Descrição</th>
					<th scope="col">Status</th>
					<th scope="col">Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$items = $admin->allProdutos();

					while($item = $items->fetch_assoc()){
						?>
						<tr>
							<td><?php echo $item['id']?></td>
							<td><?php echo $item['name']?></td>
							<td><?php echo $categoria->nomeCategoria($item['id_categoria'])?></td>
							<td><?php echo $item['price']?></td>
							<td><?php echo $item['images']?></td>
							<td><?php echo $item['description']?></td>
							<td><?php echo $item['status']?></td>
							<td>
								<a href="edit.php?id=<?php echo $item['id'] ?>" class="link-dark"><i class="bi bi-pencil-fill me-3"></i></a>
								<a href="delete.php?id=<?php echo $item['id'] ?>" class="link-dark"><i class="bi bi-trash-fill fs-5"></i></a>
							</td>
						</tr>
						<?php
					}
				?>

			</tbody>
		</table>
	</div>
	

</body>

</html>
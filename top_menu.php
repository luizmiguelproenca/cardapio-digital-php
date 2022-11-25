<?php
if (true) {
  ?>
   <ul class="nav nav-tabs justify-content-end mt-3 mb-3">
	<li class="nav-item" >
		<a href="index.php" class="nav-link <?php if(mb_strpos($_SERVER["SCRIPT_NAME"], 'index.php') != false) echo "active"?>" aria-current="page">
			<i class="bi bi-postcard-fill"></i> Cardápio </a>
	</li>
	<li>
		<a href="cart.php" class="nav-link <?php if( mb_strpos($_SERVER["SCRIPT_NAME"], 'cart.php') != false) echo "active"?>" aria-current="page">
			<i class="bi bi-cart-fill"></i> Carrinho  (<?php
	  if(isset($_SESSION["cart"])){
	  $count = count($_SESSION["cart"]); 
	  echo "$count"; 
		}
	  else
		echo "0";
	  ?>) </a></li>
  </ul>
<?php        
}
?>
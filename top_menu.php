<?php
if (true) {
  ?>
   <ul class="nav navbar-nav navbar-right">
	<li class="active" ><a href="index.php"><span class="glyphicon glyphicon-cutlery"></span> Cardápio </a></li>
	<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Carrinho  (<?php
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
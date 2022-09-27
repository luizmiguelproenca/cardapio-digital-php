var texto = encodeURIComponent(`
	*NOVO PEDIDO* 
	-----------------------------
	*RESUMO DO PEDIDO*
	Pedido #<?php echo $_GET['order']; ?>
`)


var url = "https://wa.me/5511950428309?text=" + texto;

function openInNewTab(url) {
	var win = window.open(url, '_blank');
	win.focus();
}

openInNewTab(url);

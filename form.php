<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();
?>

<div class="col-md-6">
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
        <div class="row">
            <h3>Dados para entrega</h3>
            <label>
                <legend>cep</legend>
                <input type="text" name="nome-do-input" placeholder="cep" id="cep" value="" required="true" />
                <button type="button" onclick="consultaCep()">Consultar</button>
            </label>
            <br>
            <label>
                <legend>rua</legend>
                <input type="text" name="rua" placeholder="rua" id="logradouro" value="" required="true" />
            </label>
            <label>
                <legend>bairro</legend>
                <input type="text" name="bairro" placeholder="bairro" id="bairro" value="" required="true" />
            </label>
            <label>
                <legend>numero</legend>
                <input type="text" name="numero" placeholder="numero" id="id-do-input" required="true" required="true" />
            </label>
            <label>
                <legend>complemento</legend>
                <input type="text" name="complemento" placeholder="complemento" id="id-do-input" value="" />
            </label>
            <label>
                <legend>cidade</legend>
                <input type="text" name="cidade" placeholder="cidade" id="localidade" value="" required="true" />
            </label>
            <label>
                <legend>uf</legend>
                <input type="text" name="uf" placeholder="estado" id="uf" value="" required="true" />
            </label>
            <label>
                <legend>nome</legend>
                <input type="text" name="nome" placeholder="Nome" id="nome" value="" required="true" />
            </label>
            <label>
                <legend>celular</legend>
                <input type="text" name="celular" placeholder="Whatsapp" id="uf" value="" required="true" />
            </label>
            <h3>Forma de pagamento</h3>
            <select name="forma_pagamento" id="forma_pagamento" required onchange="verifica(this.value)">
                <option value="">Selecione</option>
                <option value="3">Dinheiro</option>
                <option value="2">Cartão</option>
                <option value="1">Pix</option>
            </select>
            <label>
                <label for=""> Troco para:</label>
                <input type="text" name="troco" placeholder="R$" id="troco" value="" disabled />
            </label>
            <div class="">
                <h3>Detalhes do pedido</h3>
                <p id="Itens"><strong>Itens</strong>: <?php for ($i = 0; $i < $cont; $i++) echo "<br> " . $qtd[$i] . " " . $itens[$i] . " - R$ " . $precos[$i] * $qtd[$i] ?></p>
                <p id="Total-Itens"><strong>Total Itens</strong>: R$ <?php echo $orderTotal; ?></p>
                <p id="Taxa"><strong>Taxa de entrega</strong>: R$ 0</p>
                <p id="TotalPedido"><strong>Total pedido</strong>: R$ <?php echo $orderTotal; ?></p>
                <input name="obs" type="text" name="obs" placeholder="Observação" id="obs">
                <p><button id="btn" form="dados" type="submit" name="enviar" class="btn btn-warning">Confirmar Pedido</button></a></p>
            </div>
        </div>
    </form>

    <script src="./api/consultaCep.js"></script>
    <script>
        function verifica(value) {
            var input = document.getElementById("troco");

            if (value == 3) {
                input.disabled = false;
            } else {
                input.disabled = true;
            }
        };
    </script>
</div>
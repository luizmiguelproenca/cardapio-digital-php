<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();
?>

<div class="col">
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
        <h4>Dados para entrega</h4>
        <div style="display: flex;">
            <div>

                <div class="input-group input-group mb-3" style="display: flex; margin-top: 15px">
                    <input class="form-control w-80" type="text" name="nome-do-input" placeholder="CEP" id="cep" value="" required="true" />
                    <button class="btn btn-secondary" type="button" onclick="consultaCep()">Consultar</button>

                </div>

                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Rua</span>
                    <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" type="text" name="rua" placeholder="Rua" id="logradouro" value="" required="true" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Bairro</span>
                    <input class="form-control w-80" type="text" name="bairro" placeholder="Bairro" id="bairro" value="" required="true" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Número</span>
                    <input class="form-control w-80" type="text" name="numero" placeholder="Número" id="id-do-input" required="true" required="true" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Complemento</span>
                    <input class="form-control w-80" type="text" name="complemento" placeholder="Complemento" id="id-do-input" value="" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Cidade</span>
                    <input class="form-control w-80" type="text" name="cidade" placeholder="Cidade" id="localidade" value="" required="true" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">UF</span>
                    <input class="form-control w-80" type="text" name="uf" placeholder="Estado" id="uf" value="" required="true" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                    <input class="form-control w-80" type="text" name="nome" placeholder="Nome" id="nome" value="" required="true" />
                </div>
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Celular</span>
                    <input class="form-control w-80" type="text" name="celular" placeholder="Whatsapp" id="uf" value="" required="true" />
                </div>
            </div>


            <div style="margin-left: 80px;">
                <h4>Forma de pagamento</h4>
                <div>
                <select class="form-select w-80" name="forma_pagamento" id="forma_pagamento" required onchange="verifica(this.value)">
                    <option value="">Selecione</option>
                    <option value="3">Dinheiro</option>
                    <option value="2">Cartão</option>
                    <option value="1">Pix</option>
                </select>
                <div class="mt-3">
                    <label for=""> Troco para:</label>
                    <input type="text" name="troco" placeholder="R$" id="troco" value="" disabled />
                </div>
                </div>
                <h4 class="mt-3" >Detalhes do pedido</h4>
                <p class="mb-1" id="Itens"><strong>Itens</strong>: <?php for ($i = 0; $i < $cont; $i++) echo " " . $qtd[$i] . " " . $itens[$i] . " - R$ " . $precos[$i] * $qtd[$i] ?></p>
                <p class="mb-1" id="Total-Itens"><strong>Total Itens</strong>: R$ <?php echo $orderTotal; ?></p>
                <p class="mb-1" id="Taxa"><strong>Taxa de entrega</strong>: R$ 3</p>
                <p class="mb-1" id="TotalPedido"><strong>Total pedido</strong>: R$ <?php echo $orderTotal + 3; ?></p>
                <input class="input-group input-group mt-3" name="obs" type="text" name="obs" placeholder="Observação" id="obs">
                <p><button id="btn" form="dados" type="submit" name="enviar" class="btn btn-outline-success mt-3">Confirmar Pedido</button></a></p>
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
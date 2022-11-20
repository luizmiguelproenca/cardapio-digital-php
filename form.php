<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();
?>

<div class="col-md-6" style="margin-left: 50px;">
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
        <div class="row">
            <h3>Dados para Entrega</h3>

            <div style="display: flex;" class="form">
                <div class="form-content">
                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="nome-do-input" placeholder=" Digite seu CEP Aqui" id="cep" value="" required="true" />
                            <button class="btn btn-outline btn-info" type="button" onclick="consultaCep()">Consultar</button>
                        </label>

                    </div>
                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="rua" placeholder=" Logradouro" id="logradouro" value="" required="true" />
                        </label>
                    </div>
                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="bairro" placeholder=" Bairro" id="bairro" value="" required="true" />
                        </label>
                    </div>

                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="numero" placeholder=" Número da casa" id="id-do-input" required="true" required="true" />
                        </label>
                    </div>

                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="complemento" placeholder=" Complemento" id="id-do-input" value="" />
                        </label>
                    </div>

                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="cidade" placeholder=" Cidade" id="localidade" value="" required="true" />
                        </label>
                    </div>

                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="uf" placeholder=" Estado" id="uf" value="" required="true" />
                        </label>
                    </div>

                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="nome" placeholder=" Nome" id="nome" value="" required="true" />
                        </label>
                    </div>

                    <div class="form-control" style="margin-top: 10px;">
                        <label class="input-group input-group-sm">
                            <span></span>
                            <input class="input input-bordered w-full max-w-xs" type="text" name="celular" placeholder=" Whatsapp" id="uf" value="" required="true" />
                        </label>
                    </div>
                </div>
                <div style="margin-left: 50px;" class="teste">
                    <h3 style="margin-top: 10px;">Forma de Pagamento</h3>
                    <select style="margin-top: 10px;" class="select select-bordered" name="forma_pagamento" id="forma_pagamento" required onchange="verifica(this.value)">
                        <option value="">Selecione</option>
                        <option value="3">Dinheiro</option>
                        <option value="2">Cartão</option>
                        <option value="1">Pix</option>
                    </select>
                    <label>
                        <label for=""> Troco para:</label>
                        <input class="input input-bordered w-full max-w-xs" type="text" name="troco" placeholder="R$" id="troco" value="" disabled />
                    </label>
                    <div class="">
                        <h3 style="margin-top: 10px;">Detalhes do pedido</h3>
                        <p id="Itens"><strong>Itens</strong>: <?php for ($i = 0; $i < $cont; $i++) echo "<br> " . $qtd[$i] . " " . $itens[$i] . " - R$ " . $precos[$i] * $qtd[$i] ?></p>
                        <p id="Total-Itens"><strong>Total Itens</strong>: R$ <?php echo $orderTotal; ?></p>
                        <p id="Taxa"><strong>Taxa de entrega</strong>: R$ 0</p>
                        <p id="TotalPedido"><strong>Total pedido</strong>: R$ <?php echo $orderTotal; ?></p>
                        <input style="margin: 10px 0px;" class="input input-bordered w-full max-w-xs" name="obs" type="text" name="obs" placeholder="Observação" id="obs">
                        <p><button id="btn" form="dados" type="submit" name="enviar" class="btn btn-outline btn-success">Confirmar Pedido</button></a></p>
                    </div>
                </div>
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
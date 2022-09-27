<?php
include_once 'config/Database.php';

$database = new Database();
$db = $database->getConexao();
?>

<div class="col-md-6">
    <h3>Dados para entrega</h3>
    <form id="dados" action="process_order.php?order=<?php echo $orderNumber; ?>" method="post">
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
    </form>
    <script src="./api/consultaCep.js"></script>
</div>
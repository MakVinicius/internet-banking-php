<?php
    $numeroAgencia = buscarAgencia($conexao);
?>

<form action="index.php" method="post" class="cadastroAgencia">
    <fieldset class="campoCriarAgencia">
        <legend class="legendaCriarAgencia">Transferência entre contas:</legend>

        <div>
            <label for="numero-agencia">Número Agência Origem</label>
            <input type="text" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" disabled />
            <input type="hidden" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" />
        </div>

        <div>
            <label for="numero-conta-origem">Número da Conta Origem</label>
            <input type="number" name="numero-conta-origem" required />         
        </div>

        <div>
            <label for="valor_transferencia">Valor da Transferencia</label>
            <input type="number" name="valor_transferencia" required />
        </div>

        <div>
            <label for="numero-agencia">Número Agência Destino</label>
            <input type="text" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" disabled />
            <input type="hidden" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" />
        </div>

        <div>
            <label for="numero-conta-destino">Número da Conta Destino</label>
            <input type="number" name="numero-conta-destino" required />         
        </div>

        <button type="submit">Enviar</button>

        <input type="hidden" name="escolha" value="transferencia" />
    </fieldset>
</form>
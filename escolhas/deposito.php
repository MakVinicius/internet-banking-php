<?php
    $numeroAgencia = buscarAgencia($conexao);
?>

<form action="index.php" method="post" class="cadastroAgencia">
    <fieldset class="campoCriarAgencia">
        <legend class="legendaCriarAgencia">Realizar Depósito</legend>

        <div>
            <label for="numero-agencia">Número Agência</label>
            <input type="text" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" disabled />
            <input type="hidden" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" />
        </div>

        <div>
            <label for="numero-conta">Número Conta Destino</label>
            <input type="number" name="numero-conta" required />        
        </div>

        <div>
            <label for="valor_deposito">Valor do Depósito</label>
            <input type="number" name="valor_deposito" required />
        </div>

        <button type="submit">Enviar</button>

        <input type="hidden" name="escolha" value="deposito" />
    </fieldset>
</form>
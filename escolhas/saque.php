<?php
    // $directory = dirname(__DIR__);
    // include($directory . '\banco.php');

    $numeroAgencia = buscarAgencia($conexao);
?>

<form action="index.php" method="post">
    <fieldset>
        <legend>Realizar Saque</legend>

        <div>
            <label for="numero-agencia">Número Agência</label>
            <input type="text" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" disabled />
            <input type="hidden" name="numero-agencia" value="<?php echo $numeroAgencia[1]['numero_agencia']; ?>" />
        </div>

        <div>
            <label for="numero-conta">Número da Conta</label>
            <input type="number" name="numero-conta" required />         
        </div>

        <div>
            <label for="valor_saque">Valor do Saque</label>
            <input type="number" name="valor_saque" required />
        </div>

        <button type="submit">Enviar</button>

        <input type="hidden" name="escolha" value="saque" />
    </fieldset>
</form>
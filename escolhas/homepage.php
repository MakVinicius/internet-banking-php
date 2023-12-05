<?php        

    
?>

<form action="index.php" method="get" class="form-options">
    <fieldset class="corpoOpcoes">
        <legend class="legendaOpcoes">Escolha a Operação Desejada</legend>
        
        <div class="radio-group">
            <label class="radio">
                <input type="radio" name="escolha" value="criarConta">
                <span>Criar Conta Corrente</span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="deposito">
                <span>Realizar Depósitos </span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="saque">
                <span>Realizar Saques </span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="transferencia">
                <span>Transferir Dinheiro Entre Contas</span>
            </label>
        </div>

        <button type="submit">Enviar</button>
    </fieldset>
</form>

<form action="index.php" method="get" class="form_pesquisar">
    <fieldset class="corpoPesquisar">
        <label for="nomeCompleto">Nome: </label>
        <input type="text" name="nomeCompleto">

        <label for="cpf">CPF: </label>
        <input type="number" name="cpf">

        <input type="hidden" name="escolha" value="pesquisar">
        <button type="submit">Pesquisar</button>
    </fieldset>
</form>

<?php include('tabela.php'); ?>
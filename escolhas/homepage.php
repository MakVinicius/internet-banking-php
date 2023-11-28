<form action="index.php" method="get" class="form-options">
    <fieldset>
        <legend>Escolha a Operação Desejada</legend>
        <div class="radio-group">
            <label class="radio">
                <input type="radio" name="escolha" value="criarConta">
                <span>Criar Conta Corrente</span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="deposito">
                <span>Realizar Depósitos ou Saques</span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="transferencia">
                <span>Transferir Dinheiro Entre Contas</span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="listarContas">
                <span>Listar Todas as Contas</span>
            </label>
            <label class="radio">
                <input type="radio" name="escolha" value="pesquisar">
                <span>Pesquisar</span>
            </label>
        </div>

        <?php if ($exibir_tabela) : ?>
            <?php include('tabela.php'); ?>
        <?php endif; ?>

        <button type="submit">Enviar</button>
    </fieldset>
</form>
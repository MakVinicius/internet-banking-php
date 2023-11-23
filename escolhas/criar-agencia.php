<form action="index.php" method="post">
    <fieldset>
        <legend>Cadastro de Agências</legend>

        <div>
            <label for="nome-banco">Nome do banco</label>
            <input type="text" name="nome-banco" required />
        </div>

        <div>
            <label for="numero-banco">Número do banco</label>
            <input type="number" name="numero-banco" required />
        </div>

        <div class="endereco">
            <h1>Informações sobre o seu endereço</h1>

            <div>
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" required />
            </div>

            <div>
                <label for="estado">Estado</label>
                <input type="text" name="estado" required />
            </div>

            <div>
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" required />
            </div>

            <div>
                <label for="logradouro">Logradouro</label>
                <input type="text" name="logradouro" required />
            </div>

            <div>
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" required />
            </div>
        </div>

        <button type="submit">Enviar</button>

        <input type="hidden" name="escolha" value="criarAgencia" />
    </fieldset>
</form>
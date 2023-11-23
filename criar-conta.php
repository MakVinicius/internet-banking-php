<form action="index.php" method="post">
    <fieldset>
        <legend>Abertura de conta corrente</legend>

        <div>
            <label for="nome-completo">Nome Completo do Titular</label>
            <input type="text" name="nome-completo" required />
        </div>

        <div>
            <label for="cpf">CPF do titular (Apenas números)</label>
            <input type="number" name="cpf" required />
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
    </fieldset>
</form>
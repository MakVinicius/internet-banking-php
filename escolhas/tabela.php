<table>
    <tr>
        <th>Número da Conta</th>
        <th>Nome Completo</th>
        <th>CPF</th>
        <th>Saldo</th>
        <th>Cidade</th>
        <th>Excluir</th>
    </tr>
    <?php foreach ($lista_contas as $conta) : ?>
        <tr>
            <td>
                <?php echo $conta['numero_conta']; ?>
            </td>
            <td>
                <?php echo $conta['nome_completo']; ?>
            </td>
            <td>
                <?php echo $conta['cpf']; ?>
            </td>          
            <td>
                <?php echo $conta['saldo']; ?>
            </td>
            <td>
                <?php echo $conta['cidade']; ?>
            </td>
            <td>
                <a href="index.php?numeroConta=<?php echo $conta['numero_conta'] ?>&escolha=deletar">Excluir conta</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

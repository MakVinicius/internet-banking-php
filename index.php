<?php
    include('banco.php');

    $escolha = "";
    $operacao = "";

    if (isset($_GET['escolha'])) {
        $escolha = $_GET['escolha'];
        $operacao = $escolha;
    } else if (isset($_POST['escolha'])) {
        $escolha = $_POST['escolha'];
        $operacao = $escolha;
    }

    if ($escolha == 'criarAgencia' && isset($_POST['nome-banco'])) {
        $cadastroAgencia = array(
            'numeroBanco' => $_POST['numero-banco'],
            'nomeBanco' => $_POST['nome-banco'],
            'cidade' => $_POST['cidade'],
            'estado' => $_POST['estado'],
            'bairro' => $_POST['bairro'],
            'logradouro' => $_POST['logradouro'],
            'complemento' => $_POST['complemento']
        );

        criarAgencia($cadastroAgencia, $conexao);
        $escolha = "";
    }

    if ($escolha == 'criarConta' && isset($_POST['cpf'])) {
        $cadastroConta = array(
            'numeroAgencia' => $_POST['numero-agencia'],
            'nomeCompleto' => $_POST['nome-completo'],
            'cpf' => $_POST['cpf'],
            'saldo' => 0.00,
            'cidade' => $_POST['cidade'],
            'estado' => $_POST['estado'],
            'bairro' => $_POST['bairro'],
            'logradouro' => $_POST['logradouro'],
            'complemento' => $_POST['complemento']
        );

        criarConta($cadastroConta, $conexao);
        $escolha = "";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Bancos</title>
    <link rel="stylesheet" href="styles1.css" type="text/css" />
</head>
<body>
    <h1>Bem Vindo ao Gerenciador de Bancos</h1>

    <?php
        if($escolha == "criarAgencia") {
            include('escolhas/criar-agencia.php');
        } else if($escolha == "criarConta") {
            include('escolhas/criar-conta.php');
        } else if($escolha == "deposito") {
            include('escolhas/deposito.php');
        } else if($escolha == "transferencia") {
            include('escolhas/transferencia.php');
        } else if($escolha == "listarContas") {
            include('escolhas/listar-contas.php');
        } else if($escolha == "pesquisar") {
            include('escolhas/pesquisar.php');
        } else {
            $homepage = '
            <h3>Escolha uma das opções abaixo para utilizar o sistema</h3>

            <form action="index.php" method="get">
                <fieldset>
                    <label for="escolha">Escolha a Operação Desejada</label>
                    <input type="radio" name="escolha" value="criarAgencia" >Criar Agência</input>
                    <input type="radio" name="escolha" value="criarConta" >Criar Conta Corrente</input>
                    <input type="radio" name="escolha" value="deposito" >Realizar Depósitos ou Saques</input>
                    <input type="radio" name="escolha" value="transferencia" >Transferir Dinheiro Entre Contas</input>
                    <input type="radio" name="escolha" value="listarContas" >Listar Todas as Contas</input>
                    <input type="radio" name="escolha" value="pesquisar" >Pesquisar</input>

                    <button type="submit">Enviar</button>
                </fieldset>
            </form>
            ';

            echo $homepage;
        }
    ?>
</body>
</html>

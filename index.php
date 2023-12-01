<?php
    include('banco.php');

    $escolha = "";
    $exibir_tabela = true;

    $agencia = buscarAgencia($conexao);
    if (!isset($agencia[1])) {
        $escolha = "criarAgencia";
    }

    if (isset($_GET['escolha'])) {
        $escolha = $_GET['escolha'];
    } else if (isset($_POST['escolha'])) {
        $escolha = $_POST['escolha'];
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
        $escolha = ""; // precisa zerar a escolha para entrar na opção correta que é o else
        $cadastroConta = array(); // precisa zerar o array para não enviar a mesma informação do cadastro anterior
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Bancos</title>
    <link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<body>
    <?php
        if($escolha == "criarAgencia") {
            include('escolhas/criar-agencia.php');
        } else if($escolha == "criarConta") {
            include('escolhas/criar-conta.php');
        } else if($escolha == "deposito") {
            include('escolhas/deposito.php');
        } else if($escolha == "transferencia") {
            include('escolhas/transferencia.php');
        } else if($escolha == "pesquisar") {
            include('escolhas/pesquisar.php');
        } else {
            include('escolhas/homepage.php');
        }
        $lista_contas = todasContas($conexao);
        $contas = array(
            'numero_conta' => '',
            'nome_completo' => '',
            'cpf' => '',
            'saldo' => '',
            'estado' => ''
        );
    ?>
</body>
</html>

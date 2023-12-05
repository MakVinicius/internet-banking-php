<?php
    include('banco.php');

    $escolha = "";
    $mensagem = "";

    $agencia = buscarAgencia($conexao);
    if (!isset($agencia[1])) {
        $escolha = "criarAgencia";
    }

    if (isset($_GET['escolha'])) {
        $escolha = $_GET['escolha'];
    } else if (isset($_POST['escolha'])) {
        $escolha = $_POST['escolha'];
    }

    $lista_contas = array();
    if ($escolha == 'pesquisar' && $_GET['nomeCompleto'] != null) {
        $lista_contas = pesquisarPeloNome($_GET['nomeCompleto'], $conexao);
    } else if ($escolha == 'pesquisar' && $_GET['cpf'] != null) {
        $lista_contas = pesquisarPeloCPF($_GET['cpf'], $conexao);
    } else {
        $lista_contas = todasContas($conexao);
        // $contas = array(
        //     'numero_conta' => '',
        //     'nome_completo' => '',
        //     'cpf' => '',
        //     'saldo' => '',
        //     'estado' => ''
        // );
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

        //header('Location: index.php');
        // die();
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

        $lista_contas = todasContas($conexao);

        //header('Location: index.php');
        // die();
    }

    if ($escolha == "deposito" && isset($_POST['numero-conta']) && isset($_POST['valor_deposito'])) {
        
        $numeroConta = $_POST['numero-conta'];
        $valorDeposito = $_POST['valor_deposito'];

        $mensagem = deposito($numeroConta, $valorDeposito, $conexao);
        $escolha = ""; // precisa zerar a escolha para entrar na opção correta que é o else
        $valorDeposito = array(); // precisa zerar o array para não enviar a mesma informação do cadastro anterior

        $lista_contas = todasContas($conexao);
        
        // if ($valorDeposito > 0) {
        //     header('Location: index.php');
        //     die();
        // }
        //header('Location: index.php');
    }

    if ($escolha == "saque" && isset($_POST['numero-conta']) && isset($_POST['valor_saque'])) {
    
        $numeroConta = $_POST['numero-conta'];
        $valorSaque = $_POST['valor_saque'];

        $mensagem = saque($numeroConta, $valorSaque, $conexao);
        $escolha = ""; // precisa zerar a escolha para entrar na opção correta que é o else
        $valorSaque = array(); // precisa zerar o array para não enviar a mesma informação do cadastro anterior

        $lista_contas = todasContas($conexao);

        //header('Location: index.php');
        // die();
    }

    if ($escolha == "transferencia" && isset($_POST['numero-conta-origem']) && isset($_POST['numero-conta-destino']) && isset($_POST['valor_transferencia'])) {
        // Verifica se o formulário para transferência foi submetido
    
        $contaOrigem = $_POST['numero-conta-origem'];
        $contaDestino = $_POST['numero-conta-destino'];
        $valorTransferencia = $_POST['valor_transferencia'];
    
        $mensagem = transferencia($contaOrigem, $contaDestino, $valorTransferencia, $conexao);
        $escolha = ""; // Precisa zerar a escolha para entrar na opção correta que é o else
        $valorTransferencia = array(); // Precisa zerar o array para não enviar a mesma informação do cadastro anterior

        $lista_contas = todasContas($conexao);

        // header('Location: index.php');
        // die();
    }

    if ($escolha == "deletar" && isset($_GET['numeroConta'])) {
        deletarConta($_GET['numeroConta'], $conexao);

        $lista_contas = todasContas($conexao);
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

        include('escolhas/mensagem.php');
        if($escolha == "criarAgencia") {
            include('escolhas/criar-agencia.php');
        } else if($escolha == "criarConta") {
            include('escolhas/criar-conta.php');
        } else if($escolha == "deposito") {
            include('escolhas/deposito.php');
        } else if($escolha == "saque") {
            include('escolhas/saque.php');
        } else if($escolha == "transferencia") {
            include('escolhas/transferencia.php');
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

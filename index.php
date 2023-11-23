<?php

    $escolha = "";

    if (isset($_GET['escolha'])) {
        $escolha = $_GET['escolha'];

        
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

    <?php
        if($escolha == "criarAgencia") {
            include('criar-agencia.php');
        } else if($escolha == "criarConta") {
            include('criar-conta.php');
        } else if($escolha == "deposito") {
            include('criar-conta.php');
        } else if($escolha == "transferencia") {
            include('criar-conta.php');
        } else if($escolha == "listarContas") {
            include('criar-conta.php');
        } else if($escolha == "pesquisar") {
            include('criar-conta.php');
        }
    ?>
</body>
</html>
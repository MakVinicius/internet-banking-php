<?php
    $bdServidor = '127.0.0.1';
    $bdUsuario = 'root';
    $bdSenha = '';
    $bdBanco = 'internet-banking';

    $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);
    if (mysqli_connect_errno()) {
        echo "Problemas para conectar no banco. Verifique os dados!";
        die();
    }

    function todasContas($conexao) {
        $sqlBusca = 'SELECT * FROM contas';
        $resultado = mysqli_query($conexao, $sqlBusca);
        $contas = array();
        
        while ($conta = mysqli_fetch_assoc($resultado)) {
            $contas[] = $conta;
        }
        
        return $contas;
    }

    function buscarAgencia($conexao) {
        $sqlBusca = 'SELECT numero_agencia FROM agencias;';
        $resultado = mysqli_query($conexao, $sqlBusca);
        $numeros[] = array();

        while ($numeroAgencia = mysqli_fetch_assoc($resultado)) {
            $numeros[] = $numeroAgencia;
        }

        return $numeros;
    }

    function criarAgencia($cadastroAgencia, $conexao) {
        $sqlCriarAgencia = "
            INSERT INTO agencias
            (numero_banco, nome_banco, cidade, estado, bairro, logradouro, complemento)
            VALUES
            (
                {$cadastroAgencia['numeroBanco']},
                '{$cadastroAgencia['nomeBanco']}',
                '{$cadastroAgencia['cidade']}',
                '{$cadastroAgencia['estado']}',
                '{$cadastroAgencia['bairro']}',
                '{$cadastroAgencia['logradouro']}',
                '{$cadastroAgencia['complemento']}'
            )
        ";

        mysqli_query($conexao, $sqlCriarAgencia);
    }

    function criarConta($cadastroConta, $conexao) {
        $sqlCriarConta = "
            INSERT INTO contas
            (numero_agencia, nome_completo, cpf, saldo, cidade, estado, bairro, logradouro, complemento)
            VALUES
            (
                {$cadastroConta['numeroAgencia']},
                '{$cadastroConta['nomeCompleto']}',
                {$cadastroConta['cpf']},
                {$cadastroConta['saldo']},
                '{$cadastroConta['cidade']}',
                '{$cadastroConta['estado']}',
                '{$cadastroConta['bairro']}',
                '{$cadastroConta['logradouro']}',
                '{$cadastroConta['complemento']}'
            )
        ";

        mysqli_query($conexao, $sqlCriarConta);
    }
?>
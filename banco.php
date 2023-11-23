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
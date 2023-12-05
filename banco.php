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

    function buscarAgencia($conexao) {
        $sqlBusca = 'SELECT numero_agencia FROM agencias;';
        $resultado = mysqli_query($conexao, $sqlBusca);
        $numeros[] = array();

        while ($numeroAgencia = mysqli_fetch_assoc($resultado)) {
            $numeros[] = $numeroAgencia;
        }

        return $numeros;
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

    function contaExiste($numeroConta, $conexao) {
        $sqlVerificaConta = "SELECT COUNT(*) AS total FROM contas WHERE numero_conta = $numeroConta";
        $resultado = mysqli_query($conexao, $sqlVerificaConta);
        $dadosConta = mysqli_fetch_assoc($resultado);
    
        return $dadosConta['total'] > 0; // Retorna verdadeiro se a conta existir
    }

    function deposito($numeroConta, $valorDeposito, $conexao) {

        $mensagem = "";

        if (!contaExiste($numeroConta, $conexao)) {
            echo "A conta informada não existe. Por favor, verifique o número da conta para realizar o depósito.";
            return;
        }

        $sqlVerificaSaldo = "SELECT saldo FROM contas WHERE numero_conta = $numeroConta";
        $resultado[0]['saldo'] = mysqli_query($conexao, $sqlVerificaSaldo);
    
        if ($resultado) {
            $dadosConta = mysqli_fetch_assoc($resultado[0]['saldo']);
            $saldoAtual = $dadosConta['saldo'];
    
            if ($valorDeposito > 0) {
                $saldoAtual += $valorDeposito; // Adiciona o valor do depósito ao saldo atual
                $sqlAtualizaSaldo = "UPDATE contas SET saldo = $saldoAtual WHERE numero_conta = $numeroConta";
                $resultadoAtualizado = mysqli_query($conexao, $sqlAtualizaSaldo);
    
                if ($resultadoAtualizado ) {
                    $mensagem = "Depósito de R$ $valorDeposito realizado com sucesso.";
                } else {
                    $mensagem = "Erro ao atualizar o saldo após o depósito.";
                }
            } else {
                $mensagem = "Valor do depósito deve ser maior que 0.";
            }
        } else {
            $mensagem = "Erro ao obter informações da conta.";
        }

        return $mensagem;
    }

    function saque($numeroConta, $valorSaque, $conexao) {

        $mensagem = '';

        if (!contaExiste($numeroConta, $conexao)) {
            echo "A conta informada não existe. Por favor, verifique o número da conta para realizar o saque.";
            return;
        }

        $sqlVerificaSaldo = "SELECT saldo FROM contas WHERE numero_conta = $numeroConta";
        $resultado[0]['saldo'] = mysqli_query($conexao, $sqlVerificaSaldo);
    
        if ($resultado) {
            $dadosConta = mysqli_fetch_assoc($resultado[0]['saldo']);
            $saldoAtual = $dadosConta['saldo'];
    
            if ($saldoAtual >= $valorSaque) {
                $novoSaldo = $saldoAtual - $valorSaque; // Calcula o novo saldo após o saque
                $sqlAtualizaSaldo = "UPDATE contas SET saldo = $novoSaldo WHERE numero_conta = $numeroConta";
                $resultadoAtualizado = mysqli_query($conexao, $sqlAtualizaSaldo);
    
                if ($resultadoAtualizado) {
                    $mensagem = "Saque de R$ $valorSaque realizado com sucesso.";
                } else {
                    $mensagem = "Erro ao atualizar o saldo após o saque.";
                }
            } else {
                $mensagem = "Saldo insuficiente para realizar o saque.";
            }
        } else {
            $mensagem = "Erro ao obter informações da conta.";
        }
        return $mensagem;
    }

    function transferencia($contaOrigem, $contaDestino, $valorTransferencia, $conexao) {
        $mensagem = ''; // Variável para armazenar a mensagem de saída

        if (!contaExiste($contaOrigem, $conexao) || !contaExiste($contaDestino, $conexao)) {
            $mensagem = "Uma das contas informadas não existe. Por favor, verifique os números das contas.";
            return $mensagem; // Retorna a mensagem
        }
    

        $sqlVerificaSaldoOrigem = "SELECT saldo FROM contas WHERE numero_conta = $contaOrigem";
        $resultadoOrigem[0]['saldo'] = mysqli_query($conexao, $sqlVerificaSaldoOrigem);

        $sqlVerificaSaldoDestino = "SELECT saldo FROM contas WHERE numero_conta = $contaDestino";
        $resultadoDestino[0]['saldo'] = mysqli_query($conexao, $sqlVerificaSaldoDestino);
    
        if ($resultadoDestino || $resultadoOrigem ) {
            $dadosContaOrigem = mysqli_fetch_assoc($resultadoOrigem[0]['saldo']);
            $saldoAtualOrigem = $dadosContaOrigem['saldo'];
    
            $dadosContaDestino = mysqli_fetch_assoc($resultadoDestino[0]['saldo']);
            $saldoAtualDestino= $dadosContaDestino['saldo'];

            if ($saldoAtualOrigem >= $valorTransferencia) {
                if($valorTransferencia > 0){
                $novoSaldoOrigem = $saldoAtualOrigem - $valorTransferencia; // Calcula o novo saldo após o saque
                $novoSaldoDestino = $saldoAtualDestino + $valorTransferencia; // Calcula o novo saldo após o saque
                
                $sqlAtualizaSaldoOrigem = "UPDATE contas SET saldo = $novoSaldoOrigem WHERE numero_conta = $contaOrigem";
                $sqlAtualizaSaldoDestino = "UPDATE contas SET saldo = $novoSaldoDestino WHERE numero_conta = $contaDestino";
                $resultadoAtualizadoOrigem = mysqli_query($conexao, $sqlAtualizaSaldoOrigem);
                $resultadoAtualizadoDestino = mysqli_query($conexao, $sqlAtualizaSaldoDestino);
    
                if ($resultadoAtualizadoOrigem && $resultadoAtualizadoDestino) {
                    $mensagem = "Transferência de R$$valorTransferencia realizado com sucesso.";
                } else {
                    $mensagem = "Erro ao atualizar o saldo após a transferência.";
                }
            } else {
                $mensagem = "Valor de transferência precisa ser maior que 0.";
            }
                }else{
                    $mensagem = "Saldo insuficiente para realizar a transferência.";
                }
        } 
        return $mensagem ;
    }

    function pesquisarPeloNome($nomeCompleto, $conexao) {
        $sqlBusca = "SELECT * FROM contas WHERE nome_completo LIKE '%$nomeCompleto%'";
        $resultado = mysqli_query($conexao, $sqlBusca);
        $contas = array();
        
        while ($conta = mysqli_fetch_assoc($resultado)) {
            $contas[] = $conta;
        }
        
        return $contas;
    }

    function pesquisarPeloCPF($cpf, $conexao) {
        $sqlBusca = "SELECT * FROM contas WHERE cpf = $cpf";
        $resultado = mysqli_query($conexao, $sqlBusca);
        $contas = array();
        
        while ($conta = mysqli_fetch_assoc($resultado)) {
            $contas[] = $conta;
        }
        
        return $contas;
    }

    function deletarConta($numeroConta, $conexao) {
        $sqlDeletar = "DELETE FROM contas WHERE numero_conta = $numeroConta";
        mysqli_query($conexao, $sqlDeletar);
    }
?>
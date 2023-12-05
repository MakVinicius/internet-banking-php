CREATE TABLE agencias (
    numero_agencia BIGINT AUTO_INCREMENT PRIMARY KEY,
    numero_banco BIGINT,
    nome_banco VARCHAR(255),
    cidade VARCHAR(100),
    estado VARCHAR(100),
    bairro VARCHAR(100),
    logradouro VARCHAR(255),
    complemento VARCHAR(255)
);

CREATE TABLE contas (
    numero_conta BIGINT AUTO_INCREMENT PRIMARY KEY,
    numero_agencia BIGINT,
    nome_completo VARCHAR(255),
    cpf BIGINT,
    saldo DOUBLE,
    cidade VARCHAR(100),
    estado VARCHAR(100),
    bairro VARCHAR(100),
    logradouro VARCHAR(255),
    complemento VARCHAR(255),
    FOREIGN KEY (numero_agencia) REFERENCES agencias(numero_agencia)
);
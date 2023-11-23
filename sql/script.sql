CREATE TABLE contas (
    numero_conta BIGINT AUTO_INCREMENT PRIMARY KEY,
    numero_banco BIGINT,
    nome_banco VARCHAR(255),
    nome_completo VARCHAR(255),
    saldo DOUBLE,
    cidade VARCHAR(100),
    estado VARCHAR(100),
    bairro VARCHAR(100),
    logradouro VARCHAR(255),
    complemento VARCHAR(255)
);

CREATE TABLE agencias (
    numero_banco BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome_banco VARCHAR(255),
    cidade VARCHAR(100),
    estado VARCHAR(100),
    bairro VARCHAR(100),
    logradouro VARCHAR(255),
    complemento VARCHAR(255)
);

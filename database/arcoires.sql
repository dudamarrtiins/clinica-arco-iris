-- Estrutura do banco de dados da Clínica Arco-Íris.
-- Execute este arquivo dentro do banco arcoires.

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE paciente (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(90),
    cpf VARCHAR(14),
    nasc DATE,
    idade INT,
    convenio VARCHAR(30),
    sexo VARCHAR(30)
);

CREATE TABLE telefone (
    id SERIAL PRIMARY KEY,
    id_paciente INT,
    telefone VARCHAR(13),
    FOREIGN KEY (id_paciente) REFERENCES paciente(id)
);

CREATE TABLE consulta (
    id SERIAL PRIMARY KEY,
    id_paciente INT REFERENCES paciente(id),
    dia DATE,
    hora TIME,
    status VARCHAR(20) DEFAULT 'agendada'
);

CREATE TABLE entrada (
    id SERIAL PRIMARY KEY,
    valor_entrada NUMERIC(15, 2),
    dia DATE
);

CREATE TABLE saida (
    id SERIAL PRIMARY KEY,
    valor_saida NUMERIC,
    dia DATE
);

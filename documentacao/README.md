# Clínica Arco-Íris

Sistema web desenvolvido em PHP com banco de dados PostgreSQL.

## Requisitos

- PostgreSQL instalado e em execução.
- PHP instalado, com as extensões `PDO` e `pdo_pgsql` habilitadas.
- Os arquivos deste repositório.

## 1. Obter os arquivos do projeto
Clone este repositório:
    abra o terminal e execulte:

```bash
# acesse o repositório:
git clone https://github.com/dudamarrtiins/clinica-arco-iris.git

# acesse a pasta do projeto:
cd clinica-arco-ires
```

## 2. Criar o usuário e o banco de dados

- Baixe o XAMP para utilizar como servidor.
- Baixe o Pgadim4

Acesse o Pgadim4 e crie um novo banco de dados e um novo usuario

```sql
CREATE USER root WITH PASSWORD 'arcoires';
CREATE DATABASE arcoires OWNER root;
```

## 3. Criar as tabelas

Na pasta principal do projeto, o arquivo com a estrutura do banco fica em `database/arcoires.sql`. Execute-o no banco `arcoires` usando o terminal:

```bash
psql -U root -d arcoires -f database/arcoires.sql
```

Quando solicitado, informe a senha do usuário `root`. Esse comando cria as tabelas necessárias. 

importar o arquivo dump.sql para o banco:


## 4. Configurar a conexão da aplicação

No arquivo `database/config_local.php`, configure os dados do banco local. O arquivo deve ter este formato:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'arcoires');
define('DB_USER', 'root');
define('DB_PASS', 'arcoires');
?>
```

## 5. Conferir o driver do PostgreSQL no PHP

O PHP precisa ter a extensão `pdo_pgsql` habilitada. Se a aplicação mostrar um erro de driver ou de conexão, confira o arquivo `php.ini` usado pelo PHP e habilite a linha abaixo, removendo o ponto e vírgula inicial, se houver:

```ini
extension=pdo_pgsql
```

Salve o arquivo e reinicie o servidor PHP depois da alteração.

## 6. Iniciar a aplicação

Abra um terminal na pasta principal do projeto e execute:

```bash
php -S localhost:8000
```

## 7. Acessar o sistema

Abra o navegador e acesse:

http://localhost:8000

## Problemas comuns

- **Não foi possível conectar ao banco:** confira se o serviço PostgreSQL está em execução, se o banco se chama `arcoires` e se usuário, senha e porta estão corretos em `database/config_local.php`.

- **`could not find driver`:** habilite `pdo_pgsql` no `php.ini` usado pela aplicação e reinicie o servidor PHP.

- **`psql` não é reconhecido:** use o caminho completo do `psql.exe`.

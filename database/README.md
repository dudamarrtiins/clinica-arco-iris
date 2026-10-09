# Clínica Arco-Íris

Sistema web desenvolvido em PHP com banco de dados PostgreSQL.

## Requisitos

- PostgreSQL instalado e em execução.
- PHP instalado, com as extensões `PDO` e `pdo_pgsql` habilitadas.
- Os arquivos deste projeto.

Você não precisa do Visual Studio Code para executar o sistema. Ele é apenas um editor de código opcional.

## 1. Obter os arquivos do projeto

Se o projeto estiver no GitHub, clone o repositório:

```bash
git clone URL_DO_REPOSITORIO
cd NOME_DA_PASTA
```

Substitua `URL_DO_REPOSITORIO` pelo endereço real do repositório e `NOME_DA_PASTA` pelo nome da pasta criada. Se você já recebeu a pasta do projeto, pode usar essa pasta e pular esta etapa.

## 2. Criar o usuário e o banco de dados

Abra o SQL Shell (`psql`) ou outra ferramenta de administração do PostgreSQL e conecte-se com um usuário administrador, como `postgres`. Execute os comandos abaixo. Se o usuário `root` já existir, não crie novamente: apenas confirme que ele tem acesso ao banco.

```sql
CREATE USER root WITH PASSWORD 'ESCOLHA_UMA_SENHA';
CREATE DATABASE arcoires OWNER root;
```

Troque `ESCOLHA_UMA_SENHA` por uma senha sua. Guarde-a e não a publique no GitHub. Se o banco `arcoires` já existir, não execute o comando `CREATE DATABASE` novamente.

## 3. Criar as tabelas

Na pasta principal do projeto, o arquivo com a estrutura do banco fica em `database/arcoires.sql`. Execute-o no banco `arcoires` usando o terminal:

```bash
psql -U root -d arcoires -f database/arcoires.sql
```

Quando solicitado, informe a senha do usuário `root`. Esse comando cria as tabelas necessárias. Execute o arquivo em um banco vazio, pois ele não foi feito para recriar tabelas que já existem.

Se o comando `psql` não for reconhecido, use o SQL Shell (`psql`) instalado com o PostgreSQL ou informe o caminho completo do executável `psql.exe` no terminal.

## 4. Configurar a conexão da aplicação

No arquivo `database/config_local.php`, configure os dados do banco local. O arquivo deve ter este formato, com a sua própria senha:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'arcoires');
define('DB_USER', 'root');
define('DB_PASS', 'SUA_SENHA');
?>
```

Substitua `SUA_SENHA` pela senha escolhida na etapa 2. Não compartilhe esse arquivo com senhas reais nem publique credenciais no repositório.

A configuração padrão da aplicação utiliza `database/config_local.php`. O arquivo `database/config.php` pode ser mantido para a configuração do ambiente da escola.

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

Se o comando `php` não for reconhecido, execute o servidor usando o caminho completo do `php.exe` instalado no seu computador. Por exemplo, em uma instalação do XAMPP, o executável fica dentro da pasta `php` do XAMPP.

Mantenha o terminal aberto enquanto utiliza a aplicação.

## 7. Acessar o sistema

Abra o navegador e acesse:

http://localhost:8000

## Problemas comuns

- **Não foi possível conectar ao banco:** confira se o serviço PostgreSQL está em execução, se o banco se chama `arcoires` e se usuário, senha e porta estão corretos em `database/config_local.php`.
- **`could not find driver`:** habilite `pdo_pgsql` no `php.ini` usado pela aplicação e reinicie o servidor PHP.
- **`psql` não é reconhecido:** use o SQL Shell (`psql`) ou o caminho completo do `psql.exe`.
- **Tabela já existe:** o arquivo SQL deve ser executado em um banco vazio. Não apague tabelas ou dados existentes sem ter certeza de que não precisa deles.

## Observação

Este arquivo SQL cria a estrutura das tabelas, mas não inclui dados de exemplo nem cria automaticamente uma conta de acesso ao sistema. Caso a aplicação exija um usuário para entrar, cadastre-o pelo próprio sistema ou siga as instruções específicas do projeto.

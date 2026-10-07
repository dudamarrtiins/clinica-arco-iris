<?php
require_once __DIR__ . '/../database/connect.php'; 
// puxa a conexão com o banco

//            CREATE - CADASTRARPACIENTE/ ADICIONAR
function cadastrar($conexao, $nome, $cpf, $nasc, $idade, $convenio, $sexo, $telefone)
{
    require_once __DIR__ . '/../database/connect.php'; // mostra o caminho 

    $sql = "INSERT INTO paciente (nome, cpf, nasc, idade, convenio, sexo) VALUES (:nome, :cpf, :nasc, :idade, :convenio, :sexo)"; // sql coloque tais coisas nas seguintes colunas com as seguintes informações que estão sendo puxadas do forms 

    try { // ta atribuindo os valores para as colunas
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":nasc", $nasc);
        $stmt->bindParam(":idade", $idade);
        $stmt->bindParam(":convenio", $convenio);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->execute();

        $idPaciente = $conexao->lastInsertId(); // puxa o id
        // para pegar o id da tabela paciente que tbm esta na tabela de telefone

        // mesma coisa que o de cima, só que com a tab de tele:
        $sqlTelefone = "INSERT INTO telefone (id_paciente, telefone) VALUES (:id_paciente, :telefone)";

        $stmtTelefone = $conexao->prepare($sqlTelefone);
        $stmtTelefone->bindParam(":id_paciente", $idPaciente);
        $stmtTelefone->bindParam(":telefone", $telefone);
        $stmtTelefone->execute();

        echo "Paciente inserido com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                  SELECT - PRONTUARIO - VER TODOS

function prontuario($conexao)
{
    $sqlPacientes = "SELECT * FROM paciente";

    try {
        $stmt = $conexao->prepare($sqlPacientes);
        $stmt->execute();

        $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($pacientes as $paciente) {
            echo "ID: {$paciente['id']}<br>";
            echo "nome: {$paciente['nome']}<br>";
            echo "cpf: {$paciente['cpf']}<br>";
            echo "nasc: {$paciente['nasc']}<br>";
            echo "idade: {$paciente['idade']}<br>";
            echo "convenio: {$paciente['convenio']}<br>";
            echo "sexo: {$paciente['sexo']}<br>";

            // Busca O TELEFONE DESTE PACIENTE específico
            $sqlTel = "SELECT telefone FROM telefone WHERE id_paciente = :id_paciente";

            $stmtTel = $conexao->prepare($sqlTel);

            $stmtTel->bindParam(":id_paciente", $paciente['id']);

            $stmtTel->execute();

            $sqltel = $stmtTel->fetch(PDO::FETCH_ASSOC);

            if ($sqltel) {
                echo "telefone: {$sqltel['telefone']}<br>";
            } else {
                echo "telefone: Não cadastrado<br>";
            }

            echo "<hr>";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                 DELETE - delete/Apagar

function apagar($conexao, $nome)
{
    try {
        // 1. Busca o ID do paciente pelo nome antes de apagar
        $sqlBusca = "SELECT id FROM paciente WHERE nome = :nome";
        $stmtBusca = $conexao->prepare($sqlBusca);
        $stmtBusca->bindParam(":nome", $nome);
        $stmtBusca->execute();
        
        $paciente = $stmtBusca->fetch(PDO::FETCH_ASSOC);

        if ($paciente) {
            $idPaciente = $paciente['id'];

            // 2. PRIMEIRO apaga os telefones do paciente
            $sqlTelefone = "DELETE FROM telefone WHERE id_paciente = :id_paciente";
            $stmtTelefone = $conexao->prepare($sqlTelefone);
            $stmtTelefone->bindParam(":id_paciente", $idPaciente);
            $stmtTelefone->execute();

            // 3. DEPOIS apaga o paciente
            $sqlPaciente = "DELETE FROM paciente WHERE id = :id";
            $stmtPaciente = $conexao->prepare($sqlPaciente);
            $stmtPaciente->bindParam(":id", $idPaciente);
            $stmtPaciente->execute();

            echo "Usuário $nome removido com sucesso!";
        } else {
            echo "Paciente não encontrado!";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//            ATUALIZAR 

function atualizar($conexao, $id, $nome, $cpf, $nasc, $idade, $convenio, $sexo, $telefone)
{
    require_once __DIR__ . '/../database/connect.php'; // mostra o caminho 

   
    $sql = "UPDATE paciente SET nome = :nome , cpf = :cpf , nasc = :nasc , idade = :idade , convenio = :convenio , sexo = :sexo WHERE id = :id";
    // sql coloque tais coisas nas seguintes colunas com as seguintes informações que estão sendo puxadas do forms 

    try { // ta atribuindo os valores para as colunas
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":nasc", $nasc);
        $stmt->bindParam(":idade", $idade);
        $stmt->bindParam(":convenio", $convenio);
        $stmt->bindParam(":sexo", $sexo);
        

        $stmt->execute();
        // mesma coisa que o de cima, só que com a tab de tele:
        $sqlTelefone = "UPDATE telefone SET telefone = :telefone WHERE id = :id_paciente";

        $stmtTelefone = $conexao->prepare($sqlTelefone);
        $stmtTelefone->bindParam(":id_paciente", $idPaciente);
        $stmtTelefone->bindParam(":telefone", $telefone);
        $stmtTelefone->execute();

        echo "Paciente atualizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                     SELECT W - CONSULTAR - VER UM SO
function consultar($conexao, $nome)
{

    $sql = "SELECT id, nome, cpf, nasc, idade, convenio, sexo FROM paciente WHERE nome = :nome";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->execute();

        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "ID: {$paciente['id']} <br>";
        echo "Nome: {$paciente['nome']}<br>";
        echo "CPF: {$paciente['cpf']}<br>";
        echo "Nascimento: {$paciente['nasc']}<br>";
        echo "Idade: {$paciente['idade']}<br>";
        echo "Convenio: {$paciente['convenio']}<br>";
        echo "Sexo: {$paciente['sexo']}<br>";
      
        $sqlTel = "SELECT telefone FROM telefone WHERE id_paciente = :id_paciente";

            $stmtTel = $conexao->prepare($sqlTel);

            $stmtTel->bindParam(":id_paciente", $paciente['id']);

            $stmtTel->execute();

            $sqltel = $stmtTel->fetch(PDO::FETCH_ASSOC);

            if ($sqltel) {
                echo "telefone: {$sqltel['telefone']}<br>";
            } else {
                echo "telefone: Não cadastrado<br>";
            }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                        ENTRADA DE DINHEIRO - GESTAO

function entrada($conexao, $valor_entrada, $dia)
{
    require_once __DIR__ . '/../database/connect.php'; // mostra o caminho 

    $sql = "INSERT INTO entrada (valor_entrada, dia) VALUES (:entrada, :dia)";  

    try { // ta atribuindo os valores para as colunas
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":entrada", $valor_entrada);
        $stmt->bindParam(":dia", $dia);
        $stmt->execute();
         echo "Registrado Ganho!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                       SAIDA DE DINHEIRO - GESTAO

function saida($conexao, $valor_saida, $dia)
{
    require_once __DIR__ . '/../database/connect.php'; // mostra o caminho 

    $sql = "INSERT INTO saida (valor_saida, dia) VALUES (:saida, :dia)";  

    try { // ta atribuindo os valores para as colunas
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":saida", $valor_saida);
        $stmt->bindParam(":dia", $dia);
        $stmt->execute();
        echo "Registrado Gasto!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}


//                            EXTRATO

function extrato($conexao)
{
    require_once __DIR__ . '/../database/connect.php';

   
    $stmtE = $conexao->prepare("SELECT * FROM entrada");
    $stmtE->execute();
    $entradas = $stmtE->fetchAll(PDO::FETCH_ASSOC);

    
    foreach ($entradas as $e) {
        echo "<br>Valor Ganho: " . $e['valor_entrada'] . "<br>";
        echo "Valor Gasto: 0<br>";
        echo "Data: " . $e['dia'] . "<br><hr>";
    }

    
    $stmtS = $conexao->prepare("SELECT * FROM saida");
    $stmtS->execute();
    $saidas = $stmtS->fetchAll(PDO::FETCH_ASSOC);

    
    foreach ($saidas as $s) {
        echo "Valor Ganho: 0<br>";
        echo "Valor Gasto: " . $s['valor_saida'] . "<br>";
        echo "Data: " . $s['dia'] . "<br><hr>";
    }
}

//            Cadastrar USER
function cadastrar_user($conexao, $email, $senha)
{
    require_once '../database/connect.php';

    $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);

        $stmt->execute();
        echo "Usuário cadastrado com sucesso!!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                   VE SE O USER EXISTE 

function consulta_user($conexao, $email)
{

    $sql = "SELECT id, email, senha FROM usuarios WHERE email = :email";

    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario; // para globalizar ela
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

//                         AGENDAMENTO 
// 1. Marca um novo atendimento (status inicia automaticamente como 'agendada')
function agendarConsulta($conexao, $id_paciente, $dia, $hora)
{
    $sql = "INSERT INTO consultas (id_paciente, dia, hora, status) 
            VALUES (:id_paciente, :dia, :hora, 'agendada')";
    
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_paciente', $id_paciente);
        $stmt->bindParam(':dia', $dia);
        $stmt->bindParam(':hora', $hora);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao agendar: " . $e->getMessage();
        return false;
    }
}

// 2. Atualiza o status da consulta ('agendada', 'realizada', 'cancelada')
function atualizarStatusConsulta($conexao, $id_consulta, $novo_status)
{
    $sql = "UPDATE consultas SET status = :status WHERE id = :id";
    
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':status', $novo_status);
        $stmt->bindParam(':id', $id_consulta);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao atualizar status: " . $e->getMessage();
        return false;
    }
}

// 3. Atalho para cancelar a consulta
function cancelarConsulta($conexao, $id_consulta)
{
    return atualizarStatusConsulta($conexao, $id_consulta, 'cancelada');
}

// 4. Apaga definitivamente do banco de dados (Delete)
function deletarConsulta($conexao, $id_consulta)
{
    $sql = "DELETE FROM consultas WHERE id = :id";
    
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id_consulta);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao deletar: " . $e->getMessage();
        return false;
    }
}

// 5. Remarca a data e o horário de uma consulta
function remarcarConsulta($conexao, $id_consulta, $novo_dia, $nova_hora)
{
    $sql = "UPDATE consultas SET dia = :dia, hora = :hora WHERE id = :id";
    
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':dia', $novo_dia);
        $stmt->bindParam(':hora', $nova_hora);
        $stmt->bindParam(':id', $id_consulta);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao remarcar: " . $e->getMessage();
        return false;
    }
}

// 6. Lista todas as consultas marcadas
function listarConsultas($conexao)
{
    $sql = "SELECT c.*, p.nome AS paciente_nome 
            FROM consultas c
            LEFT JOIN paciente p ON c.id_paciente = p.id
            ORDER BY c.dia ASC, c.hora ASC";
    
    try {
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar consultas: " . $e->getMessage();
        return [];
    }
}




?>
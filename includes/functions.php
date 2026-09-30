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

//                  SELECT - PRONTUARIO 

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
        
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

?>
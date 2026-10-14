Clínica Arco-Íris 🌈 - Sistema de Gestão Psicológica
A Clínica Arco-Íris é uma aplicação web desenvolvida para gerenciar de forma prática, organizada e segura as operações essenciais de uma clínica de psicologia. O projeto foi estruturado com foco em controle de pacientes, agendamento de consultas e acompanhamento de fluxo financeiro.

📌 Sobre o Projeto
O objetivo principal deste projeto foi aplicar as diretrizes de engenharia de requisitos segundo a norma ISO/IEC/IEEE 29148:2018 em um cenário prático de gestão clínica. Utilizando metodologias ágeis como Kanban e Scrum, a aplicação foi desenhada para centralizar as necessidades operacionais de um responsável de atendimento, cobrindo desde o cadastro de pacientes até o controle financeiro de entradas e saídas.

🚀 Funcionalidades Principais
Cadastro de Pacientes (RF-001): Registro obrigatório com validações para nome completo, CPF, telefone, data de nascimento, endereço e convênio.
Edição e Gestão de Perfil (RF-002): Permissão para atualizar e alterar dados de pacientes cadastrados a qualquer momento.

Remoção de Clientes (RF-003): Exclusão definitiva de perfis de pacientes.

Extrato Financeiro Dinâmico (RF-004): Apresentação detalhada das movimentações de entradas e saídas. 

Navegação e Interface Interativa (RF-005): Painel acessível para transição rápida entre a agenda de atendimentos, cadastro e fluxo financeiro.

📐 Engenharia de Requisitos (Padrão ISO 29148)
A arquitetura do software foi guiada estritamente pela documentação de requisitos para garantir consistência lógica e regras bem definidas:

Regras de Negócio Fundamentais (RN)

RN-001 (Valor da Consulta): Definição do valor padrão de R$ 200,00 para cada consulta agendada.
RN-002 (Liberação de Atendimento): Sessões subsequentes à primeira só são liberadas caso a consulta anterior já tenha a confirmação de pagamento.


🛠️ Tecnologias Utilizadas
O projeto foi construído focando em uma arquitetura limpa e padrão procedural seguro:
Linguagem Backend: PHP (PDO para acesso ao banco de dados com prepared statements)
Banco de Dados: PostgreSQL (Gerenciado via pgAdmin 4 ou Moba)
Frontend: HTML5, CSS3
Ferramentas de Desenvolvimento: VS Code, Git e GitHub

Acesse a documentação completa na pasta “ documentacao” neste repositório 

ESTRUTURA COMPLETA DO PROJETO 

Acesse o DER completo na pasta “documentacao” neste repositório 

DIAGRAMA

Acesse o dicionário de dados completo realizado no Excel na pasta “documentacao” neste repositório 

DOCUMENTAÇÃO 

🎨 Design e Apresentação
Design no Figma: Você pode acessar o protótipo da prototipagem: 👉 Acessar Projeto no Canva

Apresentação no Canva: O material gráfico e a apresentação visual deste projeto foram desenvolvidos no Canva: 👉 Ver Projeto no Canva

COMO EXECUTAR A APLICAÇÃO:
README 

🌈 Conclusão
O maior desafio durante o desenvolvimento foi manter a precisão na estruturação do banco de dados relacional e a correta manipulação de rotas, funções e parâmetros em PHP. O uso de metodologias ágeis auxiliou na organização das etapas e permitiu a entrega de uma solução robusta e funcional para a gestão da clínica.

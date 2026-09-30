# ProjetoClinicaArcoIris
### Projeto final de Semestre
# Clinica Arco - Iris
# Especificação de Requisitos

## 1. Introdução

### 1.1 Propósito
Este documento especifica os requisitos funcionais, não-funcionais e regras de negócio para o Sistema da Clinica Arco - Iris, seguindo as diretrizes de especificação do padrão ISO/IEC/IEEE 29148:2018.

### 1.2 Escopo
O sistema consistirá em uma aplicação escrita em PHP, HTML para gerenciar de forma volátil operações de gerenciamento de pacientes de uma clinica psicologica, como, vissualização de agenda, ganhos e pacientes.

### 1.3 Definições e Acrônimos
- **RF**: Requisito Funcional (O que o sistema faz).
- **RNF**: Requisito Não-Funcional (Características de qualidade/técnicas).
- **RN**: Regra de Negócio (Diretrizes financeiras e restrições operacionais do banco).
- **NS**: Necessidade do Stakeholder.

### 1.4 Referências
- ISO/IEC/IEEE 29148:2018 - *Systems and software engineering — Life cycle processes — Requirements engineering*.

---

## 2. Descrição Geral

### 2.1 Perspectiva do Produto
O sistema operará de forma autônoma, sendo executado localmente. Os dados persistirão apenas durante a sessão ativa da aplicação.

### 2.2 Funções Principais
- Adicionar novos pacientes. - C
- Remoção e alteração de pacientes. - D & U
- Vissualizaçõa das informações dos pacientes. 
- Vissualização da agenda.

---

## 3. Requisitos Específicos

### 3.0 user story

Responsável que utiliza o sistema - "Eu quero que o sisitema me mostre todas informações de meus paciente, sendo elas o pagamento pela consulta, o dia de atendimento, o telefone, data de nascimento, cpf, endereço, convenio e nome completo."

### 3.1 Requisitos Funcionais (RF)

#### RF-001: Abertura de Conta
**Descrição**: O sistema deve permitir a abertura de um novo paciente solicitando obrigatoriamente o nome completo do mesmo.

**Prioridade**: Alta  
**Versão**: 1.0  
**Data**: 2026-09-25  

**Critérios de Aceitação**:
- [ ] O sistema não deve aceitar nomes de titulares vazios.
- [ ] Após o cadastro bem-sucedido, os dados devem ser salvos em memória e o menu principal deve ser liberado.

---

#### RF-002: Realização de Depósitos
**Descrição**: O sistema deve permitir que o usuário root modifique qualquer informação dos pacientes, sendo eles recem adicionados ou não.

**Prioridade**: Alta  
**Versão**: 1.0  
**Data**: 2026-09-25  
**Rastreabilidade**: Derivado de NS-001

**Critérios de Aceitação**:
- [ ] As novas informações adicionadas não devem ficar vazias.
- [ ] O sistema deve atualizar imediatamente as informações no perfil do paciente.

**Dependências**: RF-001

---

#### RF-003: Realização de Saques
**Descrição**: O sistema deve permitir que o usuário root apague perfis de antigos clientes.

**Prioridade**: Alta  
**Versão**: 1.0  
**Data**: 2026-09-25  
**Rastreabilidade**: Derivado de NS-001

**Critérios de Aceitação**:
- [ ] O sistema deve apagar todas as informações do perfil de um determinado cliente quando solicitado.
**Dependências**: RN-001

---

#### RF-004: Consulta de Extrato Dinâmico
**Descrição**: O sistema deve exibir em tela as últimas movimentações financeiras realizadas.

**Prioridade**: Média  
**Versão**: 1.0  
**Data**: 2026-09-25  
**Rastreabilidade**: Derivado de NS-001

**Critérios de Aceitação**:
- [ ] Exibir de forma legível o saldo atual .
- [ ] Apresentar a listagem histórica cronológica.

**Dependências**: RF-001

---

#### RF-005: Menu Interativo CLI
**Descrição**: O sistema deve disponibilizar um menu de navegação para o administrador possa navegar pelas páginas.

**Prioridade**: Média  
**Versão**: 1.0  
**Data**: 2026-09-25  

**Critérios de Aceitação**:
- [ ] Apresentar opções claras (1. Depósito, 2. Saque, 3. Extrato, 4. Sair).


---

### 3.2 Regras de Negócio (RN)

#### RN-001: Validação da consulta
**Descrição**: Toda e qualquer deve ser cobrado um valor de 200,00 reais.

**Prioridade**: Crítica  
**Versão**: 1.0  
**Data**: 2026-09-25  

---

#### RN-002: Cobrança de Taxa de Serviço
**Descrição**: As consulta seguintes da primeira sessão, só serão liberadas se a consulta anterior a esta já estiver paga


**Prioridade**: Crítica  
**Versão**: 1.0  
**Data**: 2026-09-25  

---


#### RN-004: Restrição de Idade Mínima
**Descrição**: O sistema de atendimentos é exclusivo para pacientes com idade igual ou superior a 03 anos. Caso a idade informada no cadastro inicial realizada pelo administrador seja menor que 03 anos, o sistema deve exibir uma mensagem impeditiva e encerrar o fluxo imediatamente.

**Prioridade**: Crítica
**Versão**: 1.0
**Data**: 2026-09-25

---

### 3.3 Requisitos Não-Funcionais (RNF)

#### RNF-001: Linguagem e Dependências
**Descrição**: O sistema deve ser desenvolvido exclusivamente utilizando a linguagem Python 3.14, fazendo uso apenas de suas bibliotecas padrão nativas (`os`), sem a dependência de frameworks ou pacotes externos.

**Categoria**: Portabilidade / Arquitetura  
**Prioridade**: Alta  
**Versão**: 1.0  

---

## 4. Controle de Versões

### Histórico de Alterações

| Versão | Data       | Autor                 | Modificações                                      |
|--------|------------|-----------------------|---------------------------------------------------|
| 1.0    | 2026-09-25 | Maria Eduarda         | Criação da especificação sob a ISO 29148.         |
|--------|------------|-----------------------|---------------------------------------------------|
| 2.0    | ---------- | Maria Eduarda         |           ----------------------------------------|
|--------|------------|-----------------------|---------------------------------------------------|
| 3.0    | ---------- | Maria Eduarda         |               ---------------------------------   |




### Matriz de Rastreabilidade Simplificada

* **NS-001 (Cadastro)** RF-001 (Abertura de Conta)  Teste de validação de dados iniciais.
* **NS-002 (Depósito)**  RF-002 (Realização de Depósitos) Teste de incrementação de saldo.
* **NS-003 (Saque)**  RF-003 (Realização de Saques) RN-001 (Validação de Limite) e RN-002 (Aplicação de Taxa).
* **NS-004 (Histórico)**  RF-004 (Consulta de Extrato) RN-003 (Regra das 3 posições).
* **NS-005 (Interatividade)**  RF-005 (Menu CLI)$ RNF-003 (Tratamento de Exceções).
* **NS-006 (valor)** NR-005 (Restrição de saque) 
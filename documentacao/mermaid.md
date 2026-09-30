```Mermaid

---
title: Pacientes

---
erDiagram

PACIENTE{
    int ID PK
    string nome
    string cpf
    date nasc
}

TELEFONE{
    int ID PK
    int ID_PACIENTE FK
    string telefone
}

CONSULTA{
    int ID PK
    int ID_PACIENTE
    date dia
    string hora
}


```
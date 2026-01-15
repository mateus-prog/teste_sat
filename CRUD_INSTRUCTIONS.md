# CRUD - Instruções

## 🎯 O que foi criado

Um CRUD completo:
- ✅ Listagem com Datatable
- ✅ Formulário de criação
- ✅ Formulário de edição
- ✅ Exclusão com confirmação
- ✅ Validação de campos do backend
- ✅ AJAX para todas as operações
- ✅ Bootstrap 5
- ✅ Máscaras de formatação (CPF, telefone, CEP)
- ✅ Integração com ViaCEP
- ✅ Mensagens no SweetAlert

## 📁 Arquivos Criados

```
backend/
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php              # Layout base
│   └── individuals/
│       ├── index.blade.php            # Listagem
│       ├── create.blade.php           # Criar
│       └── edit.blade.php             # Editar
└── routes/
    └── api.php                        # Rotas da API (stateless, JSON)
    └── web.php                        # Rotas web (views)
```

## 🚀 Como acessar

1. **Listagem**: http://localhost:8800/individuals
2. **Criar**: http://localhost:8800/individuals/create
3. **Editar**: http://localhost:8800/individuals/{id}/edit
3. **Visualizar**: http://localhost:8800/individuals/{id}

## 🔧 Funcionalidades

### Página de Listagem (index.blade.php)
- Tabela com todos os registros
- Botões de ação: Editar e Excluir
- Modal de confirmação para exclusão
- Loading spinner durante carregamento
- Formatação de CPF e telefone na exibição

### Página de Criação (create.blade.php)
- Formulário completo com todos os campos
- Máscaras automáticas:
  - CPF: 000.000.000-00
  - Telefone: (00) 00000-0000
  - CEP: 00000-000
- Busca automática de endereço por CEP (ViaCEP)
- Validação em tempo real
- Exibição de erros do backend

### Página de Edição (edit.blade.php)
- Carrega dados existentes
- Mesmo layout e validações do formulário de criação
- Atualização via AJAX (método PUT)

## 🎨 Validações

As validações são feitas no backend (IndividualRequest) e exibidas no frontend:

- **Nome**: obrigatório, máx. 80 caracteres
- **CPF**: obrigatório, 11 dígitos, validação de CPF
- **Email**: obrigatório, formato válido, máx. 100 caracteres
- **Telefone**: obrigatório, 10-11 dígitos
- **CEP**: obrigatório, formato 00000-000
- **Endereço**: obrigatório, máx. 50 caracteres
- **Número**: obrigatório, máx. 10 caracteres
- **Complemento**: opcional, máx. 20 caracteres
- **Bairro**: obrigatório, máx. 60 caracteres
- **Cidade**: obrigatório, máx. 60 caracteres
- **Estado**: obrigatório, 2 caracteres (UF)

## 📝 Exemplo de uso

### Criar novo Individual:
1. Acesse: http://localhost:8800/individuals
2. Clique em "Cadastrar"
3. Preencha os campos (CEP preencherá automaticamente o endereço)
4. Clique em "Salvar"

### Editar Individual:
1. Na listagem, clique no botão amarelo (lápis)
2. Altere os dados necessários
3. Clique em "Atualizar"

### Excluir Individual:
1. Na listagem, clique no botão vermelho (lixeira)
2. Confirme a exclusão no modal

## ⚙️ Tecnologias utilizadas

- PHP 8.2
- Laravel 12 (Backend)
- Bootstrap 5.3 (Interface)
- jQuery 3.7 (AJAX)
- Bootstrap Icons (Ícones)
- ViaCEP API (Busca de endereço)

## 🔍 Observações importantes

1. O formulário envia dados via AJAX para `/api/individual`
2. As máscaras são removidas antes de enviar ao backend
3. Erros de validação são exibidos abaixo de cada campo
4. O sistema usa CSRF token do Laravel
5. Todos os campos obrigatórios estão marcados com asterisco vermelho (*)

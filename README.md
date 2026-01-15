# Sistema de Gestão de Pessoas

Sistema desenvolvido em Laravel 12 para gerenciamento de cadastro de pessoas físicas (CRUD completo).

## 🚀 Tecnologias

- **Backend:** Laravel 12 (PHP 8.2)
- **Frontend:** Bootstrap 5, jQuery, DataTables
- **Banco de Dados:** MySQL 8
- **Servidor Web:** Nginx
- **Containerização:** Docker & Docker Compose

## 📋 Funcionalidades

- ✅ Cadastro completo de pessoas físicas
- ✅ Validação de CPF
- ✅ Busca automática de endereço por CEP (ViaCEP)
- ✅ Listagem com DataTables (busca, ordenação, paginação)
- ✅ Ativação/Desativação de registros
- ✅ Interface responsiva
- ✅ Tradução completa para Português (PT-BR)

## 🔧 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- [Git](https://git-scm.com/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/)

## 📦 Instalação e Configuração

### 1. Clone o repositório

```bash
git clone https://github.com/mateus-prog/teste_sat.git
cd teste_sat
```

### 2. Configure as variáveis de ambiente

Copie o arquivo de exemplo e configure conforme necessário:

```bash
cp .env.example .env
```

### 3. Suba os containers Docker

```bash
docker compose build --no-cache
docker compose up -d
```

Aguarde alguns segundos até que todos os containers estejam prontos.

```bash
docker compose exec app sh
```

### 4. Instale as dependências do Laravel

```bash
composer install
```

### 5. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 6. Execute as migrations

```bash
php artisan migrate
```

### 7. Acesse a aplicação

Abra seu navegador e acesse:

```
http://localhost:8800
```

## 📁 Estrutura do Projeto

```
backend/
├── app/                    # Lógica da aplicação
│   ├── Http/
│   │   ├── Controllers/    # Controllers da API
│   │   ├── Requests/       # Validações de requisições
│   │   └── Resources/      # Transformação de dados
│   ├── Models/             # Models Eloquent
│   ├── Services/           # Lógica de negócio
│   └── Repositories/       # Camada de dados
├── public/                 # Arquivos públicos
│   ├── css/               # Estilos CSS
│   └── js/                # Scripts JavaScript
├── resources/
│   └── views/             # Blade templates
├── routes/
│   ├── api.php            # Rotas da API
│   └── web.php            # Rotas web
├── docker-compose.yml     # Configuração Docker
└── Dockerfile             # Imagem Docker PHP
```

## 🔌 Endpoints da API

### Listar
```
GET /api/v1/individual
```

### Criar
```
POST /api/v1/individual
```

### Visualizar
```
GET /api/v1/individual/{id}
```

### Atualizar
```
PUT /api/v1/individual/{id}
```

### Excluir
```
DELETE /api/v1/individual/{id}
```

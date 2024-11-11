# RESTFUL-API-LARAVEL

## Requisitos
- **PHP**: Versão 8.3
- **Composer**: Para gerenciar dependências do PHP.

### Clone o Repositório

```bash
git clone https://github.com/KnSXl/RESTFUL-API-LARAVEL.git
```

### Acesse o Diretório do Projeto

```bash
cd RESTFUL-API-LARAVEL
```

### Instale as Dependências

```bash
composer install
```

### Crie o Arquivo .env

```bash
cp .env.example .env
```

### Gere a Chave do Projeto

```bash
php artisan key:generate
```

### Migre as Tabelas

```bash
php artisan migrate
```

### Inicie o Projeto

```bash
php artisan serve
```

### Acesso ao Projeto

- **Rodando Em:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Endpoints

- `GET` `http://127.0.0.1:8000/api/user` // Listar todos os usuários
- `GET` `http://127.0.0.1:8000/api/user/{id}` // Obter usuário específico
- `POST` `http://127.0.0.1:8000/api/user` // Criar um novo usuário
- `PUT` `http://127.0.0.1:8000/api/user/{id}` // Atualizar usuário
- `PATCH` `http://127.0.0.1:8000/api/user/{id}` // Atualizar usuário
- `DELETE` `http://127.0.0.1:8000/api/user/{id}` // Deletar usuário

# RESTFUL API LARAVEL

## Passo 1: Clonar o Repositório

```bash
git clone https://github.com/KnSXl/RESTFUL-API-LARAVEL.git
```

## Passo 2: Navegar para o Diretório do Projeto

```bash
cd RESTFUL-API-LARAVEL
```

## Passo 3: Abrir o Projeto no VS Code

```bash
code .
```

## Passo 4: Instalar Dependências do Docker

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

## Passo 5: Configurar o Alias para Sail

```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

Recarregue o arquivo de configuração do shell:

```bash
source ~/.bashrc  # Para Bash
# ou
source ~/.zshrc   # Para Zsh
```

## Passo 6: Copiar e Configurar o Arquivo `.env`

Copie o arquivo de exemplo:

```bash
cp .env.example .env
```

Edite o arquivo `.env` com as seguintes configurações:

```dotenv
APP_TIMEZONE=America/Sao_Paulo

...

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail    # Ou 'root' para acesso total ao banco de dados
DB_PASSWORD=password
```

## Passo 7: Iniciar os Contêineres Docker

```bash
sail up -d   # Ou ./vendor/bin/sail up -d se o alias não estiver configurado
```

## Passo 8: Gerar a Chave de Aplicação Laravel

```bash
sail artisan key:generate
```

## Passo 9: Migrar as Tabelas

```bash
sail artisan migrate
```

## Acesso à Aplicação e Banco de Dados

- **Aplicação Laravel**: [http://localhost](http://localhost) ou [http://127.0.0.1](http://127.0.0.1/)
- **Banco de Dados**: [http://localhost:8000](http://localhost:8000) ou [http://127.0.0.1:8000](http://127.0.0.1:8000)

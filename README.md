# 🚀 Personal Dashboard

Um projeto de boilerplate para um dashboard pessoal, construído com Laravel 12, Nginx e PostgreSQL, orquestrado com Docker Compose.

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <!-- Badges do Projeto -->
    <img src="https://img.shields.io/github/languages/top/VictorAndreon/Personal-Dashboard?style=for-the-badge" alt="Linguagem Principal">
    <img src="https://img.shields.io/github/contributors/VictorAndreon/Personal-Dashboard?style=for-the-badge" alt="Contribuidores">
</p>

## 📝 Descrição Detalhada

Este projeto serve como um ponto de partida robusto para o desenvolvimento de um "Personal Dashboard". Ele utiliza o framework PHP Laravel 12, configurado com um ambiente de desenvolvimento completo e dockerizado. A arquitetura inclui Nginx como servidor web, PHP-FPM para processamento da aplicação e PostgreSQL como banco de dados, tudo gerenciado por Docker Compose.

A estrutura é ideal para quem busca uma base sólida e moderna para construir aplicações web complexas, com foco em performance, escalabilidade e facilidade de implantação. O frontend é alimentado por Vite e estilizado com Tailwind CSS, garantindo uma experiência de desenvolvimento ágil e um design responsivo.

## 🚧 Status do Projeto

Em Desenvolvimento (Boilerplate inicial, pronto para expansão de funcionalidades).
<!--
## 📸 Visualização

<p align="center">
    <img src="https://via.placeholder.com/800x450?text=Captura+de+Tela+do+Dashboard+Aqui" alt="Captura de tela do Personal Dashboard">
</p>
-->

## ✨ Funcionalidades Principais

*   **Ambiente Dockerizado:** Configuração completa com Docker Compose para Nginx, PHP-FPM e PostgreSQL.
*   **Laravel 12:** Utiliza a versão mais recente do framework Laravel para desenvolvimento backend.
*   **PostgreSQL:** Banco de dados relacional robusto e de alta performance.
*   **Nginx:** Servidor web otimizado para servir a aplicação Laravel.
*   **PHP 8.2:** Versão moderna do PHP para melhor performance e recursos.
*   **Vite & Tailwind CSS:** Ferramentas de frontend para um desenvolvimento rápido e estilização eficiente.
*   **Gerenciamento de Usuários:** Base para autenticação e autorização de usuários.
*   **Rotas e Migrações:** Estrutura de rotas e migrações de banco de dados prontas para uso.
*   **Scripts de Setup:** Comandos facilitados via `composer` para configurar o ambiente.

## 🛠️ Tecnologias Utilizadas

*   **Backend:**
    *   [PHP 8.2](https://www.php.net/)
    *   [Laravel 12](https://laravel.com/)
    *   [Composer](https://getcomposer.org/)
*   **Banco de Dados:**
    *   [PostgreSQL 15](https://www.postgresql.org/)
*   **Servidor Web:**
    *   [Nginx](https://www.nginx.com/)
*   **Containerização:**
    *   [Docker](https://www.docker.com/)
    *   [Docker Compose](https://docs.docker.com/compose/)
*   **Frontend:**
    *   [Node.js 20.x](https://nodejs.org/en/)
    *   [npm](https://www.npmjs.com/)
    *   [Vite](https://vitejs.dev/)
    *   [Tailwind CSS](https://tailwindcss.com/)

## 📋 Pré-requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

*   [Git](https://git-scm.com/): Para clonar o repositório.
*   [Docker](https://www.docker.com/products/docker-desktop/): Para executar os containers da aplicação.
*   [Docker Compose](https://docs.docker.com/compose/install/): Para orquestrar os serviços Docker.

## 🚀 Guia de Início Rápido

Siga os passos abaixo para colocar o projeto em funcionamento em sua máquina local.

### 1. Clonar o Repositório

Abra seu terminal e clone o projeto:

```bash
git clone https://github.com/VictorAndreon/Personal-Dashboard.git
cd Personal-Dashboard
```

### 2. Configuração do Ambiente

Navegue até o diretório `src` e copie o arquivo de exemplo `.env` para criar seu arquivo de configuração local:

```bash
cp src/.env.example src/.env
```

Edite o arquivo `src/.env` e configure as variáveis de ambiente, especialmente as do banco de dados para corresponder ao `docker-compose.yml`:

```dotenv
# src/.env

APP_NAME="Personal Dashboard"
APP_ENV=local
APP_KEY= # Será gerado automaticamente
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

### 3. Subir os Containers Docker

No diretório raiz do projeto (`Personal-Dashboard`), execute o Docker Compose para construir as imagens e iniciar os serviços:

```bash
docker-compose up -d --build
```

Isso irá iniciar três containers: `laravel-app` (PHP-FPM), `laravel-nginx` (Nginx) e `laravel-db` (PostgreSQL).

### 4. Instalar Dependências e Configurar a Aplicação

Acesse o container da aplicação e execute o script de setup do Composer:

```bash
docker-compose exec app composer setup
```

Este script fará o seguinte:
*   Instalar as dependências PHP via Composer.
*   Gerar a chave da aplicação (`APP_KEY`).
*   Executar as migrações do banco de dados.
*   Instalar as dependências Node.js via npm.
*   Compilar os assets de frontend via Vite.

### 5. Acessar a Aplicação

Após todos os passos, a aplicação estará acessível em seu navegador:

```
http://localhost:8080
```

### 6. Popular o Banco de Dados (Opcional)

Para criar um usuário de teste e dados de exemplo, execute os seeders:

```bash
docker-compose exec app php artisan db:seed
```

Um usuário de teste será criado com as credenciais:
*   **Email:** `test@example.com`
*   **Senha:** `password`

## ⚙️ Uso

Este projeto fornece a base para um dashboard pessoal. Você pode começar a adicionar novas rotas, controladores, modelos e componentes de frontend para construir as funcionalidades desejadas.

*   **Desenvolvimento Frontend:** Para observar as mudanças em tempo real durante o desenvolvimento de frontend, você pode iniciar o servidor Vite:
    ```bash
    docker-compose exec app npm run dev
    ```
    E em outro terminal, para ver os logs do Laravel:
    ```bash
    docker-compose exec app php artisan pail
    ```
*   **Acesso ao Banco de Dados:** Você pode acessar o banco de dados PostgreSQL através da porta `5433` em `localhost` usando ferramentas como DBeaver ou pgAdmin, com as credenciais definidas no `.env`.

## 👥 Autores

*   **Victor Andreon**

---
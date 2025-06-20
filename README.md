Auto CMS

Auto CMS é um sistema de gerenciamento de conteúdo automotivo containerizado, composto por:

    Frontend em Vue.js

    Backend com API em PHP

    Banco de dados MySQL

Ele suporta builds Docker multi-arquitetura e implantação automatizada via scripts shell e Docker Compose.
📦 Build e Deploy
🧰 Pré-requisitos

    Docker e Docker Compose instalados

    Acesso ao registro de contêineres: registry.mele.lat

🔨 Construindo as Imagens

Use o script build.sh para construir e enviar imagens Docker para múltiplas arquiteturas:

./build.sh

Este script irá:

    Detectar a arquitetura do sistema e mapear para a plataforma Docker

    Solicitar credenciais do registro

    Construir as imagens api e web com tags específicas por plataforma

    Atualizar o arquivo .env com as referências das novas imagens

Arquiteturas Suportadas:

    amd64

    arm64

    arm/v7

    arm/v6

    386

🚀 Implantação

Implante a aplicação usando o script deploy.sh:

./deploy.sh

Este script:

    Baixa imagens específicas da arquitetura a partir do registro

    Cria ou atualiza o arquivo .env com as referências das imagens

    Cria um link simbólico para o arquivo de produção do Docker Compose

    Reinicia os serviços com a nova configuração

🏗️ Arquitetura de Produção

Utilizando compose.production.yml com Docker Compose, o sistema inclui:

    Serviço API: PHP-FPM + Nginx servindo a API backend

    Serviço Web: Arquivos estáticos do frontend Vue.js

    Serviço de Banco de Dados: MySQL com armazenamento persistente

⚙️ Configuração do Ambiente

Crie um arquivo .env na raiz do projeto com as seguintes variáveis:

APP_PORT=8080
API_PORT=8081
MYSQL_DATABASE=auto_cms
MYSQL_ROOT_USER=root
MYSQL_ROOT_PASSWORD=sua_senha

🧪 Ambiente de Desenvolvimento

Use o arquivo Compose de desenvolvimento para rodar localmente:

cd docker
docker compose up -d

Inclui:

    Banco de dados MySQL

    Interface phpMyAdmin

    Armazenamento de objetos MinIO

📌 Notas

    O sistema de build suporta múltiplas arquiteturas por meio de detecção automática de plataforma.

    O contêiner da API inclui monitoramento de saúde e migração automática do banco de dados na inicialização.

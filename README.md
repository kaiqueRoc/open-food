# Backend Challenge - Open Food Facts REST API

##   Introdução
Neste desafio, trabalharemos no desenvolvimento de uma REST API para utilizar os dados do projeto Open Food Facts, que é um banco de dados aberto com informação nutricional de diversos produtos alimentícios. O objetivo do projeto é dar suporte à equipe de nutricionistas da empresa Fitness Foods LC, permitindo que eles revisem de maneira rápida a informação nutricional dos alimentos que os usuários publicam pela aplicação móvel.
        
-----------------------------------------
###  Tecnologias utilizadas
    Linguagem: PHP
    Framework: Laravel
    Banco de Dados: MySQL
----------------------------------------
### Instalação e uso do projeto
```bash
    # Clone o repositório para sua máquina local:
    ❯  git clone https://github.com/kaiqueRoc/open-food-facts.git
```
```bash
    # Instale as dependências na raiz do projeto:
    ❯ composer install
```
```bash
    # Crie um banco de dados MySQL para o projeto.
    # Crie um arquivo .env na raiz do projeto e altere as variáveis abaixo:
    
    DB_CONNECTION=mysql
    DB_HOST=seu_host
    DB_PORT=seu_port
    DB_DATABASE=seu_banco_de_dados
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
```

```bash
    # Execute as migrações do banco de dados para criar as tabelas necessárias:

    ❯ php artisan migrate
```
```bash
    # Inicie o servidor local:

    ❯ php -S localhost:8000 -t public    
    ❯ Agora você pode acessar a API em http://localhost:8000.

```
--------------------------------------------------------
## Endpoints da API

```bash

  ❯ GET /: Retorna um Status: 200 e uma Mensagem "Fullstack Challenge 20201026"

  ❯ GET /products/:code: Obtém informações de um id do  produto específico.

  ❯ GET /products: Lista todos os produtos do banco de dados, utilizando paginação de 10 produtos por pagina para evitar sobrecarga de requisições.

```
### Extras

```bash

  ❯ Configurado Docker no Projeto para facilitar o Deploy da equipe de DevOps.

  ❯ Configurado um sistema de alerta caso ocorra falhas durante o Sync dos produtos.

  ❯ Documentação da API utilizando o conceito de Open API 3.0.
  
  # Foi Implementados testes unitários para os endpoints da API. Basta rodar o seguinte comando na raiz do projeto:
  
  ❯  vendor/bin/phpunit


```
### .gitignore
```bash

  # Configurado .gritignore para manter o projeto nos padrões de controle de versão.

    /vendor
    /.idea
    Homestead.json
    Homestead.yaml
    .env
    .phpunit.result.cache
 

```
```bash
##### Este projeto foi desenvolvido como parte de um desafio proposto pela Coodesh.

```

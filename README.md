# Backend Challenge 20220626 - Open Food Facts REST API

##   Introdução
Neste desafio, trabalharemos no desenvolvimento de uma REST API para utilizar os dados do projeto Open Food Facts, que é um banco de dados aberto com informação nutricional de diversos produtos alimentícios. O objetivo do projeto é dar suporte à equipe de nutricionistas da empresa Fitness Foods LC, permitindo que eles revisem de maneira rápida a informação nutricional dos alimentos que os usuários publicam pela aplicação móvel.

-----------------------------------------
##### ❯ Link da apresentação:  https://www.loom.com/embed/0eae779324ef449abce50c3f9ae7c4de
-----------------------------------------
###  Tecnologias utilizadas
    Linguagem: PHP
    Framework: Laravel
    Banco de Dados: MySQL
----------------------------------------
### Instalação e uso do projeto
```bash
    # Clone o repositório para sua máquina local:
    >>>  git clone https://github.com/kaiqueRoc/open-food-facts.git
```

```bash
    # Crie um banco de dados MySQL para o projeto.
    # Crie um arquivo .env igual o .env.exemplo na raiz do projeto e altere as variáveis abaixo:
    
    DB_CONNECTION=mysql
    DB_HOST=seu_host
    DB_PORT=seu_port
    DB_DATABASE=seu_banco_de_dados
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
```
```bash
    # Gere a imagem docker do php com o comando:
    >>> docker build -t open_food .
    # Gere a imagem docker do mysql com o comando:
    >>> docker build -t mysql_open_food -f DockerfileMySql .
    # Crie uma rede docker para comunicação dos containers:
    >>> docker network create rede_open_food
    #execulte os containers:
    >>> docker run -d --name open_food -v {'diretorio_do_projeto_local'}:/var/www/html --network rede_open_food -p 80:80 open_food
    >>> docker run -d --name mysql_open_food --network rede_open_food -p 3306:3306 mysql_open_food
```
```bash
    #  Acesso o container  e Instale as dependências na raiz do projeto com o comando:
    >>> docker exec -ti open_food bash
    >>> composer install
    >>> php artisan migrate
```
```bash
    # Execute as migrações do banco de dados para criar as tabelas necessárias:

    >>> php artisan migrate
```
```bash
    # Seu servidor está configurado:
    ❯ Acesse http://localhost.

```
--------------------------------------------------------
## Endpoints da API

```bash

  ❯ GET /: Retorna um Status: 200 e README com a documentação.

  ❯ GET /products/:code: Obtém informações de um id do  produto específico.

  ❯ GET /products: Lista todos os produtos do banco de dados, utilizando paginação de 10 produtos por pagina para evitar sobrecarga de requisições.

```
### Extras

```bash

  ❯ Está Configurado 2 DockerFiles para facilitar deploy dos projetos.
  
   - Dockerfile > Projeto PHP
   - DockerfileMySql > Servidor SQl
  
-------------------------------------------------------------------------------------------------------
  ❯ Configurado um sistema de alerta para sync dos produtos via email.
  
   # Para testar o envio do email deve configurar sua env antes de fazer imagem do docker.
   
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.exemplo.com
    MAIL_PORT=587
    MAIL_USERNAME= "seu email"
    MAIL_PASSWORD= "sua senha"
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS= "seu email"
    MAIL_FROM_NAME="seu nome"
    MAIL_ADM= email para receber os alertas

   # Execute o comando dentro do container:
   
  >>>  php artisan import:products

   # Nesse alerta será enviado o erro caso ocorra e qual pagina ocorreu.
   # O andamento da importação.
   # A conclusão da importação dos 100 produtos do dia.
-------------------------------------------------------------------------------------------------------
  ❯ Esta utilizado o conceito de Open API 3.0.
-------------------------------------------------------------------------------------------------------
  ❯ Foi Implementados testes unitários para os endpoints da API.  
  
  # Para a execução dos testes  o usuario deve estar na raiz do container do projeto e rodar o seguinte comando.
  
  >>> php artisan test
 
 ❯ Neste teste será avaliado os demais funções.
  
    ✓ import products   
    ✓ root endpoint                                                                                                                                                                                                                0.05s  
    ✓ get product by code                                                                                                                                                                                                          0.04s  
    ✓ list all products    
  -------------------------------------------------------------------------------------------------------
 ❯ Resultado dos testes unitarios:
 
  Tests:    4 passed (202 assertions)
  Duration: 180.47s
  -------------------------------------------------------------------------------------------------------

 


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

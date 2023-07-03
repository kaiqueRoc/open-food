# Backend Challenge 20220626 - Open Food Facts REST API

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
    >>>  git clone https://github.com/kaiqueRoc/open-food-facts.git
```
```bash
    # Instale as dependências na raiz do projeto com o comando:
    >>> composer install
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
    # Execute as migrações do banco de dados para criar as tabelas necessárias:

    >>> php artisan migrate
```
```bash
    # Inicie o servidor local com o comando:

    >>> php artisan serve

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
  
-------------------------------------------------------------------------------------------------------
  ❯ Configurado um sistema de alerta para sync dos produtos via email.
  
   # Para testar o envio do email deve configurar sua env.
   
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.exemplo.com
    MAIL_PORT=587
    MAIL_USERNAME= "seu email"
    MAIL_PASSWORD= "sua senha"
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS= "seu email"
    MAIL_FROM_NAME="seu nome"
    MAIL_ADM= email do adm para receber os alertas

   # Execute o comando:
   
  >>>  php artisan import:products

   # Nesse alerta será enviado o erro e qual pagina ocorreu.
   # O andamento da importação.
   # A conclusão da importação dos 100 produtos do dia.
-------------------------------------------------------------------------------------------------------
  ❯ Esta utilizado o conceito de Open API 3.0.
-------------------------------------------------------------------------------------------------------
  ❯ Foi Implementados testes unitários para os endpoints da API.  
  
  # Para a execução dos testes  o usuario deve estar na raiz do projeto e rodar o seguinte comando.
  
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

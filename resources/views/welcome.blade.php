<!DOCTYPE html>
<html>
<head>
    <title>Backend Challenge 20220626 - Open Food Facts REST API</title>
    <style>
        body {
            background-color: #272727;
            color: #cbd5e0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        code {
            color: #cbd5e0;
            padding: 4px 6px;
            border-radius: 4px;
            font-family: Consolas, monospace;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Backend Challenge 20220626 - Open Food Facts REST API</h1>

    <h2>Introdução</h2>
    <p>Neste desafio, trabalharemos no desenvolvimento de uma REST API para utilizar os dados do projeto Open Food Facts, que é um banco de dados aberto com informação nutricional de diversos produtos alimentícios. O objetivo do projeto é dar suporte à equipe de nutricionistas da empresa Fitness Foods LC, permitindo que eles revisem de maneira rápida a informação nutricional dos alimentos que os usuários publicam pela aplicação móvel..</p>

    <hr>

    <h3>Link da apresentação:</h3>
    <p><a href="https://www.loom.com/embed/0eae779324ef449abce50c3f9ae7c4de">https://www.loom.com/embed/0eae779324ef449abce50c3f9ae7c4de</a></p>

    <h2>Tecnologias utilizadas</h2>
    <ul>
        <li>Linguagem: PHP</li>
        <li>Framework: Laravel</li>
        <li>Banco de Dados: MySQL</li>
    </ul>

    <hr>

    <h2>Instalação e uso do projeto</h2>

    <code>
        # Clone o repositório para sua máquina local:<br>
        >>> git clone https://github.com/kaiqueRoc/open-food-facts.git
    </code>

    <code>
        # Crie um banco de dados MySQL para o projeto.<br>
        # Crie um arquivo .env igual o .env.exemplo na raiz do projeto e altere as variáveis abaixo:<br>
        <br>
        DB_CONNECTION=mysql<br>
        DB_HOST=seu_host<br>
        DB_PORT=seu_port<br>
        DB_DATABASE=seu_banco_de_dados<br>
        DB_USERNAME=seu_usuario<br>
        DB_PASSWORD=sua_senha<br>
        <br>
    </code>

    <code>

        # Gere a imagem docker do php com o comando:<br>
        >>> docker build -t open_food .
        <br>
    </code>

    <code>
        <br>
        # Gere a imagem docker do mysql com o comando:<br>
        >>> docker build -t mysql_open_food -f DockerfileMySql .
        <br>
    </code>

    <code>
        <br>
        # Crie uma rede docker para comunicação dos containers:<br>
        >>> docker network create rede_open_food
        <br>
    </code>

    <code>
        <br>
        # Execute os containers:<br>
        >>> docker run -d --name open_food -v {'diretorio_do_projeto_local'}:/var/www/html --network rede_open_food -p 80:80 open_food<br>
        >>> docker run -d --name mysql_open_food --network rede_open_food -p 3306:3306 mysql_open_food
        <br>
    </code>

    <code>
        <br>
        # Acesso o container e instale as dependências na raiz do projeto com o comando:<br>
        >>> docker exec -ti open_food bash<br>
        >>> composer install<br>
        >>> php artisan migrate
        <br>
    </code>

    <code>
        <br>
        # Execute as migrações do banco de dados para criar as tabelas necessárias:<br>
        >>> php artisan migrate
        <br>
    </code>

    <code>
        <br>
        # Seu servidor está configurado:<br>
        ❯ Acesse http://localhost.
        <br>
    </code>

    <hr>

    <h2>Endpoints da API</h2>

    <code>
        ❯ GET /: Retorna um Status: 200 e README com a documentação.<br>
    </code>

    <code>
        ❯ GET /products/:code: Obtém informações de um id do  produto específico.<br>
    </code>

    <code>
        ❯ GET /products: Lista todos os produtos do banco de dados, utilizando paginação de 10 produtos por página para evitar sobrecarga de requisições.<br>
        <br>
    </code>

    <br>
    <hr>
    <h3>Extras</h3>

    <code>
        ❯ Está Configurado 2 DockerFiles para facilitar deploy dos projetos.<br>
        <br>
        - Dockerfile > Projeto PHP<br>
        - DockerfileMySql > Servidor SQL
    </code>

    <code>
        ❯ Configurado um sistema de alerta para sync dos produtos via email.<br>
        <br>
        # Para testar o envio do email deve configurar sua env antes de fazer imagem do docker.<br>
        <br>
        MAIL_DRIVER=smtp<br>
        MAIL_HOST=smtp.exemplo.com<br>
        MAIL_PORT=587<br>
        MAIL_USERNAME="seu email"<br>
        MAIL_PASSWORD="sua senha"<br>
        MAIL_ENCRYPTION=tls<br>
        MAIL_FROM_ADDRESS="seu email"<br>
        MAIL_FROM_NAME="seu nome"<br>
        MAIL_ADM=email para receber os alertas<br>
        <br>
        # Execute o comando dentro do container:<br>
        <br>
        >>> php artisan import:products<br>
        <br>
        # Nesse alerta será enviado o erro caso ocorra e qual página ocorreu.<br>
        # O andamento da importação.<br>
        # A conclusão da importação dos 100 produtos do dia.
    </code>

    <code>
        ❯ Esta utilizado o conceito de Open API 3.0.
    </code>

    <code>
        ❯ Foi Implementados testes unitários para os endpoints da API.<br>
        <br>
        # Para a execução dos testes, o usuário deve estar na raiz do container do projeto e rodar o seguinte comando.<br>
        <br>
        >>> php artisan test<br>
        <br>
        ❯ Neste teste será avaliado os demais funções.
    </code>

    <p>Resultado dos testes unitários:</p>

    <code>
        Tests: 4 passed (202 assertions)<br>
        Duration: 180.47s
    </code>

    <hr>

    <h3>.gitignore</h3>

    <code>
        # Configurado .gitignore para manter o projeto nos padrões de controle de versão.<br>
        <br>
        /vendor<br>
        /.idea<br>
        Homestead.json<br>
        Homestead.yaml<br>
        .env<br>
        .phpunit.result.cache
    </code>

    <hr>

    <p>Este projeto foi desenvolvido como parte de um desafio proposto pela Coodesh.</p>
</div>
</body>
</html>

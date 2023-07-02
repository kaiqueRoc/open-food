<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Email de Alerta</title>
</head>
    <body>
        <h1>Olá,</h1>
        <p>Este é um email de alerta.</p>
        <p>{{$data}}</p>
        <p>Atenciosamente,</p>
        <p>Open FOOD Facts</p>
    </body>
</html>

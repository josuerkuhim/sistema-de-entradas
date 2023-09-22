<?php session_start() ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        form {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 280px;
        }

        button {
            font-size: 1em;
            background: #3498db;
            color: #fff;
            border: 0.25rem solid #3498db;
            padding: 0.85em 110px;
            margin: 1rem;
            position: relative;
            z-index: 1;
            overflow: hidden;
            }

        button:hover {
            color: #3498db;
        }

        button::after {
            content: "";
            background: #ecf0f1;
            position: absolute;
            z-index: -1;
            padding: 0.85em 0.75em;
            display: block;
        }

        button.btn::after {
            left: -20%;
            right: -20%;
            top: 0;
            bottom: 0;
            transform: skewX(45deg) scale(0, 1);
            transition: all 0.3s ease;
        }

        button.btn:hover::after {
            transform: skewX(45deg) scale(1, 1);
            transition: all 0.3s ease-out;
        }

        a {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Login</h1>

    <?php
        if(isset($_SESSION["erroLogin"])){
            echo "<p id='error'>" .  $_SESSION["erroLogin"] . " </p>";
        }
    ?>

    <form method="post" action="../controller/loginController.php">
        <label for="usuario">Usuário:</label>
        <input type="text" placeholder="CPF" id="usuario" name="usuario" required><br>

        <label for="senha">Senha:</label> <br>
        <input type="password" placeholder="******" id="senha" name="senha" required><br>

        <button type="submit" class="btn">Entrar</button>

        <p>Não tem uma conta? <a href="cadastro.html">Cadastre-se aqui</a></p>
    </form>
</body>
    <script>
        const error = document.getElementById("error");

        setTimeout(function(){
            error.innerHTML = "";
        }, 2000);
    </script>
</html>

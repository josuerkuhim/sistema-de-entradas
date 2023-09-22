<?php
    session_start();

    if (!isset($_SESSION['nome_usuario'])) {
        header("Location: login.php");
        exit();
    }

    include "../controller/indexController.php";

    $nomeUsuario = $_SESSION['nome_usuario'];
    $registro = new Registro();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['entrada'])) {
            $registro->registrarEntrada($nomeUsuario);
        }

        if (isset($_POST['saida'])) {
            $registro->registrarSaida($nomeUsuario);
        }

        if (isset($_POST['limpar'])) {
            $registro->limparRegistros($nomeUsuario);
        }
    }

    $registros = $registro->getRegistros($nomeUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Entradas e Saídas</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        h1 {
            color: #333;
            margin-top: 0;
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
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }


    </style>
</head>
<body>
    <h1>Registro de Entradas e Saídas</h1>

    <?php if (!empty($_SESSION['aviso'])) : ?>
        <div class="aviso"><?= $_SESSION['aviso'] ?></div>
        <?php unset($_SESSION['aviso']); ?>
    <?php endif; ?>

    <form method="post">
        <button class="btn" type="submit" name="entrada">Registrar Entrada</button>
        <button class="btn" type="submit" name="saida">Registrar Saída</button>
        <button class="btn" type="submit" name="limpar">Limpar Registros</button>
    </form>

    <table>
        <tr>
            <th>Entrada</th>
            <th>Saída</th>
            <th>Tempo de Permanência</th>
        </tr>
        <?php foreach ($registros as $registro) : ?>
            <tr>
                <td><?php echo $registro['entrada']; ?></td>
                <td><?php echo ($registro['saida'] ? $registro['saida'] : '-'); ?></td>
                <td>
                    <?php
                    if ($registro['saida']) {
                        $entrada = new DateTime($registro['entrada']);
                        $saida = new DateTime($registro['saida']);
                        $tempoPermanencia = $entrada->diff($saida)->format('%H:%I:%S');
                        echo $tempoPermanencia;
                    } else {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="../controller/logout.php">Sair</a>
</body>
</html>

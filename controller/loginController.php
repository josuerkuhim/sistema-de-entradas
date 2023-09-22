<?php
    include "../model/Sql.php";
    session_start();
    $sql = new Sql();

    if (isset($_SESSION['nome_usuario']) || $_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: ../view/index.php");
        exit();
    }

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $resultado = $sql->login($usuario, $senha);

    if ($resultado["senha"] == $senha) {
        $_SESSION['nome_usuario'] = $resultado['cpf'];
        header("Location: ../view/index.php");
        exit();
    } else {
        $_SESSION["erroLogin"] = 'Credenciais inválidas.';
        header("Location: ../view/login.php");
        exit();
    }
?>

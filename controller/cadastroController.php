<?php
    include "../model/Sql.php";
    $sql = new Sql();

    $data = [
        "nome" => $_POST['nome'],
        "senha" => $_POST['senha'],
        "cpf" => $_POST['cpf'],
        "genero" => $_POST['genero'],
        'telefone' => $_POST['telefone'],
        "data_nascimento" => $_POST['data_nascimento'],
        "cidade" => $_POST['cidade'],
        "estado" => strtoupper($_POST['estado'])
    ];

    if ($response = $sql->cadastro($data)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro".mysqli_connect_error($connection);
    }
?>

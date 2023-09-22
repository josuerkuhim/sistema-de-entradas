<?php
    include "../model/Db.php";

    class Sql{

        public function cadastro($data){
            $conn = Db::getConnection();

            $nome = $data["nome"];
            $senha = $data["senha"];
            $cpf = $data["cpf"];
            $genero = $data["genero"];
            $telefone = $data["telefone"];
            $data_nascimento = $data["data_nascimento"];
            $cidade = $data["cidade"];
            $estado = $data["estado"];

            $sql = "INSERT INTO usuarios(nome,senha,cpf,genero,telefone,data_nascimento,cidade,estado)
            VALUES ('$nome','$senha','$cpf','$genero','$telefone','$data_nascimento','$cidade','$estado')";

            $reposnse = mysqli_query($conn, $sql);

            if($reposnse){
                return $reposnse;
            }

            return false;
        }

        public function login($usuario, $senha){
            $conn = Db::getConnection();

            $query = "SELECT * FROM usuarios WHERE cpf = '$usuario' AND senha = '$senha'";


            $reposnse = mysqli_query($conn, $query);

            if($reposnse){
                return mysqli_fetch_assoc($reposnse);
            }

            return false;
        }
    }
?>

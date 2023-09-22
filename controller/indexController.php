<?php
    include "../model/Db.php";

    class Registro extends Db{
        public function registrarEntrada($nome) {
            $conn = $this->getConnection();
    
            $query = "SELECT id FROM registros WHERE nome = '$nome' AND entrada IS NOT NULL AND saida IS NULL";
            $result = $conn->query($query);
    
            if ($result->num_rows > 0) {
                $conn->close();
                return false; // Já existe uma entrada sem saída
            }
    
            $query = "INSERT INTO registros (nome, entrada) VALUES ('$nome', NOW())";
            $result = $conn->query($query);
    
            $conn->close();
    
            return $result;
        }
    
        public function registrarSaida($nome) {
            $conn = $this->getConnection();
    
            $query = "SELECT id FROM registros WHERE nome = '$nome' AND entrada IS NOT NULL AND saida IS NULL";
            $result = $conn->query($query);
    
            if ($result->num_rows === 0) {
                $conn->close();
                return false; // Não existe uma entrada sem saída
            }
    
            $query = "UPDATE registros SET saida = NOW() WHERE nome = '$nome' AND entrada IS NOT NULL AND saida IS NULL";
            $result = $conn->query($query);
    
            $conn->close();
    
            return $result;
        }
    
        public function limparRegistros($nome) {
            $conn = $this->getConnection();
    
            $query = "DELETE FROM registros WHERE nome = '$nome'";
            $result = $conn->query($query);
    
            $conn->close();
    
            return $result;
        }
    
        public function getRegistros($nome) {
            $conn = $this->getConnection();
    
            $query = "SELECT entrada, saida FROM registros WHERE nome = '$nome' ORDER BY entrada";
            $result = $conn->query($query);
    
            $registros = [];
    
            while ($row = $result->fetch_assoc()) {
                $registros[] = $row;
            }
    
            $conn->close();
    
            return $registros;
        }

    }
?>
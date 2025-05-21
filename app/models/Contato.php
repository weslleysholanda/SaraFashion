<?php

class Contato extends Model{

    public function salvarEmail($nome,$email,$tel,$mensagem){

        $sql = "INSERT INTO tbl_contato(nome_contato,email_contato,telefone_contato,mensagem_contato) VALUES(:nome_contato, :email_contato, :telefone_contato, :mensagem_contato)";

        $stmt = $this -> db ->prepare($sql);
        $stmt -> bindValue(':nome_contato', $nome);
        $stmt ->bindValue(':email_contato', $email);
        $stmt ->bindValue(':telefone_contato', $tel);
        $stmt ->bindValue(':mensagem_contato', $mensagem);

        return $stmt -> execute();
    }

    public function getListarContato(){
        $sql = "SELECT * FROM tbl_contato;";

        $stmt = $this->db->query($sql);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function gerarLinkWhatsApp($id_contato)
    {
        $sql = "SELECT * FROM tbl_contato WHERE id_contato = :id_contato";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_contato', $id_contato, PDO::PARAM_INT);
        $stmt->execute(); // Executa a query
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna o resultado como um array associativo
    }
}
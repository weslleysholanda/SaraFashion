<?php 

class Marcas extends Model{

    public function getLogoNome(){

        $sql = "SELECT * FROM tbl_marcas WHERE status_marcas = 'Ativo' ";
        $stmt = $this -> db -> query($sql);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMarca($dados){
        $sql = "INSERT INTO tbl_marcas(nome_marca,logo_marca,alt_marca,status_marcas) 
        VALUES(:nome_marca,:logo_marca,:alt_marca,:status_marcas)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_marca',$dados['nome_marca']);
        $stmt->bindValue(':logo_marca',$dados['logo_marca']);
        $stmt->bindValue(':alt_marca',$dados['alt_marca']);
        $stmt->bindValue(':status_marcas',$dados['status_marcas']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }
}
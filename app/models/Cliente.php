<?php

class Cliente extends Model{
    

    public function buscarCliente($email){
        $sql =  "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'  ";
        $stmt = $this -> db->prepare($sql);
        $stmt->bindValue(':email',$email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getlistarCliente(){
        $sql = "SELECT * FROM tbl_cliente WHERE status_cliente = 'Ativo';";
        $stmt = $this->db->query($sql);
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function desativarCliente($id){
        $sql = "UPDATE tbl_cliente SET status_cliente = 'Inativo' WHERE id_cliente= :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente',$id,PDO::PARAM_INT);
        return $stmt->execute();
    }
}
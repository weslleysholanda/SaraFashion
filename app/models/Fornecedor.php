<?php

class Fornecedor extends Model
{

    public function getListarFornecedor()
    {
        $sql = "SELECT * FROM tbl_fornecedor WHERE status_fornecedor='Ativo' ORDER BY nome_fornecedor ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFornecedor($dados)
    {
        $sql = "INSERT INTO tbl_fornecedor(
            nome_fornecedor,
            tipo_fornecedor,
            cpf_cnpj_fornecedor,
            data_cad_fornecedor,
            telefone_fornecedor,
            email_fornecedor,
            endereco_fornecedor,
            cidade_fornecedor,
            produto_fornecido,
            status_fornecedor
            )VALUES(
            :nome_fornecedor,
            :tipo_fornecedor,
            :cpf_cnpj_fornecedor,
            :data_cad_fornecedor,
            :telefone_fornecedor,
            :email_fornecedor,
            :endereco_fornecedor,
            :cidade_fornecedor,
            :produto_fornecido,
            :status_fornecedor)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_fornecedor', $dados['nome_fornecedor']);
        $stmt->bindValue(':tipo_fornecedor', $dados['tipo_fornecedor']);
        $stmt->bindValue(':cpf_cnpj_fornecedor', $dados['cpf_cnpj_fornecedor']);
        $stmt->bindValue(':data_cad_fornecedor', $dados['data_cad_fornecedor']);
        $stmt->bindValue(':telefone_fornecedor', $dados['telefone_fornecedor']);
        $stmt->bindValue(':email_fornecedor', $dados['email_fornecedor']);
        $stmt->bindValue(':endereco_fornecedor', $dados['endereco_fornecedor']);
        $stmt->bindValue(':cidade_fornecedor', $dados['cidade_fornecedor']);
        $stmt->bindValue(':produto_fornecido', $dados['produto_fornecido']);
        $stmt->bindValue(':status_fornecedor', $dados['status_fornecedor']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function atualizarFornecedor($id,$dados){
        $sql = "UPDATE tbl_fornecedor
        SET nome_fornecedor      = :nome_fornecedor,
            tipo_fornecedor      = :tipo_fornecedor,
            cpf_cnpj_fornecedor  = :cpf_cnpj_fornecedor,
            data_cad_fornecedor  = :data_cad_fornecedor,
            email_fornecedor     = :email_fornecedor, 
            telefone_fornecedor  = :telefone_fornecedor,
            endereco_fornecedor  = :endereco_fornecedor,
            cidade_fornecedor    = :cidade_fornecedor,
            status_fornecedor    = :status_fornecedor
        WHERE id_fornecedor      = :id_fornecedor";

        $stmt = $this->db->prepare($sql);
  
  
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_fornecedor', $dados['nome_fornecedor']);
        $stmt->bindValue(':tipo_fornecedor',$dados['tipo_fornecedor']);
        $stmt->bindValue(':cpf_cnpj_fornecedor',$dados['cpf_cnpj_fornecedor']);
        $stmt->bindValue(':data_cad_fornecedor',$dados['data_cad_fornecedor']);
        $stmt->bindValue(':email_fornecedor',$dados['email_fornecedor']);
        $stmt->bindValue(':telefone_fornecedor',$dados['telefone_fornecedor']);
        $stmt->bindValue(':endereco_fornecedor',$dados['endereco_fornecedor']);
        $stmt->bindValue(':cidade_fornecedor',$dados['cidade_fornecedor']);
        $stmt->bindValue(':status_fornecedor',$dados['status_fornecedor']);
        $stmt->bindValue(':status_fornecedor',$dados['status_fornecedor']);
        $stmt->bindValue(':id_fornecedor',$id,PDO::PARAM_INT);

        return $stmt -> execute();
        
    }

    public function desativarFornecedor($id)
    {
        $sql = "UPDATE tbl_fornecedor SET status_fornecedor = 'Inativo' WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_fornecedor', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getFornecedorById($id)
    {
        $sql = "SELECT * FROM tbl_fornecedor WHERE id_fornecedor = :id_fornecedor;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_fornecedor', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

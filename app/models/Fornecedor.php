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
}

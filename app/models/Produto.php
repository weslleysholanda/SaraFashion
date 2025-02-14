<?php

class Produto extends Model{

    public function getProduto(){
        $sql = "SELECT * FROM tbl_produto INNER JOIN tbl_galeria ON tbl_produto.id_produto = tbl_galeria.id_produto;";
        $stmt = $this->db->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduto($dados){ 
        $sql = "INSERT INTO tbl_produto (
            nome_produto,
            descricao_produto,
            informacao_produto,
            preco_produto,
            quantidade_estoque_produto,
            status_produto,
            link_produto
        ) VALUES (
            :nome_produto,
            :descricao_produto,
            :informacao_produto,
            :preco_produto,
            :quantidade_estoque_produto,
            :status_produto,
            :link_produto
        )";
        
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindValue(':nome_produto', $dados['nome_produto']);
        $stmt->bindValue(':descricao_produto', $dados['descricao_produto']);
        $stmt->bindValue(':informacao_produto', $dados['informacao_produto']); 
        $stmt->bindValue(':preco_produto', $dados['preco_produto']);
        $stmt->bindValue(':quantidade_estoque_produto', $dados['quantidade_estoque_produto']);
        $stmt->bindValue(':status_produto', $dados['status_produto']);
        $stmt->bindValue(':link_produto', $dados['link_produto']);
    
        $stmt->execute();
    
        return $this->db->lastInsertId();
    }
    


    public function getProdutoLink($link){
        $sql = "SELECT * FROM tbl_produto INNER JOIN tbl_galeria ON tbl_produto.id_produto = tbl_galeria.id_produto WHERE status_produto = 'Ativo' AND link_produto = :link ";

        $stmt = $this->db ->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addFotoGaleria($id_produto, $arquivo, $nome_produto) {
        $sql = "INSERT INTO tbl_galeria (foto_galeria, alt_foto_galeria, status_galeria, id_produto) 
                VALUES (:foto_galeria, :alt_galeria, :status_galeria, :id_produto)";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto_galeria', $arquivo);
        $stmt->bindValue(':alt_galeria', $nome_produto); // Corrigido aqui
        $stmt->bindValue(':status_galeria', 'Ativo');
        $stmt->bindValue(':id_produto', $id_produto);
        return $stmt->execute();
    }
    
    public function existeEsseProduto($link){
        $sql = "SELECT COUNT(*) as total from tbl_produto WHERE link_produto = :link";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['total'] > 0;
    }
    public function getProdutoAleatorio($limite = 3){
        $sql = "SELECT * FROM tbl_produto INNER JOIN tbl_galeria ON tbl_produto.id_produto = tbl_galeria.id_produto WHERE status_produto = 'Ativo' ORDER BY RAND() LIMIT :limite;";

        $stmt = $this-> db-> prepare($sql);

        $stmt->bindValue(':limite',(int)$limite,PDO::PARAM_INT);
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
}
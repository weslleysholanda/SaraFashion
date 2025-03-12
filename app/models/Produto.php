<?php

class Produto extends Model
{

    public function getProduto()
    {
        $sql = "SELECT 
                    tbl_produto.*, 
                    GROUP_CONCAT(tbl_galeria.foto_galeria SEPARATOR ',') AS imagens
                FROM tbl_produto 
                LEFT JOIN tbl_galeria ON tbl_produto.id_produto = tbl_galeria.id_produto
                WHERE status_produto = 'Ativo' GROUP BY tbl_produto.id_produto";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduto($dados)
    {
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
    public function atualizarProduto($id, $dados)
    {
        $sql = "UPDATE tbl_produto 
                SET nome_produto                = :nome_produto,
                    descricao_produto           = :descricao_produto,
                    informacao_produto          = :informacao_produto,
                    preco_produto               = :preco_produto, 
                    quantidade_estoque_produto  = :quantidade_estoque_produto,
                    status_produto              = :status_produto,
                    link_produto                = :link_produto
                WHERE id_produto = :id_produto";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_produto', $dados['nome_produto']);
        $stmt->bindValue(':descricao_produto', $dados['descricao_produto']);
        $stmt->bindValue(':informacao_produto', $dados['informacao_produto']);
        $stmt->bindValue(':preco_produto', $dados['preco_produto']);
        $stmt->bindValue(':quantidade_estoque_produto', $dados['quantidade_estoque_produto']);
        $stmt->bindValue(':status_produto', $dados['status_produto']);
        $stmt->bindValue(':link_produto', $dados['link_produto']);
        $stmt->bindValue(':id_produto', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function desativarProduto($id)
    {
        $sql = "UPDATE tbl_produto SET status_produto = 'Inativo' WHERE id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_produto', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getProdutoLink($link)
    {
        $sql = "SELECT p.*, 
        GROUP_CONCAT(DISTINCT g.foto_galeria ORDER BY g.id_galeria SEPARATOR ',') AS imagens
        FROM tbl_produto p
        LEFT JOIN tbl_galeria g ON p.id_produto = g.id_produto 
        WHERE p.status_produto = 'Ativo' AND p.link_produto = :link
        GROUP BY p.id_produto;";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        // Converte as imagens para um array
        $produto['imagens'] = !empty($produto['imagens']) ? explode(',', $produto['imagens']) : [];

        return $produto;
    }



    public function addFotoGaleria($id_produto, $arquivo, $nome_produto)
    {
        $sql = "INSERT INTO tbl_galeria (foto_galeria, alt_foto_galeria, status_galeria, id_produto) 
                VALUES (:foto_galeria, :alt_foto_galeria, :status_galeria, :id_produto)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto_galeria', $arquivo);
        $stmt->bindValue(':alt_foto_galeria', $nome_produto);
        $stmt->bindValue(':status_galeria', 'Ativo');
        $stmt->bindValue(':id_produto', $id_produto);
        return $stmt->execute();
    }

    public function atualizarFotoGaleria($id, $arquivos, $alt_galeria)
    {
        $sqlVerificar = "SELECT id_galeria FROM tbl_galeria WHERE id_produto = :id_produto ORDER BY id_galeria";
        $stmtVerificar = $this->db->prepare($sqlVerificar);
        $stmtVerificar->bindValue(':id_produto', $id, PDO::PARAM_INT);
        $stmtVerificar->execute();
        $galerias = $stmtVerificar->fetchAll(PDO::FETCH_ASSOC);

        foreach ($arquivos as $index => $arquivo) {
            if (isset($galerias[$index])) {
                $sql = "UPDATE tbl_galeria 
                    SET foto_galeria = :foto_galeria, 
                        alt_foto_galeria = :alt_foto_galeria, 
                        status_galeria = :status_galeria 
                    WHERE id_galeria = :id_galeria";

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id_galeria', $galerias[$index]['id_galeria'], PDO::PARAM_INT);
            } else {
                $sql = "INSERT INTO tbl_galeria (foto_galeria, alt_foto_galeria, status_galeria, id_produto) 
                    VALUES (:foto_galeria, :alt_foto_galeria, :status_galeria, :id_produto)";

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':id_produto', $id, PDO::PARAM_INT);
            }

            $stmt->bindValue(':foto_galeria', $arquivo);
            $stmt->bindValue(':alt_foto_galeria', $alt_galeria[$index]);
            $stmt->bindValue(':status_galeria', 'Ativo');
            $stmt->execute();
        }

        return true;
    }


    public function existeEsseProduto($link)
    {
        $sql = "SELECT COUNT(*) as total from tbl_produto WHERE link_produto = :link";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['total'] > 0;
    }

    public function getProdutoAleatorio($limite = 3)
    {
        $sql = "SELECT 
                tbl_produto.*, 
                GROUP_CONCAT(tbl_galeria.foto_galeria SEPARATOR ',') AS imagens
            FROM tbl_produto 
            LEFT JOIN tbl_galeria ON tbl_produto.id_produto = tbl_galeria.id_produto
            WHERE status_produto = 'Ativo' 
            GROUP BY tbl_produto.id_produto
            ORDER BY RAND() 
            LIMIT :limite";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutoById($id)
    {
        $sql = "SELECT p.*, 
        GROUP_CONCAT(DISTINCT g.foto_galeria ORDER BY g.id_galeria SEPARATOR ',') AS imagens
        FROM tbl_produto p
        LEFT JOIN tbl_galeria g ON p.id_produto = g.id_produto 
        WHERE p.id_produto = :id_produto
        GROUP BY p.id_produto;";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_produto', $id, PDO::PARAM_INT);
        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        $produto['imagens'] = $produto && $produto['imagens'] ? explode(',', $produto['imagens']) : [];

        // var_dump($produto);
        // exit(); 

        return $produto;
    }
}

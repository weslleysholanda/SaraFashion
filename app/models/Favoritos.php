<?php

class Favoritos extends Model
{
    public function verificarFavorito($id_cliente, $id_produto)
    {
        $sql = "SELECT * FROM tbl_favorito WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_produto' => $id_produto
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ativarFavorito($id_cliente, $id_produto)
    {
        $sql = "UPDATE tbl_favorito SET status_favorito = 'ativo' 
                WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_produto' => $id_produto
        ]);
    }

    public function desativarFavorito($id_cliente, $id_produto)
    {
        $sql = "UPDATE tbl_favorito SET status_favorito = 'inativo' 
                WHERE id_cliente = :id_cliente AND id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_produto' => $id_produto
        ]);
    }

    public function inserirFavorito($id_cliente, $id_produto)
    {
        $sql = "INSERT INTO tbl_favorito (id_produto, id_cliente, status_favorito) 
                VALUES (:id_produto, :id_cliente, 'ativo')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_produto' => $id_produto,
            ':id_cliente' => $id_cliente
        ]);
    }

    public function listarFavoritos($id_cliente)
    {
        $sql = "SELECT 
                p.*, 
                g.foto_galeria, 
                g.alt_foto_galeria 
            FROM tbl_produto p
            INNER JOIN tbl_favorito f ON p.id_produto = f.id_produto
            INNER JOIN tbl_galeria g ON g.id_produto = p.id_produto
            WHERE 
                f.id_cliente = :id_cliente 
                AND f.status_favorito = 'ativo'
                AND g.status_galeria = 'ativo'
            GROUP BY p.id_produto
            ORDER BY f.id_favorito DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_cliente' => $id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php 

class Depoimento extends Model{

    public function getDepoimentoCliente(){
        $sql = "SELECT * FROM tbl_avaliacao INNER JOIN tbl_cliente ON tbl_avaliacao.id_cliente = tbl_cliente.id_cliente INNER JOIN tbl_servico ON tbl_avaliacao.id_servico = tbl_servico.id_servico Where status_avaliacao = 'Aprovado' AND nota_avaliacao >= 4";
        $stmt = $this ->db -> query($sql);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListarDepoimento(){
        $sql = "SELECT * FROM tbl_avaliacao INNER JOIN tbl_cliente ON tbl_avaliacao.id_cliente = tbl_cliente.id_cliente INNER JOIN tbl_servico ON tbl_avaliacao.id_servico = tbl_servico.id_servico Where status_avaliacao = 'Aprovado'";
        $stmt = $this ->db -> query($sql);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
}
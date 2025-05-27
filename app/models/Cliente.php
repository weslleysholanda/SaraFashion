<?php

class Cliente extends Model
{


    public function buscarCliente($email)
    {
        $sql =  "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $datAdm = new DateTime($resultado['membro_desde']);

            $fmt = new IntlDateFormatter(
                'pt_BR', // Localidade para português do Brasil
                IntlDateFormatter::NONE,
                IntlDateFormatter::NONE,
                'UTC', // Ou use date_default_timezone_get() se preferir
                IntlDateFormatter::GREGORIAN,
                "dd MMM yyyy" // Dia, mês abreviado, ano
            );

            $resultado['membro_desde'] = 'Membro Desde ' . $fmt->format($datAdm);
        }

        return $resultado;
    }

    // public function getCliente($email)
    // {
    //     $sql = "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'";

    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    //     $stmt->execute();

    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getlistarCliente()
    {
        $sql = "SELECT * FROM tbl_cliente WHERE status_cliente = 'Ativo';";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCliente($dados)
    {
        $sql = "INSERT INTO tbl_cliente (
            nome_cliente,
            tipo_cliente,
            cpf_cnpj_cliente,
            data_nasc_cliente,
            email_cliente,
            senha_cliente,
            foto_cliente,
            alt_foto_cliente,
            telefone_cliente,
            endereco_cliente,
            bairro_cliente,
            cidade_cliente,
            status_cliente
        ) VALUES (
            :nome_cliente,
            :tipo_cliente,
            :cpf_cnpj_cliente,
            :data_nasc_cliente,
            :email_cliente,
            :senha_cliente,
            :foto_cliente,
            :alt_foto_cliente,
            :telefone_cliente,
            :endereco_cliente,
            :bairro_cliente,
            :cidade_cliente,
            :status_cliente
        )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':tipo_cliente', $dados['tipo_cliente']);
        $stmt->bindValue(':cpf_cnpj_cliente', $dados['cpf_cnpj_cliente']);
        $stmt->bindValue(':data_nasc_cliente', $dados['data_nasc_cliente']);
        $stmt->bindValue(':email_cliente', $dados['email_cliente']);
        $stmt->bindValue(':senha_cliente', $dados['senha_cliente']);
        $stmt->bindValue(':foto_cliente', $dados['foto_cliente']);
        $stmt->bindValue(':alt_foto_cliente', $dados['alt_foto_cliente']);
        $stmt->bindValue(':telefone_cliente', $dados['telefone_cliente']);
        $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
        $stmt->bindValue(':bairro_cliente', $dados['bairro_cliente']);
        $stmt->bindValue(':cidade_cliente', $dados['cidade_cliente']);
        $stmt->bindValue(':status_cliente', $dados['status_cliente']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function cadastrarCliente($nome, $email, $senha)
    {
        $sql = "INSERT INTO tbl_cliente (nome_cliente, email_cliente, senha_cliente, status_cliente)
                VALUES (:nome, :email, :senha, :status)";

        $stmt = $this->db->prepare($sql);

        // Bind das variáveis
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':status', 'Ativo');


        return $stmt->execute();
    }

    public function atualizarCliente($id, $dados)
    {
        $sql = "UPDATE tbl_cliente SET 
                nome_cliente = :nome_cliente,
                tipo_cliente = :tipo_cliente,
                cpf_cnpj_cliente = :cpf_cnpj_cliente,
                data_nasc_cliente = :data_nasc_cliente,
                email_cliente = :email_cliente,
                alt_foto_cliente = :alt_foto_cliente,
                telefone_cliente = :telefone_cliente,
                endereco_cliente = :endereco_cliente,
                bairro_cliente = :bairro_cliente,
                cidade_cliente = :cidade_cliente";

        if (!empty($dados['foto_cliente'])) {
            $sql .= ", foto_cliente = :foto_cliente";
        }

        if (!empty($dados['senha_cliente'])) {
            $sql .= ", senha_cliente = :senha_cliente";
        }

        $sql .= " WHERE id_cliente = :id_cliente";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id);
        $stmt->bindValue(':nome_cliente', $dados['nome_cliente']);
        $stmt->bindValue(':tipo_cliente', $dados['tipo_cliente']);
        $stmt->bindValue(':cpf_cnpj_cliente', $dados['cpf_cnpj_cliente']);
        $stmt->bindValue(':data_nasc_cliente', $dados['data_nasc_cliente']);
        $stmt->bindValue(':email_cliente', $dados['email_cliente']);
        $stmt->bindValue(':telefone_cliente', $dados['telefone_cliente']);
        $stmt->bindValue(':endereco_cliente', $dados['endereco_cliente']);
        $stmt->bindValue(':bairro_cliente', $dados['bairro_cliente']);
        $stmt->bindValue(':cidade_cliente', $dados['cidade_cliente']);
        $stmt->bindValue(':alt_foto_cliente', $dados['alt_foto_cliente']);

        if (!empty($dados['foto_cliente'])) {
            $stmt->bindValue(':foto_cliente', $dados['foto_cliente']);
        }

        if (!empty($dados['senha_cliente'])) {
            $stmt->bindValue(':senha_cliente', $dados['senha_cliente']);
        }

        return $stmt->execute();
    }


    public function desativarCliente($id)
    {
        $sql = "UPDATE tbl_cliente SET status_cliente = 'Inativo' WHERE id_cliente= :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ativarCliente($id)
    {
        $sql = "UPDATE tbl_cliente SET status_cliente = 'Ativo' WHERE id_cliente= :id_cliente";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getClientesByStatus($status)
    {
        $sql = "SELECT * FROM tbl_cliente WHERE status_cliente = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarClientePorId($id)
    {
        $sql = "SELECT * FROM tbl_cliente WHERE id_cliente = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fidelidadeCliente($id)
    {
        $sql = "SELECT 
                c.nome_cliente,
                COALESCE(f.id_fidelidade) AS id_fidelidade,
                COALESCE(f.pontos_acumulados_fidelidade, 0) AS pontos_acumulados_fidelidade
                FROM tbl_cliente c
                LEFT JOIN tbl_fidelidade f ON c.id_cliente = f.id_cliente
                WHERE c.id_cliente = :id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

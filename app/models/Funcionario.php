<?php


class Funcionario extends Model
{

    public function buscarFuncionario($email)
    {
        $sql =  "SELECT * FROM tbl_funcionario WHERE email_funcionario = :email AND status_funcionario = 'Ativo'  ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getListarFuncionario()
    {
        $sql = "SELECT * FROM tbl_funcionario INNER JOIN tbl_especialidade ON tbl_funcionario.id_especialidade = tbl_especialidade.id_especialidade WHERE status_funcionario = 'Ativo';";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFuncionario($dados)
    {
        $sql = "INSERT INTO tbl_funcionario (
        nome_funcionario,
        tipo_funcionario,
        cpf_cnpj_funcionario,
        data_adm_funcionario,
        email_funcionario,
        senha_funcionario,
        foto_funcionario,
        alt_foto_funcionario,
        telefone_funcionario,
        endereco_funcionario,
        bairro_funcionario,
        cidade_funcionario,
        cargo_funcionario,
        id_especialidade,
        salario_funcionario,
        status_funcionario
        ) VALUES (
        :nome_funcionario,
        :tipo_funcionario,
        :cpf_cnpj_funcionario,
        :data_adm_funcionario,
        :email_funcionario,
        :senha_funcionario,
        :foto_funcionario,
        :alt_foto_funcionario,
        :telefone_funcionario,
        :endereco_funcionario,
        :bairro_funcionario,
        :cidade_funcionario,
        :cargo_funcionario,
        :id_especialidade,
        :salario_funcionario,
        :status_funcionario
        )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_funcionario', $dados['nome_funcionario']);
        $stmt->bindValue(':tipo_funcionario', $dados['tipo_funcionario']);
        $stmt->bindValue(':cpf_cnpj_funcionario', $dados['cpf_cnpj_funcionario']);
        $stmt->bindValue(':data_adm_funcionario', $dados['data_adm_funcionario']);
        $stmt->bindValue(':email_funcionario', $dados['email_funcionario']);
        $stmt->bindValue(':senha_funcionario', password_hash($dados['senha_funcionario'], PASSWORD_DEFAULT));
        $stmt->bindValue(':foto_funcionario', $dados['foto_funcionario']);
        $stmt->bindValue(':alt_foto_funcionario', $dados['alt_foto_funcionario']);
        $stmt->bindValue(':telefone_funcionario', $dados['telefone_funcionario']);
        $stmt->bindValue(':endereco_funcionario', $dados['endereco_funcionario']);
        $stmt->bindValue(':bairro_funcionario', $dados['bairro_funcionario']);
        $stmt->bindValue(':cidade_funcionario', $dados['cidade_funcionario']);
        $stmt->bindValue(':cargo_funcionario', $dados['cargo_funcionario']);
        $stmt->bindValue(':id_especialidade', $dados['id_especialidade'], PDO::PARAM_INT);
        $stmt->bindValue(':salario_funcionario', $dados['salario_funcionario']);
        $stmt->bindValue(':status_funcionario', $dados['status_funcionario']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }
}

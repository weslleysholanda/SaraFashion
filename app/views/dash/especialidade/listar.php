<h1>Listar Especialidade</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Especialidade</th>
            <th scope="col">Editar</th>
            <th scope="col">Desativar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listarEspecialidade as $linha): ?>
            <tr>
                <td><?php echo $linha['nome_especialidade'] ?></td>
                <td><i id="btn-primary" class="bi bi-pencil"></i></td>
                <td><i id="btn-secundary" class="bi bi-trash"></i></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-users"></i> Clientes</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <a href="<?php echo site_url('clientes/cadastro'); ?>" class="btn btn-primary btn-block" role="button"><i class="fas fa-user-plus"></i> Novo cliente</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cpf</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        listarClientes()
    })

    const listarClientes = () => {
        $.ajax({
            url : "<?php echo site_url('clientes/listar'); ?>",
            type : 'get'
        })
        .done(function(response){
            let clientes = JSON.parse(response)
            $(clientes).each(function () {
                $("tbody").append(`
                    <tr id="cliente-${this.id}">
                        <td>${this.nome}</td>
                        <td>${this.cpf}</td>
                        <td>${this.sexo}</td>
                        <td>${this.email}</td>
                        <td>
                            <a href="<?php echo site_url("clientes/editar"); ?>/${this.id}" class="btn btn-warning btn-sm btn-tr" role="button"><i class="fas fa-edit"></i></a>
                            <button type="button" onclick="confirmarRemocao(${this.id}, '${this.nome}')" class="btn btn-danger btn-sm btn-tr" role="button"><i class="fas fa-times-circle"></i></a>
                        </td>
                    </tr>
                `);
            })
        })
        .fail(function(jqXHR){
            bloquearCampos(false)
            exception(jqXHR)
        })
    }

    const confirmarRemocao = (id, nome) => {
        makeModal({
            titulo: `Remover cliente`,
            mensagem: `Deseja realmente remover o cliente ${nome}?`,
            footer: `
                <button onclick="removerCliente(${id})" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            `
        })
    }

    const removerCliente = id => {
        $.ajax({
            url : "<?php echo site_url('clientes/remover'); ?>",
            type : 'post',
            data : {
                id
            },
        })
        .done(function(response){
            $(`#cliente-${id}`).remove()
        })
        .fail(function(jqXHR){
            exception(jqXHR)
        })
    }
</script>
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
        $.ajax({
            url : "<?php echo site_url('clientes/lista'); ?>",
            type : 'get'
        })
        .done(function(response){
            let clientes = JSON.parse(response)
            $(clientes).each(function () {
                $("tbody").append(`
                    <tr>
                        <td>${this.nome}</td>
                        <td>${this.cpf}</td>
                        <td>${this.sexo}</td>
                        <td>${this.email}</td>
                        <td>
                            <a href="<?php echo site_url("clientes/editar"); ?>/${this.id}" class="btn btn-warning btn-sm btn-tr" role="button"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-tr" role="button"><i class="fas fa-times-circle"></i></a>
                        </td>
                    </tr>
                `);
            })
        })
        .fail(function(jqXHR){
            bloquearCampos(false)
            exception(jqXHR)
        })
    })
</script>
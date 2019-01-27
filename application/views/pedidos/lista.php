<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-shopping-cart"></i> Pedidos</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <a href="<?php echo site_url('pedidos/cadastro'); ?>" class="btn btn-primary btn-block" role="button"><i class="fas fa-cart-plus"></i> Novo pedido</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Forma de Pagamento</th>
                    <th scope="col">Observação</th>
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
        listarPedidos()
    })

    const listarPedidos = () => {
        $.ajax({
            url : "<?php echo site_url('pedidos/listar'); ?>",
            type : 'get'
        })
        .done(function(response){
            let pedidos = JSON.parse(response)
            $(pedidos).each(function () {
                $("tbody").append(`
                    <tr id="pedido-${this.id}">
                        <td>${formataData(this.data, 'dd/mm/yyyy')}</td>
                        <td>${this.nome}</td>
                        <td>${this.forma_pagamento}</td>
                        <td>${this.observacao}</td>
                        <td>
                        <a href="<?php echo site_url("pedidos/imprimir"); ?>/${this.id}" class="btn btn-danger btn-sm btn-tr" role="button"><i class="fas fa-file-pdf"></i></a>
                        <a href="<?php echo site_url("pedidos/enviarEmail"); ?>/${this.id}" class="btn btn-info btn-sm btn-tr" role="button"><i class="fas fa-paper-plane"></i></a>
                            <a href="<?php echo site_url("pedidos/editar"); ?>/${this.id}" class="btn btn-warning btn-sm btn-tr" role="button"><i class="fas fa-edit"></i></a>
                            <button type="button" onclick="confirmarRemocao(${this.id})" class="btn btn-danger btn-sm btn-tr" role="button"><i class="fas fa-times-circle"></i></a>
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

    const confirmarRemocao = id => {
        makeModal({
            titulo: `Remover pedido`,
            mensagem: `Todos os registros do pedido serão perdidos. Deseja realmente remover este pedido?`,
            footer: `
                <button onclick="removerPedido(${id})" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            `
        })
    }

    const removerPedido = id => {
        console.log(id)
        $.ajax({
            url : "<?php echo site_url('pedidos/remover'); ?>",
            type : 'post',
            data : {
                id
            },
        })
        .done(function(response){
            $(`#pedido-${id}`).remove()
        })
        .fail(function(jqXHR){
            exception(jqXHR)
        })
    }
</script>
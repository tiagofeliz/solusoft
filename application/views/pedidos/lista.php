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
                            <a href="<?php echo site_url("pedidos/imprimirPedido"); ?>/${this.id}" class="btn btn-danger btn-sm btn-tr" role="button" target="blank"><i class="fas fa-file-pdf"></i></a>
                            <button onclick="confirmarEnvio(${this.id})" class="btn btn-secondary btn-sm btn-tr" role="button"><i class="fas fa-paper-plane"></i></button>
                            <a href="<?php echo site_url("pedidos/detalhes"); ?>/${this.id}" class="btn btn-info btn-sm btn-tr" role="button" target="blank"><i class="fas fa-eye"></i></a>
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

    const confirmarEnvio = id => {
        makeModal({
            titulo: `Enviar pedido ao cliente`,
            mensagem: `Os dados do pedido serão enviados ao cliente através do endereço de email cadastrado.`,
            footer: `
                <button onclick="enviarEmail(${id})" type="button" class="btn btn-primary" data-dismiss="modal">Enviar pedido</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar envio</button>
            `
        })
    }

    const enviarEmail = id => {
        console.log(id)
        $.ajax({
            url : "<?php echo site_url('pedidos/enviaPedidoEmail'); ?>",
            type : 'post',
            data : {
                id
            },
            beforeSend : function(){
                makeToast({
                    titulo: 'Enviando...',
                    mensagem: `Os dados estão sendo preparados e logo após serão enviados`
                })
            }
        })
        .done(function(response){
            makeToast({
                titulo: 'Pedido enviado',
                mensagem: `O pedido foi enviado ao cliente com sucesso.`
            })
        })
        .fail(function(jqXHR){
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
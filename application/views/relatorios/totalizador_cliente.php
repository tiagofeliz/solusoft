<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-chart-bar"></i> Totalizador por cliente</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button onclick="listarPedidos()" type="button" class="btn btn-primary btn-block" role="button"><i class="fas fa-search"></i> Buscar</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <div class="col-lg-4">
            <label>Cliente</label>
            <div class="input-group">
                <input disabled="" name="cliente" id="cliente" class="form-control" />
                <div class="input-group-append">
                    <button data-toggle="modal" data-target="#selecionar-cliente" class="btn btn-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <label>ㅤ</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Valor Total: </div>
                </div>
                <input id="valor-total" disabled="" type="text" class="form-control" value="R$ 0,00" />
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="pedidos">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Forma de Pagamento</th>
                        <th scope="col">Observação</th>
                        <th scope="col">Valor Total</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Clientes -->
    <div class="modal fade" id="selecionar-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Selecione o cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        listarClientes()
    })

    let cliente = {
        id: null,
        nome: null
    }

    let totalizadorCliente = 0

    const listarPedidos = () => {
        $.ajax({
            url : "<?php echo site_url('pedidos/filtrar'); ?>",
            type : 'post',
            data: cliente
        })
        .done(function(response){
            //Resetando linhas da tabela
            $("#pedidos tbody").html("")
            //Resetando totalizador
            totalizadorCliente = 0

            let pedidos = JSON.parse(response)
            $(pedidos).each(function () {
                buscarPedido(this.id)
            })
        })
        .fail(function(jqXHR){
            bloquearCampos(false)
            exception(jqXHR)
        })
    }

    const buscarPedido = id => {
        $.ajax({
            url : `<?php echo site_url('pedidos/buscarPedido'); ?>/${id}`,
            type : 'get'
        })
        .done(function(response){
            let pedido = JSON.parse(response)
            $("#pedidos tbody").append(`
                <tr id="pedido-${pedido.id}">
                    <td>${formataData(pedido.data, 'dd/mm/yyyy')}</td>
                    <td>${pedido.nome}</td>
                    <td>${pedido.forma_pagamento}</td>
                    <td>${pedido.observacao}</td>
                    <td>${adicionarMascaraDinheiro(calculaValor(pedido.produtos))}</td>
                    <td>
                        <a data-toggle="tooltip" data-placement="bottom" title="PDF" href="<?php echo site_url("pedidos/imprimirPedido"); ?>/${pedido.id}" class="btn btn-danger btn-sm btn-tr" role="button" target="blank"><i class="fas fa-file-pdf"></i></a>
                        <button data-toggle="tooltip" data-placement="bottom" title="Eviar e-mail" onclick="confirmarEnvio(${pedido.id})" class="btn btn-secondary btn-sm btn-tr" role="button"><i class="fas fa-paper-plane"></i></button>
                        <a data-toggle="tooltip" data-placement="bottom" title="Detalhes" href="<?php echo site_url("pedidos/detalhes"); ?>/${pedido.id}" class="btn btn-info btn-sm btn-tr" role="button" target="blank"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            `);

            $('[data-toggle="tooltip"]').tooltip()
        })
        .fail(function(jqXHR){
            bloquearCampos(false)
            exception(jqXHR)
        })
    }

    const listarClientes = () => {
        $.ajax({
            url : "<?php echo site_url('clientes/listar'); ?>",
            type : 'get'
        })
        .done(function(response){
            let clientes = JSON.parse(response)
            $(clientes).each(function () {
                $("#selecionar-cliente tbody").append(`
                    <tr id="cliente-${this.id}">
                        <td>${this.nome}</td>
                        <td>${this.cpf}</td>
                        <td>${this.sexo}</td>
                        <td>${this.email}</td>
                        <td>
                            <button type="button" onclick="selecionarCliente(${this.id}, '${this.nome}')" class="btn btn-primary btn-sm btn-tr" role="button" data-dismiss="modal"><i class="fas fa-check"></i></a>
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

    const selecionarCliente = (id, nome) => {
        cliente.id = id
        cliente.nome = nome

        $('#cliente').val(nome)
        listarPedidos()
    }

    const calculaValor = produtos => {
        let valorTotal = 0
        produtos.forEach(function (elem){
            valorTotal += (elem.quantidade * elem.valor)
        })
        // Agregando totalizador
        totalizadorCliente += valorTotal

        totalCliente()

        return valorTotal
    }

    const totalCliente = () => {
        $("#valor-total").val(adicionarMascaraDinheiro(totalizadorCliente))
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
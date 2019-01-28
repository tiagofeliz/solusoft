<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-chart-bar"></i> Relatório de Pedidos</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button onclick="listarPedidos()" type="button" class="btn btn-primary btn-block" role="button"><i class="fas fa-search"></i> Buscar</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <div class="col-lg-2">
            <label>Data Inicial</label>
            <input name="data-inicial" class="form-control data" id="data-inicial" placeholder="00/00/0000"/>
        </div>
        <div class="col-lg-2">
            <label>Data Final</label>
            <input name="data-final" class="form-control data" id="data-final" placeholder="00/00/0000"/>
        </div>
    </div>
    <hr>
    <div class="row">
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
</div>

<script>
    const listarPedidos = () => {
        if($('#data-inicial').val() != "" && $('#data-final').val() != ""){
            let dataInicial = formataData($('#data-inicial').val(), 'yyyy-mm-dd')
            let dataFinal = formataData($('#data-final').val(), 'yyyy-mm-dd')
            $.ajax({
                url : "<?php echo site_url('pedidos/filtrar'); ?>",
                type : 'post',
                data: {
                    dataInicial,
                    dataFinal
                }
            })
            .done(function(response){
                $("tbody").html("")
                let pedidos = JSON.parse(response)
                $(pedidos).each(function () {
                    buscarPedido(this.id)
                })
            })
            .fail(function(jqXHR){
                bloquearCampos(false)
                exception(jqXHR)
            })
        }else{
            makeModal({
                titulo: `Atenção`,
                mensagem: `Preencha corretamente os dados para a busca.`
            })
        }
    }

    const buscarPedido = id => {
        $.ajax({
            url : `<?php echo site_url('pedidos/buscarPedido'); ?>/${id}`,
            type : 'get'
        })
        .done(function(response){
            let pedido = JSON.parse(response)
            $("tbody").append(`
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

    const calculaValor = produtos => {
        let valorTotal = 0
        produtos.forEach(function (elem){
            valorTotal += (elem.quantidade * elem.valor)
        })
        return valorTotal
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
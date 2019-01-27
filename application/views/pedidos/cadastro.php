<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-cart-plus"></i> Novo Pedido</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button id="salvar" type="button" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Valor Total: </div>
                </div>
                <input id="valor-total" disabled="" type="text" class="form-control" value="R$ 0,00" />
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Total de Itens: </div>
                </div>
                <input id="quantidade-total" disabled="" type="text" class="form-control" value="0" />
            </div>
        </div>
    </div>
    <hr>
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
        <div class="col-lg-3" data-provide="datepicker">
            <label for="data">Data</label>
            <input name="data" class="form-control data" id="data" placeholder="00/00/0000">
        </div>
        <div class="col-lg-3">
            <label for="forma_pagamento">Forma de Pagamento</label>
            <select name="forma_pagamento" class="form-control" id="forma_pagamento">
                <option value="">Selecione</option>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Boleto">Boleto</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label for="tamanho">ㅤ</label>
            <button data-toggle="modal" data-target="#selecionar-produto" type="button" class="btn btn-secondary btn-block"><i class="fas fa-plus-square"></i> Produto</a>
        </div>
    </div>
    <br>
    <div class="row" style="overflow-y: auto">
        <div class="col-lg-12" id="produtos">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Cor</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Valor Unitário</th>
                            <th scope="col" style="width: 5%">Quantidade</th>
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
    <hr>
    <div class="row">
        <div class="col">
            <label for="observacao">Observação</label>
            <textarea name="observacao" class="form-control" id="observacao" rows="3"></textarea>
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

    <!-- Modal Produtos -->
    <div class="modal fade" id="selecionar-produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Selecione o produto</h5>
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
                                    <th scope="col">Cor</th>
                                    <th scope="col">Tamanho</th>
                                    <th scope="col">Valor</th>
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

    let cliente = {
        id: null,
        nome: null
    }

    let produtos = []

    let index_produto = 0

    $(document).ready(function () {
        listarClientes()
        listarProdutos()
    })

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
    }

    const listarProdutos = () => {
        $.ajax({
            url : "<?php echo site_url('produtos/listar'); ?>",
            type : 'get'
        })
        .done(function(response){
            let produtos = JSON.parse(response)
            $(produtos).each(function () {
                $("#selecionar-produto tbody").append(`
                    <tr>
                        <td>${this.nome}</td>
                        <td>${this.cor}</td>
                        <td>${this.tamanho}</td>
                        <td>${adicionarMascaraDinheiro(this.valor)}</td>
                        <td>
                            <button type="button" onclick="selecionarProduto(${this.id}, '${this.nome}', '${this.cor}', '${this.tamanho}', ${this.valor})" class="btn btn-primary btn-sm btn-tr" role="button" data-dismiss="modal"><i class="fas fa-check"></i></a>
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

    const selecionarProduto = (id, nome, cor, tamanho, valor) => {

        produtos[index_produto] = {
            id,
            nome,
            cor,
            tamanho,
            valor,
            quantidade: 0
        }

        $("#produtos tbody").append(`
            <tr id="produto-${index_produto}" data-index-produto="${index_produto}">
                <td>${nome}</td>
                <td>${cor}</td>
                <td>${tamanho}</td>
                <td>${adicionarMascaraDinheiro(valor)}</td>
                <td><input type="number" onchange="alterarValor(this, ${index_produto})" class="text-center form-control apenas-numeros" value="0" /></td>
                <td class="total-produto">${adicionarMascaraDinheiro(0)}</td>
                <td>
                    <button type="button" onclick="confirmarRemocao(${index_produto})" class="btn btn-danger btn-sm btn-tr" role="button"><i class="fas fa-times-circle"></i></a>
                </td>
            </tr>
        `);

        $('.apenas-numeros').keypress(function (event) {
            var tecla = (window.event) ? event.keyCode : event.which;
            if ((tecla > 47 && tecla < 58))
                return true;
            else {
                if (tecla != 8){
                    makeToast({
                        titulo: "Atenção",
                        mensagem: "Para a quantidade do produto, você deve inserir apenas dígitos válidos"
                    })
                    return false;
                } else {
                    return true;
                }
            }
        });

        index_produto++

        atualizarInformacoesGlobais()
    }

    const confirmarRemocao = index_selecionado => {
        makeModal({
            titulo: `Remover produto`,
            mensagem: `Deseja realmente remover do pedido o produto ${produtos[index_selecionado].nome}?`,
            footer: `
                <button onclick="removerProduto(${index_selecionado})" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            `
        })
    }

    const removerProduto = index_selecionado => {
        $(`#produto-${index_selecionado}`).remove()
        delete produtos[index_selecionado]
        atualizarInformacoesGlobais()
    }

    const alterarValor = (input, index_selecionado) => {
        let quantidade = parseInt($(input).val())
        if(quantidade < 0){
            $(input).val(0).change()
        }else{
            produtos[index_selecionado].quantidade = parseInt($(input).val())
            $(`#produto-${index_selecionado} .total-produto`).text(adicionarMascaraDinheiro(produtos[index_selecionado].quantidade * produtos[index_selecionado].valor))
        }
        atualizarInformacoesGlobais()
    }

    const atualizarInformacoesGlobais = () => {
        let valorTotal = 0
        let quantidadeTotal = 0
        $('#produtos tbody tr').each(function(){
            let index_produto = $(this).attr('data-index-produto')
            quantidadeTotal += produtos[index_produto].quantidade
            valorTotal += produtos[index_produto].valor * produtos[index_produto].quantidade
            console.log(valorTotal)
        })
        $('#valor-total').val(adicionarMascaraDinheiro(valorTotal))
        $('#quantidade-total').val(quantidadeTotal)
    }

    $('#salvar').click(function (){

        let pedido = []
        pedido['cliente'] = cliente
        pedido['produtos'] = produtos
        pedido['data'] = $('#data').val()
        pedido['forma_pagamento'] = $('#forma_pagamento').val()
        pedido['observacao'] = $('#forma_pagamento').val()

        console.log(pedido)
        if(validaPedido(pedido)){
            alert('ok')
            // incluirProduto(pedido)
        }else{
            makeToast({
                titulo: "Atenção",
                mensagem: "Preencha todos os campos para cadastrar o produto"
            })
        }
    })

    const validaPedido = pedido => {
        // validando cliente
        if(pedido['cliente'].id == null){
            return false
        }

        // validando produtos
        pedido['produtos'] = pedido['produtos'].filter(function (elem, i, array) {
            return elem !== undefined
        })
        if(pedido['produtos'].length <= 0) {
            return false
        }

        // validando demais dados
        if(pedido['data'] == "" || pedido['forma_pagamento'] == ""){
            return false
        }

        return true
    }

    const incluirPedido = pedido => {
        $.ajax({
            url : "<?php echo site_url('pedidos/incluir'); ?>",
            type : 'post',
            data : pedido,
            beforeSend : function(){
                bloquearCampos(true)
                makeToast({
                    titulo: 'Enviando...',
                    mensagem: `Os dados estão sendo verificados e enviados`
                })
            }
        })
        .done(function(response){
            makeModal({
                titulo: 'Sucesso',
                mensagem: `O pedido foi realizado com sucesso`,
                hidden: function (e) {
                    window.location.href='<?php echo site_url("produtos"); ?>'
                }
            })
        })
        .fail(function(jqXHR){
            bloquearCampos(false)
            exception(jqXHR)
        })
    }
</script>
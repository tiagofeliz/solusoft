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
                <input disabled="" type="text" class="form-control" value="R$ 0,00" />
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Total de Itens: </div>
                </div>
                <input disabled="" type="text" class="form-control" value="0" />
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-4">
            <label>Cliente</label>
            <div class="input-group">
                <input disabled="" type="text" class="form-control" />
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
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Cor</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Valor Unitário</th>
                            <th scope="col">Quantidade</th>
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
    $(document).ready(function () {
        $('#valor').maskMoney({prefix: 'R$ ', thousands: '.', decimal: ',', allowZero: true})
    })

    $('#salvar').click(function (){

        let valor = ($('#valor').val() == "") ? 0 : removerMascaraDinheiro($('#valor').val())

        let produto = {
            nome: $('#nome').val(),
            tamanho: $('#tamanho').val(),
            cor: $('#cor').val(),
            valor
        }
        
        if(validaProduto(produto)){
            incluirProduto(produto)
        }else{
            makeToast({
                titulo: "Atenção",
                mensagem: "Preencha todos os campos para cadastrar o produto"
            })
        }
    })

    const validaProduto = ({nome, tamanho, cor}) => {
        if(nome == "" || tamanho == "" || cor == ""){
            return false
        }
        return true
    }

    const incluirProduto = produto => {
        $.ajax({
            url : "<?php echo site_url('produtos/incluir'); ?>",
            type : 'post',
            data : produto,
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
                mensagem: `O produto ${produto.nome} foi cadastrado com sucesso`,
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
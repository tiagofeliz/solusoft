<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-cubes"></i> Produtos</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <a href="<?php echo site_url('produtos/cadastro'); ?>" class="btn btn-primary btn-block" role="button"><i class="fas fa-plus-square"></i> Novo produto</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
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

<script>
    $(document).ready(function () {
        listarProdutos()
    })

    const listarProdutos = () => {
        $.ajax({
            url : "<?php echo site_url('produtos/listar'); ?>",
            type : 'get'
        })
        .done(function(response){
            let produtos = JSON.parse(response)
            $(produtos).each(function () {
                $("tbody").append(`
                    <tr id="produto-${this.id}">
                        <td>${this.nome}</td>
                        <td>${this.cor}</td>
                        <td>${this.tamanho}</td>
                        <td>${adicionarMascaraDinheiro(this.valor)}</td>
                        <td>
                            <a href="<?php echo site_url("produtos/editar"); ?>/${this.id}" class="btn btn-warning btn-sm btn-tr" role="button"><i class="fas fa-edit"></i></a>
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
            titulo: `Remover produto`,
            mensagem: `Deseja realmente remover o produto ${nome}?`,
            footer: `
                <button onclick="removerProduto(${id})" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            `
        })
    }

    const removerProduto = id => {
        $.ajax({
            url : "<?php echo site_url('produtos/remover'); ?>",
            type : 'post',
            data : {
                id
            },
        })
        .done(function(response){
            if(JSON.parse(response)){
                $(`#produto-${id}`).remove()
            }else{
                makeToast({
                    titulo: `Atenção`,
                    mensagem: `Este produto não pode estar incluídos em pedidos já gravados!`
                })
            }
        })
        .fail(function(jqXHR){
            exception(jqXHR)
        })
    }
</script>
<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-pen-square"></i> Editando produto</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button id="salvar" type="button" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</button>
        <a href="<?php echo site_url('produtos'); ?>" role="button" class="btn btn-danger btn-block btn-tr"><i class="fas fa-arrow-left"></i> Cancelar Edição</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <input type="hidden" name="id" id="id" value="<?php echo $produto->id; ?>" />
        <div class="col-lg-3">
            <label for="nome">Nome</label>
            <input name="nome" class="form-control" id="nome" placeholder="Ex.: Samsung QLed" value="<?php echo $produto->nome; ?>">
        </div>
        <div class="col-lg-3">
            <label for="cor">Cor</label>
            <input name="cor" class="form-control" id="cor" placeholder="Ex.: Preta" value="<?php echo $produto->cor; ?>">
        </div>
        <div class="col-lg-2">
            <label for="tamanho">Tamanho</label>
            <input name="tamanho" class="form-control" id="tamanho" placeholder='Ex.: 50"' value="<?php echo $produto->tamanho; ?>">
        </div>
        <div class="col-lg-2">
            <label for="valor">Valor</label>
            <input name="valor" class="form-control" id="valor" placeholder='Ex.: R$ 0,00' value="<?php echo formataValor($produto->valor); ?>">
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
            id: $('#id').val(),
            nome: $('#nome').val(),
            tamanho: $('#tamanho').val(),
            cor: $('#cor').val(),
            valor
        }
        if(validaProduto(produto)){
            editarProduto(produto)
        }else{
            makeToast({
                titulo: "Atenção",
                mensagem: "Preencha todos os campos para editar o produto"
            })
        }
    })
    
    const validaProduto = ({nome, tamanho, cor}) => {
        if(nome == "" || tamanho == "" || cor == ""){
            return false
        }
        return true
    }
    
    const editarProduto = produto => {
        $.ajax({
            url : "<?php echo site_url('produtos/atualizar'); ?>",
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
                mensagem: `O produto ${produto.nome} foi atualizado com sucesso`,
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
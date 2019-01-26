<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-plus-square"></i> Novo produto</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button id="salvar" type="button" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <div class="col-lg-3">
            <label for="nome">Nome</label>
            <input name="nome" class="form-control" id="nome" placeholder="Ex.: Samsung QLed">
        </div>
        <div class="col-lg-3">
            <label for="cor">Cor</label>
            <input name="cor" class="form-control" id="cor" placeholder="Ex.: Preta">
        </div>
        <div class="col-lg-2">
            <label for="tamanho">Tamanho</label>
            <input name="tamanho" class="form-control" id="tamanho" placeholder='Ex.: 50"'>
        </div>
        <div class="col-lg-2">
            <label for="valor">Valor</label>
            <input name="valor" class="form-control" id="valor" placeholder='Ex.: R$ 0,00'>
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
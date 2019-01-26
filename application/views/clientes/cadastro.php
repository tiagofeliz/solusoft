<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-user-plus"></i> Novo cliente</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button id="salvar" type="button" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <div class="col-lg-3">
            <label for="nome">Nome</label>
            <input name="nome" class="form-control" id="nome" placeholder="Ex.: Flavio Augusto da Silva">
        </div>
        <div class="col-lg-3">
            <label for="email">E-Mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Ex.: flavio@example.com">
        </div>
        <div class="col-lg-3">
            <label for="cpf">Cpf</label>
            <input name="cpf" class="form-control" id="cpf" placeholder="000.000.000-00">
        </div>
        <div class="col-lg-3">
            <label for="exampleInputPassword1">Sexo</label>
            <select name="sexo" class="form-control" id="sexo">
                <option value="">Selecione</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Não listado</option>
            </select>
        </div>
    </div>
</div>
<script>
    $('#cpf').mask('999.999.999-99')

    $('#salvar').click(function (){
        let cliente = {
            nome: $('#nome').val(),
            email: $('#email').val(),
            cpf: $('#cpf').val(),
            sexo: $('#sexo').val()
        }

        if(validaCliente(cliente)){
            incluirCliente(cliente)
        }else{
            makeToast({
                titulo: "Atenção",
                mensagem: "Preencha todos os campos para cadastrar o cliente"
            })
        }
    })

    const validaCliente = ({nome, email, cpf, sexo}) => {
        if(nome == "" || email == "" || cpf == "" || sexo == ""){
            return false
        }
        return true
    }

    const incluirCliente = cliente => {
        $.ajax({
            url : "<?php echo site_url('clientes/incluir'); ?>",
            type : 'post',
            data : cliente,
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
                mensagem: `O cliente ${cliente.nome} foi cadastrado com sucesso`,
                hidden: function (e) {
                    window.location.href='<?php echo site_url("clientes"); ?>'
                }
            })
        })
        .fail(function(jqXHR){
            bloquearCampos(false)
            exception(jqXHR)
        })
    }
</script>
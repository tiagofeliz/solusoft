<div class="col-lg-3 col-md-12" id="menu">
    <div class="text-center menu menu-titulo">
        <h4><i class="fas fa-user-edit"></i> Editando cliente</h4>
    </div>
    <div class="text-center menu menu-opcoes">
        <button id="salvar" type="button" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Salvar</button>
        <a href="<?php echo site_url('clientes'); ?>" role="button" class="btn btn-danger btn-block btn-tr"><i class="fas fa-arrow-left"></i> Cancelar Edição</a>
    </div>
</div>
<div class="col-lg-9 col-md-12" id="conteudo">
    <div class="row">
        <input type="hidden" name="id" id="id" value="<?php echo $cliente->id; ?>">
        <div class="col-lg-3">
            <label for="nome">Nome</label>
            <input name="nome" class="form-control" id="nome" placeholder="Ex.: Flavio Augusto da Silva" value="<?php echo $cliente->nome; ?>">
        </div>
        <div class="col-lg-3">
            <label for="email">E-Mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Ex.: flavio@example.com" value="<?php echo $cliente->email; ?>">
        </div>
        <div class="col-lg-3">
            <label for="cpf">Cpf</label>
            <input name="cpf" class="form-control cpf" id="cpf" placeholder="000.000.000-00" value="<?php echo $cliente->cpf; ?>">
        </div>
        <div class="col-lg-3">
            <label for="exampleInputPassword1">Sexo</label>
            <select name="sexo" class="form-control" id="sexo">
                <option value="">Selecione</option>
                <option value="Masculino" <?php echo ($cliente->sexo == 'Masculino')?'selected':''; ?>>Masculino</option>
                <option value="Feminino" <?php echo ($cliente->sexo == 'Feminino')?'selected':''; ?>>Feminino</option>
                <option value="Não listado" <?php echo ($cliente->sexo == 'Não listado')?'selected':''; ?>>Não listado</option>
            </select>
        </div>
    </div>
</div>
<script>
    $('#salvar').click(function (){
        let cliente = {
            id: $('#id').val(),
            nome: $('#nome').val(),
            email: $('#email').val(),
            cpf: $('#cpf').val(),
            sexo: $('#sexo').val()
        }
        if(validaCliente(cliente)){
            editarCliente(cliente)
        }else{
            makeToast({
                titulo: "Atenção",
                mensagem: "Preencha todos os campos para editar o cliente"
            })
        }
    })
    
    const validaCliente = ({nome, email, cpf, sexo}) => {
        if(nome == "" || email == "" || cpf == "" || sexo == ""){
            return false
        }
        return true
    }
    
    const editarCliente = cliente => {
        $.ajax({
            url : "<?php echo site_url('clientes/atualizar'); ?>",
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
                mensagem: `O cliente ${cliente.nome} foi atualizado com sucesso`,
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
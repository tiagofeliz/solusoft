<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');

            body {
                font-family: 'Montserrat', sans-serif!important;
            }

            #conteudo{
                background: #eee;
                padding: 1em;
            }

            #dados-pedido{
                background: rgba(255, 255, 255, .7);
                padding: .5em;
            }

            .dado{
                margin: .5em auto;
                border-bottom: 1px dashed;
                display: flex;
                justify-content: space-between;
            }

            .dado .dh{
                font-weight: bold;
            }

            .dado .dd{
                text-align: right;
            }

            #produtos-email thead{
                background: #aaa;
            }

            #produtos-email th, #produtos-email td{
                padding: 10px;
            }
            
            #produtos-email tbody tr{
                background: #ddd;
            }

            #observacao-area{
                background: rgba(255, 255, 255, .7);
                padding: .5em;
                min-height: 100px;
            }
        </style>

    </head>
    <body>
        <div id="conteudo">
            <div>
                <h2>Pedido #<?php echo $pedido->id; ?></h2>
            </div>
            <hr>
            <div class="row">
                <div>
                    <h3>Itens do Pedido</h3>
                </div>
            </div>
            <div class="row">
                <div id="produtos-email">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Cor</th>
                                <th scope="col">Tamanho</th>
                                <th scope="col">Valor Unitário</th>
                                <th scope="col" style="width: 5%">Quantidade</th>
                                <th scope="col">Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $quantidadeTotal = 0; ?>
                            <?php $valorTotal = 0; ?>
                            <?php foreach ($pedido->produtos as $produto){ ?>
                            <tr>
                                <td><?php echo $produto->nome; ?></td>
                                <td><?php echo $produto->cor; ?></td>
                                <td><?php echo $produto->tamanho; ?></td>
                                <td><?php echo formataValor($produto->valor); ?></td>
                                <td><?php echo $produto->quantidade; ?></td>
                                <td><?php echo formataValor($produto->quantidade * $produto->valor); ?></td>
                            </tr>
                            <?php $quantidadeTotal += $produto->quantidade; ?>
                            <?php $valorTotal += ($produto->quantidade * $produto->valor); ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div id="dados-pedido">
                <div class="dado">                    
                    <div class="dh">Valor Total: </div>
                    <div class="dd"><?php echo formataValor($valorTotal); ?></div>
                </div>
                <div class="dado">
                    <div class="dh">Total de Itens: </div>
                    <div class="dd"><?php echo $quantidadeTotal; ?></div>
                </div>                
                <div class="dado">
                    <div class="dh">Cliente: </div>
                    <div class="dd"><?php echo $pedido->nome; ?></div>
                </div>
                <div class="dado">       
                    <div class="dh">Data: </div>
                    <div class="dd"><?php echo $pedido->data; ?></div>
                </div>
                <div class="dado">
                    <div class="dh">Forma de Pagamento: </div>
                    <div class="dd"><?php echo $pedido->forma_pagamento; ?></div>
                </div>
            </div>
            <hr>
            <div>                    
                <div>
                    <h3>Observação: </h3>
                </div>
                <div id="observacao-area">
                    <?php echo $pedido->observacao; ?>
                </div>
            </div>
        </div>
    </body>
</html>
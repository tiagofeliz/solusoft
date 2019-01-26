<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Solusoft</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- main css -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" type="text/css">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- bootstrap js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <!-- masked input -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" crossorigin="anonymous"></script>        
    </head>
    <body>
        <div class="">
            <div class="row">
                <!-- menu -->
                <div class="col-sm-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Solusoft</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo site_url('clientes'); ?>"><i class="fas fa-users"></i> Clientes</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo site_url('produtos'); ?>"><i class="fas fa-cubes"></i> Produtos</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo site_url('pedidos'); ?>"><i class="fas fa-shopping-cart"></i> Pedidos</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-chart-bar"></i> Relatórios
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?php echo site_url('relatorios/pedidos'); ?>">Pedidos</a>
                                        <a class="dropdown-item" href="<?php echo site_url('relatorios/totalizadorCliente'); ?>">Totalizador por cliente</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- conteúdo -->
            <div class="row" id="page">
                <?php if(isset($page)) $this->load->view($page); ?>
            </div>
        </div>

        <!-- toast -->
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            <div class="toast-header">
                <strong class="mr-auto">
                    <!-- Titulo -->
                </strong>
                <small class="text-muted">
                    <!-- Descricao -->
                </small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <!-- Mensagem -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalGenerico" tabindex="-1" role="dialog" aria-labelledby="modalGenericoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalGenericoLabel">
                            <!-- Título -->
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Mensagem -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        const exception = request => {
            console.log(request)
            makeToast({
                titulo: "Ocorreu um erro no processo",
                mensagem: `${request.status} - ${request.statusText}`
            })
        }

        const bloquearCampos = bloquear => $('input, select').attr('disabled', bloquear)

        const makeToast = toast => {
            $('.toast .toast-header strong').html(toast.titulo)
            $('.toast .toast-body').html(toast.mensagem)
            $('.toast').toast('show')
        }

        const makeModal = modal => {
            $('.modal .modal-title').html(modal.titulo)
            $('.modal .modal-body').html(modal.mensagem)
            if(modal.footer != undefined){
                $('.modal .modal-footer').html(modal.footer)
            }
            $('#modalGenerico').on('hidden.bs.modal', modal.hidden)
            $('#modalGenerico').modal()
            $('#modalGenerico').modal()
        }
    </script>
</html>
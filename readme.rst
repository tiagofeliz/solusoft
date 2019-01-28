#########################################
Teste para a vaga de programador Solusoft
#########################################

*****************************************************
Criar um sistema que contenha os seguintes cadastros:
*****************************************************

Clientes (Listagem, inclusão, edição e remoção)

-  Código do cliente
-  nome
-  cpf
-  sexo
-  email

Produtos (Listagem, inclusão, edição e remoção)

-  Código do produto
-  nome
-  cor
-  tamanho
-  valor

Pedidos (Listagem, inclusão, edição e remoção)

-  Código do pedido
-  Data do pedido
-  Observação
-  Forma de pagamento ( Dinheiro, Cartão, Cheque )

-  Um pedido deverá ser de um cliente
-  Um pedido deverá conter um ou mais produtos

O pedido terá a opção de enviar para o email do cliente
O pedido terá a opção de ser impresso em PDF

Fazer também os seguintes relatórios:

-  Relatorio de pedidos: contendo os filtros data inicial e data final para poder filtrar todos os pedidos naquele periodo
-  Relatório totalizador por cliente: Ao selecionar um cliente nesse relatório, ele irá buscar todos os pedidos daquele cliente e retornará os pedidos com o valor total no final.

**********
Instalação
**********

-  Clonar o repositório no localhost
-  Na raiz do sistema, incluir as dependências via: **composer install** (caso retorne dependências a resolver, verifique a última seção do readme)
-  Criar o banco de dados de nome solusoft
-  Na raiz do sistema, executar o comando **mysql -u root -p solusoft < solusoft.sql** para importar o script para criação da base de dados
-  Alterar as configurações do arquivo /application/config/database.php com as configurações do servidor MySQL
-  Executar no navegador **localhost/solusoft**

***************************
Ambiente de desenvolvimento
***************************

-  SO Linux Mint 19.1 Cinnamon
-  PHP 7.2.10
-  MySQL 5.5.56
-  Apache2

#######
Atenção
#######

Ao incluir a última versão da biblioteca mPDF utilizando o composer, foi solicitado **PHP 7** ou superior e a instalação das extensões ext-gd e ext-mbstring no PHP.
As dependências foram resolvidas ao instalar as extensões usando: **sudo apt-get install php7.2-gd && sudo apt-get install php-mbstring**

A versão das extensões devem seguir a versão do PHP em execução.

Pode vir a ser necessário após resolver as dependências via composer, dar permissão de escrita na pasta do sistema devido a biblioteca mPDF.

O endereço de email tiagofeliz.solusoft@gmail.com foi criado para o envio do pedido para o email do cliente

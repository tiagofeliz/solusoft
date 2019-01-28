#########################################
Teste para a vaga de programador Solusoft
#########################################

Criar um sistema que contenha os seguintes cadastros:

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
-  Executar o script para criação da base de dados, que se encontra na raiz do sistema, no arquivo solusoft.sql
-  Alterar as configurações do arquivo /application/config/database.php com as configurações do servidor MySQL
-  Executar no navegador localhost/solusoft

****************************
Condições de desenvolvimento
****************************

-  SO Linux Mint 19.1 Cinnamon
-  PHP 7.2.10
-  MySQL 5.5.56

*******
Atenção
*******

Ao incluir a última versão da biblioteca mPDF utilizando o composer, foi solicitada a instalação da extensão ext-gd no PHP.
A dependência foi resolvida ao instalar a extensão usando: sudo apt-get install php7.2-gd

A versão da extensão deve seguir a versão do PHP em execução.
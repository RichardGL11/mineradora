# Descrição do Projeto

## 1. Objetivo Geral
Desenvolver um aplicativo para gerenciar tanto a venda de produtos da A S.OS Areia e Brita quanto a logística de entrega, conectando clientes, administrador da plataforma e caçambeiros. O sistema permitirá que os clientes realizem pedidos diretamente no app, o administrador gere solicitações de frete, e os caçambeiros aceitem e realizem as entregas. O sistema contará com geolocalização para exibição da rota do frete e integração com meios de pagamento para processamento das compras e resgates de créditos.

## 2. Fluxo Operacional

### 2.1 Processo de Compra e Pagamento
- O cliente da mineradora seleciona e compra um produto diretamente pelo aplicativo. (feito)
- O pagamento é processado pelo sistema através das integrações disponíveis. (feito)

### 2.2 Processamento e Atribuição do Frete
- O administrador da plataforma recebe a solicitação de compra e gera um frete vinculado ao pedido. (feito)
- O sistema disponibiliza o frete para os caçambeiros cadastrados, que podem aceitar ou recusar. (feito)
- O primeiro caçambeiro a aceitar fica responsável pela entrega. (feito)

### 2.3 Geolocalização e Acompanhamento
- O sistema exibe a rota da entrega via geolocalização, informando ao caçambeiro e ao cliente o status do transporte. (feito)
- A entrega é realizada, e o caçambeiro confirma a finalização da corrida.

### 2.4 Créditos e Resgates
- Após a entrega, o caçambeiro recebe um crédito na plataforma.
- O crédito pode ser utilizado de duas formas:
    - Compra de produtos na mineradora.
    - Resgate financeiro via PIX, débito ou outra forma definida.

## 3. Entidades do Sistema

- **Clientes**: Usuários que compram produtos e solicitam fretes.
- **Caçambeiros**: Profissionais cadastrados para realizar entregas.
- **Administrador**: Responsável por gerenciar pedidos e fretes.
- **Produtos**: Itens vendidos pela mineradora dentro do aplicativo.
- **Fretes**: Solicitações de transporte criadas automaticamente após a venda.
- **Pagamentos**: Transações processadas dentro do app.
- **Créditos**: Valores recebidos pelos caçambeiros pelas entregas realizadas.

## 4. Requisitos Funcionais

### 4.1 Cadastro e Gerenciamento de Usuários
- Clientes podem criar contas e realizar pedidos.
- Caçambeiros podem se cadastrar para receber e aceitar fretes.
- O sistema terá uma copy persuasiva para incentivar caçambeiros a realizarem o cadastro na tela inicial.

### 4.2 Venda de Produtos
- Listagem de produtos com preços e disponibilidade.
- Opção de adicionar produtos ao carrinho e finalizar a compra.
- Pagamento realizado diretamente pelo aplicativo.

### 4.3 Gestão de Fretes
- O administrador gera solicitações de frete vinculadas às compras.
- Os caçambeiros recebem as solicitações e podem aceitar ou recusar.
- O primeiro caçambeiro a aceitar garante o serviço.
- O sistema exibe a rota da entrega via geolocalização, permitindo ao caçambeiro e ao cliente acompanhar o trajeto.

### 4.4 Registro de Entrega
- O sistema registra a entrega do produto.
- O status da entrega é atualizado em tempo real no app.

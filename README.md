Descrição do Projeto:
1. Objetivo Geral
   Desenvolver um aplicativo para gerenciar tanto a venda de produtos da A S.OS Areia e Brita quanto a logística de entrega, conectando clientes, administrador da plataforma e caçambeiros. O sistema permitirá que os clientes realizem pedidos diretamente no app, o administrador gere solicitações de frete, e os caçambeiros aceitem e realizem as entregas. O sistema contará com geolocalização para exibição da rota do frete e integração com meios de pagamento para processamento das compras e resgates de créditos.

2. Fluxo Operacional
   2.1 O cliente da mineradora seleciona e compra um produto diretamente pelo aplicativo.
   2.2 O pagamento é processado pelo sistema através das integrações disponíveis.
   2.3 O administrador da plataforma recebe a solicitação de compra e gera um frete vinculado ao pedido.
   2.4 O sistema disponibiliza o frete para os caçambeiros cadastrados, que podem aceitar ou recusar.
   2.5 O primeiro caçambeiro a aceitar fica responsável pela entrega.
   2.6 O sistema exibe a rota da entrega via geolocalização, informando ao caçambeiro e ao cliente o status do transporte.
   2.7 A entrega é realizada, e o caçambeiro confirma a finalização da corrida.
   2.8 Após a entrega, o caçambeiro recebe um crédito na plataforma.
   2.9 O crédito pode ser utilizado de duas formas:
   2.9.1 Compra de produtos na mineradora.
   2.9.2 Resgate financeiro via PIX, débito ou outra forma definida.
   2.10 O administrador tem acesso a um painel de métricas e movimentação, permitindo a análise dos dados com filtros por dia, semana e mês.
   2.11 O sistema pode ser integrado ao banco de dados da empresa para sincronização de informações.

3. Entidades do Sistema
   Clientes: Usuários que compram produtos e solicitam fretes.
   Caçambeiros: Profissionais cadastrados para realizar entregas.
   Administrador: Responsável por gerenciar pedidos e fretes.
   Produtos: Itens vendidos pela mineradora dentro do aplicativo.
   Fretes: Solicitações de transporte criadas automaticamente após a venda.
   Pagamentos: Transações processadas dentro do app.
   Créditos: Valores recebidos pelos caçambeiros pelas entregas realizadas.

4. Requisitos Funcionais
   4.1 Cadastro e Gerenciamento de Usuários
   Clientes podem criar contas e realizar pedidos.
   Caçambeiros podem se cadastrar para receber e aceitar fretes.
   O sistema terá uma copy persuasiva para incentivar caçambeiros a realizarem o cadastro na tela inicial.
   4.2 Venda de Produtos
   Listagem de produtos com preços e disponibilidade.
   Opção de adicionar produtos ao carrinho e finalizar a compra.
   Pagamento realizado diretamente pelo aplicativo.
   4.3 Gestão de Fretes
   O administrador gera solicitações de frete vinculadas às compras.
   Os caçambeiros recebem as solicitações e podem aceitar ou recusar.
   O primeiro caçambeiro a aceitar garante o serviço.
   O sistema exibe a rota da entrega via geolocalização, permitindo ao caçambeiro e ao cliente acompanhar o trajeto.
   4.4 Registro de Entrega
   O sistema registra a entrega do produto.
   O status da entrega é atualizado em tempo real no app.
   4.5 Créditos e Resgates
   O caçambeiro recebe créditos ao concluir as entregas.
   Os créditos podem ser usados para compras na mineradora ou convertidos em dinheiro via PIX/débito.
   4.6 Painel Administrativo
   Relatórios de movimentação financeira do app.
   Filtros por dia, semana e mês.
   Controle de créditos e resgates dos caçambeiros.
   Integração opcional com o banco de dados da empresa.
   4.7 Estratégias de Engajamento
   Sistema de premiação: O app terá um sistema de bonificação por metas para incentivar a produtividade dos caçambeiros.
   Link com redes sociais: O app terá integração com as redes sociais da empresa.
   4.8 Integração com Meios de Pagamento
   O sistema terá suporte para pagamentos via Bradesco e Caixa Econômica.
   Caso essas integrações não sejam viáveis, será usada uma API de terceiros (exemplo: PagSeguro).

5. Requisitos Não-Funcionais
   Segurança: Proteção de dados e transações financeiras.
   Escalabilidade: Suporte para crescimento do número de usuários e movimentações.
   Usabilidade: Interface intuitiva para clientes, caçambeiros e administradores.
   Notificações em Tempo Real: Aviso de novas solicitações para os caçambeiros.


## Desafio VX Case descrição:

Teste PHP
O objetivo deste teste é conhecer suas habilidades em:

PHP, MySQL e JavaScript;
Entendimento e análise dos requisitos;
Modelagem de banco de dados;
Integração com API; -
A aplicação pode ser feita em PHP puro ou algum framework conhecido no mercado. Banco de dados MySQL. Será um diferencial se for usado o Framework Zend ou Laravel, pois é com eles que você vai trabalhar.

Problema
Sistema de Vendas
O cliente pediu uma aplicação para poder realizar as vendas de produtos da loja;
Ele quer tambem poder visualizar as vendas que foram realizadas.
Requisitos
O Back deve ser uma API REST
Modelar a tabela de vendas
A venda tem que ter os produtos vendidos, data da compra
Uma venda pode ter mais de um produto
A única tela de cadastro que você precisa fazer é a de vendas, não precisa criar a tela de cadastro de produtos, somente a tabela no banco de dados. - Popule a tabela de produtos diretamente no banco;
Um produto deve conter nome, preço e previsão de entrega (Dias). Todos obrigatórios (lembrando que você não vai criar a tela de cadastro, mas deve tratar isso no banco de dados);
O banco de dados não pode permitir 2 produtos com mesma referência;
O front fica a seu critério. Atualmente, trabalhamos com Angular mas, você pode usar javascript puro ou algum framework (React/Vue/Angular);
Considere sempre quantidade 1 para cada item adicionado na tela de venda;
Os preços dos produtos sofrem atualização semanal, isso não pode interferir no valor das vendas registradas e de seus produtos. Modele o banco de dados de tal forma a tratar essa questão;
Diferenciais
Ao exibir as vendas informar o tempo de entrega com base na maior data de previsão;
Semantica no código
Legibilidade no código
Utilizar conceito DRY
Utilizar princípio da responsabilidade única

## Desenvolvimento

-Framework Laravel 8.x
-FrontEnd Bootstrap 4.X
-Javascript Puro

## Instalalção

Pré requisitos: instalar Laravel
ver documentação em https://laravel.com/docs/8.x/installation

git clone https://github.com/mauriciolanner/desafio-vxcase.git

$ composer install

$ npm install

$ php artisan migrate

$ php artisan serve
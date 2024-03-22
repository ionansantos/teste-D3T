<h1>Teste-D3T</h1>

<img src="http://img.shields.io/static/v1?label=STATUS&message=CONCLUIDO&color=GREEN&style=for-the-badge"/>

![](pxn.gif)

## Descrição do projeto

<p align="justify">
  Este projeto é uma aplicação web desenvolvida com o framework Laravel e a biblioteca Vue.js , O sistema tem 
   como objetivo permitir o cadastro, listagem, edição e exclusão de Contatos, além de fornecer uma interface de usuário simples e 
   responsiva.
</p>

## Funcionalidades

:heavy_check_mark: Cadastro de Contatos:
O usuário pode adicionar novos contatos com os seguintes campos:
Nome do contato (campo obrigatório)
Endereço do contato (campo obrigatório)
email  (campo obrigatório)
telefone (campo obrigatório)

:heavy_check_mark: Listagem de Contatos:
Todos os contatos cadastrados são exibidos na página inicial.

:heavy_check_mark: Edição de Contatos:
O usuário pode editar os dados de um contato existente.

:heavy_check_mark: Exclusão de Contatos:
Os contatos existentes podem ser removidos do banco de dados.

## Pré-requisitos

:warning: [Docker](https://www.docker.com/)

...

## Como rodar a aplicação :arrow_forward:

No terminal, clone o projeto:

```
git clone https://github.com/ionansantos/teste-D3T
```

```
cd teste-D3T
```

```
cp .env.example .env
```

```
docker compose up -d --build 
```

```
docker compose exec app composer install  
```

```
docker compose exec app chmod 777 -R ./storage ./bootstrap/cache
...

docker exec app php artisan key:generate
```


## Iniciando banco de dados

```
 docker exec app_d3t php artisan migrate
```

```
docker exec app_d3t php artisan db:seed --class=ScheduleTableSeeder --force
```

## os dados da aplicação são salvos em duas tabelas

### schedule:

| id  | name | andress | email | telefone |
| --- | ---- | ----------- | ----- | -------- |


### para instalar as depedencias do npm

```
npm install
npm run dev
```

acesse em : http://localhost


Copyright :copyright: 2023 - teste-d3t


## INSTRUCOES

sudo docker exec app_d3t php artisan migrate

sudo docker exec app_d3t php artisan db:seed --class=ScheduleTableSeeder --force

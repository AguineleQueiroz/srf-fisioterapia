# SRF-Fisioterapia
Trata-se de um sistema de referenciamento fisioterapêutico para as cidades de Datas e Presidente Kubitschek. 
Basicamente tem o propósito de facilitar a gestão de atendimentos das atenções primárias, secundárias e basicas das respectivas cidades.

## Tecnologias Utilizadas

- [x] Laravel 12.1
- [x] PHP 8.12
- [x] MySQL
- [x] Vue 3
- [x] Digital Ocean - Droplets[VM para hospedagem]
- [x] PHP Storm

## Instalação do projeto

Clone o projeto
```sh
git clone https://github.com/AguineleQueiroz/srf-fisioterapia.git
```
Acesse a pasta do projeto executando o seguinte comando:
```sh
cd srf-fisioterapia
```
Crie o arquivo com as variáveis de ambiente:
```sh
cp .env.example .env
```
Atualize as variáveis de ambiente listadas abaixo:
```
APP_NAME="SRFisioterapia"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Instale as dependências do projeto rodando:
```sh
composer install
```
Rode as migrations do projeto:
```
php artisan migrate
```
Gere a key do projeto SRFisioterapia:
```sh
php artisan key:generate
```


Agora você já pode acessar a aplicação através da url abaixo:
[http://localhost](http://localhost)

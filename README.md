# SRF-Fisioterapia
Trata-se de um sistema de referenciamento fisioterapêutico para as cidades de Datas e Presidente Kubitschek. 
Basicamente tem o propósito de facilitar a gestão de atendimentos das atenções primárias, secundárias e básicas das respectivas cidades.

<img width="1361" height="650" alt="srf-fisioterapia-login" src="https://github.com/user-attachments/assets/956582f3-7c0c-46eb-acb0-ccd2d43b1de4" />
<img width="1362" height="649" alt="srf-fisioterapia" src="https://github.com/user-attachments/assets/e9404a99-09b3-40f3-aad6-ff4cafee8668" />

## Tecnologias Utilizadas

- [x] Laravel 12.44.0
- [x] PHP 8.4
- [x] PHPUnit
- [x] PostgreSQL
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

DB_CONNECTION=postgresql
DB_HOST=postgresql17
DB_PORT=5432
DB_DATABASE=srf
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Suba os containers:
```sh
docker-compose up -d
```
Instale as dependências do projeto rodando:
```sh
docker-compose exec app composer install
```
Gere a key do projeto SRFisioterapia:
```sh
docker-compose exec app php artisan key:generate
```
Rode as migrations do projeto:
```
docker-compose exec app php artisan migrate
```
Instale dependências Node - o Vite já instala automaticamente. Mas você pode forçar manualmente, caso seja necessário:
```
docker-compose exec vite npm install
```

🌐 Acessando a Aplicação

 - Laravel App: http://localhost
 - Vite HMR: http://localhost:5174
 - MySQL: localhost:3306

O projeto foi desenvolvido utilizando php 7.3, laravel 8 e mysql 8.
## Instruções usando composer
- execute o comando:
```
composer install
```
- Configure .env com as credenciais do banco
- Crie e povoe as tabelas com o comando:
```
php artisan migrate --seed
```
- Rode a aplicação:
```
php artisan serve
```
## Instruções usando docker
- Com o docker já instalado e rodando na sua máquina, clone o projeto e rode o seguinte comando dentro da pasta raiz:
```
docker-compose up --build
```
- Após finalizar todas as dependências, o projeto pode ser rodado utilizando o comando sail:
```
.vendor/bin/sail up
```
- E a partir daí utilizar o sail para os comandos do artisan:
```
.vendor/bin/sail artisan migrate --seed
```

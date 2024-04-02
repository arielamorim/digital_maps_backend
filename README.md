
## Teste Luizalabs Backend - DigitalMaps

Este projeto é uma resposta ao teste de backend da Luizalabs.

A tecnologia utilizada foi o framework [Laravel](https://laravel.com/docs/9.x) v9.19 para desenvolver a aplicação.

Para rodar o projeto localmente é necessário ter instalado:
- PHP
- composer
- sqlite3 `sudo apt-get install php-sqlite3`

Para rodar aplicação, siga os seguintes passos:
- Instalar as dependencias `composer install`
- Rodar as migrations `php artisan migrate`
- Subir a aplicação `php artisan serve`, 

Com isso será possível ver a home do laravel em `http://localhost:8000`.

A documentação dos endpoints foi feita através do [scribe](https://scribe.knuckles.wtf/) e está disponível em `/docs`.

Para rodar os testes, utilizar o comando `php artisan test`.

### Observações

Acredito ter atendido a todos os requisitos do documento, meu único pesar foi retirar os `try it out's` da documentação do scribe, pois acabei não conseguindo resolver um problema de CORS.




## Sobre📒

Aplicação para a conversão de moedas utilizando a API 
para conversão dos valores: https://docs.awesomeapi.com.br/api-de-moedas pela facilidade e boa documentação.

## Requisitos⚠️

- Composer (https://getcomposer.org)
- PHP 8.0 ou superior (https://www.php.net/downloads)
- None js 16.0 ou superior (https://nodejs.org/en/download/)

## Instalação 👨‍💻
1) Intalando as dependências do composer<br>
   ``` 
   composer install
   ```
1) Intalando as dependências do packager e compilando<br>
   ```
   npm install 
   ```
1) Compilando packager<br>
   ```
   npm run build. 
   ```
   
## Configurando 🔧
Renomeie o arquivo **.env.example** localizando na raiz do projeto para **.env**
   
1) Altere as seguintes vareavis do seu  **.env** <br> 
   **1.1) Banco de dados<br>**
   ```
   DB_CONNECTION=
   DB_HOST=
   DB_PORT=
   DB_DATABASE=
   DB_USERNAME=
   DB_PASSWORD=
   ```
   **1.2) E-mail<br>**
   ```
   MAIL_MAILER=
   MAIL_HOST=
   MAIL_PORT=
   MAIL_USERNAME=
   MAIL_PASSWORD=
   MAIL_ENCRYPTION=
   MAIL_FROM_ADDRESS=
   MAIL_FROM_NAME=
   ```
1) Abra o terminal na pasta do projeto e gere uma chave nova atravez do comando;<br>
   ```
    php artisan key:generate  
   ```
3) Inserir as tabelas<br>
    ```
   php artisan migrate
    ```   
4) Inserir os dados iniciais Valores das taxas, formas de pagamentos e as combinações das moedas<br>
    ```
   php artisan db:seed
    ```
5) Rodar o projeto<br>
    ```
   php artisan serve
    ```   

## Tecnologias 🚀
- [Laravel 9](https://laravel.com/docs/9.x)
- [Laravelcollective](https://laravelcollective.com/docs/6.x/html)
- [Laravel IDE Helper Generator](https://github.com/barryvdh/laravel-ide-helper)
- [Módulo de linguagem pt-BR (português brasileiro) para Laravel](https://github.com/lucascudo/laravel-pt-BR-localization)
- [Laravel DataTables](https://yajrabox.com/docs/laravel-datatables/master/installation)
- [Adminlte](https://adminlte.io)
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction)
- [Font Awesome](https://fontawesome.com)
- [Apexcharts](https://apexcharts.com)
- [Jquery](https://jquery.com)
- [Sweetalert2](https://sweetalert2.github.io)
- [Selectize](https://selectize.dev)
- [Source Sans Pro](https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback)

## Screenshots 🚧
![Login](https://s5.gifyu.com/images/ezgif-4-0660c9ae81.gif)


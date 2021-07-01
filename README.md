## Introduction

This is a simple POST API using native PHP and Postgresql

## Clone repo of cartrack-exam
<pre><code>
git clone https://github.com/juliusestebar/cartrack-exam.git
</code></pre>

## Composer
<code>composer install</code>

## Environment


<code>Copy and paste on the same directory `.env.example` and rename it to `.env` </code>


*Change enviroment variables for postgresql database connection*

<pre><code>
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=cartrack-exam
DB_USERNAME=postgres
DB_PASSWORD=password
API_KEY=cartrack-api-key
</code></pre>

## Seed
- Need bash 
<blockquote>
<code>php dbseed.php </code>
</blockquote>

## Generate Token

<blockquote>
<code>php create_token.php </code>
</blockquote>

## Bearer Token
- copy token and use it in Authorization - Bearer Token 
<blockquote>
<code>{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMCIsImF1ZCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDB9.WYFGWvPz4QM-udHJPVLZRQbafysRYt5BhFbkJpcv0NQ","expires":1357000000}</code>
</blockquote>


## Deployment
- For local development you may run PHP's built-in web server:
<blockquote>
<code>php -S 127.0.0.1:8000 -t public</code>
</blockquote>


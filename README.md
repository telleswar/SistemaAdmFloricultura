<h2>Clone o projeto</h2>

git clone https://github.com/telleswar/SistemaAdmFloricultura.git

<h2>Acesse o projeto</h2>

cd SistemaAdmFloricultura

<h2>Instale as dependências e o framework</h2>

composer install --no-scripts

<h2>Copie o arquivo .env.example</h2>

cp .env.example .env

<h2>Crie uma nova chave para a aplicação</h2>

php artisan key:generate

Em seguida você deve configurar o arquivo .env e rodar o arquivo floricultura_dump.sql para gerar o banco de dados.

# Buffet Alegria

## Descrição do projeto 
Um sistema web gerenciador de buffets para festas infantis desenvolvido com Laravel.

## Funcionalidades
<ul>
    <li>Reservar um horario para festa</li>
    <li>Listar os horarios de festa disponíveis</li>
    <li>Convidar e confirmar presença de convidados</li>
    <li>Gestão operacional da festa</li>
    <li>Entre outros...</li>
</ul>

## Instalação do projeto: 

### Instalação do docker: 
*Instalar o docker no seu computador:*
```
https://www.docker.com/
```

### Clonar repositório do Github
*Pelo site do github:*
```
https://github.com/Projetos-Pucc/buffet-alegria.git
```
```sh
cd buffet-alegria/
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Executar as migrations
```sh
php artisan migrate
```

Inicializar os valores base no banco de dados
```sh
php artisan db:seed
```

Acessar o projeto
[http://localhost:8989](http://localhost:8989)

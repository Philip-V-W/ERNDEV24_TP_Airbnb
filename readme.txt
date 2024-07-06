Before you start, copy

Build and Start: Run the Docker commands to build and start your containers:

docker-compose down
docker-compose build
docker-compose up -d


Initialize Composer: If your new project requires Composer dependencies, install them:

docker-compose exec appserver composer install
docker-compose exec appserver composer update
docker-compose exec appserver composer require vlucas/phpdotenv


To open the website, visit http://localhost:"port"/ in your browser. The port number is the one you specified in the docker-compose.yml file.
To access the database, visit http://localhost:"port"/phpmyadmin/ in your browser. The port number is the one you specified in the docker-compose.yml file.
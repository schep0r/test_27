Requirements:

* Docker and docker-compose
* Symfony CLI


To get working environment need to run next
(I prefer to run each command with own terminal):

``docker-compose up --build``

``symfony serve``

After you got env need to load data to DB:

``bin/console doctrine:migrations:migrate``

``bin/console doctrine:fixtures:load``
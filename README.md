
Komanda IMK
============
### http://imk.projektai.nfqakademija.lt/

# Installation


### Docker
Docker `17.x-ce` or greater is required. [Install instructions](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04).

### Docker-compose
Docker-compose `1.8.1` or greater is required. [Download link](https://github.com/docker/compose/releases). [Install instructions](https://docs.docker.com/compose/install/).

### Docker files
Grab required Docker files from [NFQ Kickstart repository](https://github.com/nfqakademija/kickstart): [Download Link](https://github.com/nfqakademija/kickstart/archive/master.zip)

## Starting the project
Start Docker containers by running these commands:
```bash
cd ~/link/to/project/dir
docker-compose up -d
docker-compose exec fpm composer install --prefer-dist -n
docker-compose run npm npm install
docker-compose run npm gulp
```
Enter the Docker container:
```bash
docker-compose fpm exec bash
```
Install the required assets:
```php
bin/console assets:install --symlink
```
Exit from Docker container bash shell:
```bash
exit
```
Project should run locally now and is accessible via http://localhost:8000/.

# Contributors

* Karolis Martusevičius. [GitHub](https://github.com/karmrt)
* Mindaugas Petraitis. [GitHub](https://github.com/mindaugaspe)
* Ieva Dapševičiūtė. [GitHub](https://github.com/ievadap)

Team mentor:
* Paulius Ruminas. [GitHub](https://github.com/pauliusrum)


<p align="center">
  <h1 align="center">Symfony Project - Web Development</h1>
  <h4 align="center">Creation of a CRUD website on primary and secondary schools in France</h4>
</p>

<p align="center">
  <img alt="CSS3" src="https://img.shields.io/badge/-CSS3-0068BA?style=flat&logo=css3&logoColor=white" />
  <img alt="PHP" src="https://img.shields.io/badge/-PHP-7377AD?style=flat&logo=php&logoColor=white" />
  <img alt="PostgreSQL" src="https://img.shields.io/badge/-PostgreSQL-31648C?style=flat&logo=postgresql&logoColor=white" />
  <img alt="Shell" src="https://img.shields.io/badge/-Shell-121011?style=flat&logo=gnu-bash&logoColor=white" />
  <img alt="Symfony" src="https://img.shields.io/badge/-Symfony-000000?style=flat&logo=symfony&logoColor=white" />
  <img alt="Twig" src="https://img.shields.io/badge/-Twig-BCCF27?style=flat&logo=twig&logoColor=white" />
</p>

<table>
    <thead>
        <tr>
            <th width="300px">Year</th>
            <th width="300px">Course</th>
            <th width="300px">Subject</th>
            <th width="300px">Project</th>
            <th width="300px">Collaborators</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td align="center">2020-2021</td>
        <td align="center">L3 Computer science</td>
        <td align="center">Web Development</td>
        <td align="center">Symfony CRUD</td>
        <td align="center">Léa Gallier & Claire Loisel</td>
        </tr>
    </tbody>
</table>

## About

This project aims to create a CRUD-type web application on primary and secondary schools in France. Data on these establishments is stored in a .csv file: `data/fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre.csv`.

In this web application, we therefore had to list all the schools but also display one in detail, be able to modify them as well as delete them. In addition, we also had to make filters, i.e. to be able to display schools according to department, region, municipality, academy, sector (private or public) and nature (the type of school). In addition to that, we also had to be able to geolocate schools on a map, but also be able to add comments to these places (see, create, modify and delete comments).

The data displayed for each establishment were as follows: identifier, name, nature, sector, longitude and latitude for location on the map, address, department, municipality, region, academy , its opening date as well as its associated comments. The comments had as fields: an identifier, the name of the author, its creation date, a score from 1 to 5 and a text (the comment).

> This project aimed to teach us how to use <a href="https://symfony.com/">Symfony</a> and how to create forms with this framework.

## Requirements

- PHP >= 7.2.5
- Symfony = 5.2
- A database server (PostgreSQL or MariaDB)

### Installing Symfony

To start using Symfony you need to install:

- **composer**: PHP's dependency manager
- **symfony**: the utility that allows you to create new projects

These steps are described in the official Symfony doc: https://symfony.com/doc/current/book/installation.html

#### Composer

Install composer by following these instructions.

- For *Windows*:

We use the installer offered on the composer site: https://getcomposer.org/Composer-Setup.exe then we restart the terminal to update the environment.

- For *Linux*:

Follow the instructions and execute the commands given here: https://getcomposer.org/download/

> Attention: the following commands must only be executed once!

```
mkdir -p ${HOME}/.composer/bin
wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --install-dir=${HOME}/.composer/bin --filename=composer
```

We then modify the environment variable $PATH so that the composer executable is available everywhere by adding the following line to the file `${HOME}/.profile`

```
export PATH="$HOME/.composer/bin:$PATH"
```

#### Symfony

To install Symfony follow the instructions depending on the OS used: https://symfony.com/download

- Installation of the binary version:

We download the binary version of symfony: https://github.com/symfony-cli/symfony-cli/releases/download/v5.4.1/symfony-cli_linux_amd64.tar.gz
  - Extract the archive to a local folder, for example: `$HOME/.symfony/bin`.
  - Add the following line to the file `${HOME}/.profile`:
```
export PATH="$HOME/.symfony/bin:$PATH"
```
  - Finally, we execute the following command to reload the environment:
```
source ${HOME}/.profile
```

### Initialization

Go to the folder where you want to put the project and open a terminal:

```
git clone https://github.com/LeaG76/l3-web-symfony-project.git
cd l3-web-symfony-project
```

We must then install the libraries necessary for the operation of the application. We can download them by running the following command:

```
composer install
```

We must then configure access to the database, modify the `.env` file or create a `.env.local` file to add one of the following two lines:

```
# PostgreSQL
DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=13&charset=utf8"

# MariaDB
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=mariadb-10.3.27"
```

Then run the following commands to create the database:

```
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```

## Get started

### Project structure

```bash
.
├── .env
├── .env.test
├── .git/
├── .gitignore
├── bin/
├── composer.json
├── composer.lock
├── config/
├── data/
├── migrations/
├── phpunit.xml.dist
├── public/
├── README.md
├── src/
├── symfony.lock
├── symfony_tools.txt
├── templates/
├── tests/
├── translations/
├── var/
└── vendor/
```

- The folder `config/` contains application settings. We modify this folder to configure the application or change its default behavior (e.g.: loading additional modules).
- The folder `src/` contains the sources of our application. This is the case that interests us the most here.
- The folder `public/` contains the application's images and CSS files.
- The folder `templates/` contains TWIG *templates* files to facilitate the generation of Web pages.
- The folder `vendor/` contains all the libraries used by Symfony.
- The folder `tests/` contains as one suspects, the tests.

### Start app

```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

The next step is to start the application. We use PHP's internal web server rather than Apache for development.

```bash
symfony server:start
```

The site can be viewed in a browser at [http://localhost:8000](http://localhost:8000).

## Sources

Link to the Github repository of Mr. Pigné's web development course: https://github.com/pigne/teaching

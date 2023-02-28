<p align="center">
  <h1 align="center">Symfony Project - Web Development</h1>
  <h4 align="center">Creation of a CRUD website on primary and secondary schools in France</h4>
</p>

<p align="center">
  <img alt="CSS3" src="https://img.shields.io/badge/-CSS3-0068BA?style=flat&logo=css3&logoColor=white" />
  <img alt="PHP" src="https://img.shields.io/badge/-PHP-7377AD?style=flat&logo=php&logoColor=white" />
  <img alt="Shell" src="https://img.shields.io/badge/-Shell-121011?style=flat&logo=gnu-bash&logoColor=white" />
  <img alt="Symfony" src="https://img.shields.io/badge/-Symfony-000000?style=flat&logo=symfony&logoColor=white" />
  <img alt="Twig" src="https://img.shields.io/badge/-Twig-BCCF27?style=flat&logo=twig&logoColor=white" />
</p>

<table>
    <thead>
        <tr>
            <th width="150px">Year</th>
            <th width="150px">Course</th>
            <th width="300px">Subject</th>
            <th width="300px">Project</th>
            <th width="350px">Collaborators</th>
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

This project aims to create a CRUD-type web application on primary and secondary schools in France. Data on these establishments is stored in a .csv file: `data/ fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre.csv`.

In this web application, we therefore had to list all the schools but also display one in detail, be able to modify them as well as delete them. In addition, we also had to make filters, i.e. to be able to display schools according to department, region, municipality, academy, sector (private or public) and nature (the type of school). In addition to that, we also had to be able to geolocate schools on a map, but also be able to add comments to these places (see, create, modify and delete comments).

The data displayed for each establishment were as follows: identifier, name, nature, sector, longitude and latitude for location on the map, address, department, municipality, region, academy , its opening date as well as its associated comments. The comments had as fields: an identifier, the name of the author, its creation date, a score from 1 to 5 and a text (the comment).

> This project aimed to teach us how to use <a href="https://symfony.com/">Symfony</a> and how to create forms with this framework.

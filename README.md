# RideShare

Are you tired from unsuccessfully looking for hitch-hike? This web application is for you.
On RideShare you can look for rides or create your own and share your car on your trip to other!

## Features:
  - Adding your ride for other people to join
  - Joining rides from other users
  - Searching your added or joined rides
  - Browsing all rides that meet your requirement (starting location, destination, date)
  - Removing harmful users as administrator

## Technologies used:
 - HTML
 - CSS
 - JS
 - PHP
 - PostgreSQL
 - Docker

## Installation guide:
1. Requirements:
 - make sure you have installed Docker
2. Clone this repository:
```
git clone https://github.com/kjzieba/Hitchhiking-App.git
```
3. Create .env file in root directory with variables used for connecting to database:
```
DB_NAME=''
DB_USER=''
DB_PASSWORD=''
DB_HOST=''
```
4. Create env.php file in root directory with variables used for connecting to database:
```
<?php

const DB_NAME='';
const DB_USER='';
const DB_PASSWORD='';
const DB_HOST='';
```
5.  Run those commands in terminal:
```
docker compose build
```
```
docker compose up
```
6. Application is ready to be accessed at http://localhost:8080.

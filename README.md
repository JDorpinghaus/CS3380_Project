# CS3380 Project
### Group Members
Jacob Dorpinghaus
Jacob Ross
Mason Breece
Lawrence Neely
Matt Barber

### Application Description
The application we created is an mp3 storage system. There is a login system to create an account to begin to use the database. Any user with an account can login and then upload any mp3 file to the database to hold on to. The application takes the metadata of the mp3 and populates the database with the song name, artist, album and genre. Users can also search the database for any song that the database might hold. Users can edit and delete any song in the database as well. The purpose is to have an “open to everyone” database that can be a hub of songs that anyone can contribute to. 

### Database Schema
songs schema:

| Field| Type | NULL| Key |Default | Extra | 
| ------------- |:-------------:| -----:|--- |---|---
| id | int(11) |NO |PRI|NULL|auto_increment|
| mp3| mediumblob|NO||NULL||
| title | varchar(100)|NO||||
|artist|varchar(100)|NO||||
|album|varchar(100)|NO||||
|genre|varchar(100)|NO||||

users schema:

| Field| Type | NULL| Key |Default | Extra | 
| ------------- |:-------------:| -----:|--- |---|---
|userID | int(11) |NO |PRI|NULL|auto_increment|
|loginID| varchar(255)|NO||NULL||
|password | varchar(255)|NO||NULL||
|firstName|varchar(128)|NO||NULL||
|lastName|varchar(128)|NO||NULL||


### ERD Diagram
![alt text](https://github.com/JDorpinghaus/CS3380_Project/blob/master/ERDDatabaseFinal.png "ERD Diagram")

### CRUD

### Demonstration Video

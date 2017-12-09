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
|userID|int(11)|NO|MUL|NULL||

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
#### Create
Users can upload songs to the database using the upload function of our application. After the user has logged in the user can click the upload button to take them to a screen where they choose an mp3 file to be uploaded to the database. The functionality of this can be seen in the upload.php file in the php folder of the project. The execution of the sql statement that makes this happen can be seen on lines 47 and 48:
```php
$sql = "INSERT INTO songs (mp3, title, artist, album, genre) VALUES ('" . $mp3 . "', '" . $tags[comments_html][title][0] . "', '" . $tags[comments_html][artist][0] . "', '" . $tags[comments_html][album][0] . "', '" . $tags[comments_html][genre][0] . "')";
$result = $db->query($sql);
```

#### Read
Users can search for any song that is in the database using the search function of our application. After the user has logged in, the user can click the search function and then search based on title, artist, album, or genre. The search will then show a table full of all the songs in the database that match their search requirements. The functionality of this can be seen in the search.php file in the php folder of the project. The execution of the sql statement that makes this happen can be seen on lines 20 - 29:

```php
$id = $_REQUEST['songId'];
$title = $_REQUEST['title'];
$artist = $_REQUEST['artist'];
$album = $_REQUEST['album'];
$genre = $_REQUEST['genre'];
$songs = array();

$sql = "SELECT * FROM songs WHERE title LIKE '%" . $title . "%' AND album LIKE '%" . $album . "%' AND artist LIKE '%" . $artist . "%' AND genre LIKE '%" . $genre . "%'";
$result = $db->query($sql);
```

#### Update
Users can edit any song in the database if they made a mistake when inserting a song or if they notice an error. After the user has logged in and searched for a song, the table of songs in the database will come up and an edit button and delete button will also be in the table. The edit button will bring the user to the edit screen where they can change the entry. The functionality for this can be seen in edit.php on lines 21-28:

```php
$id = $_REQUEST['songId'];
$title = $_REQUEST['title'];
$artist = $_REQUEST['artist'];
$album = $_REQUEST['album'];
$genre = $_REQUEST['genre'];

$sql = "UPDATE songs SET title='" . $title . "', artist='" . $artist . "', album='" . $album . "', genre='" . $genre . "' WHERE id='" . $id . "'";
$result = $db->query($sql);
```

#### Delete
Users can delete any song in the database if they believe that it does not belong, if the mp3 file is broken, etc. After the user has logged in and searched for a song, the table of songs in the database will come up and an edit button and delete button will also be in the table. The delete button will remove the song from the database. The functionality for this can be seen in delete.php on lines 21-27:

```php
$id = $_REQUEST['songId'];
$songs = array();
$sql = "DELETE FROM songs WHERE id='" . $id . "'";
$result = $db->query($sql);
```

### Demonstration Video

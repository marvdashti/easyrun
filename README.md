# Easyrun
Easy import csv to database <br>
This application is developed in PHP language, PDO And Ajax Technology. The purpose of developing this application is to import data easily into the database.<br>
Use of this application is free for everyone. For commercial use, the source of this application must be mentioned.<br>
# Structure
<ul>
<li>
<strong>index.php</strong><br>
The main page of the application. This page contains the Csv file upload form. 
</li>
<li>
<strong>config.php</strong><br>
To configure the application, you must set the defined constants. for example: <br>
<ul>
<li><strong>dbServer:</strong>Database server address. Default is localhost.</li>
<li><strong>dbName:</strong>Database name.</li>
<li><strong>dbUser:</strong>Database username. Default is root</li>
<li><strong>dbPassword:</strong>Database password.</li>
</ul>
</li>
<li>
<strong>easyrun.php</strong><br>
The main class is the application. This class has several methods and objects:
<ul>
<li><strong>conn object:</strong> In this object, the database connection is stored. This object is private.</li>
<li><strong>alert object:</strong> In this object, the system message is stored. This object is public.</li>
<li><strong>construct method:</strong> In this method, In this function, the connection to the database is performed. The connection to the database is done via PDO.</li>
<li><strong>getTables method:</strong> This method returns a list of all database tables.</li>
<li><strong>getColumns method:</strong> This method returns all the columns of the selected database table.</li>
<li><strong>import method:</strong> In this method, the csv file sent by the user is received and divided line by line for import into the database.</li>
<li><strong>insertToDb method:</strong> This method receives data from the import method and inserts it into the database.</li>
</ul>
</li>
<li>
<strong>column.php</strong><br>
This file sends a request to the getColumns method. It then displays the list of columns of the selected table to the user.
</li>
<li>
<strong>import.php</strong><br>
This file receives the information sent by the form and sends it to the import method and displays the result to the user.
</li>
<li>
<strong>body.js</strong><br>
All JavaScript and Ajax functions are stored in this file.
</li>
<li>
<strong>style.css</strong><br>
This file contains all CSS styles.
</li>
</ul>




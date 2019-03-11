# products-catalog

a very simple and light-weight "search in results" project.

all that is needed to run is xampp configured to default htdocs path or other path<br/>
just download the files to the htdocs folder or to designated xampp projects path<br/>
setup a database credentials in config/config.php<br/>
  // DB Params<br/>
  define('DB_HOST', '<host address (localhost for xampp)>'); <br/>
  define('DB_USER', '<username>'); <br/>
  define('DB_PASS', '<password>'); <br/>
  define('DB_NAME', '<database name>'); <br/>
  
*once searched for first time server will set up the log table if not exist<br/>

*configuring xampp <br/>
(from https://stackoverflow.com/questions/18902887/how-to-configuring-a-xampp-web-server-for-different-root-directory)<br/>
1. Go to C:\xampp\apache\conf\httpd.conf.<br/>
2. Open httpd.conf.<br/>
3. Find tag : DocumentRoot "C:/xampp/htdocs"<br/>
4. Edit tag to : DocumentRoot "C:/xampp/htdocs/myproject/web" or any other path<br/>
5. Now find tag and change it to < Directory "C:/xampp/htdocs/myproject/web" > or same path defined above<br/>
6. Restart Your Apache.<br/>


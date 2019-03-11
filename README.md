# products-catalog

a very simple and light-weight "search in results" project.

all that is needed to run is xampp configured to default htdocs path or other path
just download the files to the htdocs folder or to designated xampp projects path
setup a database credentials in config/config.php
  // DB Params
  define('DB_HOST', '<host address (localhost for xampp)>');
  define('DB_USER', '<username>');
  define('DB_PASS', '<password>');
  define('DB_NAME', '<database name>');
  
*once searched for first time server will set up the log table if not exist

*configuring xampp 
(from https://stackoverflow.com/questions/18902887/how-to-configuring-a-xampp-web-server-for-different-root-directory)
1. Go to C:\xampp\apache\conf\httpd.conf.
2. Open httpd.conf.
3. Find tag : DocumentRoot "C:/xampp/htdocs"
4. Edit tag to : DocumentRoot "C:/xampp/htdocs/myproject/web" or any other path
5. Now find tag and change it to < Directory "C:/xampp/htdocs/myproject/web" > or same path defined above
6. Restart Your Apache.


<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Test my PostgreSql Database </title>
    </head>
    <body>
   
    <p><em>Retrieving all tuples from the artist table</em></p>

 <form id="testdb" name="testdb" method="post" action="">
            <p> <lable for="name"> Enter your User Name:</lable>
            <input name="iuser" type="text" id="iuser" />
            </p>
            <p> <lable for="name"> Enter your password:</lable>
            <input name="ipass" type="password" id="ipass" />
            </p>
            <p> <input type="submit" name="bfetch" value="Fetch"/>
        </form>      
		<?php
		if (array_key_exists('ipass', $_POST) && array_key_exists('iuser', $_POST))
		{
			// Connecting, selecting database    
			$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=".$_POST['iuser']." user=".$_POST['iuser']." password=".$_POST['ipass'])        
			or die('Could not connect: ' . pg_last_error());
			
			// Printing database object
			echo "$dbconn";

			// Performing SQL query
			$query = 'SELECT * FROM sailors.boats';
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());

			// Printing results in HTML

			echo "<table>\n";
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				echo "\t<tr>\n";
				foreach ($line as $col_value) {
					echo "\t\t<td>$col_value</td>\n";
				}
				echo "\t</tr>\n";
			}
			echo "</table>\n";

			// Free resultset
			pg_free_result($result);

			// Closing connection
			pg_close($dbconn);
		}
		?>

    </body>
</html>


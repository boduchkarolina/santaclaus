<?php
	session_start();

	if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false )
		header("Location: index.php");


		require 'connection.php'

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Baza Grzecznych lub mniej dzieci Świętego Mikołaja</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/index.css">
  </head>
  <body>
    <div class="container-fluid">
    <div class="jumbotron text-center">
      <h1 class="logo-txt">Witaj świety Mikołaju</h1>
      <img src="santa.jpg" class="img-responsive">
    </div>
    </div>
    <button type="button" onclick="alert('Hello world!')">Click Me!</button>



		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Connecting, selecting database
  // Performing SQL query
  $query = 'SELECT * FROM children';
  $result = pg_query( $query ) or die('Query failed: ' . pg_last_error());

  // Printing results in HTML
  echo "<table>\n";

  while ( $line = pg_fetch_array( $result, null, PGSQL_ASSOC ) )
  {
      echo "\t<tr>\n";

      foreach ($line as $col_value)
      {

          echo "\t\t<td>$col_value</td>\n";

      }
      echo "\t</tr>\n";
  }
  echo "</table>\n";

  // Free resultset
  pg_free_result($result);

  // Closing connection
  pg_close($dbconn);
?>

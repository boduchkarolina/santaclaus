<?php
	session_start();

		require 'connection.php';
		$GLOBALS['active'] = "add";
		if( isset( $_POST['add'] ) && $_POST['add'] == 'true'  )
		{
        $name = $_POST['child_name'];
        $surname =  $_POST['child_surrname'];
        $age = $_POST['child_age'];
        $address = $_POST['child_address'];

				$GLOBALS['notyfication'] = "";


        if( validForm( $name, $surname, $age, $address ) )
        {
			      $query = "INSERT INTO children ( child_name, child_surname, child_age, child_address ) VALUES ( '".$name."','". $surname."','".$age."','".$address."' )";
            pg_query( $query ) or die('Query failed: ' . pg_last_error());
        }
				else
				$GLOBALS['notyfication'] = "Error: ".$GLOBALS['notyfication'];
		}


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Baza Grzecznych lub mniej dzieci Świętego Mikołaja</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
  </head>
  <body>
    <div class="container-fluid">
    <div class="jumbotron text-center">
      <h1 class="logo-txt">Witaj świety Mikołaju</h1>
    </div>
    </div>
		<?php
			require 'navigation.php';
		?>
		<div class="row">
			<div class="container-fluid">
				<div class = "col-md-5">
          <?php
          	if( $GLOBALS['notyfication'] != "" )
					 			echo $GLOBALS['notyfication'];
          ?>
          <form action="add.php" method="post">
            <div class="form-group">
              <label for="">  Imię  </label>
              <input type="text" class="form-control" name="child_name" value="">
            </div>
            <div class="form-group">
              <label for="">  Nazwisko  </label>
              <input type="text" class="form-control" name="child_surrname" value="">
            </div>
            <div class="form-group">
              <label for=""> Wiek </label>
              <input type="number" class="form-control" name="child_age" value="">
            </div>
            <div class="form-group">
              <label for="">  Adress</label>
              <input type="text" class="form-control" name="child_address" value="">
            </div>
            <input type="hidden" name="add" value="true">
            <input  class="btn btn-default" type="submit" value="Dodaj">
          </form>

        </div>
			</div>
		</div>



		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

<?php
  // Free resultset
  pg_free_result($result);

  // Closing connection
  pg_close($dbconn);
?>

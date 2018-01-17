<?php
	session_start();

		require 'connection.php';

		if( isset( $_POST['add'] ) && $_POST['add'] == 'true'  )
		{
        $name = $_POST['child_name'];
        $surname =  $_POST['child_surrname'];
        $age = $_POST['child_age'];
        $address = $_POST['child_address'];

        if( validForm( $name, $surname, $age, $address ) )
        {
			       $query = "INSERT INTO children ( child_name, child_surname, child_age, child_address ) VALUES ( '".$name."','". $surname."','".$age."','".$address."' )";
            pg_query( $query ) or die('Query failed: ' . pg_last_error());

             $notyfication = "Dane dodane poprawnie";
        }
        else
        {
          echo $name." ".$surname." ".$age." ".$address;
          $notyfication = "Żadne pole nie może być puste";
        }
		}

    function validForm( $name, $surname, $age, $address )
    {
      if(  $name != null && $name != "" ){
        if(  $surname != null && $surname != "" )
          if(  $age != null && $age != "" )
            if(   $address != null && $address != "" )

              return true;
            }
          return false;
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
    <link rel="stylesheet" href="/css/index.css">
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
				<div class = "col-md-10">
          <?php
            echo $notyfication;
          ?>
          <form action="add.php" method="post">
            <label for="">
              Imię
              <input type="text" name="child_name" value="">
            </label>
            <label for="">
              Nazwisko
              <input type="text" name="child_surrname" value="">
            </label>
            <label for="">
              Wiek
              <input type="number" name="child_age" value="">
            </label>
            <label for="">
              Adress
              <input type="text" name="child_address" value="">
            </label>
            <input type="hidden" name="add" value="true">
            <input type="submit" value="Wyślij">
          </form>


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

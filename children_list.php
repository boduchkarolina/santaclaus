<?php
	session_start();

	if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false )
		header("Location: index.php");


		require 'connection.php';

		$GLOBALS['notyfication'] = "";

		if( isset( $_GET['delate'] ) )
		{
			$query = "DELETE FROM children where child_id=".$_GET['delate']."";
			echo $query;
			pg_query( $query ) or die('Query failed: ' . pg_last_error());
		}

		if(  isset( $_GET['update'] ))
		{
			if( validForm($_GET['name'], $_GET['surname'], $_GET['age'], $_GET['address']) )
			{
				$query = "UPDATE children SET child_name = '".$_GET['name']."', child_surname = '".$_GET['surname']."', child_age='".$_GET['age']."', child_address='".$_GET['address']."'  WHERE child_id =".$_GET['id'];
				pg_query( $query ) or die('Query failed: ' . pg_last_error());
				header("Location: children_list.php");
			}
			else
				$GLOBALS['notyfication'] = "Error: ".$GLOBALS['notyfication'];

		}
		$idToEdit = null;

		if( isset( $_GET['edit'] ) )
			$idToEdit = $_GET['edit'];

		$query = 'SELECT * FROM children';
		$result = pg_query( $query ) or die('Query failed: ' . pg_last_error());

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
					<?php if( $GLOBALS['notyfication'] != "" ) echo $GLOBALS['notyfication']; ?>
				 <table class="table table-striped">
					 <tr>
					 	<th>ID</th>
						<th>Imię</th>
						<th>Nazwisko</th>
						<th>Wiek</th>
						<th>Miejsce zamieszkania</th>
						<th></th>
						<th></th>
					</tr>
				 	<?php
					while ( $line = pg_fetch_array( $result, null, PGSQL_ASSOC ) )
					{
							echo "\t<tr>\n";

							$i = 1;
							foreach ($line as $col_value)
							{
									if( $idToEdit == null || $line['child_id'] != $idToEdit || $col_value ==  $line['child_id'])
										echo "\t\t<td>$col_value</td>\n";
									else if( isset($_GET['edit']) && $line['child_id'] == $idToEdit  )
										echo "<td><input type='text' id='inp".$i."' value='".$col_value."'</td>\n";
									$i++;
							}
							if( $idToEdit == null || $line['child_id'] != $idToEdit )
							{
								echo "\t\t<td><a href='children_list.php?edit=".$line['child_id']."'>edytuj</a></td>\n";
								echo "\t\t<td><a href='children_list.php?delate=".$line['child_id']."'>usuń</a></td>\n";
							}
							else if( isset($_GET['edit']) && $line['child_id'] == $idToEdit  )
							{
								echo "\t\t<td><button onclick='update(".$line['child_id'].")'>Zapisz</button></td>\n";
								echo "\t\t<td><a href='children_list.php?delate=".$line['child_id']."'>usuń</a></td>\n";
							}


							echo "\t</tr>\n";
					}
					?>
				 </table>

			</div>
		</div>



		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function update( id )
			{
					var name = $('#inp2').val()
					var surname = $('#inp3').val()
					var age = $('#inp4').val()
					var address = $('#inp5').val()
					console.log(name + " " + surname + " "+ age + " "+address );

					var link = './children_list.php?update=true&name='+name+'&surname='+surname+'&age='+age+'&address='+address+"&id="+id;
					document.location.href = link;
			}
		</script>
</body>
</html>

<?php
  // Free resultset
  pg_free_result($result);

  // Closing connection
  pg_close($dbconn);
?>

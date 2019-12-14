<?php
	//get the index from URL
	$index = $_GET['index'];
 
	//get json data
	$data = file_get_contents('velo.json');
	$data_array = json_decode($data);
 
	//assign the data to selected index
	$row = $data_array[$index];
 
?>
<?php
	if(isset($_POST['save']))
	{
		//set the updated values
		$input = array(
			'idd' => $_POST['idd'],
			'model' => $_POST['model'],
			'color' => $_POST['color'],
			'nam' => $_POST['nam'],
			'price' => $_POST['price'],
			'urlim' => $_POST['urlim']
		);
		//password_verify($password, $hashed_password)
		//update the selected index
		$data_array[$index] = $input;
		//encode back to json
		$data = json_encode($data_array, JSON_PRETTY_PRINT);
		file_put_contents('velo.json', $data);
		header('location: prod_index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Velocity</title>
</head>
<body>
<form method="POST">
	<a href="prod_index.php">Back</a>
	<p>
		<label for="idd">ID</label>
		<input type="text" id="idd" name="idd" value="<?php echo $row->idd; ?>">
	</p>
	<p>
		<label for="model">Modele</label>
		<input type="text" id="model" name="model" value="<?php echo $row->model; ?>">
	</p>
	<p>
		<label for="color">Couleur</label>
		<input type="text" id="color" name="color" value="<?php echo $row->color; ?>">
	</p>
	<p>
		<label for="nam">Marque</label>
		<input type="text" id="nam" name="nam" value="<?php echo $row->nam; ?>">
	</p>
	<p>
		<label for="price">Prix</label>
		<input type="text" id="price" name="price" value="<?php echo $row->price; ?>">
	</p>
	<p>
		<label for="urlim">Image Url</label>
		<input type="text" id="urlim" name="urlim" value="<?php echo $row->urlim; ?>">
	</p>
	<input type="submit" name="save" value="Save">
</form>
</body>
</html>
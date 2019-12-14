<?php
	if(isset($_POST['save'])){
		//open the json file
		$data = file_get_contents('velo.json');
		$data = json_decode($data);
 
		//data in out POST
		$input = array(
			'idd' => $_POST['idd'],
			'model' => $_POST['model'],
			'color' => $_POST['color'],
			'nam' => $_POST['nam'],
			'price' => $_POST['price'],
			'urlim' => $_POST['urlim']
		);
 
		//append the input to our array
		$data[] = $input;
		//encode back to json
		$data = json_encode($data, JSON_PRETTY_PRINT);
		file_put_contents('velo.json', $data);
		header('location: prod_index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD Operation on JSON File using PHP</title>
</head>
<body>
<form method="POST">
	<a href="prod_index.php">Back</a>
	<p>
		<label for="id">ID</label>
		<input type="text" id="idd" name="idd">
	</p>
	<p>
		<label for="firstname">Model</label>
		<input type="text" id="model" name="model">
	</p>
	<p>
		<label for="lastname">Color</label>
		<input type="text" id="color" name="color">
	</p>
	<p>
		<label for="address">Marque</label>
		<input type="text" id="nam" name="nam">
	</p>
	<p>
		<label for="gender">Prix</label>
		<input type="text" id="price" name="price">
	</p>
	<p>
		<label for="gender">Url</label>
		<input type="text" id="urlim" name="urlim">
	</p>
	<input type="submit" name="save" value="Save">
</form>
</body>
</html>
						<td>".$row->idd."</td>
						<td>".$row->model."</td>
						<td>".$row->color."</td>
						<td>".$row->nam."</td>
						<td>".$row->price."</td>
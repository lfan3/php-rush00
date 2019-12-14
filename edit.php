<?php
	//get the index from URL
	$index = $_GET['index'];
 
	//get json data
	$data = file_get_contents('members.json');
	$data_array = json_decode($data);
 
	//assign the data to selected index
	$row = $data_array[$index];
 
?>
<?php
	if(isset($_POST['save']))
	{
		//set the updated values
		$input = array(
			'id' => $_POST['id'],
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'address' => $_POST['address'],
			'password' => password_hash($_POST['password'],PASSWORD_DEFAULT)
		);
		//password_verify($password, $hashed_password)
		//update the selected index
		$data_array[$index] = $input;
		//encode back to json
		$data = json_encode($data_array, JSON_PRETTY_PRINT);
		file_put_contents('members.json', $data);
		header('location: index.php');
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
	<a href="index.php">Back</a>
	<p>
		<label for="id">ID</label>
		<input type="text" id="id" name="id" value="<?php echo $row->id; ?>">
	</p>
	<p>
		<label for="firstname">Firstname</label>
		<input type="text" id="firstname" name="firstname" value="<?php echo $row->firstname; ?>">
	</p>
	<p>
		<label for="lastname">Lastname</label>
		<input type="text" id="lastname" name="lastname" value="<?php echo $row->lastname; ?>">
	</p>
	<p>
		<label for="address">Address</label>
		<input type="text" id="address" name="address" value="<?php echo $row->address; ?>">
	</p>
	<p>
		<label for="Password">Password</label>
		<input type="text" id="password" name="password" value="<?php echo $row->password; ?>">
	</p>
	<input type="submit" name="save" value="Save">
</form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD Operation on JSON File using PHP</title>
</head>
<body>
<a href="add.php">Add</a>
<table border="1">
	<thead>
		<th>ID</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Address</th>
		<th>Gender</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php
			//fetch data from json
			$data = file_get_contents('members.json');
			//decode into php array
			$data = json_decode($data);
 
			$index = 0;
			foreach($data as $row){
				echo "
					<tr>
						<td>".$row->id."</td>
						<td>".$row->firstname."</td>
						<td>".$row->lastname."</td>
						<td>".$row->address."</td>
						<td>".$row->password."</td>
						<td>
							<a href='edit.php?index=".$index."'>Edit</a>
							<a href='delete.php?index=".$index."'>Delete</a>
						</td>
					</tr>
				";
 
				$index++;
			}
		?>
	</tbody>
</table>
</body>
</html>
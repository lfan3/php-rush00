<?php
header('Content-Type: application/json');
		//fetch data from json
	$data = file_get_contents('velo.json');
	//decode into php array
	$data = json_decode($data);
	$index = 0;
	$list = array_unique(explode(" ",$_COOKIE['basket']));
	//$list = array_unique(explode(" ","870266 870266 712495 821225 712495 886002 559052 1076540 1076537"));
	echo "[";
foreach($data as $row){
		if(in_array($row->idd,$list))
		echo '
			    {
			        "idd": "'.$row->idd.'",
			        "model": "'.$row->model.'",
			        "color": "'.$row->color.'",
			        "nam": "'.$row->nam.'",
			        "price": "'.$row->price.'",
			        "urlim": "'.$row->urlim.'"
			    },';

		$index++;
	}

	echo "{}]";
?>
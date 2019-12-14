<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD Operation on JSON File using PHP</title>
</head>
<body>


<div id="basket" class="paniercont">
	Panier vide
</div>

<a href="prod_add.php">Add</a>
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
			$data = file_get_contents('velo.json');
			//decode into php array
			$data = json_decode($data);
 
			$index = 0;
			echo print_r($_COOKIE);
			foreach($data as $row){
				echo "
					<tr>
						<td>".$row->idd."</td>
						<td>".$row->model."</td>
						<td>".$row->color."</td>
						<td>".$row->nam."</td>
						<td>".$row->price."</td>

						<td>
							<img class='improd' src='".$row->urlim."''>
							<a href='prod_edit.php?index=".$index."'>Edit</a>
							<a href='prod_delete.php?index=".$index."'>Delete</a>
							<button class='basket' typ ='".$row->idd."'>Ajouter au panier</button>
						</td>
					</tr>
				";
				$index++;
			}
		?>
	</tbody>
</table>
<script type="text/javascript">
var bask = document.getElementsByClassName("basket");
for(var i = 0;i < bask.length;i++)
{
	bask[i].addEventListener("click",function(){setCookie("basket",getCookie("basket") + " " +this.getAttribute("typ"),1);})
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}

var getJSON = function(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'json';
    xhr.onload = function() {
      var status = xhr.status;
      if (status === 200) {
        callback(null, xhr.response);
      } else {
        callback(status, xhr.response);
      }
    };
    xhr.send();
};
var basket;
getJSON('./miniapi.php',
function(err, data) {
  if (err !== null) {
    console.log("JSON PROBLEM")
  } else {
   	updatebasket(data);
   	console.log(data);
   	basket = data;
  }
});

function updatebasket(data){
	var bb = document.getElementById("basket");
	var elem = "<div class='basketitem'>";
	for (var i = 0; i < data.length -1; i++) {
		elem = elem + data[i]["model"] + "<br>";
		elem = elem + data[i]["price"] + "<br>";
	}
	var elem = elem + "</div>";
	bb.innerHTML = elem;
}

</script>
</body>
</html>
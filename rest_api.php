
<?php 
$link = "https://restcountries.eu/rest/v2/all";

// $data = json_decode($link,true);
 $data = json_decode(file_get_contents($link), true);
/* echo "<pre>";
print_r($data); */

foreach($data as $ix->$data){
	if(is_array($data)){
		foreach($data as $iix->$idata){
			echo $iix.":".$idata;
			
			}
		}else{
		echo $ix.":".$data;
		}
	}

//echo "<pre>";
//print_r($data);


?>
<?php
//array of names from HBO TV Series Game of Thrones
$nemarray = array(
			"Eddard Stark","Robert Baratheon","Jaime Lannister","Catelyn Stark",
			"Cersei Lannister","Daenerys Targaryen","Jorah Mormont","Petyr Baelish",
			"Oberyn Martell","Jon Snow","Viserys Targaryen","Aemon Targaryen",
			"Sansa Stark","Theon Greyjoy","Sandor Clegane","Khal Drogo",
			"Davos Seaworth","Samwell Tarly","Margaery Tyrell","Stannis Baratheon",
			"Jeor Mormont","Tormund Giantsbane","Brienne of Tarth","Ramsay Bolton",
			"Tommen Baratheon","Roose Bolton","Rickon Stark","Barristan Selmy",
			"Tyrion Lannister","Loras Tyrell","Beric Dondarrion","Yara Greyjoy",
			"Euron Greyjoy","Mance Rayder","Doran Martell","Randyll Tarly"
				);
echo $nemarray[(int)$_POST['res']];//convert sent variable to integer ex. 09 to 9
?>
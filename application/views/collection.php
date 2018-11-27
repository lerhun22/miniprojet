<div class="container">
    <div id ="home-title" class="alert alert-success">Liste des Pokemons</div>   
<h4>My Collection</h4>
	<?php
        echo "<pre>";
		print_r ($_SESSION);
		print_r ($collection);
		echo "</pre>";
/*
		foreach($collection as $col){
			echo $col->pokemon_id;
			echo "<br>";
		}
*/
	?>
</div>
</body>
</html>

<?php include "templates/header.php"; ?>


<div class="grid-container"> 
	<div class="item1" style="display: flex; justify-content: flex-end;"> <button class="land" onclick="location.href='create.php'"> Register a Madison House Member </button> 
	</div> 
	<div class="item2" style="display: flex; justify-content: flex-start;"> <button class="land" onclick="location.href='read.php'"> Find a Member of Madison House </button>
	</div>
	<div class="item3" style="display: flex; justify-content: flex-end;"> <button class="land" onclick="location.href='update.php'"> Update a Madison House Member </button>
	</div>
	<div class="item4" style="display: flex; justify-content: flex-start;"> <button class="land" onclick="location.href='delete.php'"> Delete a Madison House Member </button>
	</div>
</div> 


<?php include "templates/footer.php"; ?>
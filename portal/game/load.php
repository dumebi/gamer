<?= 
if($_POST)
{
	//sanitize post value
	$group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	
	//throw HTTP error if group number is not valid
	if(!is_numeric($group_number)){
		header('HTTP/1.1 500 Invalid number!');
		exit();
	}
	
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	
	
	//Limit our results within a specified range. 
	$results = $conn->prepare("select * from games order by name ASC LIMIT $position, $items_per_group");
	$results->execute(); //Execute prepared Query
	$results->bind_result($id, $name,$image, $type, $cost); //bind variables to prepared statement
	
	$gameID = encrypt($id); 
	echo '<ul class="page_result">';
	while($results->fetch()){ //fetch values
		echo'
							<!---------		Game -------->
				  <div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box">
					<!-- /.box-header -->
					<a href="details.php?g='.$gameID.'" style="color: inherit; cursor: pointer; cursor: hand;">
					<div class="box-body">
						   <div class="product-img">
									<img class="img-responsive" src="../../game_icons/'.$image.'" alt="Product Image">
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
						   <h4>'.$name.' <span class="label pull-right bg-green"> '.$cost.' <i class="fa fa-shopping-cart"></i></span></h4> 
						   </div>
						   <div class="col-md-12 col-sm-12 col-xs-12">
						   <p>'.$type.'<i class="fa fa-gamepad fa-lg pull-right"></i></p>
						   </div>
					  </div>
					</a>
					</div>
					<!-- /.box-body -->
				  </div>
				<!---------		Game End -------->
					';
					}

echo '</ul>';
	$mysqli->close();
}
?>
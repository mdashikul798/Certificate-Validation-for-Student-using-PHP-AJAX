<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>Document</title>
</head>
<body>
	<?php
	include('db.php');

	 $certificate = condition($_SESSION["certificate"]);

	 function condition($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if($certificate){

	//Fetching data from database
	$sql = "SELECT * FROM student WHERE certificate_num = '$certificate'";
    $result = mysqli_query($conn, $sql) or die('<h3>No record found!</h3>');

	//Fatching data from database
    if(mysqli_num_rows($result) > 0){
	    while ($row = mysqli_fetch_assoc($result)) {
?>
	<div class="cont-title"><h2>EC-Council Exam Transcription</h2></div>
	<div class="col-md-6 form-data">
		<form>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Candidate Name</label>
		    <input type="text" class="form-control" name="name" value="<?php echo $row['candidateName'] ?>" readonly>
		  </div>
		  <div class="form-group">
		    <label for="exampleInput">Test Name</label>
		    <input type="text" class="form-control" name="text_name" value="<?php echo $row['test_name']; ?>" readonly>
		  </div>
		  <div class="form-group">
		    <label for="exampleInput">Certificate No:</label>
		    <input type="text" class="form-control" name="certificate" value="<?php echo $row['certificate_num']; ?>" readonly>
		  </div>
		  <div class="form-group">
			<label for="exampleInput">Date Test Taken</label>
			<?php $testDate = new DateTime($row['test_date']);; ?>
		    <input type="text" class="form-control" name="test_date" value="<?php echo $testDate->format('j F, Y'); ?>" readonly>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Score</label>
		    <input type="text" class="form-control" name="score" value="<?php echo $row['score']; ?>" readonly>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Status</label>
		    <input type="text" class="form-control" name="status" value="<?php echo $row['status']; ?>" readonly>
		  </div>
		</form>
	</div>
  
<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>

<?php
	}
} else {
	  echo "<h3>No such result is found</h3>";
}
$conn->close();
session_destroy();
}else{
	header("Location: index.php");
}
?>

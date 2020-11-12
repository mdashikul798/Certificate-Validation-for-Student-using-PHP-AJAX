<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
	//form validation
	$message = "";
	if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty($_POST["certificate"])){
		$message = 'Student certificate number is required';
	}else{
		$certificate = condition($_POST["certificate"]);
		//Valid user name is checking
		if(!preg_match("/([a-zA-Z0-9])/",$certificate)){
			$message = 'Only letter and number';
		}
	}
	if(empty($_POST["capture"])){
		$message = 'Capture is required';
	}else{
		$capture = condition($_POST["capture"]);
		//valid email address is checking
		if(!preg_match("/([a-zA-Z0-9])/",$capture)){
			$message = 'Capture is required';
			
		}
	}

	$certificate = condition($_POST['certificate']);
	$capture = condition($_POST['capture']);
	$hidden_imgUrl = $_POST['hidden_imgUrl'];
	$capture = $_POST['capture'];
	$convert_url = substr($hidden_imgUrl, 0, -4);

	if($capture != $convert_url){
		$message = 'Invalid capture';
	}

	if(isset($_POST['certificate'])){
		$_SESSION["certificate"] = $_POST['certificate'];

		}

	if($message == ''){
			header("Location: output.php");
		}
	
}
	//condition for unwanted input
	function condition($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>
<div class="container-fluid">
	<div class="col-md-12 home_main_contents">
		<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="col-md-6">
				<div class="col-md-12 stu_certificate">
					<label for="certificate">Certificate Number:</label>
					<input type="text" name="certificate" class="form-control">
				</div>

				<div class="col-md-12 capture">
					<div class="col-md-12 mb-">
						<img id="myimage" src="imgs/1EROF.jpg" name="canvas" style="width:250px; height:70px"/>
					</div>
					<div class="col-md-12">
						<input type="text" name="capture" class="form-control">
						<label for="capture">Type the Code from the Image:</label>
					</div>
					<input type="hidden" id="imgUrl" name="hidden_imgUrl">
				</div>
				<div class="col-md-12">
					<button type="submit" class="btn btn-success pull-right">submit</button>
				</div>
			<br><br><br>
			<span class ="error">
				<?php if($message){echo $message;} ?>	
			</span>
			</div>
		</form>
	</div>
</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
<script>
	var imagesArray = ['3VOMQ.jpg', '3YHMO.jpg', '7PIR7.jpg', '8XUOV.jpg', '13NLQ.jpg', '21CLG.jpg', '29XOT.jpg', '47PMK.jpg', '81PMR.jpg', 'A6DO4.jpg', 'E584N.jpg', 'EK2OQ.jpg', 'I7IWC.jpg', 'JLYL5.jpg', 'KMOMQ.jpg', 'ORA8C.jpg', 'OYWTP.jpg', 'PHR7V.jpg', 'PTQLW.jpg', 'PY9MP.jpg', 'QHE4A.jpg', 'QSUF3.jpg', 'RFYPO.jpg', 'RP9DX.jpg', 'SCPOS.jpg', 'T5MEK.jpg', 'TQVCO.jpg', 'U7TY6.jpg', 'WJ2A4.jpg', 'WMFA3.jpg', 'ZEERZ.jpg', 'ZKF1J.jpg'];
	function displayImage(){
	    var num = Math.floor(Math.random() * (imagesArray.length));
	    document.canvas.src="imgs/"+imagesArray[num];
	    document.getElementById('imgUrl').value = imagesArray[num];
	}
	document.getElementById("myimage").innerHTML = displayImage();
</script>
</body>
</html>
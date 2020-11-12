<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        right: 0;
        margin: -15px 10px 5px 0px;
    }

    label{
        margin-top:10px;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }
    .top-section{
        margin: 20px;
    }
    .top-section a{
        float:right;
        margin-bottom:10px;
        cursor:pointer;
    }
    .top-section span{
        margin-left: 35%;
    }
    .error_message{
        color:red;
    }
    .success_message{
        color:green;
    }
    .sign-out{
        margin-left:10px;
    }
</style>
</head>
<body>
<?php
	//form validation
    $error = "";
    if($_SESSION['username'] == ''){
        header("Location: login.php");
        exit;
       }

	if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty($_POST["student_name"])){
		$error = 'Candidate name is required';
	}else{
		$student_name = condition($_POST["student_name"]);
		//Valid user name is checking
		if(!preg_match("/([a-zA-Z])/",$student_name)){
			$error = 'Only letter is accepted';
		}
    }
    if(empty($_POST["test_name"])){
		$error = 'Name of test is required';
	}else{
		$test_name = condition($_POST["test_name"]);
		//Valid user name is checking
		if(!preg_match("/([a-zA-Z])/",$test_name)){
			$error = 'Only letter is accepted';
		}
    }
    if(empty($_POST["ctr_num"])){
		$error = 'Certificate number is required';
	}else{
		$ctr_num = condition($_POST["ctr_num"]);
		//Valid user name is checking
		if(!preg_match("/([0-9])/",$ctr_num)){
			$error = 'Number formate irror';
		}
    }
    if(empty($_POST["score"])){
		$error = 'Score field is required';
	}else{
		$score = condition($_POST["score"]);
		//Valid user name is checking
		if(!preg_match("/([0-9.%])/",$score)){
			$error = 'Score number formate irror';
		}
    }
    if(empty($_POST["status"])){
		$error = 'Status field is required';
	}
    if(empty($_POST["test_date"])){
		$error = 'Date of test is required';
	}

	$candidateName = condition($_POST['student_name']);
	$test_name = condition($_POST['test_name']);
    $ctr_num = condition($_POST['ctr_num']);
    $test_date = $_POST['test_date'];
    $score = condition($_POST['score']);
    $status = $_POST['status'];
	
	if(!empty($candidateName && $test_name && $ctr_num && $test_date && $score && $status)){
		$_SESSION["candidateName"] = $candidateName;
        $_SESSION["test_name"] = $test_name;
        $_SESSION["ctr_num"] = $ctr_num;
        $_SESSION["test_date"] = $test_date;
        $_SESSION["score"] = $score;
        $_SESSION["status"] = $status;
	}

	if($error == ''){
			header("Location: save_data.php");
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
        <div class="top-section">
            <h2>Students Information</h2>
                <?php if($error){ ?>
                    <span class="error_message"><?php echo $error; ?></span>
                <?php } ?>
                <?php if(isset($_GET['success'])){ ?>
                    <span class="success_message"><?php echo $_GET['success']; ?></span>
                <?php } ?>
                <?php if(isset($_GET['error'])){ ?>
                    <span class="error_message"><?php echo $_GET['error']; ?></span>
                <?php } ?>

                <h2><a href="logout.php" class="btn btn-warning sign-out">Sign Out</a></h2>

            <!-- Trigger/Open The Modal -->
            <a id="myBtn" class="btn btn-success">Add new student</a>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Add new student information</h3>
                <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="row">
                        <div class="col-md-6 stu_certificate">
                            <label for="certificate">Candidate Name:</label>
                            <input type="text" name="student_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 capture">
                            <label for="capture">Test Name:</label>
                            <input type="text" name="test_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 capture">
                            <label for="capture">Certificate Number:</label>
                            <input type="number" name="ctr_num" class="form-control" required>
                        </div>
                        <div class="col-md-6 capture">
                            <label for="capture">Date of Test:</label>
                            <input type="date" name="test_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 capture">
                            <label for="capture">Score:</label>
                            <input type="text" name="score" class="form-control" required>
                        </div>
                        <div class="col-md-6 capture">
                            <label for="capture">Status:</label>
                            <select name="status" class="form-control" required>
                                <option value="">Choose...</option>
                                <option value="PASSED">PASSED</option>
                                <option value="FAILED">FAILED</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" style="float:right">submit</button>
                    </div>

                </form>
            </div>
        </div>
        
        <div class="col-md-12" style="clear:both">
            <table class="table" id="insert-table-data">
                <!-- Data loading from database -->
            </table>
        </div>
    </div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script src="js/jQuery.js"></script>
<script src="js/script.js"></script>
</body>
</html>
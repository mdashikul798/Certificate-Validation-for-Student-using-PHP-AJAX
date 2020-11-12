<?php
    session_start();
?>
<html>
   <head>
      <title>Login Page</title>
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
            width: 100%;
            padding: 9px;
         }
         .submit_button{
            padding: 6px;
            background: green;
            float: right;
            color: #fff;
            font-size: 18px;
         }
         .error{
             color:red;
         }
      </style>
   </head>
   <body bgcolor = "#FFFFFF">
       <?php
       
       if(isset($_SESSION['username'])){
        header("Location: index.php");
       }
        include('../db.php');
        //form validation
        $message = "";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["username"])){
            $message = 'User name is required';
        }else{
            $username = condition($_POST["username"]);
        }
        if(empty($_POST["password"])){
            $message = 'Password is required';
        }else{
            $password = condition($_POST["password"]);
        }

        $username = condition($_POST['username']);
        $password = condition($_POST['password']);
        
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql) or die('<h3>Invalid input!</h3>');
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                if($username != $row['username']){
                    $message = "User name doesn't matched";
                }else if($password != $row['password']){
                    $message = "Password  doesn't matched";
                }else{
                    $_SESSION['username'] = $username;
                }
            }
        }
        
        if($message == ''){
                header("Location: index.php");
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
      <div align = "center">
         <div style = "width:40%; border: solid 1px #333333; margin-top:5%;" align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
                <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <label>UserName  :</label><input type = "text" name = "username" class ="box" required/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" required/><br/><br />
                  
                  <span class ="error">
                    <?php if($message){echo $message;} ?>	
                </span>
                  <input type = "submit" class="submit_button" value = "Submit"/><br />
               </form>
               
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
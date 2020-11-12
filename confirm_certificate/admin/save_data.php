<?php
    session_start();
    include('../db.php');
    
    $textrand = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,5))), 1, 5);
   
    $candidateName = $_SESSION["candidateName"];
    $test_name = condition($_SESSION["test_name"]);
    $ctr_num = condition($_SESSION["ctr_num"]);
    $test_date = condition($_SESSION["test_date"]);
    $score = condition($_SESSION["score"]);
    $status = condition($_SESSION["status"]);

    $dupStd = "SELECT * FROM student WHERE certificate_num = '$ctr_num'";
    $dplResult = mysqli_query($conn, $dupStd) or die('<h3>Invalid input!</h3>');
    
               
    if ($dplResult->num_rows > 0) {
        // output data of each row
        while($row = $dplResult->fetch_assoc()) {
            if($ctr_num == $row['certificate_num']){
                header("Location: index.php?error= !Opps data already exist");
                exit;
            } 
        }
    }

    $sql = "INSERT INTO student(candidateName, test_name, certificate_num, test_date, score, status) VALUES ('{$candidateName}', '{$test_name}', '{$ctr_num}', '{$test_date}', '{$score}', '{$status}')";
    if (mysqli_query($conn, $sql)){
        header('Location: index.php?success=Data addedd successfully!');
    }else{
        header("Location: index.php?error= !Opps data doesn't saved");
    }
    
//condition for unwanted input
function condition($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
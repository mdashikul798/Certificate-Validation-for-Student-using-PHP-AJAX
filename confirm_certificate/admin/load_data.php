<?php
    include('../db.php');
    $sql = 'SELECT * FROM student ORDER BY id DESC';
    $result = mysqli_query($conn, $sql) or die('Query is faild');

    //Fatching data from database
    $output = '';
    if(mysqli_num_rows($result) > 0){
        $output = '
            <thead>
                <tr>
                <th scope="col">SL.</th>
                <th scope="col">Candidate Name</th>
                <th scope="col">Test Name</th>
                <th scope="col">Certificate Num</th>
                <th scope="col">Test Date</th>
                <th scope="col">Score</th>
                <th scope="col">Status</th>
                </tr>
            </thead>';
        $stNum = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "
                <tr>
                    <th scope='row'>{$stNum}</th>
                    <td>{$row["candidateName"]}</td>
                    <td>{$row["test_name"]}</td>
                    <td>{$row["certificate_num"]}</td>
                    <td>{$row["test_date"]}</td>
                    <td>{$row["score"]}</td>
                    <td>{$row["status"]}</td>
                </tr>";
                $stNum ++;
        }
        mysqli_close($conn);
        echo $output;
    }else{
        echo 'Record not found';
    }
    // End of fatching data from database    
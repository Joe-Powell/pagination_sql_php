<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination</title>
</head>

<body>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $db = 'blogcms';

    $conn = new mysqli($servername, $username, $password, $db);


    //how many results you want per page
    $results_per_page = 2;

    // number of results stored in database
    $sql = "SELECT id,title FROM posts";
    $result = $conn->query($sql);
    $number_of_results = mysqli_num_rows($result);
    //echo $number_of_results;


    // display on page 
    // while ($arr = $result->fetch_array()) {
    //     echo $arr['id'] . ' ' . $arr['title'] . '<br>';
    // }


    // Determine number of pages dividing $number_of_results divided by $results_per_page
    $number_of_pages = round($number_of_results / $results_per_page);
    //echo $number_of_pages;


    // determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    // determine each pages sql LIMIT OFFSET STARTING number automatically
    $starting_limit_offset_number = ($page - 1) * $results_per_page;
    // echo 'starting_limit_offset_number= ' . $starting_limit_offset_number . 'through ' . $results_per_page . '<br>';

    // make the sql 
    $sql = "SELECT * FROM posts LIMIT " . $starting_limit_offset_number . ',' . $results_per_page;
    $result = $conn->query($sql);
    // var_dump($result);

    while ($arr = $result->fetch_array()) {
        echo $arr['id'] . ' ' . $arr['title'] . '<br>';
    }




    //make previous button
    if ($page > 1) {
        echo '<a href="index.php?page=' . ($page - 1) . ' ">Previous</a> ';
        echo '<a href="index.php?page=' . 1  . ' ">Start</a> ';
    } else {
        echo '<a href="index.php?page=' . $page . ' ">Previous</a> ';
    }






    // display the links between Previous and Next to a set max number

    $max = $page + 4;

    for ($i = $page; $i <= $number_of_pages && $i < $max; $i++) {
        echo '<a href="index.php?page=' . $i . ' ">' . $i . '</a> ';
    }











    // Next Button
    if ($page < $number_of_pages) {
        echo '<a href="index.php?page=' . ($page + 1) . ' ">Next</a> ';
    }

    ?>

</body>

</html>
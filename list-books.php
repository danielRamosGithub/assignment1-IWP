<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Assignemnt 1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--My CSS Section-->
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="./css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/app.css">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h1>Book Lovers</h1>
            </div>
            <div class="row">
                    <?php
                    //insert into database
                    $servername = "localhost";
                    $database = "id1020029_library_books";
                    $username = "id1020029_daniel_db";
                    $password = "1234567890";

                    try {
                        $conn = new mysqli($servername, $username, $password, $database);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 

                        $stmt = "SELECT * FROM books";

                        $result = $conn->query($stmt);
                        
                        echo '<table border ="1"><tr><td>Book Title</td><td>Book Genre</td><td>Book Review</td><td>Reviewer</td><td>Reviewer Email</td><td>Url Store</td><td>Delete Record</td></tr>';

                        /*use a loop to cycle through data */
                        while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'. $row['book_title'] . '</td>
                                <td>'. $row['book_genre'] . '</td>
                                <td>'. $row['book_review'] . '</td>
                                <td>'. $row['book_review_person'] . '</td>
                                <td>'. $row['person_email'] . '</td>
                                <td>'. $row['book_store_link'] . '</td>
                                <td><a href="delete_book.php?book_id=' .$row['book_id'].'"onclick="return confirm(\'Are you sure?\');"> Delete</td>
                                </tr>';
                        }
                        echo '</table>';


                        }
                    catch(PDOException $e)
                        {
                        echo "Connection failed: " . $e->getMessage();
                        }

                    // close connection
                    $conn->close(); 
                    ?>
                    <div class="input-group">
                        <a href="index.html"> <button type="button" class="btn btn-info">Insert a New Book</button></a>
                    </div>
            </div>
        </div>

    <!--JavaScript Section-->
    <script src="./Scripts/jquery.min.js"></script>
    <script src="./Scripts/bootstrap.min.js"></script>
    <script src="./Scripts/app.js"></script>
    </body>
</html>
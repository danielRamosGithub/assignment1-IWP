<?php
    $servername = "localhost";
    $database = "id1020029_library_books";
    $username = "id1020029_daniel_db";
    $password = "1234567890";

    //read the id of the user to Delete
    $book_id = $_GET['book_id'];
    
    try {
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("DELETE FROM books WHERE book_id=:book_id");
        $stmt->bindParam(':book_id', $book_id);

        $stmt->execute();

        // echo "Book deleted successfully";
        }
        catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
        $conn = null;
    ?>
    <html>
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
            <div class="input-group">
                <a href="list-books.php"> <button type="button" class="btn btn-info">Go Back to Book List</button></a>
            </div>
        </body>
    </html>
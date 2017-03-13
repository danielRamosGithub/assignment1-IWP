<?php

// define variables and set to empty values\
$bookTitleErr = $bookGenreErr = $bookReviewErr = $bookReviewerErr = $reviewerEmailErr = $storeUrlErr = "";
$bookTitle = $bookGenre = $bookReview = $bookReviewer = $reviewerEmail = $storeUrl = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $formOk = true;

  if (empty($_POST["book-title"])) {
    $bookTitleErr = "Book Title is required";
    $formOk = false;
  } else {
    $bookTitle = test_input($_POST["book-title"]);
    // check if book-title only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$bookTitle)) {
      $bookTitleErr = "Only letters and white space allowed";
      $formOk = false;
    }
  }

  if (empty($_POST["book-genre"])) {
    $bookGenreErr = "Book Genre is required";
    $formOk = false;
  } else {
    $bookGenre = test_input($_POST["book-genre"]);
    // check if book-genre only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$bookGenre)) {
      $bookGenreErr = "Only letters and white space allowed";
      $formOk = false; 
    }
  }

  if (empty($_POST["book-reviewer"])) {
    $bookReviewerErr = "Book Reviewer is required";
    $formOk = false;
  } else {
    $bookReviewer = test_input($_POST["book-reviewer"]);
    // check if book-title only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$bookReviewer)) {
      $bookReviewerErr = "Only letters and white space allowed"; 
      $formOk = false;
    }
  }

  if (empty($_POST["reviewer-email"])) {
    $reviewerEmailErr = "Reviewer Email is required";
    $formOk = false;
  } else {
    $reviewerEmail = test_input($_POST["reviewer-email"]);
    // check if e-mail address is well-formed
    if (!filter_var($reviewerEmail, FILTER_VALIDATE_EMAIL)) {
      $reviewerEmailErr = "Invalid email format"; 
      $formOk = false;
    }
  }
    
  if (empty($_POST["store-url"])) {
    $storeUrl = " ";
  } else {
    $storeUrl = test_input($_POST["store-url"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$storeUrl)) {
      $websiteErr = "Invalid URL"; 
      $formOk = false;
    }
  }

  if ($formOk == true) {
    //insert into database
    $servername = "localhost";
    $database = "id1020029_library_books";
    $username = "id1020029_daniel_db";
    $password = "1234567890";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO books (`book_title`, `book_genre`, `book_review`, `book_review_person`, `person_email`, `book_store_link`) 
            VALUES (:bookTitle, :bookGenre, :bookReview, :bookReviewer, :reviewerEmail, :storeUrl)");
        $stmt->bindParam(':bookTitle', $bookTitle);
        $stmt->bindParam(':bookGenre', $bookGenre);
        $stmt->bindParam(':bookReview', $bookReview);
        $stmt->bindParam(':bookReviewer', $bookReviewer);
        $stmt->bindParam(':reviewerEmail', $reviewerEmail);
        $stmt->bindParam(':storeUrl', $storeUrl);

        $stmt->execute();
        echo 'Records added successfully. <br /> <a href="list-books.php"> View Records </a>';
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

      // close connection
      $conn = null;             
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
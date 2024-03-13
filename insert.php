<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>insertion</title>
      <style>
            form *{
                  margin-left: 15px;
                  padding-bottom: 5px;
                  display: block;
            }
            .right{
                  margin-top: 10px;
                  margin-left: 150px;
            }
      </style>
</head>
<body>
      <div class="nav">
            <a href="./overview.php">Back to overview.</a>
            <a href="./search.php">Search for a book!</a>
      </div>
      <h3>Insert new book</h3>
      <br>
      <form action="insert.php" method="post">
           <label for="book_name">Book's name:
            <input type="text" name="name" id="book_name"></label>
           <label for="isbn">ISBN:
            <input type="text" name="isbn" id="isbn"></label>
           <label for="author_fName">Author's firstname:<input type="text" name="autor_fName" id="author_fName"></label>
           <label for="author_sName">Author's surname:<input type="text" name="autor_sName" id="author_sName"></label>
           <label for="description">Description of book:
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <input class="right" type="submit" value="Insert New Book">
      </form>
      <?php 
include("dbLogin.php");
      try {
            $con=mysqli_connect($host, $user, $password, $db);
            echo "connection established <br>";
      } catch (\Throwable $th) {
           die("Cannot connect ". mysqli_errno($connection)." " . mysqli_error($connection).".</body></html>");
      }
if(
      isset($_POST["name"]) && $_POST["name"]!=""&&
      isset($_POST["isbn"]) && $_POST["isbn"]!=""&&
      isset($_POST["autor_fName"]) && $_POST["autor_fName"]!=""&&
      isset($_POST["autor_sName"]) && $_POST["autor_sName"]!=""&&
      isset($_POST["description"])       
){      
      $query= "INSERT INTO books(name, isbn, autor_fName, autor_sName, description) VALUES (
                  '" . addslashes($_POST["name"]) ."',
                  '" . addslashes($_POST["isbn"]) ."',
                  '" . addslashes($_POST["autor_fName"]) ."',
                  '" . addslashes($_POST["autor_sName"]) ."',
                  '" . addslashes($_POST["description"]) ."'
      )";

      try {
            mysqli_query($con, $query);
            echo "Book has been inserted";
      } catch (\Throwable $th) {
             die("Query failed ". mysqli_errno($connection)." " . mysqli_error($connection).".</body></html>");
      }
      mysqli_close($con);
}
?>
</body>

</html>
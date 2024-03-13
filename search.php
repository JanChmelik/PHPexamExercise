<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>search</title>
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
            table{
                  width: 100%;
            }
            table, table *{
                  border: 1px solid black;
                  border-collapse: collapse;
                  min-height: 1.5rem;
            }
      </style>
</head>
<body>
      <div class="nav">
            <a href="./insert.php">New book insertion.</a>
            <a href="./overview.php">Go back to overview!</a>
      </div>
      <h3>Search</h3>
      <form action="search.php" method="post">
            <label for="searchName">Search by name<input type="text" name="name" id="searchName"></label>
            <label for="searchIsbn">Search by ISBN<input type="text" name="isbn" id="searchIsbn"></label>
            <label for="searchAuthorFirst">Search by Author's firstname<input type="text" name="autor_fName" id="searchAuthorFirst"></label>
            <label for="searchAuthorSur">Search by author's surname<input type="text" name="autor_sName" id="searchAuthorSur"></label>
            <input type="submit" value="Search">
      </form>
      <?php
      //aquiring and concatenating my query from form
      if (
            isset($_POST["name"])&&
            isset($_POST["isbn"])&&
            isset($_POST["autor_fName"])&&
            isset($_POST["autor_sName"])
      ) {
      $query= "SELECT * FROM books WHERE 1=1";
      //how to make that lowercase - in scriptae
            if ($_POST["name"]!="") {
                  $query.= " AND name = '". addslashes($_POST["name"]) ."'";
            }
            if ($_POST["isbn"]!="") {
                  $query.= " AND isbn = '". addslashes($_POST["isbn"])."'";
            }
            if ($_POST["autor_fName"]!="") {
                  $query.= " AND autor_fName = '". addslashes($_POST["autor_fName"]) ."'";
            }
            if ($_POST["autor_sName"]!="") {
                  $query.= " AND autor_sName = '". addslashes($_POST["autor_sName"]) ."'";
            }

        
      //establishing connection to dba
      include("dbLogin.php");
      try {
            $connection=mysqli_connect($host, $user, $password, $db);
            // echo "connection established <br>";
      } catch (\Throwable $th) {
           die("Cannot connect ". mysqli_errno($connection)." " . mysqli_error($connection).".</body></html>");
      }
      echo $query;
       
?>

 <table>
            <thead>
                  <tr>
                        <th>Book's name</th>
                        <th>isbn</th>
                        <th>author's firstname</th>
                        <th>author's surname</th>
                        <th>Book's description</th>
                  </tr>
            </thead>
            <?php 
try {
                  $result=mysqli_query($connection, $query);
            foreach ($result as $item) {
            ?>
            <tr>
                  <td><?php echo $item["name"]!=""?$item["name"]:"undefined";?></td>
                  <td><?php echo $item["isbn"];?></td>
                  <td><?php echo $item["autor_fName"];?></td>
                  <td><?php echo $item["autor_sName"];?></td>
                  <td><?php echo $item["description"];?></td>
            </tr>
            <?php
      } //foreach
      mysqli_close($connection);
            } catch (\Throwable $th) {

                   die("Query failed ". mysqli_errno($connection).":". mysqli_error($connection).".</body></html>");
            }
   

            ?>
      </table>
 <?php
      } // if for isset
      ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>overview</title>
      <style>
            table, table *{
                  border: 1px solid black;
                  border-collapse: collapse;
                  min-height: 1.5rem;
            }

      </style>
</head>
<body>
         <?php 
            include("dbLogin.php");
            try {
                 $connection=mysqli_connect($host, $user, $password, $db);
                 ?>
                 <div class="message">
                  <p class="dismissInTen">
                        <?php echo "connection established <br>"; ?>
                  </p>
                 </div> 
                 <?php
            } catch (\Throwable $th) {
                  die("Cannot connect ". mysqli_errno($connection)." " . mysqli_error($connection).".</body></html>");
            } // /catch
            $query="SELECT * FROM books";
            try {
                  $result=mysqli_query($connection, $query);
            } catch (\Throwable $th) {
                   die("Query failed ". mysqli_errno($connection).":". mysqli_error($connection).".</body></html>");
            }
            
            ?>
      <div class="nav">
            <a href="./insert.php">New book insertion.</a>
            <a href="./search.php">Search for a book!</a>
      </div>
      <h3>Overview</h3>
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

               foreach ($result as $item) {
            ?>
            <tr>
                  <td><?php echo $item["name"];?></td>
                  <td><?php echo $item["isbn"];?></td>
                  <td><?php echo $item["autor_fName"];?></td>
                  <td><?php echo $item["autor_sName"];?></td>
                  <td><?php echo $item["description"];?></td>
            </tr>
            <?php
      } //foreach

            ?>
      </table>
</body>
         
</html>
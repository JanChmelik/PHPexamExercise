<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <style>
            table, table *{
                  border: 1px solid black;
                  border-collapse: collapse;
            }

      </style>
</head>
<body>
         <?php 
            include("dbLogin.php");
            try {
                 $connection=mysqli_connect($host, $user, $password, $db);
            echo "connection established <br>";
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
      <h3>Overview</h3>
      <div class="nav">
            <a href="./insert.php">New book insertion.</a>
            <a href="">Search for a book!</a>
      </div>
      <h4>books:</h4>
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
                  <td><?php echo $item["isbn"].",- Kc"?></td>
                  <td><?php echo $item["autor_fName"];?></td>
                  <td><?php echo $item["autor_sName"];?></td>
                  <td><?php echo $item["description"];?></td>
                  <td>
                        <form action="27.php" method="POST">
                              <input type="submit" name="objednat" value="Objednat">
                              <input type="hidden" name="productId" value="<?php echo $item["id_produkt"]?>">
                        </form>
                  </td>
            </tr>
            <?php
      } //foreach

            ?>
      </table>
</body>
         
</html>
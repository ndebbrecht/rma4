<!DOCTYPE html>
<html>
<head>
  <title>Meilenstein 4 - Rich Media Applications</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="starter-template.css" rel="stylesheet">
</head>
<body>
  <table class="table">
    <?
      $objInARow = 0;
      $file = fopen('data.csv');
      while (($line = fgetcsv($file)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
          $objInARow++;
          echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
      }
      fclose($f);
    ?>
  </table>
  <button href="form.php?info=<?$objInARow?>" class="btn btn-primary">Add</button>
</body>
</html>

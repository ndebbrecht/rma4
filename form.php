<html>
<head>
  <title>Add Data - Meilenstein 4 - Rich Media Applications</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="starter-template.css" rel="stylesheet">
</head>
<body>
  <form action="index.php" method="get">
    <?
      $file = fopen('data.csv', "r");
      $content = array();
      while(($line = fgetcsv($file)) !== false){
        array_push($content,$line);
      };
      fclose($file);

    $cells = count($content[0]);
    $i = 0;
    for(;$i<$cells;$i++){
      if(isset($_GET['edit'])){
        $value = $content[$_GET['edit']][$i];
      } else {
        $value = "";
      }
      echo "<input type='text' name=".$i." value='".$value."'/>";
    }
    ?>
    <input type="submit" <?
      if(isset($_GET['edit']))
      {
        $j = $_GET['edit'];
        echo 'name="delete" value="'.$j.'"';
      };
      ?>>
  </form>
</body>
</html>

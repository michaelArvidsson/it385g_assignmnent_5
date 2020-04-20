<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newspaper article database</title>
</head>
<body>
    <form metod='POST' action='response.php'>
<?php
 
    $xml = file_get_contents('https://wwwlab.iit.his.se/gush/XMLAPI/articleservice/papers');
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);
    
    $newspapers= $dom->getElementsByTagName('NEWSPAPER');
    foreach ($newspapers as $newspaper){
  echo $newspaper->getAttribute("NAME");
    }

  echo "<select name='paper'>";

  echo "</select>";

  
?>
</body>
</html>
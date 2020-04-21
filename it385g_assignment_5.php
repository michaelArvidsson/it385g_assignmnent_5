<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newspaper article database</title>
</head>
<body>
    <form metod='POST' action='response_it385g_assignment_5.php'>
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
    echo "<option value='".$attributes['TYPE']->value."'>";  
    echo "</select>";

  
?>
<input style='margin-left:10px'; type='submit' name='submitbutton' value='Submit!'>
  </form>
</body>
</html>
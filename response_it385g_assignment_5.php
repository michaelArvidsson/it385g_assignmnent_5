<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newspaper aarticle database</title>
</head>
<body>
<table border='1'>
<?php
 
    // Morning edition is default
    if(isset($_POST['paper'])){
        $paper=$_POST['paper'];
    }else{
        $paper="Morning_Edition";
    }
    /* echo "<pre>";
    print_r($_POST);
    echo "</pre>"; */
 $xml = file_get_contents("https://wwwlab.iit.his.se/gush/XMLAPI/articleservice/articles?paper=".$paper);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $newspapers= $dom->getElementsByTagName('NEWSPAPER');
    foreach ($newspapers as $newspaper){
      echo "<tr>";
 
      $attributes = $newspaper->attributes;
      echo "<td>".$attributes['NAME']->value."</td>";

      echo "<td>".$newspaper->getAttribute("SUBSCRIBERS")."</td>";    
      echo "<td>".$newspaper->getAttribute("TYPE")."</td>";
      
      foreach ($newspaper->childNodes as $child){
        $text=trim($child->nodeValue);
        if($text!=""){
            echo "<td>".$text."</td>";
        }
    }      
      echo "</tr>";
      
  }
  
?>
</table>
</body>
</html>
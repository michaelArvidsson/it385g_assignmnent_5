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
    
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

 $xml = file_get_contents("https://wwwlab.iit.his.se/gush/XMLAPI/articleservice/articles?paper=".$paper);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $newspapers= $dom->getElementsByTagName('NEWSPAPER');
    $articles= $dom->getElementsByTagName('NEWSPAPER');
    echo "<tr><th id='headline'>Paper</th><th id='headline'>Subscribers</th><th id='headline'>Type</th><th id='head' colspan='6'>Article</th></tr>";
    foreach ($newspapers as $newspaper){
      
      echo "<td>".$newspaper->getAttribute("NAME")."</td>";
      echo "<td>".$newspaper->getAttribute("SUBSCRIBERS")."</td>";    
      echo "<td>".$newspaper->getAttribute("TYPE")."</td>";

    
    foreach ($newspaper->childNodes as $child){
      if($child->getAttribute("DESCRIPTION")=='News'){
        echo "<td style='background:yellow;'>";        
      }else{
        echo "<td style='background:lightblue'>";        
      }
        $text=trim($child->nodeValue);
        if($text!=""){           
            echo "ID: ";
            echo "<span>";
            echo $child->getAttribute("ID");
            echo $child->getAttribute("TIME");
            echo $child->getAttribute("DESCRIPTION");
            echo "</span>";
            echo $text;
            echo "</td>";
        }
    }  
        
      echo "</tr>";
      
    }
  
?>
</table>
</body>
</html>
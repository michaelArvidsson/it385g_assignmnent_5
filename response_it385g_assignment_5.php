<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newspaper article database</title>
  <style>
    table {
      border-collapse: collapse;
    }
    h3 {
      text-align:center;
      text-decoration: underline;
      padding-top:10px;
    }
    #article{
      width:350px;
      padding:10px;
      
    }
    tr {
      border-bottom: 1px solid black;
    }
  </style>
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

    $xml = file_get_contents("https://wwwlab.iit.his.se/gush/XMLAPI/articleservice/articles?paper=".$paper);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $newspapers= $dom->getElementsByTagName('NEWSPAPER');
    echo "<tr><th id='headline'>Paper</th><th id='headline'>Subscribers</th><th id='headline'>Type</th><th id='head' colspan='6'>Article</th></tr>";
    foreach ($newspapers as $newspaper){
        echo "<tr>";
        echo "<td>".$newspaper->getAttribute("NAME")."</td>";
        echo "<td>".$newspaper->getAttribute("SUBSCRIBERS")."</td>";    
        echo "<td>".$newspaper->getAttribute("TYPE")."</td>";
        foreach ($newspaper->childNodes as $article){
            echo "<td style=border:0px;'>";
            echo "ID: ";
            echo $article->getAttribute("ID");
            echo "<br>";
            echo $article->getAttribute("TIME");
            echo "<br>";
            echo $article->getAttribute("DESCRIPTION");

            
            if($article->getAttribute("DESCRIPTION")=='News'){
              echo "<div id='article' style='background:yellow;'>";        
            }else{
              echo "<div id='article'style='background:lightblue'>";        
            }
           
              $attributes = $article->attributes;
              foreach ($article->childNodes as $text){
                if($text->tagName == "HEADING"){
                    foreach($text->childNodes as $heading){
                        echo "<h3>";
                        echo $heading->nodeValue;
                        echo "</h3>";
                    }   

                }else{
                  foreach($text->childNodes as $story){
                    echo "<p>";
                    echo $story->nodeValue;
                    echo "</p>";
                  }  
                }
              }
              echo "</div>";
              echo "</td>";
        }         
        echo "</tr>";
        /* echo "<pre>";
        echo print_r($article);
        echo "</pre>";     */
    }  
?>
</table>
</body>
</html>
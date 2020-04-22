<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newspaper article database</title>
  <style>
    body {
      width:100%;
    }
    #head {
        background-color: #EDECE8;
        color:darkslategrey;
        width:100%;
        font-size: 200%;
        font-weight: bold;
        letter-spacing: 5px;
        text-align: center;
        text-shadow: 2px 2px rgba(0, 0, 0, 0.1);
        padding:10px;
        margin:0px;
    }
    /* #headline {
        background-color: #EDECE8;
        color:darkslategrey;
        font-size: 120%;
        font-weight: bold;
        letter-spacing: 5px;
        text-align: center;
        text-shadow: 2px 2px rgba(0, 0, 0, 0.1);
        padding:10px;
        margin-top:0px;
        margin-bottom:0px;
    } */
    #head_a {
        color:darkslategrey;
        font-weight:bold;
        font-size:120%;
        transform: rotate(180deg);
        white-space: nowrap;
        text-align: center;
        text-shadow: 2px 2px rgba(0, 0, 0, 0.1);
        border-right:0px;
    }
    #head_b {
        color:darkslategrey;
        transform: rotate(180deg);
        white-space: nowrap;
        text-align: center;
        border-left:0px;
    }
    table {
        border-collapse: collapse;
        background-color: #EDECE8;
    }
    h3 {
        color:#525252;
        text-align:center;
        text-decoration: underline;
      
    }
    #article{
        width:350px;
        padding:10px;
        margin: 10px;
        border-radius: 5px;      
    }
    tr {
        border-bottom: 1px solid black;
    }
    #article_att {
        color:darkslategrey;
        margin:20px;
    }
    p {
        border: 1px dashed grey;
        border-radius: 5px;
        padding: 5px;
        margin-top:0px;
        margin-bottom: 20px; 
    } 
    span {
      margin: 5px;
    } 
  </style>
</head>
<body>
<h1 id='head'>Newspaper article database</h1>
<table border='1'>
<?php
 
    // Morning edition is default
    if(isset($_POST['paper'])){
        $paper=$_POST['paper'];
    }else{
        $paper="Morning_Edition";
    }
    if (empty($paper)) {
      $paper = "Morning_Edition";
    }
    
    $xml = file_get_contents("https://wwwlab.iit.his.se/gush/XMLAPI/articleservice/articles?paper=".$paper);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

    $newspapers= $dom->getElementsByTagName('NEWSPAPER');
   
    foreach ($newspapers as $newspaper){
        echo "<tr>";
        echo "<td id='head_a'><span style='writing-mode: vertical-lr;'>".$newspaper->getAttribute("NAME")."</span></td>";
        echo "<td id='head_b'><span style='writing-mode: vertical-lr;'>";
        echo "Edition: ";
        echo $newspaper->getAttribute("TYPE");
        echo "</span>";
        echo "<span style='writing-mode: vertical-lr;'>Subscribers: ";    
        echo $newspaper->getAttribute("SUBSCRIBERS")."</span></td>";

        foreach ($newspaper->childNodes as $article){
            echo "<td style='vertical-align:top; border:0px;'>";
            if($article->getAttribute("DESCRIPTION")=='News'){
              echo "<div id='article' style='background:#ffd28a; box-shadow: 2px 2px 5px 2px darkorange;'>";        
            }else{
              echo "<div id='article'style='background:#ede1ec; box-shadow: 2px 2px 5px 2px purple;'>";        
            }
            echo "<div style='border-bottom: 1px solid grey; text-align:center;'>";
            echo "<span id='article_att'>";
            echo "ID: ";
            echo $article->getAttribute("ID");
            echo "</span>";
            echo "<span id='article_att'>";
            echo $article->getAttribute("DESCRIPTION");
            echo "</span>";
            echo "<span id='article_att'>";
            echo $article->getAttribute("TIME");
            echo "</span>";
            echo "</div>";
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
    }  
?>
</table>
</body>
</html>
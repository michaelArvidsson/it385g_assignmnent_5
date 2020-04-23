<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newspaper article database</title>
  <style>
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
        margin-top:0px;
        margin-bottom:10px;
    }
  form {
        width:600px;
        background-color: #EDECE8;
        padding:50px;
        margin:auto;      
        box-shadow: 2px 2px 4px 2px;
    }
    #form_body {
        Width:400px;
        margin:auto;
        font-weight:bold;
        font-size:15px;
    }

  </style>
</head>
<body>
    <h1 id='head'>Newspaper article database</h1>
    <form method='POST' action='response_it385g_assignment_5.php'>
    <div id=form_body>
      <label style="margin-right:10px">Select Newspaper</label>
      <select name='paper'>
    
<?php
 
      $xml = file_get_contents('https://wwwlab.iit.his.se/gush/XMLAPI/articleservice/papers');
      $dom = new DomDocument;
      $dom->preserveWhiteSpace = FALSE;
      $dom->loadXML($xml);
      echo "<option value=''>---";
      $newspapers= $dom->getElementsByTagName('NEWSPAPER');
      foreach ($newspapers as $newspaper){
        echo "<option value='".$newspaper->getAttribute("TYPE")."'>";
        echo $newspaper->getAttribute("NAME");       
        echo "</option>";
      }
     
?>
      </select>
      <input style='margin-left:10px'; type='submit' name='submitbutton' value='Show result'>
    </div>
    </form>
</body>
</html>
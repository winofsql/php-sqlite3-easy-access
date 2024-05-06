<?php 

try {
  
  $db = new PDO('sqlite:../lightbox.sqlite3');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $syain = $db->query("SELECT * FROM 社員マスタ");
    
  $db = null;
}
catch ( PDOException $ex ) {
  print $ex->getMessage();
}

$result = "";

$cols = $syain->columnCount();

$result = "<table>";

foreach ( $syain as $row ) { 

  $result .= "<tr>";
  for( $i = 0; $i < $cols; $i++ ) {
      $result .= "<td class='p-1 text-nowrap'>{$row[$i]}</td>";
  }
  $result .= "</tr>";

}

$result .= "</table>";

require_once("view.php");

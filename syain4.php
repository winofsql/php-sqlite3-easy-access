<?php 

try {
  
  $db = new PDO('sqlite:../lightbox.sqlite3');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = <<<QUERY_DATA
    select 
      社員コード,
      氏名,
      フリガナ,
      所属,
      CASE
        WHEN 性別 = 0 THEN "男性"
        WHEN 性別 = 1 THEN "女性"  
      END as 性別,
      strftime('%Y/%m/%d',作成日) as 作成日,
      strftime('%Y/%m/%d',更新日) as 更新日,
      printf("%,d",給与) as 給与,
      printf("%,d",手当) as 手当,
      管理者,
      strftime('%Y/%m/%d',生年月日) as 生年月日
    from 社員マスタ
QUERY_DATA;

  $syain = $db->query( $query );
    
  $db = null;
}
catch ( PDOException $ex ) {
  print $ex->getMessage();
}

$result = "";

$cols = $syain->columnCount();

$result = "<table>";

for( $i = 0; $i < $cols; $i++ ) {
    $result .= "<th class='p-1 text-nowrap'>{$syain->getColumnMeta($i)["name"]}</th>";
}

foreach ( $syain as $row ) { 

  $result .= "<tr>";
  for( $i = 0; $i < $cols; $i++ ) {
      $result .= "<td class='p-1 text-nowrap'>{$row[$i]}</td>";
  }
  $result .= "</tr>";

}

$result .= "</table>";

require_once("view.php");

<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Retrieve query strings
$country = $_GET['country'];
$cityParam = $_GET['context'];
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

// Make SQL query based on query string
$stmt = getQuery($conn, $country, $cityParam);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

/**
 * Makes queries to SQL based on the query string
 */
function getQuery($conn, $country, $cityParam){
  if($cityParam != "cities"){
    return $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  }else{
    return $conn->query("SELECT cities.name, cities.district,cities.population 
                         FROM countries LEFT JOIN cities ON countries.code = cities.country_code 
                         WHERE countries.name LIKE '%$country%'");
  }
}
?>

<table>
<?php
$cityStr = ''; 
$headerStr = '';
$headerStr .= '<tr>';
$headerStr .= '<th>Name</th>';
  if($cityParam != "cities"){
    $headerStr .= '<th>Continent</th>';
    $headerStr .= '<th>Independence</th>';
    $headerStr .= '<th>Head of State</th>';
  }else{
    $headerStr .= '';
    $headerStr .= '<th>District</th>';
    $headerStr .= '<th>Population</th>';
  }
  $headerStr .= '</tr>';

  echo $headerStr;
  foreach ($results as $row):
    if($cityParam != "cities"){
      $cityStr .= "<tr>";
      $cityStr .= "<td>{$row['name']}</td>";
      $cityStr .= "<td>{$row['continent']}</td>";
      $cityStr .= "<td>{$row['independence_year']}</td>";
      $cityStr .= "<td>{$row['head_of_state']}</td>";
      $cityStr .= "</tr>";
    }else{
      $cityStr .= "<tr>";
      $cityStr .= "<td>{$row['name']}</td>";
      $cityStr .= "<td>{$row['district']}</td>";
      $cityStr .= "<td>{$row['population']}</td>";
      $cityStr .= "</tr>";
    }
    echo $cityStr;
?>
<?php endforeach; ?>
</table>



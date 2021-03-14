!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pagination</title>
</head>
<body>
<?php
// connect to database
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'pagination');

// define how many results you want per page
$results_per_page = 10;

// find out the number of results stored in database
$sql='SELECT * FROM alphabet';
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);


// determine number of total pages available

$number_of_pages = ceil($number_of_results/$results_per_page);     //l3adad howa 2.6 wlakin CEIL rada traj3o 3 (idakan matalan 4,2 radi yweli 5)



// determine which page number visitor is currently on

if (!isset($_GET['page'])) {                              //ida mafhamtich chof a5ir wah7da
  $page = 1;
} else {
  $page = $_GET['page'];
}


// determine the sql LIMIT starting number for the results on the displaying page

$this_page_first_result = ($page-1)*$results_per_page;     //page1(0*10=0) / page2(1*10=10) / page1(2*10=20)



// retrieve selected results from database and display them on page
$sql='SELECT * FROM alphabet LIMIT ' . $this_page_first_result . ',' .  $results_per_page;    //LIMIT = l7ad (lbedya mnin rada tjib ',' ch7al rada tjib)
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
  echo $row['id'] . ' ' . $row['alphabet']. '<br>';     //rada teTale3 fe saf7a attribut id o alphabet dyal rows dyal tables lirada tjib
}


// display the links to the pages

for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';      //123(1 = index.php / 2 = index.php?page=2 / 3 = index.php?page=3)
}

?>
</body>
</html>
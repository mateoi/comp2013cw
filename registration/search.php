<html>
<head>
<Title>Search Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search for registered people</h1>
<p>Enter the name you wish to search for, then click <strong>Search</strong>.</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Name  <input type="text" name="name" id="name"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "bbf7e198f118fd";
    $pwd = "2eb24775";
    $db = "phptestAKHclfkuG";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }

    if (!empty($_POST)) {
        // Retrieve data
        $name = $_POST['name'];
        $sql_select = "SELECT * FROM registration_tbl WHERE name = \"".$name."\"";
        $stmt = $conn->query($sql_select);
        $registrants = $stmt->fetchAll(); 
        if(count($registrants) > 0) {
            echo "<h2>People who are registered with that name:</h2>";
            echo "<table>";
            echo "<tr><th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Company Name</th>";
            echo "<th>Date</th></tr>";
            foreach($registrants as $registrant) {
                echo "<tr><td>".$registrant['name']."</td>";
                echo "<td>".$registrant['email']."</td>";
                echo "<td>".$registrant['cname']."</td>";
                echo "<td>".$registrant['date']."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>No one is currently registered with that name.</h3>";
        }
    }
?>
<a href="index.php">Go back</a>
</body>
</html>
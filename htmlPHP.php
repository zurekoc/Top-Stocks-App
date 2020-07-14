<table>
    <tr>
        <th>
            <a href="?orderBy=exchange">Exchange:</a>
        </th>
        <th>
            <a href="?orderBy=symbol">Symbol:</a>
        </th>
        <th>
            <a href="?orderBy=company">Company:</a>
        </th>
        <th>
            <a href="?orderBy=volume">Volume:</a>
        </th>
        <th>
            <a href="?orderBy=price">Price:</a>
        </th>
        <th>
            <a href="?orderBy=change">Change:</a>
        </th>
    </tr>
</table>
<?php
$servername = localhost;
$database = mysql;
$username = "root";

$connection = mysqli_connect($servername, $username, $database);
if(!conn){
	die("No connection." . mysqli_connect_error());
}
else
	echo "Successful connection.";

$sql = "CREATE TABLE stockexchange (exchange CHAR(10), symbol VARCHAR(20), company VARCHAR(25), volume DEC(20), price DEC(20), change DEC(20))";

if($connection->query($sql) == TRUE){
	echo "Table stockexchange created successfully.";
}
else
	echo "Error creating the table. " . $connection->error;

$sql = "INSERT INTO stockexchange (exchange, symbol, company, volume, price, change) VALUES (%s, %s, %s, %d, %d, %d)";

if(mysqli_query($connection, $sql)){
	echo "Insertion successful.";
}
else
	echo "Error occurred with " . $sql . mysqli_error($connection);

$orderBy = array('exchange','symbol','company','volume','price','change');
$order = 'exchange';
if(isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)){
	$order = $_GET['orderBy'];
}

$query = 'SELECT * FROM stockexchange ORDER BY '.$order;

//retrieve and show data
mysqli_close($connection);
?>

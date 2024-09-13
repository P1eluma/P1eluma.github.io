<?php
// Database connection
$servername = "localhost";
$username = "Paul";
$password = "65623@bsix.ac.uk";
$dbname = "Inventory";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve products and inventory statistics
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Products</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Price</th><th>Quantity</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>$" . $row["price"] . "</td><td>" . $row["quantity"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}

// Calculate inventory statistics
$total_products_sql = "SELECT COUNT(*) AS total_products FROM products";
$total_products_result = $conn->query($total_products_sql);
$total_products = $total_products_result->fetch_assoc()["total_products"];

$total_quantity_sql = "SELECT SUM(quantity) AS total_quantity FROM products";
$total_quantity_result = $conn->query($total_quantity_sql);
$total_quantity = $total_quantity_result->fetch_assoc()["total_quantity"];

echo "<h2>Inventory Statistics</h2>";
echo "<p>Total Products: " . $total_products . "</p>";
echo "<p>Total Quantity: " . $total_quantity . "</p>";

// Close database connection
$conn->close();
?>

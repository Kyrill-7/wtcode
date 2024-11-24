<?php
// products.php
include('db_config.php');
session_start();

// Farmer-specific functionality (add product)
if ($_SESSION['user_type'] == 'farmer' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $farmer_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];

    // Insert product into database
    $stmt = $pdo->prepare("INSERT INTO products (farmer_id, name, description, price, stock_quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$farmer_id, $name, $description, $price, $stock_quantity]);

    echo "Product added successfully!";
}

// Display products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($products as $product) {
    echo "<h2>" . htmlspecialchars($product['name']) . "</h2>";
    echo "<p>" . htmlspecialchars($product['description']) . "</p>";
    echo "<p>Price: $" . htmlspecialchars($product['price']) . "</p>";
    echo "<p>Stock: " . htmlspecialchars($product['stock_quantity']) . "</p>";
}
?>

<!-- Farmer product add form -->
<?php if ($_SESSION['user_type'] == 'farmer') { ?>
    <form method="POST" action="products.php">
        Name: <input type="text" name="name" required><br>
        Description: <textarea name="description" required></textarea><br>
        Price: <input type="number" name="price" step="0.01" required><br>
        Stock Quantity: <input type="number" name="stock_quantity" required><br>
        <input type="submit" value="Add Product">
    </form>
<?php } ?>

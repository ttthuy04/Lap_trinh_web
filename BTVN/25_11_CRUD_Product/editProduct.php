<?php
session_start();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $products = $_SESSION['products'];

    // Tìm sản phẩm theo ID
    foreach ($products as $key => $product) {
        if ($product['id'] === $id) {
            $currentProduct = $product;
            $productKey = $key;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Cập nhật thông tin sản phẩm
    $_SESSION['products'][$productKey]['name'] = $name;
    $_SESSION['products'][$productKey]['price'] = $price;

    // Quay về trang index
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Product</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $currentProduct['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $currentProduct['price'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>

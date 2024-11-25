<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Lấy danh sách sản phẩm hiện tại
    $products = $_SESSION['products'];

    // Tính ID mới (lớn nhất hiện tại + 1)
    $newId = count($products) + 1;

    // Thêm sản phẩm mới
    $products[] = [
        'id' => $newId,
        'name' => $name,
        'price' => $price,
    ];

    // Lưu lại danh sách sản phẩm vào session
    $_SESSION['products'] = $products;

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
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add Product</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>

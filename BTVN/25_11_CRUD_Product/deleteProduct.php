<?php
session_start();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Lấy danh sách sản phẩm hiện tại
    $products = $_SESSION['products'];

    // Tìm và xóa sản phẩm theo ID
    $products = array_filter($products, function ($product) use ($id) {
        return $product['id'] !== $id;
    });

    // Sắp xếp lại ID từ 1 đến N
    $products = array_values($products);
    foreach ($products as $index => $product) {
        $products[$index]['id'] = $index + 1;
    }

    // Lưu lại danh sách sản phẩm vào session
    $_SESSION['products'] = $products;

    // Quay về trang index
    header('Location: index.php');
    exit();
}
?>

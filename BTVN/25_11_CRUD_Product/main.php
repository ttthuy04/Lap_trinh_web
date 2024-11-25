<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu mảng sản phẩm chưa được lưu trong session, khởi tạo mảng sản phẩm mặc định
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        ['id' => 1, 'name' => 'Sản phẩm 1', 'price' => 100000],
        ['id' => 2, 'name' => 'Sản phẩm 2', 'price' => 200000],
        ['id' => 3, 'name' => 'Sản phẩm 3', 'price' => 300000],
    ];
}

// Hàm thêm sản phẩm
function addProduct($name, $price) {
    // Lấy mảng sản phẩm từ session
    $products = $_SESSION['products'];
    
    // Tạo ID cho sản phẩm mới
    $newProduct = [
        'id' => count($products) + 1,
        'name' => $name,
        'price' => $price
    ];

    // Thêm sản phẩm vào mảng
    $products[] = $newProduct;

    // Lưu lại mảng vào session
    $_SESSION['products'] = $products;
}

// Hàm xóa sản phẩm
function deleteProduct($id) {
    // Lấy mảng sản phẩm từ session
    $products = $_SESSION['products'];

    // Tìm và xóa sản phẩm theo ID
    foreach ($products as $index => $product) {
        if ($product['id'] == $id) {
            unset($products[$index]);
            break;
        }
    }

    // Đổi lại chỉ số mảng
    $_SESSION['products'] = array_values($products);
}

// Hàm sửa sản phẩm
function editProduct($id, $name, $price) {
    // Lấy mảng sản phẩm từ session
    $products = $_SESSION['products'];

    // Tìm và sửa sản phẩm theo ID
    foreach ($products as &$product) {
        if ($product['id'] == $id) {
            $product['name'] = $name;
            $product['price'] = $price;
            break;
        }
    }

    // Lưu lại mảng vào session
    $_SESSION['products'] = $products;
}
?>

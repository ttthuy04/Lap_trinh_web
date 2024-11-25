<?php
session_start();
include 'includes/flowers.php'; // Dữ liệu ban đầu của hoa
include 'includes/functions.php'; // Các hàm xử lý

$isAdmin = isset($_GET['admin']) && $_GET['admin'] === 'true';

if (!isset($_SESSION['flowers'])) {
    $_SESSION['flowers'] = $flowers; // Lưu hoa vào session
}

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']; // Sử dụng $_FILES thay vì $_POST cho hình ảnh

    // Kiểm tra nếu có ảnh được tải lên
    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/';
        $uploadFile = $uploadDir . basename($image['name']);

        // Kiểm tra xem file có phải là hình ảnh không
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowedTypes)) {
            // Di chuyển file từ thư mục tạm tới thư mục images/
            if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                // Lưu thông tin hoa vào session
                $flowerData = [
                    'name' => $name,
                    'description' => $description,
                    'image' => $uploadFile
                ];

                if ($action === 'edit' && isset($id)) {
                    $_SESSION['flowers'][$id] = $flowerData;
                } elseif ($action === 'add') {
                    $_SESSION['flowers'][] = $flowerData;
                }

                header('Location: admin.php?admin=true'); // Chuyển hướng sau khi lưu dữ liệu
                exit;
            } else {
                echo "Lỗi khi tải ảnh lên.";
            }
        } else {
            echo "Chỉ cho phép tải ảnh với các định dạng JPG, JPEG, PNG, GIF.";
        }
    } else {
        echo "Lỗi khi tải ảnh lên: " . $image['error'];
    }
} elseif ($action === 'delete' && $isAdmin && isset($id)) {
    unset($_SESSION['flowers'][$id]);
    $_SESSION['flowers'] = array_values($_SESSION['flowers']); // Reset lại chỉ số mảng
    header('Location: admin.php?admin=true');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Quản lý danh sách các loài hoa</h1>
    <?php if ($isAdmin): ?>
    <a href="admin.php?action=add&admin=true" class="btn btn-primary mb-4">Thêm mới hoa</a>
    <?php displayAdminView($_SESSION['flowers']); ?> <!-- Hiển thị danh sách hoa cho admin -->
    <?php if ($action === 'edit' || $action === 'add'): ?>
        <form method="post" enctype="multipart/form-data" class="mt-4"> <!-- Thêm enctype để hỗ trợ tải file -->
            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $action === 'edit' ? $_SESSION['flowers'][$id]['name'] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea name="description" id="description" class="form-control" required><?= $action === 'edit' ? $_SESSION['flowers'][$id]['description'] : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success"><?= $action === 'edit' ? 'Cập nhật' : 'Thêm mới' ?></button>
        </form>
    <?php endif; ?>
<?php else: ?>
    <?php displayGuestView($_SESSION['flowers']); ?> <!-- Hiển thị hoa cho người dùng -->
<?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card img {
            width: 100%; /* Chiều rộng 100% theo thẻ chứa */
            height: 200px; /* Chiều cao cố định */
            object-fit: cover; /* Cắt ảnh để phù hợp kích thước */
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Danh sách các loài hoa</h1>
    <div class="row">
        <?php 
        session_start();
        include 'includes/flowers.php';
        
        if (!isset($_SESSION['flowers'])) {
            $_SESSION['flowers'] = $flowers;
        }

        foreach ($_SESSION['flowers'] as $index => $flower): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= $flower['image'] ?>" class="card-img-top" alt="<?= $flower['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $flower['name'] ?></h5>
                        <p class="card-text"><?= $flower['description'] ?></p>
                    </div>
                </div>
            </div>
            <?php if (($index + 1) % 3 == 0): ?>
                </div><div class="row">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<footer class="bg-dark text-light py-4 mt-4">
    <div class="container text-center">
        <p class="mb-1">&copy; 2024 - Quản lý danh sách các loài hoa</p>
        <p class="mb-0">Liên hệ: <a href="mailto:support@flowers.com" class="text-warning">support@flowers.com</a></p>
        <p class="mb-0">
            <a href="#" class="text-light mx-2">Chính sách bảo mật</a> | 
            <a href="#" class="text-light mx-2">Điều khoản sử dụng</a>
        </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


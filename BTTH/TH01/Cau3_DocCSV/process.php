<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Kiểm tra nếu form được gửi bằng phương thức POST
    // Kiểm tra tệp CSV được tải lên
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $csvTmpPath = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Kiểm tra định dạng tệp
        if ($fileExtension !== 'csv') {
            echo "<p style='color: red;'>Only .csv files are accepted.</p>";
            exit;
        }

        // Đọc tệp CSV
        $file = fopen($csvTmpPath, 'r');
        $data = [];
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row; // Lưu từng dòng dữ liệu vào mảng $data
        }
        fclose($file);

        // Lưu vào session để sử dụng sau này
        $_SESSION['csv_data'] = $data;

        // Hiển thị dữ liệu
        echo "<h1>Data from the CSV file:</h1>";
        echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
        echo "<thead style='background-color: #f2f2f2;'><tr>";
        foreach ($data[0] as $header) { // Giả định dòng đầu tiên là tiêu đề
            echo "<th>" . htmlspecialchars($header) . "</th>";
        }
        echo "</tr></thead>";
        echo "<tbody>";
        for ($i = 1; $i < count($data); $i++) { // Hiển thị dữ liệu từ dòng thứ 2 trở đi
            echo "<tr>";
            foreach ($data[$i] as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p style='color: red;'>File upload failed! Please try again.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        form {
            margin-bottom: 20px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Upload CSV File</h1>
    <form method="POST" enctype="multipart/form-data" action="">
        <label for="csv_file">Select a CSV file:</label>
        <input type="file" id="csv_file" name="csv_file" accept=".csv" required>
        <br><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>

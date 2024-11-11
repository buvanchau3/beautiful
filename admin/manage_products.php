<?php
session_start();
require_once "config.php";

$sql_products = "SELECT * FROM products";
$sql_categories = "SELECT * FROM categories";

$result_products = $conn->query($sql_products);
$result_categories = $conn->query($sql_categories);

$sql = "SELECT * FROM products";
$resuilt = $conn->query($sql_products);


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar h2 {
            padding: 15px;
            font-size: 1.5rem;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .list-group-item {
            background-color: #343a40;
            border: none;
        }
        .list-group-item a {
            color: white;
        }
        .list-group-item a:hover {
            background-color: #495057;
            color: white;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2 class="text-center">Bảng điều khiển Admin</h2>
        <ul class="list-group">
            <li class="list-group-item bg-dark"><a href="index.php">Trang chủ</a></li>
            <li class="list-group-item bg-dark"><a href="manage_products.php">Quản lý sản phẩm</a></li>
            <li class="list-group-item bg-dark"><a href="manage_orders.php">Quản lý đơn hàng</a></li>
            <li class="list-group-item bg-dark"><a href="manage_users.php">Quản lý người dùng</a></li>
            <li class="list-group-item bg-dark"><a href="manage_categories.php">Quản lý danh mục</a></li>
            <li class="list-group-item bg-dark"><a href="manage_coupons.php">Mã giảm giá</a></li>
            <li class="list-group-item bg-dark"><a href="#">Đăng xuất</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Quản lý sản phẩm</h1>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Thêm sản phẩm</button>

        <!-- Modal Thêm sản phẩm -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm mới</h5>
                        <!-- messsage thong bao -->
                         
                        <?php if (isset($_GET['message'])): ?>
                            <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
                        <?php endif; ?>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addProductForm" action="add_product.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Danh mục</label>
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <?php
                                    if ($result_categories->num_rows > 0) {
                                        while ($category = $result_categories->fetch_assoc()) {
                                            echo "<option value='" . $category['category_id'] . "'>" . $category['name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Tải lên hình ảnh</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- show san pham -->
        <div class="container mt-5">
            <h1>Danh sách sản phẩm</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kiểm tra xem có sản phẩm nào không
                    if ($result_products->num_rows > 0) {
                        while ($row = $result_products->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . number_format($row["price"], ) . " VNĐ</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td><img src='" . $row["image_path"] . "' alt='" . $row["name"] . "' title='" . $row["name"] . "' style='width: 100px;'></td>";
                            echo "<td>
                    <a href='edit_product.php?id=" . $row["product_id"] . "' class='btn btn-warning btn-sm'>Sửa</a> 
                    <form action='delete_product.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này không?\");'>Xóa</button>
                    </form>
                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Không có sản phẩm nào</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
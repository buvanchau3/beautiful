<?php
$id = $_GET['id'];
$sql_brand = "SELECT * FROM brands";
$query_brand = mysqli_query($connect, $sql_brand);

$sql_up = "SELECT * FROM products WHERE prd_id = '$id'";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);
if(isset($_POST['submit'])){
    $prd_name = $_POST['prd_name'];
    if( $_FILES['image']['name'] == ''){
        $image = $row_up['image']; //Nếu không có file ảnh giữ lại ảnh cũ
    } else{
        $image = $_FILES['image']['name']; // Nếu có file ảnh mới, lấy tên ảnh mới
        $image_tmp = $_FILES['image']['tmp_name'];  // Lấy tên tạm thời của file ảnh mới
         // Di chuyển file ảnh từ thư mục tạm vào thư mục chính thức
        move_uploaded_file($image_tmp, 'img/'.$image);
    }
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $brand_id = $_POST['brand_id'];

    $sql = "UPDATE products SET prd_name = '$prd_name',image = '$image',price = '$price',quantity = '$quantity',description = '$description',brand_id='$brand_id' WHERE prd_id = '$id'";
    $query = mysqli_query($connect, $sql);
   
    header('location:index.php?page_layout=view_product.php');
}
?>
<div class="container-fluid">
 <div class="card">
    <div class="card-header">
        <h2>Sửa sản phẩm</h2>
    </div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">
        <div class="from-groud">
          <label for="">Tên sản phẩm</label>
          <input type="text" name="prd_name" class="form-control" value="<?php echo $row_up['prd_name'] ?>" required><br>
        </div>
        <div class="from-groud">
          <label for="">Ảnh sản phẩm</label>
          <br>
          <input type="file" name="image" value="<?php $row_up['image'] ?>"  required>
        </div><br>
        <div class="from-groud">
          <label for="">Giá sản phẩm</label>
          <input type="text" name="price" class="form-control" value="<?php echo $row_up['price'] ?>" required>
        </div>
        <div class="from-groud">
          <label for="">Số lượng sản phẩm</label>
          <input type="text" name="quantity" class="form-control" value="<?php echo $row_up['quantity'] ?>" required>
        </div>
        <div class="from-groud">
          <label for="">Mô tả sản phẩm</label>
          <input type="text" name="description" class="form-control" value="<?php echo $row_up['description'] ?>" required>
        </div>
        <div class="from-groud">
          <label for="">Thương hiện</label>
          <select class="form-control" name="brand_id">
           <?php while($row_brand_id = mysqli_fetch_assoc($query_brand)){?>
            <option value=" <?php echo $row_brand_id['brand_id'] ?> "><?php echo $row_brand_id['brand_name'] ?> </option>

            <?php } ?>
          </select>
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Sửa</button>
       </form>
    </div>
 </div>    
</div>

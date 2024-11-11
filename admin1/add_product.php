<?php
$sql_brand = "SELECT * FROM brands";
$query_brand = mysqli_query($connect, $sql_brand);
if(isset($_POST['submit'])){
    $prd_name = $_POST['prd_name'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $brand_id = $_POST['brand_id'];

    $sql = "INSERT INTO products(prd_name,image,price,quantity,description,brand_id) VALUES ('$prd_name','$image','$price','$quantity','$description','$brand_id')";
    $query = mysqli_query($connect, $sql);
    move_uploaded_file($image_tmp, 'img/'.$image);
    header('location:index.php?page_layout=view_product.php');
}
?>
<div class="container-fluid">
 <div class="card">
    <div class="card-header">
        <h2>Thêm sản phẩm</h2>
    </div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">
        <div class="from-groud">
          <label for="">Tên sản phẩm</label>
          <input type="text" name="prd_name" class="form-control" required><br>
        </div>
        <div class="from-groud">
          <label for="">Ảnh sản phẩm</label>
          <br>
          <input type="file" name="image"  required>
        </div><br>
        <div class="from-groud">
          <label for="">Giá sản phẩm</label>
          <input type="text" name="price" class="form-control" required>
        </div>
        <div class="from-groud">
          <label for="">Số lượng sản phẩm</label>
          <input type="text" name="quantity" class="form-control" required>
        </div>
        <div class="from-groud">
          <label for="">Mô tả sản phẩm</label>
          <input type="text" name="description" class="form-control" required>
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

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
       </form>
    </div>
 </div>    
</div>

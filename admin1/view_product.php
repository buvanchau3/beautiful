<?php
$sql = "SELECT * FROM products inner join brands on products.brand_id = brands.brand_id";
$query = mysqli_query($connect, $sql);
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>ảnh sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Mô tả phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Xoá</th>
                        <th>Sửa</th>
                      
                    </tr>
                </thead>
                <tbody>
              <?php
              $i = 1;
              while($row = mysqli_fetch_assoc($query)){ ?>
                <tr>
                        <td><?php echo $i++ ;?></td>
                        <td><?php echo $row['prd_name'] ?></td>
                        <td>
                           <a href="#"> <img src="img/<?php echo $row['image']?>" style="width: 100px; height: 100px"></a>
                            <?php echo $row['image']?>
                           
                        </td>
                        <td><?php echo $row['price']?></td>
                        <td><?php echo $row['quantity']?></td>
                        <td><?php echo $row['description']?></td>
                        <td><?php echo $row['brand_name']?></td>
                        <td>
                            <a onclick="return del('<?php echo $row['prd_name']; ?>')" class="btn btn-danger" href="index.php?page_layout=delete_product&id=<?php echo $row['prd_id']?> ">Xoá</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="index.php?page_layout=edit_product&id=<?php echo $row['prd_id'] ?>">Sửa</a>
                        </td>
                    </tr>
    
             <?php } ?>
                </tbody>
            </table>
            <a class="btn btn-primary" href="index.php?page_layout=add_product">Thêm mới</a>
        </div>
    </div>
</div>
<script>
    const del = (name)=>{
        return confirm("Bạn có chắc chắn muốn xoá sản phẩm: " + name + " ? ");
    }
</script>
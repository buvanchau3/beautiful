<?php
require_once 'db/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <title>home</title>
</head>
<body>
    <?php
    if (isset($_GET['page_layout'])){
      switch ($_GET['page_layout']) {
        case 'view_product':
          require_once 'admin1/view_product.php';
          break;
       case 'add_product':
          require_once 'admin1/add_product.php';
          break;
       case 'delete_product':
          require_once 'admin1/delete_product.php';
         break;
       case 'edit_product':
         require_once 'admin1/edit_product.php';
          break;                            
        default:
          require_once 'admin1/view_product.php';
          break;
      }
    }else{
        require_once 'admin1/view_product.php';    
    }
    
    ?>
</body>
</html>
<?php
    require_once 'partials/connect.php';
    require_once 'view/seller-api.php';
    require_once 'model/seller-model.php';
    require_once 'view/product-api.php';
    require_once 'model/product-model.php';

    $pdo = connect($host, $db, $password, $charset);
    $sellerModel = new SellerModel($pdo);
    $sellerApi = new SellerApi($pdo);
    $productModel = new ProductModel($pdo);
    $productApi = new ProductApi($pdo);

    if (isset($_GET['action'])) {
        $chosenAction = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($chosenAction == 'sellers'){
            $sellerApi->outputSellers($sellerModel->getSellers());
        }

        if ($chosenAction == 'seller') {
            if (isset($_GET['id'])) {
                $data = $sellerModel->getSellerAndProductsById($_GET['id']);
                $sellerApi->outputSellerAndProductsById($data['sellerData'], $data['productData']);
            }
        }
         
        if ($chosenAction == 'products'){
            $productApi->outputProducts($productModel->getProducts());
        }

        if ($chosenAction == 'product'){
            if(isset($_GET['id'])){
                $productApi->outputProductById($productModel->getProductById($_GET['id']));
            }
        }

        if ($chosenAction == 'add-product'){
            $productApi->addProduct();
        }

        if ($chosenAction == 'add-seller'){
            $sellerApi->addSeller();
        }

        if ($chosenAction == 'update-product'){
            $productApi->updateProduct();
        }

        if ($chosenAction == 'update-seller'){
            $sellerApi->updateSeller();
        }

        if ($chosenAction == 'delete-seller'){
            $sellerApi->deleteSeller();
        }

        if ($chosenAction == 'delete-product'){
            $productApi->deleteProduct();
        }
    }
?>
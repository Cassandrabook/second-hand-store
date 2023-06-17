<?php
    class ProductApi{
        private $pdo;
       
        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function outputProducts(array $products):void {
            $json = [
                'product-count'=>count($products),
                'result'=>$products
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }

        public function outputProductById(array $products):void {
            $json = [
                'Produkt'=>$products
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }

        public function addProduct(){
            $data = json_decode(file_get_contents("php://input"), true);

            $name = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $size = filter_var($data['size'], FILTER_SANITIZE_SPECIAL_CHARS);
            $price = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT);
            $sellerId = filter_var($data['seller_id'], FILTER_SANITIZE_NUMBER_INT);
            $sold = filter_var($data['sold'], FILTER_SANITIZE_NUMBER_INT);

            $productModel = new ProductModel($this->pdo);
            $productId = $productModel->addProduct($name, $size, $price, $sellerId, $sold);

            $json = [
                'message' => 'Product created successfullt',
                'product_id' => $productId
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }

        public function updateProduct(){
            $data = json_decode(file_get_contents("php://input"), true);
        
            $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
            $name = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $size = filter_var($data['size'], FILTER_SANITIZE_SPECIAL_CHARS);
            $price = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT);
            $sellerId = filter_var($data['seller_id'], FILTER_SANITIZE_NUMBER_INT);
            $sold = filter_var($data['sold'], FILTER_SANITIZE_NUMBER_INT);
            
            $dateSold = $sold ? date('Y-m-d H:i:s') : null; 
            
            $productModel = new ProductModel($this->pdo);
            $productId = $productModel->updateProduct($id, $name, $size, $price, $sellerId, $sold, $dateSold); 
        
            $json = [
                'message' => 'Product updated successfully',
                'product_id' => $productId
            ];
            
            header("Content-Type: application/json");
            echo json_encode($json);
        }
        

        public function deleteProduct() {
            $data = json_decode(file_get_contents("php://input"), true);
            $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        
            $productModel = new ProductModel($this->pdo);
            $productId = $productModel->deleteProduct($id);
        
            $json = [
                'message' => 'Product deleted successfully',
                'product_id' => $productId
            ]; 
        
            header("Content-Type: application/json");
            echo json_encode($json);
        }
    }
?>
<?php
    class SellerApi{
        private $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function outputSellers(array $sellers):void {
            $json = [
                'seller-count'=>count($sellers),
                'result'=>$sellers
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }

        public function outputSellerAndProductsById($sellerData, $productData): void {
            $json = [
                'Säljare' => $sellerData,
                'Produkter' => $productData
            ];
        
            header("Content-Type: application/json");
            echo json_encode($json);
        }

        public function addSeller(){
            $data = json_decode(file_get_contents("php://input"), true);

            $firstname = filter_var($data['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
            $lastname = filter_var($data['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);

            $sellerModel = new SellerModel($this->pdo);
            $sellerId = $sellerModel->addSeller($firstname, $lastname, $email);

            $json = [
                'message' => 'Seller created successfullt',
                'seller_id' => $sellerId
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }

        public function updateSeller(){
            $data = json_decode(file_get_contents("php://input"), true);
            
            $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
            $firstname = filter_var($data['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
            $lastname = filter_var($data['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
            
            $sellerModel = new SellerModel($this->pdo);
            $sellerId = $sellerModel->updateSeller($id, $firstname, $lastname, $email); 

            $json = [
                'message' => 'Seller updated successfully',
                'seller_id' => $sellerId
            ];
            
            header("Content-Type: application/json");
            echo json_encode($json);
            
        }
        
        public function deleteSeller() {
            $data = json_decode(file_get_contents("php://input"), true);
            $sellerId = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        
            $sellerModel = new SellerModel($this->pdo);
            $rowCount = $sellerModel->deleteSeller($sellerId);
        
            $json = [
                'message' => 'Seller deleted successfully',
                'seller_id' => $rowCount
            ];
            
            header("Content-Type: application/json");
            echo json_encode($json);
        }
    }
?>
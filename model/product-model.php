<?php
    require_once 'db.php';
    class ProductModel extends DB{

        public function __construct(PDO $pdo){
            parent::__construct($pdo, 'products', 'sellers');
        }
        
        public function getProducts(){
            $statement = $this->pdo->prepare('SELECT
            p.id AS "id",
            p.name AS "Produktnamn",
            p.size AS "Storlek",
            p.price AS "Pris",
            s.firstname AS "Säljarens förnamn",
            s.lastname AS "Säljarens efternamn",
            CASE p.sold
                WHEN 0 THEN "Nej"
                WHEN 1 THEN "Ja"
            END AS "Såld",
            DATEDIFF(CURDATE(), p.submitted_date) AS "Dagar sedan inlämnad"
            FROM ' . $this->table . ' AS p
            JOIN ' . $this->tableJoin . ' AS s ON p.seller_id = s.id
            ORDER BY p.id ASC'); 
            $statement->execute();
            return $statement->fetchAll();
        }
        

        public function getProductById(int $productId){
            $statement = $this->pdo->prepare('SELECT p.id,
            p.name AS Namn,
            p.size AS Storlek,
            p.price AS Pris,
            p.submitted_date AS Inlämnad,
            CASE p.sold
                WHEN 0 THEN "Nej"
                WHEN 1 THEN "Ja"
            END AS "Såld",
            p.date_sold AS "Försäljningsdatum", 
            p.seller_id AS "Säljarens id", 
            s.firstname AS "Säljarens förnamn", 
            s.lastname AS "Säljarens efternamn" 
            FROM ' . $this->table . ' AS p 
            JOIN ' . $this->tableJoin . ' AS s 
            ON p.seller_id = s.id WHERE p.id = :productId');
            $statement->bindValue(':productId', $productId, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll();
        }

        public function updateProduct(int $productId, string $name, string $size, float $price, int $sellerId, int $sold, string $submittedDate, ?string $dateSold = null){
            if ($sold) {
                $dateSoldValue = 'CURRENT_TIMESTAMP';
            } else {
                $dateSoldValue = 'NULL';
            }

            $statement = $this->pdo->prepare('UPDATE ' . $this->table . ' SET name = ?, size = ?, price = ?, seller_id = ?, sold = ?, submitted_date = ?, date_sold = ' . $dateSoldValue . ' WHERE id = ?');
            $statement->execute([$name, $size, $price, $sellerId, $sold, $submittedDate, $productId]);
            return $statement->rowCount();
        }


        public function addProduct(string $name, string $size, float $price, int $sellerId, int $sold){
            $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (name, size, price, seller_id, sold) VALUES (?,?,?,?,?)');
            $statement->execute([$name, $size, $price, $sellerId, $sold]);
            return $this->pdo->lastInsertId();
        }

        public function deleteProduct(int $productId){
            return $this->delete($productId);
        }
    }
?>
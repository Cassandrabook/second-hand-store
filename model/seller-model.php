<?php
    require_once 'db.php';
    class SellerModel extends DB{

        public function __construct(PDO $pdo){
            parent::__construct($pdo, 'sellers', 'products');
        }
        
        public function getSellers(){
            $statement = $this->pdo->prepare('SELECT id, firstname, lastname, email FROM ' . $this->table . ' ORDER BY firstname ASC');
            $statement->execute();
            return $statement->fetchAll();
        }

        public function getSellerAndProductsById($sellerId) {
            $sellerStatement = $this->pdo->prepare('SELECT
                s.id AS "Säljarens id",
                s.firstname AS "Säljarens förnamn",
                s.lastname AS "Säljarens efternamn",
                s.email AS "Säljarens email",
                COUNT(p.id) AS "Totalt antal inlämnade produkter",
                SUM(p.sold) AS "Totalt antal sålda produkter",
                SUM(p.price * p.sold) AS "Sålt för"
            FROM
                ' . $this->table . ' AS s
                LEFT JOIN ' . $this->tableJoin . ' AS p ON s.id = p.seller_id
            WHERE
                s.id = :sellerId
            GROUP BY
                s.id,
                s.firstname,
                s.lastname;');
        
            $sellerStatement->bindValue(':sellerId', $sellerId, PDO::PARAM_INT);
            $sellerStatement->execute();
            $sellerData = $sellerStatement->fetch();
        
            $productStatement = $this->pdo->prepare('SELECT
                p.id AS "id",
                p.name AS "Namn",
                p.size AS "Storlek",
                p.price AS "Pris",
                p.submitted_date AS "Inlämnad",
                CASE p.sold
                WHEN 0 THEN "Nej"
                WHEN 1 THEN "Ja"
            END AS "Såld",
                p.date_sold AS "Försäljningsdatum", 
                s.id AS "Säljarens id",
                s.firstname AS "Säljarens förnamn",
                s.lastname AS "Säljarens efternamn"
            FROM
                ' . $this->tableJoin . ' AS p
                LEFT JOIN ' . $this->table . ' AS s ON p.seller_id = s.id
            WHERE
                s.id = :sellerId;');
        
            $productStatement->bindValue(':sellerId', $sellerId, PDO::PARAM_INT);
            $productStatement->execute();
            $productData = $productStatement->fetchAll();
        
            return [
                'sellerData' => $sellerData,
                'productData' => $productData
            ];
        }

        public function addSeller($firstname, $lastname, $email){
            $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (firstname, lastname, email) VALUES (?,?,?)');
            $statement->execute([$firstname, $lastname, $email]);
            return $this->pdo->lastInsertId();
        }

        public function updateSeller($id, $firstname, $lastname, $email){
            $statement = $this->pdo->prepare('UPDATE ' . $this->table . ' SET firstname = ?, lastname = ?, email = ? WHERE id = ?');
            $statement->execute([$firstname, $lastname, $email, $id]);
            return $statement->rowCount();
        }

        public function deleteSeller(int $sellerId){
            return $this->delete($sellerId);
        }
    }
?>
<?php
    class DB {
        protected $pdo;
        protected $table;
        protected $tableJoin;
    
        public function __construct(PDO $pdo, string $table, string $tableJoin){
            $this->pdo = $pdo;
            $this->table = $table;
            $this->tableJoin = $tableJoin;
        }
    
        public function delete(int $id){
            $statement = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id');
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->rowCount();
        }
    
    }
?>
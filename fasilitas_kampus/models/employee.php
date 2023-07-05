<?php
    class Employee{
    // Connection
    private $conn;
    // Table
    private $db_table = "Employee";
    // Columns
    public $id;
    public $name;
    public $kegunaan;
    public $no_ruangan;
    public $jumlah_ruangan;
    public $created;
    // Db connection
    public function __construct($db){
    $this->conn = $db;
    }
    // GET ALL
    public function getEmployees(){
        $sqlQuery = "SELECT id, name, kegunaan, no_ruangan, jumlah_ruangan, created FROM "
        . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
        }
    // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
            ". $this->db_table ."
            SET
            name = :name,
            kegunaan = :kegunaan,
            no_ruangan = :no_ruangan,
            jumlah_ruangan = :jumlah_ruangan,
            created = :created";
            
        $stmt = $this->conn->prepare($sqlQuery);
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->kegunaan=htmlspecialchars(strip_tags($this->kegunaan));
        $this->no_ruangan=htmlspecialchars(strip_tags($this->no_ruangan));
        $this->jumlah_ruangan=htmlspecialchars(strip_tags($this->jumlah_ruangan));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":kegunaan", $this->kegunaan);
        $stmt->bindParam(":no_ruangan", $this->no_ruangan);
        $stmt->bindParam(":jumlah_ruangan", $this->jumlah_ruangan);
        $stmt->bindParam(":created", $this->created);

        if($stmt->execute()){
            return true;
        }
        return false;
        }
    // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id,
                        name,
                        kegunaan,
                        no_ruangan,
                        jumlah_ruangan,
                        created
                        FROM
                        ". $this->db_table ."
                        WHERE
                        id = ?
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $dataRow['name'];
            $this->kegunaan = $dataRow['kegunaan'];
            $this->no_ruangan = $dataRow['no_ruangan'];
            $this->jumlah_ruangan = $dataRow['jumlah_ruangan'];
            $this->created = $dataRow['created'];
    }
    // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        name = :name,
                        kegunaan = :kegunaan,
                        no_ruangan = :no_ruangan,
                        jumlah_ruangan = :jumlah_ruangan,
                        created = :created
                        WHERE
                        id = :id";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->kegunaan=htmlspecialchars(strip_tags($this->kegunaan));
            $this->no_ruangan=htmlspecialchars(strip_tags($this->no_ruangan));
            $this->jumlah_ruangan=htmlspecialchars(strip_tags($this->jumlah_ruangan));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":kegunaan", $this->kegunaan);
            $stmt->bindParam(":no_ruangan", $this->no_ruangan);
            $stmt->bindParam(":jumlah_ruangan", $this->jumlah_ruangan);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
            return true;
            }
            return false;
    }
    // DELETE
    function deleteEmployee(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
        return true;
        }
        return false;
      }
    }
?>
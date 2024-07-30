<?php
class Database
{
    public $conn; 

    function __construct()
    {
        $this->connect_db();
    }

    public function connect_db()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'cozyChapters');
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    public function getData()
    {
        $query = 'SELECT * FROM books';
        $result = $this->conn->query($query);
        return $result;
    }

    public function execute($isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added, $image_path)
    {
        $sql = "INSERT INTO books (isbn, book_name, authors_name, number_of_pages, edition, publisher, original_language, date_added, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param('sssiissss', $isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added, $image_path);
        $result = $stmt->execute();
        if ($result === false) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        return $result;
    }

    public function read()
    {
        return $this->getData();
    }

    public function close()
    {
        $this->conn->close();
    }
}

try{
    $conn = new PDO('mysql:host=localhost;dbname=cozyChapters','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

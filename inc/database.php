<?php
class Database
{
    private $connection;

    function __construct()
    {
        $this->connect_db();
    }

    public function connect_db()
    {
        $this->connection = new mysqli('localhost', 'root', '', 'cozyChapters');
        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function getData()
    {
        $query = 'SELECT * FROM books';
        $result = $this->connection->query($query);
        return $result;
    }

    public function execute($isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added)
    {
        $sql = "INSERT INTO books (isbn, book_name, authors_name, number_of_pages, edition, publisher, original_language, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $this->connection->error);
        }

        $stmt->bind_param('sssiisss', $isbn, $book_name, $authors_name, $number_of_pages, $edition, $publisher, $original_language, $date_added);
        $result = $stmt->execute();
        if ($result === false) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        return $result;
    }
}

$database = new Database();
?>

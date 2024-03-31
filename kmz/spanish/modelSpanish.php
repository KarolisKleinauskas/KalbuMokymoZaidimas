<!-- modelSpanish.php -->
<?php
class WordModel {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "kmz";

    public function getWords() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $words = [];

        $sql = "SELECT word FROM CategoryWordsSpanish"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $words[] = $row["word"];
            }
        }

        $conn->close();
        return $words;
    }
}
?>

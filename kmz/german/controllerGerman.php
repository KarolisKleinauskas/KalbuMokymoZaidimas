<!-- controllerGerman.php -->
<?php
require_once 'modelGerman.php';

class WordController {
    private $model;

    public function __construct() {
        $this->model = new WordModel();
    }

    public function displayWords() {
        $words = $this->model->getWords();
        foreach ($words as $word) {
            echo "<div class='word'>" . $word . "</div>";
        }
    }
}
?>

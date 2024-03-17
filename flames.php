<?php
class Flames
{
    // Properties (variables)
    private $my_name;
    private $their_name;

    private $result_array = array(
        1 => "friends",
        2 => "lovers",
        3 => "anger",
        4 => "married",
        5 => "engaged",
        0 => "soulmates"
    );

    // Constructor
    public function __construct($my_name, $their_name)
    {
        // Convert the names to lowercase and 
        // Remove any non alphabetic characters
        $this->my_name = preg_replace("/[^a-z]/", "", strtolower($my_name));
        $this->their_name = preg_replace("/[^a-z]/", "", strtolower($their_name));
    }

    public function getResults()
    {
        echo json_encode(array(
            'my_name' => $this->my_name,
            'my_name_similar_count' => $this->getCommonLettersCount($this->my_name),
            'their_name' => $this->their_name,
            'their_name_similar_count' => $this->getCommonLettersCount($this->their_name),
            'result' => $this->getResult(),
            'common_letters' => $this->getCommonLetters(),
        ));
    }

    private function getCommonLetters()
    {
        $letters = array();

        // Compare all the letters of both arrays
        foreach (str_split($this->my_name) as $letter1) {
            foreach (str_split($this->their_name) as $letter2) {
                // If there is a match, add the letter in the letters bank
                // Only add the letter in the bank if it doesnt exist yet
                if ($letter1 == $letter2 && !in_array($letter1, $letters)) {
                    array_push($letters, $letter1);
                }
            }
        }

        return $letters;
    }

    private function getResult()
    {
        $my_name_count = $this->getCommonLettersCount($this->my_name);
        $their_name_count = $this->getCommonLettersCount($this->their_name);

        $similar_count = $my_name_count + $their_name_count;
        $normalized = $similar_count % count($this->result_array);

        return $this->result_array[$normalized];
    }

    private function getCommonLettersCount($name)
    {
        $common_letters_count = 0;

        foreach (str_split($name) as $letter) {
            if (in_array($letter, $this->getCommonLetters()))
                $common_letters_count++;
        }

        return $common_letters_count;
    }
}

$flames = new Flames($_POST['myName'], $_POST['theirName']);

echo $flames->getResults();

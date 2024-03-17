<?php
class Flames
{
    // Properties (variables)
    private $my_name;
    private $their_name;
    private $my_birthday;
    private $their_birthday;

    private $result_array = array(
        1 => "friends",
        2 => "lovers",
        3 => "anger",
        4 => "married",
        5 => "engaged",
        0 => "soulmates"
    );

    // Constructor
    public function __construct($my_name, $their_name, $my_birthday, $their_birthday)
    {
        // Convert the names to lowercase and 
        // Remove any non alphabetic characters
        $this->my_name = preg_replace("/[^a-z]/", "", strtolower($my_name));
        $this->their_name = preg_replace("/[^a-z]/", "", strtolower($their_name));
        $this->my_birthday = $my_birthday;
        $this->their_birthday = $their_birthday;
    }

    public function getResults()
    {
        $this->savePromptToDB();

        // Parse the birthdate to extract month and day
        list($my_year, $my_month, $my_day) = explode('-', $this->my_birthday);
        list($their_year, $their_month, $their_day) = explode('-', $this->their_birthday);

        return json_encode(array(
            'my_name' => $this->my_name,
            'my_name_similar_count' => $this->getCommonLettersCount($this->my_name),
            'their_name' => $this->their_name,
            'their_name_similar_count' => $this->getCommonLettersCount($this->their_name),
            'result' => $this->getResult(),
            'common_letters' => $this->getCommonLetters(),
            'my_zodiac' => $this->getZodiacSign($my_month, $my_day),
            'their_zodiac' => $this->getZodiacSign($their_month, $their_day),
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

    public function savePromptToDB()
    {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = ""; // Default password is empty in XAMPP
        $database = "flames"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO prompts (myName, theirName, myBirthday, theirBirthday) VALUES ('$this->my_name', '$this->their_name', '$this->my_birthday', '$this->their_birthday')";

        // Execute the query
        $conn->query($sql);

        // Close the connection
        $conn->close();
    }

    public function getZodiacSign($month, $day)
    {
        // Array of zodiac signs and their corresponding date ranges
        $zodiacSigns = array(
            array("name" => "Capricorn", "start_date" => "12-22", "end_date" => "01-19"),
            array("name" => "Aquarius", "start_date" => "01-20", "end_date" => "02-18"),
            array("name" => "Pisces", "start_date" => "02-19", "end_date" => "03-20"),
            array("name" => "Aries", "start_date" => "03-21", "end_date" => "04-19"),
            array("name" => "Taurus", "start_date" => "04-20", "end_date" => "05-20"),
            array("name" => "Gemini", "start_date" => "05-21", "end_date" => "06-20"),
            array("name" => "Cancer", "start_date" => "06-21", "end_date" => "07-22"),
            array("name" => "Leo", "start_date" => "07-23", "end_date" => "08-22"),
            array("name" => "Virgo", "start_date" => "08-23", "end_date" => "09-22"),
            array("name" => "Libra", "start_date" => "09-23", "end_date" => "10-22"),
            array("name" => "Scorpio", "start_date" => "10-23", "end_date" => "11-21"),
            array("name" => "Sagittarius", "start_date" => "11-22", "end_date" => "12-21")
        );

        // Convert month and day to a date format
        $date = sprintf("%02d-%02d", $month, $day);

        // Loop through the zodiac signs array to find the corresponding sign
        foreach ($zodiacSigns as $sign) {
            // Checks for 2 scenarios
            // - For when the date goes beyond the year;
            // - For when it doesn't

            // Checks for when the start_date is lesser than or equal to the end_date
            $condition1 = ($date >= $sign['start_date'] && $date <= $sign['end_date'] && $sign['start_date'] <= $sign['end_date']);

            // Checks for when the start_date is greater than or equal to the end_date
            $condition2 = $sign['start_date'] > $sign['end_date'] && ($date >= $sign['start_date'] || $date <= $sign['end_date']);

            if ($condition1 || $condition2) {
                return $sign['name'];
            }
        }

        // If no sign found, return null
        return null;
    }
}

$flames = new Flames($_POST['myName'], $_POST['theirName'], $_POST['myBirthday'], $_POST['theirBirthday']);

echo $flames->getResults();

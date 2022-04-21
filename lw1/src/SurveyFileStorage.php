<?php
class SurveyFileStorage  
{
    public function saveData(Survey $survey): void
    {
        self::writeInFile($survey->getParameterFirstName(), $survey->getParameterLastName(), $survey->getParameterEmail(), $survey->getParameterAge());
    }

    public function loadFileData(Survey $survey): void
    {
        $email = $survey->getParameterEmail();
        $path = "./data/" . $email . ".txt";
        if( is_dir('data') === false )
        {
            mkdir('data');
        }
        if (file_exists($path))
        {
            $file = fopen($path, "r");
            $survey->setParameterFirstName(self::getFileSubstring(fgets($file)));
            $survey->setParameterLastName(self::getFileSubstring(fgets($file)));
            $survey->setParameterEmail(self::getFileSubstring(fgets($file)));
            $survey->setParameterAge(self::getFileSubstring(fgets($file)));
            fclose($file);
        }
        else
        {
            echo "Error upload: no such file or directory" . PHP_EOL;
        }
    }

    private static function writeInFile(?string $firstName, ?string $lastName, ?string $email, ?string $age): void
    {
        $path = "./data/" . $email . ".txt";
        if( is_dir('data') === false )
        {
            mkdir('data');
        }
        if (file_exists($path))
        {
            $file = fopen($path, "r");
            self::getSubstringInFile(file($path), $firstName, $lastName, $age);
            fclose($file);
        }
        $file = fopen($path, "w");
        $content = "First Name:" . $firstName . PHP_EOL . "Last Name:" . $lastName . PHP_EOL . "Email:" . $email . PHP_EOL . "Age:" . $age;
        fwrite($file, $content);
        fclose($file);
    }

    private static function getSubstringInFile(array $arrayStrings, ?string &$firstName, ?string &$lastName, ?string &$age): void
    {
        $firstName = $firstName ?? trim(substr($arrayStrings[0], strpos($arrayStrings[0], ':') + 1));
        $lastName = $lastName ?? trim(substr($arrayStrings[1], strpos($arrayStrings[1], ':') + 1));
        $age = $age ?? trim(substr($arrayStrings[3], strpos($arrayStrings[3], ':') + 1));
    }

    private static function getFileSubstring(?string $fileString): ?string
    {
        return (trim(substr($fileString, strpos($fileString, ':') + 1)));
    }
}
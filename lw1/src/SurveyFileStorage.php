<?php
class SurveyFileStorage  
{
    private static ?string $firstName;
    private static ?string $lastName;
    private static ?string $email;
    private static ?string $age;

    public function saveData(Survey $survey): void
    {
        SurveyFileStorage::$firstName = $survey->getParameterFirstName();
        SurveyFileStorage::$lastName = $survey->getParameterLastName();
        SurveyFileStorage::$email = $survey->getParameterEmail();
        SurveyFileStorage::$age = $survey->getParameterAge();
        $path = "./data/" . SurveyFileStorage::$email . ".txt";
        SurveyFileStorage::writeInFile($path);
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
            $survey->setParameterFirstName(SurveyFileStorage::getFileSubstring($file));
            $survey->setParameterLastName(SurveyFileStorage::getFileSubstring($file));
            $survey->setParameterEmail(SurveyFileStorage::getFileSubstring($file));
            $survey->setParameterAge(SurveyFileStorage::getFileSubstring($file));
            fclose($file);
        }
        else
        {
            echo "Error upload: no such file or directory" . PHP_EOL;
        }
    }
    
    private static function writeInFile(string $path): void
    {
        if( is_dir('data') === false )
        {
            mkdir('data');
        }
        if (file_exists($path))
        {
            $file = fopen($path, "r");
            SurveyFileStorage::getSubstringInFile(file($path));
            fclose($file);
        }
        $file = fopen($path, "w");
        $content = "First Name:" . SurveyFileStorage::$firstName . PHP_EOL . "Last Name:" . SurveyFileStorage::$lastName . PHP_EOL . "Email:" . SurveyFileStorage::$email . PHP_EOL . "Age:" . SurveyFileStorage::$age;
        fwrite($file, $content);
        fclose($file);
    }

    private static function getSubstringInFile(array $arrayStrings): void
    {
        SurveyFileStorage::$firstName = SurveyFileStorage::$firstName ?? trim(substr($arrayStrings[0], strpos($arrayStrings[0], ':') + 1));
        SurveyFileStorage::$lastName = SurveyFileStorage::$lastName ?? trim(substr($arrayStrings[1], strpos($arrayStrings[1], ':') + 1));
        SurveyFileStorage::$age = SurveyFileStorage::$age ?? trim(substr($arrayStrings[3], strpos($arrayStrings[3], ':') + 1));
    }

    private static function getFileSubstring(mixed $file): ?string
    {
        $fileString = fgets($file);
        return (trim(substr($fileString, strpos($fileString, ':') + 1)));
    }
}
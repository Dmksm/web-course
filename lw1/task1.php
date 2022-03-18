<?php
header("Content-Type: text/plain");
class Survey 
{
    private $firstName;
    private $lastName;
    private $email;
    private $age;

    public function saveParameter($firstName, $lastName, $email, $age)
    { 
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
    }
    public function getParameter($name)
    { 
        return $this->$name;       
    }
    public function setParameter($keyName, $valueName)
    {
        $this->$keyName = $valueName;
    }
}
class RequestSurveyLoader
{
    private $userData; 

    public function getParameterFromQueryString($firstName, $lastName, $email, $age)
    { 
        function getQueryStringParameter(string $name): ?string
        { 
            return isset($_GET[$name]) ? $_GET[$name] : null;
        }
        $this->userData = new Survey;
        if (getQueryStringParameter('email'))
        {
            $this->userData -> saveParameter(getQueryStringParameter($firstName), getQueryStringParameter($lastName), getQueryStringParameter($email), getQueryStringParameter($age));
            return $this->userData;
        }
        else
        {
            echo "don't got email!";
            return null;
        }
    }
}
class SurveyFileStorage  
{
    private $file;
    private $path;
    private $content;
    private $firstName;
    private $lastName;
    private $email;
    private $age;
    private $stringFromFile;

    public function getSubstringInFile(array $arrayStrings)
    { 
        $this->firstName = $this->firstName ?? trim(substr($arrayStrings[0], strpos($arrayStrings[0], ':') + 1));
        $this->lastName = $this->lastName ?? trim(substr($arrayStrings[1], strpos($arrayStrings[1], ':') + 1));
        $this->age = $this->age ?? trim(substr($arrayStrings[3], strpos($arrayStrings[3], ':') + 1)); 
    }
    public function storageData($user, $storage)
    {   
        $this->firstName = $user->getParameter('firstName');
        $this->lastName = $user->getParameter('lastName');
        $this->age = $user->getParameter('age'); 
        $this->email = $user->getParameter('email');
        $this->path = "./data/" . $this->email . ".txt";
        if (file_exists($this->path))
        {
            $this->file = fopen($this->path, "r");
            $storage->getSubstringInFile(file($this->path));
            fclose($this->file);
        }
        $this->file = fopen($this->path, "w");
        $this->content = "First Name:" . $this->firstName . "\nLast Name:" . $this->lastName . "\nEmail:" . $this->email . "\nAge:" . $this->age;
        fwrite($this->file, $this->content);
        fclose($this->file);
    }
    public function uploadUserData($user)
    {
        $this->email = $user->getParameter('email');
        $this->path = "./data/" . $this->email . ".txt";
        if (file_exists($this->path))
        {
            $this->file = fopen($this->path, "r");
            $this->stringFromFile = fgets($this->file);
            $user->setParameter('firstName', trim(substr($this->stringFromFile, strpos($this->stringFromFile, ':') + 1)));
            $this->stringFromFile = fgets($this->file);
            $user->setParameter('lastName', trim(substr($this->stringFromFile, strpos($this->stringFromFile, ':') + 1)));
            $this->stringFromFile = fgets($this->file);
            $user->setParameter('email', trim(substr($this->stringFromFile, strpos($this->stringFromFile, ':') + 1)));
            $this->stringFromFile = fgets($this->file);
            $user->setParameter('age', trim(substr($this->stringFromFile, strpos($this->stringFromFile, ':') + 1)));
            fclose($this->file);
        }
        else
        {
            echo "Error upload: no such file or directory\n";
        }
    }
}
class SurveyPrinter 
{ 
    public function printSurvey($name)
    { 
        if (file_exists("./data/" . $name->getParameter('email') . ".txt"))
        {
            echo 'First name:' . $name->getParameter('firstName') . "\n" . 'Last name:' . $name->getParameter('lastName') . "\n" . 'Email:' . $name->getParameter('email') . "\n" . 'Age:' . $name->getParameter('age') . "\n"; 
        }
        else
        {
            echo "Error printing: no such file or directory\n";
        }
    }
}
$user = new RequestSurveyLoader;
$storage = new SurveyFileStorage;
$print = new SurveyPrinter;
$user = $user->getParameterFromQueryString('first_name', 'last_name', 'email', 'age'); //user = new Survey
if ($user)
{
    $storage->storageData($user, $storage);
    $storage->uploadUserData($user);
    $print->printSurvey($user);
}
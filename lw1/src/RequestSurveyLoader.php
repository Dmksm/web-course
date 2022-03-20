<?php
class RequestSurveyLoader
{
    private $survey; 

    public function createNewSurvey(string $firstName, $lastName, $email, $age): ?object 
    { 
        $firstName = isset($_GET[$firstName]) ? $_GET[$firstName] : null;
        $lastName = isset($_GET[$lastName]) ? $_GET[$lastName] : null;
        $email =  isset($_GET[$email]) ? $_GET[$email] : null;
        $age = isset($_GET[$age]) ? $_GET[$age] : null;

        if ($email)
        {
            $this->survey = new Survey($firstName, $lastName, $email, $age);
            return $this->survey;
        }
        else
        {
            echo "don't got email!\n";
            return null;
        }
    }
}
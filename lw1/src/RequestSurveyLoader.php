<?php
class RequestSurveyLoader
{
    public function createNewSurvey(string $firstName, string $lastName, string $email, string $age): ?Survey
    { 
        $firstName = $_GET[$firstName] ?? null;
        $lastName = $_GET[$lastName] ?? null;
        $email = $_GET[$email] ?? null;
        $age = $_GET[$age] ?? null;

        if ($email)
        {
            return new Survey($firstName, $lastName, $email, $age);
        }
        else
        {
            echo "don't got email!" . PHP_EOL;
            return null;
        }
    }
}
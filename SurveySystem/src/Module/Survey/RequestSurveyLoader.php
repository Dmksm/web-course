<?php

namespace App\Module\Survey;

class RequestSurveyLoader
{
    public function createNewSurvey(string $firstName, string $lastName, string $email, string $age, string $avatar): ?Survey
    { 
        $firstName = $_POST[$firstName] ?? null;
        $lastName = $_POST[$lastName] ?? null;
        $email = $_POST[$email] ?? null;
        $age = $_POST[$age] ?? null;
        $avatar = $_FILES[$avatar] ?? null;
        if ($avatar && ($avatar["size"] < 10*1024*1024) && ($avatar["type"] === "image/png" || $avatar["type"] === "image/jpeg"))
        {
            $avatarId = uniqid();
            $format = ".png";
            if ($avatar["type"] === "image/jpeg")
            {
                $format = ".jpg";
            }
            $pathFile = "./images/" . $avatarId . $format;
            move_uploaded_file($avatar["tmp_name"], $pathFile);
            $avatar = $pathFile;
        }
        else
        {
            $avatar = null;
        }
        if ($email)
        {
            return new Survey($firstName, $lastName, $email, $age, $avatar);
        }
        else
        {
            return null;
        }
    }
}
<?php

namespace App\Module\Survey;

class RequestSurveyLoader
{
    private const maxSizeAvatar = 10*1024*1024;
    private const pngType = "image/png";
    private const jpegType = "image/jpeg";

    public function createNewSurvey(string $firstName, string $lastName, string $email, string $age, string $avatar): ?Survey
    { 
        $firstName = $_POST[$firstName] ?? null;
        $lastName = $_POST[$lastName] ?? null;
        $email = $_POST[$email] ?? null;
        $age = $_POST[$age] ?? null;
        $avatar = $_FILES[$avatar] ?? null;
        if ($avatar && ($avatar["size"] < self::maxSizeAvatar) && ($avatar["type"] === self::pngType || $avatar["type"] === self::jpegType))
        {
            $avatarId = uniqid();
            $format = ".png";
            if ($avatar["type"] === self::jpegType)
            {
                $format = ".jpg";
            }
            $pathFile = "./images/" . $avatarId . $format;
            move_uploaded_file($avatar["tmp_name"], $pathFile);
            $avatarPath = $pathFile;
        }
        else
        {
            $avatarPath = null;
        }
        if ($email)
        {
            return new Survey($firstName, $lastName, $email, $age, $avatarPath);
        }
        else
        {
            return null;
        }
    }
}
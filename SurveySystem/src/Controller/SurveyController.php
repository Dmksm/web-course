<?php

namespace App\Controller;

use App\Survey\SurveyI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    public function printSurvey(): Response
    {
        return $this->render('CreatingSurvey.html.twig', SurveyI::printingSurvey());
    }

    public function saveSurvey(): Response
    {
        return $this->render('CreatingSurvey.html.twig', SurveyI::savingSurvey());
    }
}

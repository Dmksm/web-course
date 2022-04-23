<?php

namespace App\Controller;

use App\Module\Survey\Service;
use App\View\SurveyView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    private Service $service;

    function __construct()
    {
        $this->service = new Service();
    }

    public function saveSurvey(): Response
    {
        $response = $this->service->saveSurvey();
        return $this->render(SurveyView::getTemplate(), SurveyView::getArgs($response[0], $response[1]));
    }

    public function printSurvey(): Response
    {
        $response = $this->service->printSurvey();
        return $this->render(SurveyView::getTemplate(), SurveyView::getArgs($response[0], $response[1]));
    }
}

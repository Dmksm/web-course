<?php

namespace App\Controller;

use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\Service;
use App\Module\Survey\SurveyFileStorage;
use App\View\SurveyView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    private Service $service;

    function __construct()
    {
        $this->service = new Service(new RequestSurveyLoader(), new SurveyFileStorage());
    }

    public function viewPage()
    {
        return $this->render(SurveyView::getPage(), SurveyView::getPageData());
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

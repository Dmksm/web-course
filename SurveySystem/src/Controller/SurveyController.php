<?php

namespace App\Controller;

use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\SurveyFileStorage;
use App\View\SurveyView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
    public function saveSurvey(): Response
    {
        $request = new RequestSurveyLoader();
        $storage = new SurveyFileStorage();
        $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        $title = "Don't found email!";
        if ($survey)
        {
            $storage->saveData($survey);
            $title = "Done! Saved the survey:";
        }
        return $this->render(SurveyView::getTemplate(), SurveyView::getArgs($survey, $title));
    }

    public function printSurvey(): Response
    {
        $request = new RequestSurveyLoader();
        $storage = new SurveyFileStorage();
        $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        $title = "Don't found email!";
        if ($survey)
        {
            $storage->loadFileData($survey);
            $title = "Loading old data from file:";
        }
        return $this->render(SurveyView::getTemplate(), SurveyView::getArgs($survey, $title));
    }
}

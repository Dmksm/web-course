<?php

namespace App\Module\Survey;

class Service
{
    private RequestSurveyLoader $request;
    private SurveyFileStorage $storage;
    private ?Survey $survey;
    private string $title;

    function __construct(RequestSurveyLoader $request, SurveyFileStorage $storage)
    {
        $this->request = $request;
        $this->storage = $storage;
        $this->survey = $this->request->createNewSurvey('first_name', 'last_name', 'email', 'age', 'avatar');
        $this->title = "Don't found email!";
    }

    public function saveSurvey(): array
    {
        if ($this->survey)
        {
            $this->storage->saveData($this->survey);
            $this->title = "Done! Saved the survey:";
        }
        return [$this->survey, $this->title];
    }

    public function printSurvey(): array
    {
        if ($this->survey)
        {
            $this->storage->loadFileData($this->survey);
            $this->title = "Loading old data from file:";
        }
        return [$this->survey, $this->title];
    }
}
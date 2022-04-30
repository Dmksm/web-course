<?php

namespace App\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurveyPage extends AbstractController
{
   public function viewPage()
   {
       return $this->render('CreatingPage.html.twig', ['operation_with_survey' => 'SaveSurvey']);
   }
}

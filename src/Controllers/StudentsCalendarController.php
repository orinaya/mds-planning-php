<?php


namespace App\Controllers;
use App\Models\StudentsCalendarModel;

class StudentsCalendarController
{
    private array $studentsCalendar;

    public function __construct()
    {
        $this->studentsCalendar = StudentsCalendarModel::getStudentsCalendar();
    }

    public function show(Environment $twig)
    {
        echo "coucou";
        echo $twig->render('students-calendar.html.twig', [
            'studentsCalendar' => $this->studentsCalendar
        ]);
    }


}


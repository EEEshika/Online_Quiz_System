<?php
require_once __DIR__ . "/../Model/TeacherModel.php";

class TeacherController {

    private $model;

    public function __construct() {
        $this->model = new TeacherModel();
    }

    public function getAllQuizzes() {
        return $this->model->getAllQuizzes();
    }

    public function getAllQuestions() {
        return $this->model->getAllQuestions();
    }

    public function addQuestion($data) {
        return $this->model->insertQuestion($data);
    }

    public function deleteQuestion($id) {
        return $this->model->deleteQuestion($id);
    }
}

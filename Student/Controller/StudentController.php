<?php
require_once __DIR__ . "/../Model/StudentModel.php";

class StudentController {

    private StudentModel $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function allQuizzes() {
        return $this->model->getAllQuizzes();
    }

    public function quizTimeLimit(int $quizId): int {
        return $this->model->getQuizTimeLimit($quizId);
    }

    public function quizData(int $quizId): array {
        return $this->model->getQuizQuestions($quizId);
    }

    // ✅ REQUIRED METHOD (FIXES YOUR ERROR)
    public function submitQuiz(int $quizId, array $answers): int {
        return $this->model->gradeQuiz($quizId, $answers);
    }
}

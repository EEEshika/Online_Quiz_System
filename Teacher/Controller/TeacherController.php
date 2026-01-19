<?php
require_once __DIR__ . "/../Model/TeacherModel.php";

class TeacherController {

    private $model;

    public function __construct() {
        $this->model = new TeacherModel();
    }

    /* ✅ quizzes list (used in add_question.php) */
    public function getAllQuizzes() {
        return $this->model->getAllQuizzes();
    }

    /* ✅ questions list (used in delete/view) */
    public function getAllQuestions() {
        return $this->model->getAllQuestions();
    }

    public function addQuestion($data) {
        return $this->model->insertQuestion($data);
    }

    public function deleteQuestion($id) {
        return $this->model->deleteQuestion($id);
    }

    // ✅ NEW: get one question
    public function getQuestionById($id) {
        $id = (int)$id;
        if ($id <= 0) return null;
        return $this->model->getQuestionById($id);
    }

    // ✅ NEW: update question
    public function updateQuestion($data) {
        $id = (int)($data["id"] ?? 0);
        $quiz_id = (int)($data["quiz_id"] ?? 0);

        $question = trim($data["question"] ?? "");
        $o1 = trim($data["option1"] ?? "");
        $o2 = trim($data["option2"] ?? "");
        $o3 = trim($data["option3"] ?? "");
        $o4 = trim($data["option4"] ?? "");

        $correct = (int)($data["correct_option"] ?? 0);

        if ($id <= 0 || $quiz_id <= 0) return false;
        if ($question === "" || $o1 === "" || $o2 === "" || $o3 === "" || $o4 === "") return false;
        if ($correct < 1 || $correct > 4) return false;

        return $this->model->updateQuestion($id, $quiz_id, $question, $o1, $o2, $o3, $o4, $correct);
    }
}

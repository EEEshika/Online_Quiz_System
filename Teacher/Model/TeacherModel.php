<?php
require_once __DIR__ . "/../../config/DatabaseConnection.php";

class TeacherModel extends DatabaseConnection {

    public function getAllQuizzes() {
        $sql = "SELECT id, subject FROM quizzes ORDER BY id ASC";
        return $this->connect()->query($sql);
    }

    public function getAllQuestions() {
        $sql = "SELECT * FROM questions ORDER BY id ASC";
        return $this->connect()->query($sql);
    }

    public function insertQuestion($d) {
        $stmt = $this->connect()->prepare(
            "INSERT INTO questions
            (quiz_id, question, option1, option2, option3, option4, correct_option)
            VALUES (?,?,?,?,?,?,?)"
        );

        $stmt->bind_param(
            "isssssi",
            $d["quiz_id"],
            $d["question"],
            $d["option1"],
            $d["option2"],
            $d["option3"],
            $d["option4"],
            $d["correct_option"]
        );

        return $stmt->execute();
    }

    public function deleteQuestion($id) {
        $stmt = $this->connect()->prepare(
            "DELETE FROM questions WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

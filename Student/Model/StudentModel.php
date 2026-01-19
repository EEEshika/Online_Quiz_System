<?php
require_once __DIR__ . "/../../config/DatabaseConnection.php";

class StudentModel extends DatabaseConnection {

    public function getAllQuizzes() {
        return $this->connect()->query(
            "SELECT id, subject, type, marks, time FROM quizzes ORDER BY id DESC"
        );
    }

    public function getQuizTimeLimit(int $quizId): int {
        $stmt = $this->connect()->prepare(
            "SELECT time FROM quizzes WHERE id=?"
        );
        $stmt->bind_param("i", $quizId);
        $stmt->execute();

        $row = $stmt->get_result()->fetch_assoc();
        return $row ? (int)$row["time"] : 0;
    }

    public function getQuizQuestions(int $quizId): array {
        $stmt = $this->connect()->prepare(
            "SELECT id, question, option1, option2, option3, option4, correct_option
             FROM questions
             WHERE quiz_id=?"
        );
        $stmt->bind_param("i", $quizId);
        $stmt->execute();

        $res = $stmt->get_result();
        $questions = [];

        while ($row = $res->fetch_assoc()) {
            $questions[] = $row;
        }

        return $questions;
    }

    // ✅ GRADE + SAVE + SESSION STORE
    public function gradeQuiz(int $quizId, array $answers): int {
        $questions = $this->getQuizQuestions($quizId);
        $score = 0;

        foreach ($questions as $q) {
            $qid = $q["id"];
            if (
                isset($answers[$qid]) &&
                (int)$answers[$qid] === (int)$q["correct_option"]
            ) {
                $score++;
            }
        }

        // save in DB
        $stmt = $this->connect()->prepare(
            "INSERT INTO results (username, quiz_id, score)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param(
            "sii",
            $_SESSION["username"],
            $quizId,
            $score
        );
        $stmt->execute();

        // store ONLY latest result (your requirement)
        $_SESSION["latest_result"] = [
            "quiz_id" => $quizId,
            "score"   => $score
        ];

        return $score;
    }
}

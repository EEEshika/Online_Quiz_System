<?php
require_once __DIR__ . "/../../config/DatabaseConnection.php";

class TeacherModel extends DatabaseConnection {

    /* quizzes table */
    public function getAllQuizzes() {
        $sql = "SELECT id, subject FROM quizzes ORDER BY id ASC";
        return $this->connect()->query($sql);
    }

    /* questions table */
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

    // ✅ NEW: Get single question by ID (for update page)
public function getQuestionById($id) {
    $stmt = $this->connect()->prepare("SELECT * FROM questions WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();
    return $res ? $res->fetch_assoc() : null;
}

// ✅ NEW: Update question by ID
public function updateQuestion($id, $quiz_id, $question, $o1, $o2, $o3, $o4, $correct) {
    $stmt = $this->connect()->prepare(
        "UPDATE questions
         SET quiz_id=?, question=?, option1=?, option2=?, option3=?, option4=?, correct_option=?
         WHERE id=?"
    );

    $stmt->bind_param("isssssii", $quiz_id, $question, $o1, $o2, $o3, $o4, $correct, $id);
    return $stmt->execute();
}

}

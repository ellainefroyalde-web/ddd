<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Grading System - CRUD</title>
</head>
<body>

<h2>Add Student Grade</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Student Name" required><br><br>
    <input type="number" name="quiz" placeholder="Quiz (0–100)" required><br><br>
    <input type="number" name="assignment" placeholder="Assignment (0–100)" required><br><br>
    <input type="number" name="exam" placeholder="Exam (0–100)" required><br><br>
    <button type="submit" name="save">Save</button>
</form>

<?php
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $quiz = $_POST['quiz'];
    $assignment = $_POST['assignment'];
    $exam = $_POST['exam'];

    // compute final grade
    $final = ($quiz * 0.30) + ($assignment * 0.30) + ($exam * 0.40);

    $sql = "INSERT INTO students (name, quiz, assignment, exam, final_grade)
            VALUES ('$name', '$quiz', '$assignment', '$exam', '$final')";

    mysqli_query($conn, $sql);
    echo "<p>Student added!</p>";
}
?>

<hr>
<h2>Student Grades</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Quiz</th>
        <th>Assignment</th>
        <th>Exam</th>
        <th>Final Grade</th>
        <th>Actions</th>
    </tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM students");

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['quiz']}</td>
        <td>{$row['assignment']}</td>
        <td>{$row['exam']}</td>
        <td>{$row['final_grade']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a> |
            <a href='delete.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>

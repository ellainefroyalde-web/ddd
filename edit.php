<?php
include "db.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Grade</title>
</head>
<body>

<h2>Edit Student Grade</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $row['name'] ?>" required><br><br>
    <input type="number" name="quiz" value="<?= $row['quiz'] ?>" required><br><br>
    <input type="number" name="assignment" value="<?= $row['assignment'] ?>" required><br><br>
    <input type="number" name="exam" value="<?= $row['exam'] ?>" required><br><br>
    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $quiz = $_POST['quiz'];
    $assignment = $_POST['assignment'];
    $exam = $_POST['exam'];

    $final = ($quiz * 0.30) + ($assignment * 0.30) + ($exam * 0.40);

    mysqli_query($conn, "UPDATE students SET 
        name='$name',
        quiz='$quiz',
        assignment='$assignment',
        exam='$exam',
        final_grade='$final'
        WHERE id=$id
    ");

    echo "<p>Updated!</p>";
    echo "<a href='index.php'>Back</a>";
}
?>

</body>
</html>

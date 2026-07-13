<?php
// Registered Email: dkdeveloper15@gmail.com

include 'db.php';

$title = "";
$subject = "";
$description = "";
$message = "";
$error = "";

if(isset($_POST['submit'])){

    $title = trim($_POST['title']);
    $subject = trim($_POST['subject']);
    $description = trim($_POST['description']);

    if(empty($title) || empty($subject) || empty($description)){

        $error = "⚠ Please fill all fields.";

    }else{

        $stmt = $pdo->prepare("INSERT INTO notes(title,subject,description) VALUES(?,?,?)");
        $stmt->execute([$title,$subject,$description]);

        $message = "✅ Note Added Successfully.";

        $title="";
        $subject="";
        $description="";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Note</title>

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="container">

<div class="header">

<div class="logo">
<h1>➕ Add New Note</h1>
<p>Create and save your study notes.</p>
</div>

<a href="index.php" class="btn">
<i class="fa-solid fa-house"></i> Dashboard
</a>

</div>

<div class="glass">

<?php if($message!=""){ ?>
<p style="background:#16a34a;padding:12px;border-radius:10px;margin-bottom:20px;">
<?php echo $message; ?>
</p>
<?php } ?>

<?php if($error!=""){ ?>
<p style="background:#dc2626;padding:12px;border-radius:10px;margin-bottom:20px;">
<?php echo $error; ?>
</p>
<?php } ?>

<form method="POST">
    <label for="title">
    <i class="fa-solid fa-book"></i> Note Title
</label>

<input
type="text"
id="title"
name="title"
placeholder="Enter Note Title"
value="<?php echo htmlspecialchars($title); ?>"
required>

<label for="subject">
    <i class="fa-solid fa-graduation-cap"></i> Subject
</label>

<input
type="text"
id="subject"
name="subject"
placeholder="Enter Subject Name"
value="<?php echo htmlspecialchars($subject); ?>"
required>

<label for="description">
    <i class="fa-solid fa-file-lines"></i> Description
</label>

<textarea
id="description"
name="description"
placeholder="Write your note here..."
required><?php echo htmlspecialchars($description); ?></textarea>

<div style="display:flex;gap:15px;margin-top:20px;">

<button type="submit" name="submit" class="btn">
    <i class="fa-solid fa-floppy-disk"></i>
    Save Note
</button>

<a href="index.php" class="btn" style="background:#2563eb;">
    <i class="fa-solid fa-arrow-left"></i>
    Back
</a>

</div>

</form>

</div>

<div class="footer">

© 2026 Student Notes Manager | Developed by <b>Dhrauv Kumar</b>

</div>

<script src="script.js"></script>

</body>
</html>
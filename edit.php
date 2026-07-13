<?php
// Registered Email: dkdeveloper15@gmail.com

include 'db.php';

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit();
}

$id=$_GET['id'];

$stmt=$pdo->prepare("SELECT * FROM notes WHERE id=?");
$stmt->execute([$id]);
$note=$stmt->fetch();

if(!$note){
    die("Note not found");
}

$title=$note['title'];
$subject=$note['subject'];
$description=$note['description'];

$message="";
$error="";

if(isset($_POST['update'])){

$title=trim($_POST['title']);
$subject=trim($_POST['subject']);
$description=trim($_POST['description']);

if(empty($title)||empty($subject)||empty($description)){

$error="⚠ Please fill all fields.";

}else{

$stmt=$pdo->prepare("UPDATE notes SET title=?,subject=?,description=? WHERE id=?");
$stmt->execute([$title,$subject,$description,$id]);

header("Location:index.php");

exit();

}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Note</title>

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="container">

<div class="header">

<div class="logo">

<h1>✏ Edit Note</h1>

<p>Update your study notes.</p>

</div>

<a href="index.php" class="btn">

🏠 Dashboard

</a>

</div>

<div class="glass">

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
value="<?php echo htmlspecialchars($title); ?>"
required>

<label for="subject">
    <i class="fa-solid fa-graduation-cap"></i> Subject
</label>

<input
type="text"
id="subject"
name="subject"
value="<?php echo htmlspecialchars($subject); ?>"
required>

<label for="description">
    <i class="fa-solid fa-file-lines"></i> Description
</label>

<textarea
id="description"
name="description"
required><?php echo htmlspecialchars($description); ?></textarea>

<div style="display:flex;gap:15px;margin-top:20px;flex-wrap:wrap;">

<button type="submit" name="update" class="btn">
    <i class="fa-solid fa-floppy-disk"></i>
    Update Note
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
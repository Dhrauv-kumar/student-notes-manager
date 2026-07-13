<?php
// Registered Email: dkdeveloper15@gmail.com

include 'db.php';

$search = "";

if(isset($_GET['search'])){
    $search = trim($_GET['search']);

    $stmt = $pdo->prepare("SELECT * FROM notes
    WHERE title LIKE ? OR subject LIKE ?
    ORDER BY id DESC");

    $stmt->execute(["%$search%","%$search%"]);

}else{

    $stmt = $pdo->query("SELECT * FROM notes ORDER BY id DESC");

}

$notes = $stmt->fetchAll();

$totalNotes = count($notes);

$totalSubjects = $pdo->query("SELECT COUNT(DISTINCT subject) FROM notes")->fetchColumn();

$todayNotes = $pdo->query("SELECT COUNT(*) FROM notes WHERE DATE(created_at)=CURDATE()")->fetchColumn();

$latestNote = $pdo->query("SELECT title FROM notes ORDER BY id DESC LIMIT 1")->fetchColumn();

if(!$latestNote){
    $latestNote = "No Notes";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Student Notes Manager</title>

<link rel="stylesheet" href="style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="container">

<div class="header">

<div class="logo">

<h1>📚 Student Notes Manager</h1>

<p>Professional PHP & MySQL Dashboard</p>

</div>

<a href="add.php" class="btn">
<i class="fa-solid fa-plus"></i> Add Note
</a>

</div>

<div class="glass welcome">

<div class="welcome-left">

<h2>👋 Welcome, Dhrauv Kumar</h2>

<p>Manage all your study notes in one premium dashboard.</p>

</div>

<div class="clock">

<h3 id="clock"></h3>

<p id="date"></p>

</div>

</div>

<div class="cards">

<div class="card blue">

<h3>Total Notes</h3>

<h1><?php echo $totalNotes; ?></h1>

<span>📚 Notes Available</span>

</div>

<div class="card green">

<h3>Subjects</h3>

<h1><?php echo $totalSubjects; ?></h1>

<span>📖 Total Subjects</span>

</div>

<div class="card orange">

<h3>Today's Notes</h3>

<h1><?php echo $todayNotes; ?></h1>

<span>📅 Added Today</span>

</div>

<div class="card red">

<h3>Latest Note</h3>

<h1 style="font-size:22px;">
<?php echo htmlspecialchars($latestNote); ?>
</h1>

<span>⭐ Recently Added</span>

</div>

</div>
<div class="glass">

<form method="GET" class="search-box">

<input
type="text"
name="search"
placeholder="🔍 Search by Title or Subject..."
value="<?php echo htmlspecialchars($search); ?>">

<button type="submit">
<i class="fa-solid fa-magnifying-glass"></i> Search
</button>

</form>

</div>

<div class="table-box">

<table>

<thead>

<tr>
<th>ID</th>
<th>Title</th>
<th>Subject</th>
<th>Description</th>
<th>Date</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if(count($notes)>0): ?>

<?php foreach($notes as $note): ?>

<tr>

<td><?php echo $note['id']; ?></td>

<td><?php echo htmlspecialchars($note['title']); ?></td>

<td>
<span style="background:#2563eb;padding:6px 12px;border-radius:20px;">
<?php echo htmlspecialchars($note['subject']); ?>
</span>
</td>

<td><?php echo htmlspecialchars($note['description']); ?></td>

<td><?php echo date("d M Y",strtotime($note['created_at'])); ?></td>

<td>

<a href="edit.php?id=<?php echo $note['id']; ?>" class="edit-btn">
<i class="fa-solid fa-pen"></i>
</a>

<a href="delete.php?id=<?php echo $note['id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this note?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6">

<h3>No Notes Found 📭</h3>

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

<div class="footer">

© 2026 Student Notes Manager | Developed by <b>Dhrauv Kumar</b>

</div>

<script src="script.js"></script>

</body>

</html>
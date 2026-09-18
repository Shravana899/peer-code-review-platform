<?php require "config.php";
if (isset($_POST['clear_all'])) {
    $conn->query("DELETE FROM comments");
    $conn->query("DELETE FROM submissions");

    header("Location: index.php");
    exit;
}
$total=$conn->query("SELECT COUNT(*) c FROM submissions")->fetch_assoc()["c"];
$pending=$conn->query("SELECT COUNT(*) c FROM submissions WHERE status='Pending'")->fetch_assoc()["c"];
$reviewed=$conn->query("SELECT COUNT(*) c FROM submissions WHERE status='Reviewed'")->fetch_assoc()["c"];
$r=$conn->query("SELECT * FROM submissions ORDER BY created_at DESC");
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Peer Code Review Platform</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
<header class="topbar"><div class="brand">
    <div class="brand-icon">&lt;/&gt;</div>
    <div><b>Peer Code Review Platform</b>
    <span>Student code review & feedback</span>
</div>
</div>
<nav>
    <a href="index.php">Dashboard</a>
    <a href="submissions.php">View Submissions</a>
</nav>
</header>
<main class="page">
    <h1>👋 Welcome back</h1>
    <p>Share your code, get feedback, and improve together.</p>
<div class="stats">
    <div class="stat-card">📄 <div>
        <span>Total Submissions</span>
        <strong><?=$total?></strong>
        <small>All submitted work</small>
    </div>
</div>
<div class="stat-card">⏳ <div>
    <span>Pending Reviews</span>
    <strong><?=$pending?></strong>
    <small>Needs attention</small>
</div>
</div>
<div class="stat-card">✓ <div>
    <span>Reviewed</span>
    <strong><?=$reviewed?></strong>
    <small>Great work!</small>
</div>
</div>
</div>
<div class="quick-actions">
    <a class="btn" href="submit.php">＋ Submit Code</a>
    <a class="btn outline" href="submissions.php">View All Submissions</a>

    <form method="post" style="display:inline;"
          onsubmit="return confirm('Are you sure you want to clear all submissions?');">
        <button type="submit" name="clear_all" class="btn"
                style="background:#dc3545; margin-left:8px;">
            🗑️ Clear All Submissions
        </button>
    </form>
</div>
<section class="panel">
    <div class="panel-head">
        <div>
            <h2>Recent Submissions</h2>
            <p>Your latest code submissions</p>
        </div>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>STUDENT</th>
            <th>TITLE</th>
            <th>LANGUAGE</th>
            <th>STATUS</th>
            <th>ACTION</th>
        </tr>
        <?php
         while($x=$r->fetch_assoc()): ?><tr><td>#<?=$x["id"]
         ?>
         </td>
         <td>
            <?=htmlspecialchars($x["student_name"])?></td>
            <td><b><?=htmlspecialchars($x["title"])?></b></td>
            <td><?=htmlspecialchars($x["language"])?></td>
            <td>
                <span class="status <?=str_replace(" ","-",$x["status"])?>"><?=htmlspecialchars($x["status"])?></span>
            </td>
            <td>
                <a class="btn" href="view.php?id=<?=$x["id"]?>">Open</a>
            </td>
        </tr>
        <?php
     endwhile;
     ?>
     </table>
    </section>
</main>
</body>
</html>
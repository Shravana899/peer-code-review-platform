```php
<?php
require "config.php";
$msg="";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $n=trim($_POST["student_name"]);
    $t=trim($_POST["title"]);
    $l=$_POST["language"];
    $c=$_POST["code"];

    if($n&&$t&&$c){
        $s=$conn->prepare("INSERT INTO submissions(student_name,title,language,code) VALUES(?,?,?,?)");
        $s->bind_param("ssss",$n,$t,$l,$c);
        $s->execute();
        header("Location:view.php?id=".$s->insert_id);
        exit;
    }else
        $msg="Please fill all fields.";
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Submit Code</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="topbar">

    <div class="brand">
        <div class="brand-icon">
            &lt;/&gt;
        </div>
        <b>Peer Code Review Platform</b>
    </div>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="submissions.php">View Submissions</a>
    </nav>

</header>

<main class="page">

    <a class="back" href="index.php">← Back</a>

    <h1>Submit Code</h1>
    <p>Share your code with peers and get valuable feedback.</p>

    <?php if($msg):?>
        <p><?=$msg?></p>
    <?php endif;?>

    <form class="panel form" method="post">

        <div class="grid">

            <div>
                <label>Student Name</label>
                <input name="student_name" value="Riya" required>
            </div>

            <div>
                <label>Title</label>
                <input name="title" placeholder="Test Python Program" required>
            </div>

            <div>
                <label>Language</label>

                <select name="language">
                    <option>Python</option>
                    <option>Java</option>
                    <option>PHP</option>
                    <option>C++</option>
                    <option>JavaScript</option>
                </select>

            </div>

        </div>

        <label>Code</label>

        <textarea name="code" required placeholder="Paste your code here..."></textarea>

        <br>
        <br>

        <button class="btn">
            Submit Code →
        </button>

    </form>

</main>

</body>
</html>
```

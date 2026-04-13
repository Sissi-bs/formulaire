<?php include "db.php"; ?>

<h1>PCs</h1>


<form method="POST">
    <input type="text" name="nom" placeholder="Nom">
    <button name="add">Ajouter</button>
</form>

<hr>

<?php
// pour ajouter
if (isset($_POST['add'])) {
    $pdo->prepare("INSERT INTO equipements (nom, type) VALUES (?, 'pc')")
        ->execute([$_POST['nom']]);
}

// pour supprimer
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM equipements WHERE id=?")
        ->execute([$_GET['delete']]);
}

// pour modifier
if (isset($_POST['edit'])) {
    $pdo->prepare("UPDATE equipements SET nom=? WHERE id=?")
        ->execute([$_POST['nom'], $_POST['id']]);
}
?>


<?php
$stmt = $pdo->query("SELECT * FROM equipements WHERE type='pc'");

foreach ($stmt as $row) {
    echo $row['nom'] . " 

    <a href='?delete={$row['id']}'>❌</a>

    <form method='POST' style='display:inline;'>
        <input type='hidden' name='id' value='{$row['id']}'>
        <input type='text' name='nom' placeholder='Modifier'>
        <button name='edit'>✏️</button>
    </form>

    <br>";
}
?>

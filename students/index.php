<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Kaikki opiskelijat';
require_once __DIR__ . '/../includes/header.php';

// SQL aliasit eri nimillä
$query = "
    SELECT student_id AS id, first_name AS fname, last_name AS lname, year_group AS year 
    FROM students 
    ORDER BY lname ASC, fname ASC
";
$result = $mysqli->query($query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-success">Opiskelijat</h2>
    <a href="add.php" class="btn btn-outline-success btn-sm">➕ Lisää uusi opiskelija</a>
</div>

<div class="card shadow-sm p-4">
    <table class="table table-hover table-sm align-middle">
        <thead class="table-light">
            <tr>
                <th>Nimi</th>
                <th>Vuosikurssi</th>
                <th>Toiminnot</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?></td>
                <td><?= (int)$row['year'] ?></td>
                <td class="d-flex gap-1">
                    <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Näytä</a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary">Muokkaa</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Haluatko poistaa opiskelijan?')">Poista</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

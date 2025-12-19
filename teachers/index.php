<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Kaikki opettajat';
require_once __DIR__ . '/../includes/header.php';

// SQL aliasit eri nimillä
$query = "
    SELECT teacher_id AS id, first_name AS fname, last_name AS lname, subject AS subj
    FROM teachers
    ORDER BY lname ASC
";
$result = $mysqli->query($query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-danger">Opettajat</h2>
    <a href="add.php" class="btn btn-outline-success btn-sm">➕ Lisää uusi opettaja</a>
</div>

<div class="card shadow-sm p-4">
    <table class="table table-hover table-sm align-middle">
        <thead class="table-light">
            <tr>
                <th>Nimi</th>
                <th>Aine</th>
                <th>Toiminnot</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?></td>
                <td><?= htmlspecialchars($row['subj']) ?></td>
                <td class="d-flex gap-1">
                    <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Näytä</a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary">Muokkaa</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Haluatko poistaa opettajan?')">Poista</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

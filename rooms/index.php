<?php 
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Kaikki tilat';
require_once __DIR__ . '/../includes/header.php';

// Hieman eri SQL ja aliasit
$query = "SELECT room_id AS id, name AS room_name, capacity AS cap FROM rooms ORDER BY name ASC";
$result = $mysqli->query($query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-warning">Tilat</h2>
    <a href="add.php" class="btn btn-outline-success btn-sm">➕ Lisää uusi tila</a>
</div>

<div class="card shadow-sm p-4">
    <table class="table table-hover table-sm align-middle">
        <thead class="table-light">
            <tr>
                <th>Tilan nimi</th>
                <th>Kapasiteetti</th>
                <th>Toiminnot</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['room_name']) ?></td>
                <td><?= (int)$row['cap'] ?></td>
                <td class="d-flex gap-1">
                    <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Näytä</a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary">Muokkaa</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Haluatko poistaa tämän tilan?')">Poista</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

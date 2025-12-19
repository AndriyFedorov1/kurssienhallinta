<?php 
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Kaikki kurssit';
require_once __DIR__ . '/../includes/header.php';


$query = "
    SELECT 
        c.course_id AS id, 
        c.name AS course_name, 
        c.start_date AS start, 
        c.end_date AS endd, 
        t.first_name AS teacher_first, 
        t.last_name AS teacher_last, 
        r.name AS room 
    FROM courses c
    JOIN teachers t ON c.teacher_id = t.teacher_id
    JOIN rooms r ON c.room_id = r.room_id
    ORDER BY c.start_date ASC
";
$result = $mysqli->query($query);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-info">Kaikki Kurssit</h2>
    <a href="add.php" class="btn btn-outline-success btn-sm">➕ Lisää uusi kurssi</a>
</div>

<div class="card shadow-sm p-4">
    <table class="table table-hover table-sm align-middle">
        <thead class="table-light">
            <tr>
                <th>Kurssi</th>
                <th>Opettaja</th>
                <th>Huone</th>
                <th>Aloituspäivä</th>
                <th>Valinnat</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['course_name']) ?></td>
                <td><?= htmlspecialchars($row['teacher_first'] . ' ' . $row['teacher_last']) ?></td>
                <td><?= htmlspecialchars($row['room']) ?></td>
                <td><?= date('d.m.Y', strtotime($row['start'])) ?></td>
                <td class="d-flex gap-1">
                    <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Näytä</a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary">Muokkaa</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Haluatko poistaa kurssin?')">Poista</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

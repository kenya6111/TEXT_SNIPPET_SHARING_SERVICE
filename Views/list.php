<?php
use Database\MySQLWrapper;
use Exception;

$db = new MySQLWrapper();
$stmt = $db->prepare("SELECT * FROM PasteContent");
        $stmt->execute();
        $result = $stmt->get_result();
        $snippets = $result->fetch_all(MYSQLI_ASSOC);

?>


<div class="container">
    <div class="row">
        <div class="col">
            <?php if (empty($snippets)): ?>
                <div class="alert alert-info">スニペットは登録されていません。</div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($snippets as $snippet): ?>
                        <li class="list-group-item">
                            <a href="/show?path=<?= htmlspecialchars($snippet['url']) ?>" class="text-decoration-none">
                                <h5><?= htmlspecialchars($snippet['content']) ?></h5>
                                <small>Syntax: <?= htmlspecialchars($snippet['url']) ?></small><br>
                                <small>Expire: <?= $snippet['expired_limit'] ? htmlspecialchars($snippet['expire_datetime']) : "Never" ?></small>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

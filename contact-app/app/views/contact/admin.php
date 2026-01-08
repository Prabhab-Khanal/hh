<h1>Contact Admin</h1>
<p class="small"><a href="/">← Back to form</a></p>

<section class="card">
  <?php if (empty($items)): ?>
    <p class="small">No messages yet.</p>
  <?php else: ?>
    <?php foreach ($items as $c): ?>
      <div style="margin-bottom:14px">
        <strong>#<?= (int)$c['id'] ?> — <?= htmlspecialchars($c['name']) ?></strong>
        <div class="small"><?= htmlspecialchars($c['email']) ?> • <?= htmlspecialchars($c['created_at']) ?></div>
        <p><?= nl2br(htmlspecialchars($c['message'])) ?></p>
      </div>
      <hr style="border:none;border-top:1px solid #e5e7eb;margin:12px 0">
    <?php endforeach; ?>
  <?php endif; ?>
</section>

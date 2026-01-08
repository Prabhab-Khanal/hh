<h1>Latest CSV Batch</h1>
<p class="small"><a href="/">← Upload</a></p>

<?php if (!empty($msg)): ?><p class="ok"><?= htmlspecialchars($msg) ?></p><?php endif; ?>

<section class="card">
  <?php if (empty($batch)): ?>
    <p class="small">No batch imported yet.</p>
  <?php else: ?>
    <div class="row" style="justify-content:space-between">
      <div>
        <strong>Batch ID:</strong> <span class="small"><?= htmlspecialchars($batch) ?></span>
      </div>
      <form method="post" action="/clear" onsubmit="return confirm('Delete latest batch rows?')">
        <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
        <button class="btn2" type="submit">Clear latest</button>
      </form>
    </div>

    <?php if (empty($rows)): ?>
      <p class="small">No rows found.</p>
    <?php else: ?>
      <div style="overflow:auto;margin-top:12px">
        <table>
          <thead>
            <tr><th>#</th><th>col1</th><th>col2</th><th>col3</th></tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $r): ?>
              <tr>
                <td><?= (int)$r['row_index'] ?></td>
                <td><?= htmlspecialchars((string)($r['col1'] ?? '')) ?></td>
                <td><?= htmlspecialchars((string)($r['col2'] ?? '')) ?></td>
                <td><?= htmlspecialchars((string)($r['col3'] ?? '')) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</section>

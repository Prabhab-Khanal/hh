<?php if (!empty($msg)): ?>
  <p class="ok"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<h1>To-Do List</h1>

<section class="card">
  <form method="post" action="/todo/create" class="row">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
    <input name="title" placeholder="Add a new task..." />
    <button class="btn" type="submit">Add</button>
  </form>
  <p class="small">Tip: Toggle done or delete tasks below.</p>
</section>

<section class="card">
  <?php if (empty($todos)): ?>
    <p class="small">No tasks yet.</p>
  <?php else: ?>
    <?php foreach ($todos as $t): ?>
      <div class="row" style="justify-content:space-between">
        <div>
          <?php if ((int)$t['is_done'] === 1): ?>
            <strong><s><?= htmlspecialchars($t['title']) ?></s></strong>
          <?php else: ?>
            <strong><?= htmlspecialchars($t['title']) ?></strong>
          <?php endif; ?>
          <div class="small">#<?= (int)$t['id'] ?> • <?= htmlspecialchars($t['created_at']) ?></div>
        </div>
        <div class="row">
          <form method="post" action="/todo/toggle">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
            <button class="btn2" type="submit"><?= ((int)$t['is_done']===1) ? 'Undo' : 'Done' ?></button>
          </form>
          <form method="post" action="/todo/delete" onsubmit="return confirm('Delete this task?')">
            <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
            <input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
            <button class="btn2" type="submit">Delete</button>
          </form>
        </div>
      </div>
      <hr style="border:none;border-top:1px solid #e5e7eb;margin:12px 0">
    <?php endforeach; ?>
  <?php endif; ?>
</section>

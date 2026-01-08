<h1>CSV Upload</h1>

<?php if (!empty($msg)): ?><p class="ok"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
<?php if (!empty($err)): ?><p class="error"><?= htmlspecialchars($err) ?></p><?php endif; ?>

<section class="card">
  <form method="post" action="/upload" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
    <label class="small">Choose CSV file (max 2MB)</label>
    <input type="file" name="csv" accept=".csv" />
    <div class="row" style="margin-top:12px">
      <button class="btn" type="submit">Upload & Import</button>
      <a class="small" href="/latest">View latest batch</a>
    </div>
  </form>
  <p class="small">Only the first 3 columns are stored (col1–col3).</p>
</section>

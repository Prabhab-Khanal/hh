<h1>Register</h1>
<p class="small"><a href="/">← Home</a></p>

<?php if (!empty($msg)): ?><p class="ok"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
<?php if (!empty($err)): ?><p class="error"><?= htmlspecialchars($err) ?></p><?php endif; ?>

<section class="card">
  <form method="post" action="/register">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
    <label class="small">Email</label>
    <input name="email" placeholder="you@example.com" />
    <label class="small" style="margin-top:10px;display:block">Password</label>
    <input name="password" type="password" placeholder="min 6 chars" />
    <div class="row" style="margin-top:12px">
      <button class="btn" type="submit">Create account</button>
      <a class="small" href="/login">Already have one?</a>
    </div>
  </form>
</section>

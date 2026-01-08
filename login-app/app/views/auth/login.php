<h1>Login</h1>
<p class="small"><a href="/">← Home</a></p>

<?php if (!empty($msg)): ?><p class="ok"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
<?php if (!empty($err)): ?><p class="error"><?= htmlspecialchars($err) ?></p><?php endif; ?>

<section class="card">
  <form method="post" action="/login">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">
    <label class="small">Email</label>
    <input name="email" placeholder="you@example.com" />
    <label class="small" style="margin-top:10px;display:block">Password</label>
    <input name="password" type="password" placeholder="your password" />
    <div class="row" style="margin-top:12px">
      <button class="btn" type="submit">Login</button>
      <a class="small" href="/register">Create account</a>
    </div>
  </form>
</section>

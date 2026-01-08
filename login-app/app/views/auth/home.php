<h1>Login App</h1>

<?php if ($user): ?>
  <p class="ok">Logged in as <strong><?= htmlspecialchars($user['email']) ?></strong></p>
  <p><a href="/dashboard">Go to dashboard</a> • <a href="/logout">Logout</a></p>
<?php else: ?>
  <p class="small">You are not logged in.</p>
  <p><a href="/register">Register</a> • <a href="/login">Login</a></p>
<?php endif; ?>

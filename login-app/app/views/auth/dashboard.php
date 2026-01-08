<h1>Dashboard</h1>
<p class="small">Welcome, <strong><?= htmlspecialchars($user['email']) ?></strong></p>
<section class="card">
  <p>This is a protected page (requires login).</p>
  <p><a href="/logout">Logout</a></p>
</section>

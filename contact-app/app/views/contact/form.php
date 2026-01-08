<h1>Contact Form</h1>

<?php if (!empty($msg)): ?><p class="ok"><?= htmlspecialchars($msg) ?></p><?php endif; ?>
<?php if (!empty($err)): ?><p class="error"><?= htmlspecialchars($err) ?></p><?php endif; ?>

<section class="card">
  <form method="post" action="/send">
    <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf) ?>">

    <label class="small">Name</label>
    <input name="name" placeholder="Your name" />

    <label class="small" style="margin-top:10px;display:block">Email</label>
    <input name="email" placeholder="you@example.com" />

    <label class="small" style="margin-top:10px;display:block">Message</label>
    <textarea name="message" rows="5" placeholder="Write your message..."></textarea>

    <div class="row" style="margin-top:12px">
      <button class="btn" type="submit">Send</button>
      <a class="small" href="/admin">Admin view</a>
    </div>
  </form>
</section>

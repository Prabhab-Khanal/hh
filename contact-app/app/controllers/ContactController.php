<?php
declare(strict_types=1);

final class ContactController extends Controller
{
    public function form(): void
    {
        $msg = Session::flash('msg');
        $err = Session::flash('err');
        $this->view('contact/form', [
            'title' => 'Contact Form',
            'msg' => $msg,
            'err' => $err,
            'csrf' => Session::csrfToken(),
        ]);
    }

    public function send(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $message = trim((string)($_POST['message'] ?? ''));

        if ($name === '' || $email === '' || $message === '') {
            Session::flash('err', 'All fields are required.');
            $this->redirect('/');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('err', 'Please enter a valid email.');
            $this->redirect('/');
        }

        (new Contact())->create($name, $email, $message);
        Session::flash('msg', 'Thanks! Your message was saved.');
        $this->redirect('/');
    }

    public function admin(): void
    {
        $items = (new Contact())->all();
        $this->view('contact/admin', [
            'title' => 'Contact Admin',
            'items' => $items,
        ]);
    }
}

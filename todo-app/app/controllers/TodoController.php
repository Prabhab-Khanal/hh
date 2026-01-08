<?php
declare(strict_types=1);

final class TodoController extends Controller
{
    public function index(): void
    {
        $todos = (new Todo())->all();
        $msg = Session::flash('msg');
        $this->view('todo/index', [
            'title' => 'To-Do App',
            'todos' => $todos,
            'msg' => $msg,
            'csrf' => Session::csrfToken(),
        ]);
    }

    public function create(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $title = trim((string)($_POST['title'] ?? ''));
        if ($title === '') {
            Session::flash('msg', 'Please enter a task title.');
            $this->redirect('/');
        }

        (new Todo())->create($title);
        Session::flash('msg', 'Task added.');
        $this->redirect('/');
    }

    public function toggle(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $id = (int)($_POST['id'] ?? 0);
        (new Todo())->toggle($id);
        $this->redirect('/');
    }

    public function delete(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $id = (int)($_POST['id'] ?? 0);
        (new Todo())->delete($id);
        Session::flash('msg', 'Task deleted.');
        $this->redirect('/');
    }
}

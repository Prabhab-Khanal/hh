<?php
declare(strict_types=1);

final class AuthController extends Controller
{
    public function home(): void
    {
        $user = $this->currentUser();
        $this->view('auth/home', [
            'title' => 'Login App',
            'user' => $user,
        ]);
    }

    public function registerForm(): void
    {
        $err = Session::flash('err');
        $msg = Session::flash('msg');
        $this->view('auth/register', [
            'title' => 'Register',
            'err' => $err,
            'msg' => $msg,
            'csrf' => Session::csrfToken(),
        ]);
    }

    public function register(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $email = trim((string)($_POST['email'] ?? ''));
        $pass = (string)($_POST['password'] ?? '');

        if ($email === '' || $pass === '') {
            Session::flash('err', 'Email and password are required.');
            $this->redirect('/register');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::flash('err', 'Invalid email.');
            $this->redirect('/register');
        }
        if (strlen($pass) < 6) {
            Session::flash('err', 'Password must be at least 6 characters.');
            $this->redirect('/register');
        }

        try {
            (new User())->create($email, $pass);
        } catch (PDOException $e) {
            Session::flash('err', 'That email is already registered.');
            $this->redirect('/register');
        }

        Session::flash('msg', 'Registered! Now login.');
        $this->redirect('/login');
    }

    public function loginForm(): void
    {
        $err = Session::flash('err');
        $msg = Session::flash('msg');
        $this->view('auth/login', [
            'title' => 'Login',
            'err' => $err,
            'msg' => $msg,
            'csrf' => Session::csrfToken(),
        ]);
    }

    public function login(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $email = trim((string)($_POST['email'] ?? ''));
        $pass = (string)($_POST['password'] ?? '');

        $user = (new User())->findByEmail($email);
        if (!$user || !password_verify($pass, (string)$user['password_hash'])) {
            Session::flash('err', 'Invalid credentials.');
            $this->redirect('/login');
        }

        $_SESSION['user_id'] = (int)$user['id'];
        $this->redirect('/dashboard');
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        Session::flash('msg', 'Logged out.');
        $this->redirect('/login');
    }

    public function dashboard(): void
    {
        $user = $this->requireAuth();
        $this->view('auth/dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
        ]);
    }

    private function requireAuth(): array
    {
        $id = (int)($_SESSION['user_id'] ?? 0);
        if ($id <= 0) {
            Session::flash('err', 'Please login first.');
            $this->redirect('/login');
        }
        $u = (new User())->findById($id);
        if (!$u) {
            unset($_SESSION['user_id']);
            Session::flash('err', 'Session expired. Please login again.');
            $this->redirect('/login');
        }
        return $u;
    }

    private function currentUser(): ?array
    {
        $id = (int)($_SESSION['user_id'] ?? 0);
        return $id > 0 ? (new User())->findById($id) : null;
    }
}

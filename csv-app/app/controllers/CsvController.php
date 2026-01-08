<?php
declare(strict_types=1);

final class CsvController extends Controller
{
    public function uploadForm(): void
    {
        $msg = Session::flash('msg');
        $err = Session::flash('err');
        $this->view('csv/upload', [
            'title' => 'CSV Upload',
            'msg' => $msg,
            'err' => $err,
            'csrf' => Session::csrfToken(),
        ]);
    }

    public function upload(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        if (!isset($_FILES['csv']) || $_FILES['csv']['error'] !== UPLOAD_ERR_OK) {
            Session::flash('err', 'Please choose a CSV file.');
            $this->redirect('/');
        }

        $tmp = (string)$_FILES['csv']['tmp_name'];
        $name = (string)$_FILES['csv']['name'];

        if (!preg_match('/\.csv$/i', $name)) {
            Session::flash('err', 'Only .csv files are allowed.');
            $this->redirect('/');
        }
        if (filesize($tmp) > 2 * 1024 * 1024) {
            Session::flash('err', 'File too large (max 2MB).');
            $this->redirect('/');
        }

        $batchId = bin2hex(random_bytes(16));
        $count = (new CsvData())->import($tmp, $batchId);

        $_SESSION['latest_batch'] = $batchId;
        Session::flash('msg', "Imported {$count} row(s).");
        $this->redirect('/latest');
    }

    public function latest(): void
    {
        $batch = (string)($_SESSION['latest_batch'] ?? '');
        $rows = $batch ? (new CsvData())->rows($batch) : [];
        $msg = Session::flash('msg');
        $this->view('csv/latest', [
            'title' => 'Latest CSV',
            'batch' => $batch,
            'rows' => $rows,
            'msg' => $msg,
            'csrf' => Session::csrfToken(),
        ]);
    }

    public function clearLatest(): void
    {
        $this->requirePost();
        Session::verifyCsrf($_POST['_csrf'] ?? null);

        $batch = (string)($_SESSION['latest_batch'] ?? '');
        if ($batch) {
            (new CsvData())->deleteBatch($batch);
        }
        unset($_SESSION['latest_batch']);
        Session::flash('msg', 'Cleared latest batch.');
        $this->redirect('/');
    }
}

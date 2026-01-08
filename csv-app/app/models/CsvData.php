<?php
declare(strict_types=1);

final class CsvData
{
    public function import(string $tmpFile, string $batchId): int
    {
        $fh = fopen($tmpFile, 'r');
        if ($fh === false) return 0;

        $pdo = Database::pdo();
        $stmt = $pdo->prepare(
            "INSERT INTO csv_rows (batch_id, row_index, col1, col2, col3)
             VALUES (:batch, :idx, :c1, :c2, :c3)"
        );

        $idx = 0;
        while (($row = fgetcsv($fh)) !== false) {
            // Map only first 3 columns for simplicity
            $c1 = $row[0] ?? null;
            $c2 = $row[1] ?? null;
            $c3 = $row[2] ?? null;

            $stmt->execute([
                'batch' => $batchId,
                'idx' => $idx,
                'c1' => $c1,
                'c2' => $c2,
                'c3' => $c3,
            ]);
            $idx++;
        }
        fclose($fh);
        return $idx;
    }

    public function rows(string $batchId): array
    {
        $stmt = Database::pdo()->prepare(
            "SELECT row_index, col1, col2, col3, created_at
             FROM csv_rows
             WHERE batch_id = :batch
             ORDER BY row_index ASC"
        );
        $stmt->execute(['batch' => $batchId]);
        return $stmt->fetchAll();
    }

    public function deleteBatch(string $batchId): void
    {
        $stmt = Database::pdo()->prepare("DELETE FROM csv_rows WHERE batch_id = :batch");
        $stmt->execute(['batch' => $batchId]);
    }
}

<?php

namespace TaskForce\Fixtures;

use SplFileObject;

class CsvParser
{
    private string $filename;
    private array $columns;
    private object $fp;
    private array $result = [];

    public function __construct(string $filename, array $columns)
    {
        $this->filename = $filename;
        $this->columns = $columns;
    }

    public function import(): void
    {
        try {
            $this->fp = new SplFileObject($this->filename);
        } catch (\Throwable $e) {
            throw new \Exception("Не удалось открыть файл $this->filename на чтение");
        }

        $this->fp->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        $headers = $this->getHeaderData();

        if (!$this->validateColumns($headers)) {
            throw new \Exception("Заданы неверные заголовки столбцов для $this->filename");
        }

        foreach ($this->getNextLine() as $line) {
            if ($line) {
                $this->result[] = array_combine($headers, $line);
            }
        }
    }

    public function getData(): array
    {
        return $this->result;
    }

    public function addData($field, $cb): void
    {
        $this->columns[$field] = $field;
        $this->result = array_map(fn ($it) => array_merge($it, [$field => $cb($it)]), $this->result);
    }

    public function getSQL(string $table): string
    {
        $fields = implode(', ', $this->columns);
        $insertStmt = 'INSERT INTO '.$table.' ('.$fields.') VALUES ';
        $rowsToInsert = array();
        foreach ($this->result as $row) {
            $rowsToInsert[] = '("' . implode('", "', array_map(fn ($it) => $row[$it], array_keys($this->columns))) . '")';
        }
        return $insertStmt . implode(', ', $rowsToInsert);
    }

    private function getHeaderData(): ?array
    {
        $this->fp->rewind();
        return $this->fp->fgetcsv();
    }

    private function getNextLine(): ?iterable
    {
        while (!$this->fp->eof()) {
            yield $this->fp->fgetcsv();
        }
    }

    private function validateColumns(array $headers): bool
    {
        foreach ($this->columns as $column => $value) {
            if (!in_array($column, $headers)) {
                return false;
            }
        }

        return true;
    }

}

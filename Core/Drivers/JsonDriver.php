<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Json
 *
 * @author Romário Beckman
 */

namespace Core\Drivers;

defined('BASEPATH') or exit('No direct script access allowed');

use Core\Interfaces\DriverDB;
use Core\Exceptions\InvalidConnectionDatabaseParamsException;

class JsonDriver implements DriverDB {

    private $dirFIle = BASEPATH . 'Databases' . DIRECTORY_SEPARATOR . 'Json' . DIRECTORY_SEPARATOR;

    public function connection(array $config) {
        if (!isset($config['directory']))
            throw new OutOfBoundsException('Directory of json not informed.');

        $this->dirFIle = $config['directory'];

        if (is_dir($this->dirFIle)) {
            return $this;
        } else
            throw new InvalidConnectionDatabaseParamsException("Erro on conection.");
    }

    public function fetch(string $table, array $where = []): array {
        $json = $this->getContentsTable($table);
        foreach ($json as $data) {
            $data = (array) $data;
            $match = $this->match($data, $where);
            if ($match)
                return $data;
        }

        return [];
    }

    public function fetchAll(string $table, array $where = []): array {
        $json = $this->getContentsTable($table);
        $response = [];
        foreach ($json as $data) {
            $data = (array) $data;
            $match = $this->match($data, $where);
            if ($match)
                $response[] = $data;
        }
        return $response;
    }

    public function insert(string $table, array $data): void {
        $json = $this->getContentsTable($table);
        $json[] = $data;
        $this->writeTable($table, $json);
    }

    public function update(string $table, array $data, array $where = []): void {
        $json = $this->getContentsTable($table);
        foreach ($json as $i => $d) {
            $match = $this->match((array) $d, $where);
            if ($match)
                $json[$i] = $data;
        }

        $this->writeTable($table, $json);
    }

    public function delete(string $table, array $where = []): void {
        $json = $this->getContentsTable($table);
        $response = [];
        foreach ($json as $data) {
            $data = (array) $data;
            $match = $this->match($data, $where);
            if (!$match)
                $response[] = $data;
        }
        $this->writeTable($table, $response);
    }

    private function getContentsTable(string $table): array {
        $file = $this->dirFIle . $table . '.json';
        if (!file_exists($file))
            throw new \RuntimeException('Table not be load. File: ' . $file);

        return (array) json_decode(file_get_contents($file));
    }

    private function writeTable(string $table, array $json): bool {
        $file = $this->dirFIle . $table . '.json';
        if (!file_exists($file))
            throw new \RuntimeException('Table not be load. File: ' . $file);

        return file_put_contents($file, json_encode($json));
    }

    private function match(array $data, $where): bool {
        foreach ($where as $k => $w) {
            if (!isset($data[$k]))
                return false;
            if ($data[$k] != $w)
                return false;
        }
        return true;
    }

}

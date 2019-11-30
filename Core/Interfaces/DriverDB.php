<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Romário Beckman
 */

namespace Core\Interfaces;

interface DriverDB {

    public function connection(array $config);

    public function insert(string $table, array $data): void;

    public function update(string $table, array $data, array $where): void;

    public function fetchAll(string $table, array $where): array;

    public function fetch(string $table, array $where): array;
}

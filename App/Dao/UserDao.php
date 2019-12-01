<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDao
 *
 * @author Romário Beckman
 */

namespace App\Dao;

use Core\Providers\Singleton;
use App\Models\UserModel;
use Core\Providers\Factory;

class UserDao extends Singleton {

    private $table = 'Users';

    private function encryptPassword(string $password): string {
        return hash('sha512', $password);
    }

    public function fetch(array $filtro = []): ?UserModel {
        $user = Factory::jsonDriver()->fetch($this->table, $filtro);

        if (empty($user))
            return null;

        return new UserModel(
                $user['id'] ?? null,
                $user['name'] ?? null,
                $user['email'] ?? null,
                $user['password'] ?? null,
                (int) ($user['drink'] ?? 0),
                $user['token'] ?? null
        );
    }

    public function fetchAll(array $filtro = []): ?array {
        $users = Factory::jsonDriver()->fetchAll($this->table, $filtro);

        if (empty($users))
            return null;

        return array_map(function ($user) {
            return new UserModel(
                    $user['id'] ?? null,
                    $user['name'] ?? null,
                    $user['email'] ?? null,
                    $user['password'] ?? null,
                    (int) ($user['drink'] ?? 0),
                    $user['token'] ?? null
            );
        }, $users);
    }

    public function inserir(string $name, string $email, string $password): UserModel {
        $UserModel = new UserModel(
                time(),
                $name,
                $email,
                $this->encryptPassword($password)
        );

        Factory::jsonDriver()->insert($this->table, [
            'id' => $UserModel->getId(),
            'name' => $UserModel->getName(),
            'email' => $UserModel->getEmail(),
            'password' => $UserModel->getPassword(),
            'drink' => 0,
            'token' => ''
        ]);

        return $UserModel;
    }

    public function update(UserModel $UserModel, $encryptPassword = false): void {
        if ($encryptPassword) {
            $password = $this->encryptPassword($UserModel->getPassword());
            $UserModel->setPassword($password);
        }

        Factory::jsonDriver()->update(
                $this->table,
                $UserModel->toArray(),
                ['id' => $UserModel->getId()]
        );
    }

    public function updateDrink(UserModel $UserModel, int $drink): void {
        $drinkMl = $UserModel->getDrink() + $drink;
        $UserModel->setDrink($drinkMl);

        Factory::jsonDriver()->update(
                $this->table,
                $UserModel->toArray(),
                ['id' => $UserModel->getId()]);
    }

    public function delete(int $id): void {
        Factory::jsonDriver()->delete($this->table, ['id' => $id]);
    }

    public function buscaPorEmailSenha(string $email, string $password): ?UserModel {
        $user = Factory::jsonDriver()->fetch($this->table, [
            'email' => $email,
            'password' => $this->encryptPassword($password),
        ]);

        return empty($user) ?
                null :
                new UserModel(
                        $user['id'] ?? null,
                        $user['name'] ?? null,
                        $user['email'] ?? null,
                        $user['password'] ?? null
        );
    }

}

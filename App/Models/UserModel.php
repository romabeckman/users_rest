<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Romário Beckman
 */

namespace App\Models;

class UserModel {

    private $id;
    private $name;
    private $email;
    private $password;
    private $drink;
    private $token;

    function __construct(?int $id, string $name, string $email, ?string $password = null, int $drink = 0, string $token = '') {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->drink = $drink;
        $this->token = $token;
    }

    function getId(): int {
        return $this->id;
    }

    function getName(): string {
        return $this->name;
    }

    function getEmail(): string {
        return $this->email;
    }

    function getPassword(): string {
        return $this->password;
    }

    function setId(int $id): void {
        $this->id = $id;
    }

    function setName(string $name): void {
        $this->name = $name;
    }

    function setEmail(string $email): void {
        $this->email = $email;
    }

    function setPassword(string $password): void {
        $this->password = $password;
    }

    function getDrink(): int {
        return $this->drink;
    }

    function setDrink(int $drink): void {
        $this->drink = $drink;
    }

    function getToken() {
        return $this->token;
    }

    function generateToken(): void {
        $this->token = hash('ripemd256', time() . $this->getEmail() . $this->getId());
    }

    public function __toString(): string {
        return json_encode([
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'drink' => $this->getDrink()
        ]);
    }

}

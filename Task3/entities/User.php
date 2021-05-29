<?php

namespace App\entities;

/**
 * Class User
 * @package App\entities
 * @property $name
 */
class User extends Entity
{
    public $id;
    public $name;
    public $posts =[];
    private $password;

    /**
     * Возвращает пароль
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }




}

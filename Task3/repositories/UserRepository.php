<?php


use App\entities\User;

class UserRepository extends Repository
{

    public function getTableName(): string
    {
        return 'users';
    }

    public function getEntityName(): string
    {
        return User::class;
    }

    public function getAllPostsByUserId(int $id){}
}

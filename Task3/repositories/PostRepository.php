<?php


use App\entities\Post;

class PostRepository extends Repository
{

    public function getTableName(): string
    {
        return 'posts';
    }


    public function getEntityName(): string
    {
        return Post::class;
    }

    /**
     * Получить все посты пользователя по ID
     * @param int $id
     * @return array
     */
    public function getAllPostsByUserId(int $id){}
}

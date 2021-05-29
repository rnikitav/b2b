<?php


use App\entities\Entity;
use App\services\DB;

abstract class Repository
{
    /**
     * Возвращает название таблицы в БД
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Получаем строку вызванного класса
     * для работы с БД PDO::FETCH_CLASS
     * @return string
     */
    abstract public function getEntityName(): string;


    /**
     * Получение класса DB
     * @return DB|TSingleton
     */
    protected function getDB(){
        return DB::call();
    }


    /**
     * Получаем одну сущность из БД по id
     * @param $id
     * @return Entity
     */
    public function getOneById($id){}


    /**
     * Создание или обновление сущности в БД
     * @param Entity $entity
     * @return void
     */
    public function save(Entity $entity)
    {
        if (empty($entity->id)) {
            return $this->insert($entity);
        }
        return $this->update($entity, $entity->id);
    }

    /**
     * Вставка новой строки в бд
     * @param Entity $entity
     * @return void
     */
    private function insert(Entity $entity){}

    /**
     * Обновление строки в БД по id
     * @param Entity $entity
     * @param $id
     * @return void
     */
    private function update(Entity $entity, $id){}
}

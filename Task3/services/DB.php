<?php
namespace App\services;

use PDO;

class DB
{
    protected PDO $connect;
    protected array $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'name_db',
            'charset' => 'UTF8',
            'user' => 'root',
            'password' => 'root',
    ];
    use TSingleton;

    /**
     * Получение класса DB
     * @return DB|TSingleton
     */
    public static function call()
    {
        return static::getInstance();
    }

    /**
     * Создание соединения к БД
     * @return PDO
     */
    public function getConnect() {
        if ( empty( $this->connect ) ) {
            $this->connect = new PDO(
                $this->getPrepareDsnString(),
                $this->config['user'],
                $this->config['password']
            );
            $this->connect->setAttribute( // если не нужна модель вернет в виде ассоциативного массива
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

        }
        return $this->connect;
    }

    /**
     * Подготовка dsn из массива config
     * @return string
     */
    private function getPrepareDsnString() {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbname'],
            $this->config['charset']
        );
    }

    /**
     * Подготовка SQL запроса защита от инъекций
     * и выполнение подготовленного запрос
     * @param $sql
     * @param array $params
     * @return false|\PDOStatement
     */
    protected function query($sql, array $params = [] ) {
        $PDOStatement = $this->getConnect()->prepare( $sql );
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    /**
     * Поиск одной записи из БД
     * @param $sql
     * @param $class
     * @param array $params
     * @return mixed
     */
    public function findObject($sql, $class, array $params = [] ) {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetch();
    }

    /**
     * Получение массива классов из БД
     * @param $sql
     * @param $class
     * @param array $params
     * @return array
     */
    public function findObjects($sql, $class, array $params = [] ) {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetchAll();
    }


}

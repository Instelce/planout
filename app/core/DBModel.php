<?php
// map db table to dbmodel class

namespace app\core;

abstract class DBModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;
    abstract public function canUpdateAttributes(): array;

    abstract public static function pk(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(",", $attributes).") VALUES (".implode(",", $params).")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function update() {
        $tableName = $this->tableName();
        $attributes = $this->canUpdateAttributes();
        $set = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $pk = static::pk();
        $pkValue = $this->{$pk};

        $statement = self::prepare("UPDATE $tableName SET ".implode(",", $set)." WHERE $pk = $pkValue;");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function destroy()
    {
        $tableName = static::tableName();
        $pk = static::pk();
        $pkValue = $this->{$pk};

        $statement = self::prepare("DELETE FROM $tableName WHERE $pk = $pkValue;");
        $statement->execute();

        return true;
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $whereStr = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE ".$whereStr);
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public static function find($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $whereStr = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE ".$whereStr);
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function all()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
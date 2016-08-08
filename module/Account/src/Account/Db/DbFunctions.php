<?php
namespace Account\Db;

class DbFunctions
{
  /**
   * @param $sql
   * @param $countReturn
   * @return array
   */
  public static function sql($sql, $countReturn = 0)
  {
    $Adapter = MyDbAdapter::getDbAdapter();
    return ($countReturn !== 1)
      ? iterator_to_array($Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE))
      : $Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE)->current();
  }

  /**
   * @param $entity String
   * @param int $id
   * @return array
   */
  public static function getEntity($entity, $id = 0)
  {
    $Adapter = MyDbAdapter::getDbAdapter();
    $sql = 'SELECT * FROM users';

    if ($id !== 0) {
      $sql = 'SELECT * FROM ' . $entity . 's WHERE ' . $entity . '_id = ' . $id;
      return $Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE)->current();
    }
    return iterator_to_array($Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE));
  }

  /**
   * @param $entity
   * @param $fields
   * @param null $id
   * @return array|\ArrayObject|null
   */
  public static function getFieldEntity($entity, $fields, $id = null)
  {
    $Adapter = MyDbAdapter::getDbAdapter();
    //make fields list
    $sqlField = '';
    if ($fields == null){
      $sqlField = '*';
    } else {
      $arrayCount = count($fields);
      $currentField = 1;
      foreach ($fields AS $field)
      {
        $sqlField .= ($arrayCount != $currentField) ? '`' . $field . '`, ' : '`' . $field . '`';
        ++$currentField;
      }
    }

    $sql = ($id !== null)
      ? 'SELECT ' . $sqlField . ' FROM ' . $entity . 's WHERE ' . $entity . '_id = ' . $id
      : 'SELECT ' . $sqlField . ' FROM ' . $entity . 's';

    if ($id !== null){
      return $Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE)->current();
    }
    return iterator_to_array($Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE));
  }

  /**
   * @param $entity String
   * @param $setField String
   * @return mixed
   */
  public static function insertEntity($entity, $setField)
  {
    $Adapter = MyDbAdapter::getDbAdapter();
    $sql = "INSERT INTO " . $entity . "s VALUES (DEFAULT, " . $setField . ")";
    return $Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE);
  }

  /**
   * @param $name
   * @param $pass
   * @return mixed
   */
  public static function authenticateUser($name, $pass)
  {
    $Adapter = MyDbAdapter::getDbAdapter();
    $sql = "SELECT * FROM `users` "
         . "WHERE user_name = '" . $name . "' "
         . "AND user_pass = '" . $pass . "'";
    $result = $Adapter->query($sql, $Adapter::QUERY_MODE_EXECUTE);
    $row = $result->current();
    if ($row === false){
      return false;
    }
    return $row;
  }
}
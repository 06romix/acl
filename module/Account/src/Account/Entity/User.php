<?php
namespace Account\Entity;

use Account\Db\DbFunctions;

class User
{
  const ROLE_GUEST = 'guest';
  const ROLE_OWNER = 'owner';
  const ROLE_ADMIN = 'admin';
  const ROLE_EMPLOYEE = 'employee';

  private $id;
  private $name;
  private $pass;
  private $email;
  private $role;
  private $parent;

  function __construct($id = 0)
  {
    if ($id != 0) $this->id = (int) $id;
  }

  public static function getUser($id = 0)
  {
    return DbFunctions::getEntity('user', $id);
  }

  public static function getUserLogin($id)
  {
    return DbFunctions::getEntity('user', $id)['user_name'];
  }

  public static function getUserRole($id)
  {
    return DbFunctions::getFieldEntity('user', array('user_role'), $id)['user_role'];
  }

  /**
   * @param $name String user_name
   * @param $pass String user_pass
   * @return array
   */
  public function authenticateUser($name, $pass)
  {
    $result = DbFunctions::authenticateUser($name, $pass);
    if($result == false){
      return array('status' => false);
    }
    return array('status' => true, 'data' => $result);
  }

  public function createUser()
  {
    $this->role = User::ROLE_OWNER;

    $setField = "'"
      . $this->name . "', '"
      . md5($this->pass) . "', '"
      . $this->email . "', '"
      . $this->role . "'";

    DbFunctions::insertEntity('user', $setField);
  }

  public function addReferral($parent)
  {
    $this->parent = $parent;

    $setField = "'"
      . $this->name . "', '"
      . md5($this->pass) . "', '"
      . $this->email . "', '"
      . $this->role . "', '"
      . $this->parent . "'";

    DbFunctions::insertEntity('user', $setField);
  }

  public function exchangeArray($data)
  {
    foreach ($data AS $key => $val){
      if (property_exists($this, $key)){
        $this->$key = ($val !== null) ? $val : null;
      }
    }
  }
}
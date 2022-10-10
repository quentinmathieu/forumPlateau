<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;


class UserManager extends Manager
{

    protected $className = "Model\Entities\User";
    protected $tableName = "user";


    public function __construct()
    {
        parent::connect();
    }

    public function isExisting($pseudo, $email)
    {

        $sql = "SELECT *
                    FROM " . $this->tableName . " a
                    WHERE a.pseudo = :pseudo
                    ";

        $sql2 = "SELECT *
                    FROM " . $this->tableName . " a
                    WHERE a.email = :email
                    ";

        if (
            $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $pseudo], false),
                $this->className
            ) || $this->getOneOrNullResult(
                DAO::select($sql2, ['email' => $email], false),
                $this->className
            )
        ) {
            return true;
        }
        return false;
    }

    public function validatePassword($email, $password)
    {
        if ($this->isExisting("", $email)) {
            $sql = "SELECT *
        FROM " . $this->tableName . " a
        WHERE a.email = :email
        ";
        }
        $DB= $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
        $idUser = $DB->getId();
        $passwordDB = $DB->getPassword();
        
        
        $isValid = password_verify($password, $passwordDB); 
        if($isValid){
            return $idUser;
        }

        return false;
    }
}

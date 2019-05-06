<?php
/**
 * Created by PhpStorm.
 * User: JFNgozo
 * Date: 3/5/2019
 * Time: 1:10 PM
 */

class Student
{

    private static $Firstname, $LastName, $Email, $Phone,
    $StudentID, $Password;

    /**
     * @return mixed
     */
    public static function getFirstname()
    {
        return self::$Firstname;
    }

    /**
     * @param mixed $Firstname
     */
    public static function setFirstname($Firstname)
    {
        self::$Firstname = $Firstname;
    }

    /**
     * @return mixed
     */
    public static function getLastName()
    {
        return self::$LastName;
    }

    /**
     * @param mixed $LastName
     */
    public static function setLastName($LastName)
    {
        self::$LastName = $LastName;
    }

    /**
     * @return mixed
     */
    public static function getEmail()
    {
        return self::$Email;
    }

    /**
     * @param mixed $Email
     */
    public static function setEmail($Email)
    {
        self::$Email = $Email;
    }

    /**
     * @return mixed
     */
    public static function getPhone()
    {
        return self::$Phone;
    }

    /**
     * @param mixed $Phone
     */
    public static function setPhone($Phone)
    {
        self::$Phone = $Phone;
    }

    /**
     * @return mixed
     */
    public static function getStudentID()
    {
        return self::$StudentID;
    }

    /**
     * @param mixed $StudentID
     */
    public static function setStudentID($StudentID)
    {
        self::$StudentID = $StudentID;
    }

    /**
     * @return mixed
     */
    public static function getPassword()
    {
        return self::$Password;
    }

    /**
     * @param mixed $Password
     */
    public static function setPassword($Password)
    {
        self::$Password = $Password;
    }

    public static function LoginStudent($Email, $Password)
    {

    }


}
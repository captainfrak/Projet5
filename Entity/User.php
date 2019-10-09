<?php

namespace Entity;

/**
 * @Entity @Table(name="user")
 **/
class User
{
    private static $ADMIN_ROLE_ID = 26;

    /**
     * @var integer $id
     * @id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @var string $username
     * @username @Column(type="string")
     */
    private $username;

    /**
     * @var string name
     * @name @Column(type="string")
     */
    private $name;

    /**
     * @var string $firstName
     * @firstName @Column(type="string")
     */
    private $firstName;

    /**
     * @var string $email
     * @email @Column(type="string")
     */
    private $email;

    /**
     * @var string $password
     * @password @Column(type="string")
     */
    private $password;

    /**
     * @var int $role
     * @role @column(type="integer")
     */
    private $role;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     * @return User
     */
    public function setRole(int $role): User
    {
        $this->role = $role;
        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::$ADMIN_ROLE_ID;
    }
}

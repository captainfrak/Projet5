<?php
/**
 * Entity for Users
 *
 * PHP Version 7.+
 *
 * @category  Entity
 * @package   Entity
 * @author    Sylvain SAEZ <saez.sylvain@gmail.com>
 * @copyright 2019 Frakdev
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      sylvainsaez.fr
 */

namespace Entity;

/**
 * Entity for the users used in the blog
 *
 * @category Entity
 * @package  Entity
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 *
 * @Entity @Table(name="user")
 **/
class User
{
    private static $ADMIN_ROLE_ID = 26;

    /**
     * Unique Id of the user
     *
     * @var integer $id
     * @id  @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * Username of the user
     *
     * @var      string $username
     * @username @Column(type="string")
     */
    private $username;

    /**
     * Name of the user
     *
     * @var  string name
     * @name @Column(type="string")
     */
    private $name;

    /**
     * Firstname of the user
     *
     * @var       string $firstName
     * @firstName @Column(type="string")
     */
    private $firstName;

    /**
     * Email of the user
     *
     * @var   string $email
     * @email @Column(type="string")
     */
    private $email;

    /**
     * Password of the user
     *
     * @var      string $password
     * @password @Column(type="string")
     */
    private $password;

    /**
     * Role of the user
     *
     * @var  int $role
     * @role @column(type="integer")
     */
    private $role;

    /**
     * Get the user id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the user username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the user username
     *
     * @param string $username nickname
     *
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the user email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the user email
     *
     * @param string $email email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the password of the user
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the password of the user
     *
     * @param string $password hash password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the name of the user
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of the user
     *
     * @param mixed $name name
     *
     * @return User
     */
    public function setName($name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the first name of the user
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the first name of the user
     *
     * @param string $firstName firstname
     *
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get the role of the user
     *
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * Set the role of the user
     *
     * @param int $role admin or not
     *
     * @return User
     */
    public function setRole(int $role): User
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Checked if user is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::$ADMIN_ROLE_ID;
    }
}

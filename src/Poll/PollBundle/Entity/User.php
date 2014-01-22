<?php

namespace Poll\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true, length=150)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $password;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_admin;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_author;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_respondent;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_joined;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $last_login;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set is_admin
     *
     * @param boolean $isAdmin
     * @return User
     */
    public function setIsAdmin($isAdmin)
    {
        $this->is_admin = $isAdmin;
    
        return $this;
    }

    /**
     * Get is_admin
     *
     * @return boolean 
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Set is_author
     *
     * @param boolean $isAuthor
     * @return User
     */
    public function setIsAuthor($isAuthor)
    {
        $this->is_author = $isAuthor;
    
        return $this;
    }

    /**
     * Get is_author
     *
     * @return boolean 
     */
    public function getIsAuthor()
    {
        return $this->is_author;
    }

    /**
     * Set is_respondent
     *
     * @param boolean $isRespondent
     * @return User
     */
    public function setIsRespondent($isRespondent)
    {
        $this->is_respondent = $isRespondent;
    
        return $this;
    }

    /**
     * Get is_respondent
     *
     * @return boolean 
     */
    public function getIsRespondent()
    {
        return $this->is_respondent;
    }

    /**
     * Set date_joined
     *
     * @param \DateTime $dateJoined
     * @return User
     */
    public function setDateJoined($dateJoined)
    {
        $this->date_joined = $dateJoined;
    
        return $this;
    }

    /**
     * Get date_joined
     *
     * @return \DateTime 
     */
    public function getDateJoined()
    {
        return $this->date_joined;
    }

    /**
     * Set last_login
     *
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;
    
        return $this;
    }

    /**
     * Get last_login
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }
}
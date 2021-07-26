<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Employee") 
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee(string $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getRoles(){
        return [
            'ROLE USER'
        ];
    }
    public function getSalt(){}
    public function eraseCredentials(){}

    public function serialize(){
        return serialize([
            $this->employee,
            $this->username,
            $this->password
        ]);

    } 
    public function unserialize($string){
        list( 
            $this->employee,
            $this->username,
            $this->password ) = unserialize($string,['allowed classes'=>false]);
    }
 
}

<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="Users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"userName"}, message="That username is taken!")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="userName", type="string", length=32, nullable=false)
     * @Assert\NotBlank
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     * @Assert\NotBlank(groups={"Registration"})
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false, unique=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", nullable=false)
     */
    private $language = 'en';

    /**
     * @var integer
     *
     * @ORM\Column(name="countryGeonameId", type="integer", nullable=true)
     */
    private $countryGeonameId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cityGeonameId", type="integer", nullable=true)
     */
    private $cityGeonameId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date", nullable=false)
     */
    private $birthDate = '2000-01-01';

    /**
     * @var integer
     *
     * @ORM\Column(name="createDate", type="integer", nullable=false)
     */
    private $createDate = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="updateDate", type="integer", nullable=false)
     */
    private $updateDate = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lastLoginDate", type="integer", nullable=false)
     */
    private $lastLoginDate = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=false)
     */
    private $gender;

    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;



    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set password
     *
     * @param string $password
     *
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
     * Set email
     *
     * @param string $email
     *
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
     * Set language
     *
     * @param string $language
     *
     * @return User
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set countryGeonameId
     *
     * @param integer $countryGeonameId
     *
     * @return User
     */
    public function setCountryGeonameId($countryGeonameId)
    {
        $this->countryGeonameId = $countryGeonameId;

        return $this;
    }

    /**
     * Get countryGeonameId
     *
     * @return integer
     */
    public function getCountryGeonameId()
    {
        return $this->countryGeonameId;
    }

    /**
     * Set cityGeonameId
     *
     * @param integer $cityGeonameId
     *
     * @return User
     */
    public function setCityGeonameId($cityGeonameId)
    {
        $this->cityGeonameId = $cityGeonameId;

        return $this;
    }

    /**
     * Get cityGeonameId
     *
     * @return integer
     */
    public function getCityGeonameId()
    {
        return $this->cityGeonameId;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set createDate
     *
     * @param integer $createDate
     *
     * @return User
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return integer
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set updateDate
     *
     * @param integer $updateDate
     *
     * @return User
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return integer
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set lastLoginDate
     *
     * @param integer $lastLoginDate
     *
     * @return User
     */
    public function setLastLoginDate($lastLoginDate)
    {
        $this->lastLoginDate = $lastLoginDate;

        return $this;
    }

    /**
     * Get lastLoginDate
     *
     * @return integer
     */
    public function getLastLoginDate()
    {
        return $this->lastLoginDate;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return User
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        if ($this->level >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getRoles()
    {
        if ($this->level >= 1000) {
            return ['ROLE_ADMIN'];
        } else {
            return ['ROLE_USER'];
        }
    }

    public function setRoles($roles)
    {
        if (in_array('ROLE_ADMIN', $roles)) {
            if ($this->level < 1000) {
                $this->level += 1000;
            }
        } else {
            $this->level = 1;
        }
    }

    public function getSalt()
    {
        // See "Do you need to use a Salt?" at http://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function serialize()
    {
        return serialize(array(
            $this->userId,
            $this->userName,
            $this->password,
            $this->email,
            $this->level
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->userId,
            $this->userName,
            $this->password,
            $this->email,
            $this->level
            ) = unserialize($serialized);
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }
}

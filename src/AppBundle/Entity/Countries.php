<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="Countries", indexes={@ORM\Index(name="geonameId", columns={"geonameId"}), @ORM\Index(name="localeCode", columns={"localeCode"}), @ORM\Index(name="countryIsoCode", columns={"countryIsoCode"})})
 * @ORM\Entity
 */
class Countries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="geonameId", type="integer", nullable=false)
     */
    private $geonameId;

    /**
     * @var string
     *
     * @ORM\Column(name="localeCode", type="string", length=2, nullable=false)
     */
    private $localeCode;

    /**
     * @var string
     *
     * @ORM\Column(name="countryIsoCode", type="string", length=2, nullable=false)
     */
    private $countryIsoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="countryName", type="string", length=100, nullable=false)
     */
    private $countryName;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set geonameId
     *
     * @param integer $geonameId
     *
     * @return Countries
     */
    public function setGeonameId($geonameId)
    {
        $this->geonameId = $geonameId;

        return $this;
    }

    /**
     * Get geonameId
     *
     * @return integer
     */
    public function getGeonameId()
    {
        return $this->geonameId;
    }

    /**
     * Set localeCode
     *
     * @param string $localeCode
     *
     * @return Countries
     */
    public function setLocaleCode($localeCode)
    {
        $this->localeCode = $localeCode;

        return $this;
    }

    /**
     * Get localeCode
     *
     * @return string
     */
    public function getLocaleCode()
    {
        return $this->localeCode;
    }

    /**
     * Set countryIsoCode
     *
     * @param string $countryIsoCode
     *
     * @return Countries
     */
    public function setCountryIsoCode($countryIsoCode)
    {
        $this->countryIsoCode = $countryIsoCode;

        return $this;
    }

    /**
     * Get countryIsoCode
     *
     * @return string
     */
    public function getCountryIsoCode()
    {
        return $this->countryIsoCode;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return Countries
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

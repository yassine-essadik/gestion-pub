<?php

namespace GP\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InterventionType
 *
 * @ORM\Table(name="intervention_type")
 * @ORM\Entity(repositoryClass="GP\GestionBundle\Repository\InterventionTypeRepository")
 */
class InterventionType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return InterventionType
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function __toString()
    {
    	return $this->getNom();
    }
}


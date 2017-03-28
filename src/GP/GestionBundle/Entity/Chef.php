<?php

namespace GP\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chef
 *
 * @ORM\Table(name="chef")
 * @ORM\Entity(repositoryClass="GP\GestionBundle\Repository\ChefRepository")
 */
class Chef
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
     *
     * @ORM\ManyToOne(targetEntity="GP\GestionBundle\Entity\Societe")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=10)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=255)
     */
    private $province;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;
    
    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="smallint")
     */
    private $statut;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;
    
    
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
     * @return Chef
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

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Chef
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Chef
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Chef
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Chef
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Chef
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Chef
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return Chef
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }
    
    
    
    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Chef
     */
    public function setPays($pays)
    {
    	$this->pays = $pays;
    
    	return $this;
    }
    
    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
    	return $this->pays;
    }
    
    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Poseur
     */
    public function setStatut($statut)
    {
    	$this->statut = $statut;
    
    	return $this;
    }
    
    /**
     * Get statut
     *
     * @return int
     */
    public function getStatut()
    {
    	return $this->statut;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Poseur
     */
    public function setCreated($created)
    {
    	$this->created = $created;
    
    	return $this;
    }
    
    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
    	return $this->created;
    }
    
    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Poseur
     */
    public function setModified($modified)
    {
    	$this->modified = $modified;
    
    	return $this;
    }
    
    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
    	return $this->modified;
    }
}


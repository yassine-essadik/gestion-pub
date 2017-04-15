<?php

namespace GP\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="GP\GestionBundle\Repository\ProjetRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Projet
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
     * @ORM\ManyToOne(targetEntity="GP\GestionBundle\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $client;

    /**
     *
     * @ORM\ManyToOne(targetEntity="GP\GestionBundle\Entity\Pointvente")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $pointvente;
    
    /**
     * @var string
     *
     * @ORM\Column(name="num_dossier", type="string", length=255)
     */
    private $numDossier;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial", type="string", length=255, nullable=true)
     */
    private $commercial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_pose", type="date")
     */
    private $dateDebutPose;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_pose", type="date")
     */
    private $dateFinPose;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text", nullable=true)
     */
    private $descriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="num_facture", type="string", length=255)
     */
    private $numFacture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facturation", type="date")
     */
    private $dateFacturation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="date")
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
     * Set numDossier
     *
     * @param string $numDossier
     *
     * @return Projet
     */
    public function setNumDossier($numDossier)
    {
        $this->numDossier = $numDossier;

        return $this;
    }

    /**
     * Get numDossier
     *
     * @return string
     */
    public function getNumDossier()
    {
        return $this->numDossier;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Projet
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
     * Set commercial
     *
     * @param string $commercial
     *
     * @return Projet
     */
    public function setCommercial($commercial)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return string
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * Set dateDebutPose
     *
     * @param \DateTime $dateDebutPose
     *
     * @return Projet
     */
    public function setDateDebutPose($dateDebutPose)
    {
        $this->dateDebutPose = $dateDebutPose;

        return $this;
    }

    /**
     * Get dateDebutPose
     *
     * @return \DateTime
     */
    public function getDateDebutPose()
    {
        return $this->dateDebutPose;
    }

    /**
     * Set dateFinPose
     *
     * @param \DateTime $dateFinPose
     *
     * @return Projet
     */
    public function setDateFinPose($dateFinPose)
    {
        $this->dateFinPose = $dateFinPose;

        return $this;
    }

    /**
     * Get dateFinPose
     *
     * @return \DateTime
     */
    public function getDateFinPose()
    {
        return $this->dateFinPose;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Projet
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set numFacture
     *
     * @param string $numFacture
     *
     * @return Projet
     */
    public function setNumFacture($numFacture)
    {
        $this->numFacture = $numFacture;

        return $this;
    }

    /**
     * Get numFacture
     *
     * @return string
     */
    public function getNumFacture()
    {
        return $this->numFacture;
    }

    /**
     * Set dateFacturation
     *
     * @param \DateTime $dateFacturation
     *
     * @return Projet
     */
    public function setDateFacturation($dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;

        return $this;
    }

    /**
     * Get dateFacturation
     *
     * @return \DateTime
     */
    public function getDateFacturation()
    {
        return $this->dateFacturation;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Projet
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
     * @return Projet
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

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
    	$this->setModified(new \DateTime(date('Y-m-d H:i:s')));
    
    	if($this->getCreated() == null)
    	{
    		$this->setCreated(new \DateTime(date('Y-m-d H:i:s')));
    	}
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return Projet
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set pointvente
     *
     * @param Pointvente $pointvente
     *
     * @return Projet
     */
    public function setPointvente(Pointvente $pointvente)
    {
        $this->pointvente = $pointvente;

        return $this;
    }

    /**
     * Get pointvente
     *
     * @return Pointvente
     */
    public function getPointvente()
    {
        return $this->pointvente;
    }
    
    public function __toString()
    {
    	return $this->getNom();
    }
}

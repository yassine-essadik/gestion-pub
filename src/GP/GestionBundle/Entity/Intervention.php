<?php

namespace GP\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention")
 * @ORM\Entity(repositoryClass="GP\GestionBundle\Repository\InterventionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Intervention
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
     * @ORM\ManyToOne(targetEntity="GP\GestionBundle\Entity\InterventionType")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $type;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="GP\GestionBundle\Entity\InterventionStatut")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $statut;
    
    /**
     * @ORM\ManyToMany(targetEntity="GP\GestionBundle\Entity\Poseur", cascade={"persist"})
     * @ORM\JoinTable(name="intervention_poseur")
     */
    
    private $poseurs;

    /**
     *
     * @ORM\ManyToOne(targetEntity="GP\GestionBundle\Entity\Projet")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $projet;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="date", nullable=true)
     */
    private $dateDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="laissez_passer_valide", type="smallint", nullable=true)
     */
    private $laissezPasserValide;

    /**
     * @var string
     *
     * @ORM\Column(name="laissez_passer_valide_par", type="string", length=255, nullable=true)
     */
    private $laissezPasserValidePar;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_urgence", type="string", length=255, nullable=true)
     */
    private $contactUrgence;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="brief", type="string", length=255, nullable=true)
     */
    private $brief;

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
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Intervention
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Intervention
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Intervention
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set laissezPasserValide
     *
     * @param integer $laissezPasserValide
     *
     * @return Intervention
     */
    public function setLaissezPasserValide($laissezPasserValide)
    {
        $this->laissezPasserValide = $laissezPasserValide;

        return $this;
    }

    /**
     * Get laissezPasserValide
     *
     * @return int
     */
    public function getLaissezPasserValide()
    {
        return $this->laissezPasserValide;
    }

    /**
     * Set laissezPasserValidePar
     *
     * @param string $laissezPasserValidePar
     *
     * @return Intervention
     */
    public function setLaissezPasserValidePar($laissezPasserValidePar)
    {
        $this->laissezPasserValidePar = $laissezPasserValidePar;

        return $this;
    }

    /**
     * Get laissezPasserValidePar
     *
     * @return string
     */
    public function getLaissezPasserValidePar()
    {
        return $this->laissezPasserValidePar;
    }

    /**
     * Set contactUrgence
     *
     * @param string $contactUrgence
     *
     * @return Intervention
     */
    public function setContactUrgence($contactUrgence)
    {
        $this->contactUrgence = $contactUrgence;

        return $this;
    }

    /**
     * Get contactUrgence
     *
     * @return string
     */
    public function getContactUrgence()
    {
        return $this->contactUrgence;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Intervention
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set brief
     *
     * @param string $brief
     *
     * @return Intervention
     */
    public function setBrief($brief)
    {
        $this->brief = $brief;

        return $this;
    }

    /**
     * Get brief
     *
     * @return string
     */
    public function getBrief()
    {
        return $this->brief;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Intervention
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
     * @return Intervention
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
     * Constructor
     */
    public function __construct()
    {
        $this->poseurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add poseur
     *
     * @param Poseur $poseur
     *
     * @return Intervention
     */
    public function addPoseur(Poseur $poseur)
    {
        $this->poseurs[] = $poseur;

        return $this;
    }

    /**
     * Remove poseur
     *
     * @param Poseur $poseur
     */
    public function removePoseur(Poseur $poseur)
    {
        $this->poseurs->removeElement($poseur);
    }

    /**
     * Get poseurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPoseurs()
    {
        return $this->poseurs;
    }

    /**
     * Set projet
     *
     * @param Projet $projet
     *
     * @return Intervention
     */
    public function setProjet(Projet $projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return Projet
     */
    public function getProjet()
    {
        return $this->projet;
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
     * Set type
     *
     * @param InterventionType $type
     *
     * @return Intervention
     */
    public function setType(InterventionType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return InterventionType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set statut
     *
     * @param InterventionStatut $statut
     *
     * @return Intervention
     */
    public function setStatut(InterventionStatut $statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return InterventionStatut
     */
    public function getStatut()
    {
        return $this->statut;
    }
}

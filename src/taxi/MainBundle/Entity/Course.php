<?php

namespace taxi\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="taxi\MainBundle\Repository\CourseRepository")
 */
class Course
{

    /**
     * @ORM\ManyToOne(targetEntity="taxi\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="personne", type="integer")
     */
    private $personne;

    /**
     * @var int
     *
     * @ORM\Column(name="bagage", type="integer")
     */
    private $bagage;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_depart", type="string", length=255)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arrive", type="string", length=255)
     */
    private $villeArrive;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_depart", type="string", length=255)
     */
    private $cpDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="cp_arrive", type="string", length=255)
     */
    private $cpArrive;

    /**
     * @var string
     *
     * @ORM\Column(name="voie_arrive", type="string", length=255)
     */
    private $voieArrive;

    /**
     * @var string
     *
     * @ORM\Column(name="voie_depart", type="string", length=255)
     */
    private $voieDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_depart", type="string", length=255)
     */
    private $rueDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="rue_arrive", type="string", length=255)
     */
    private $rueArrive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="datetime")
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrive", type="datetime")
     */
    private $dateArrive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heur_depart", type="datetime")
     */
    private $heurDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heur_arrive", type="datetime")
     */
    private $heurArrive;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmer", type="boolean")
     */
    private $confirmer;


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
     * Set personne
     *
     * @param integer $personne
     *
     * @return Course
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return int
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * Set bagage
     *
     * @param integer $bagage
     *
     * @return Course
     */
    public function setBagage($bagage)
    {
        $this->bagage = $bagage;

        return $this;
    }

    /**
     * Get bagage
     *
     * @return int
     */
    public function getBagage()
    {
        return $this->bagage;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     *
     * @return Course
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    /**
     * Get villeDepart
     *
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set villeArrive
     *
     * @param string $villeArrive
     *
     * @return Course
     */
    public function setVilleArrive($villeArrive)
    {
        $this->villeArrive = $villeArrive;

        return $this;
    }

    /**
     * Get villeArrive
     *
     * @return string
     */
    public function getVilleArrive()
    {
        return $this->villeArrive;
    }

    /**
     * Set cpDepart
     *
     * @param string $cpDepart
     *
     * @return Course
     */
    public function setCpDepart($cpDepart)
    {
        $this->cpDepart = $cpDepart;

        return $this;
    }

    /**
     * Get cpDepart
     *
     * @return string
     */
    public function getCpDepart()
    {
        return $this->cpDepart;
    }

    /**
     * Set cpArrive
     *
     * @param string $cpArrive
     *
     * @return Course
     */
    public function setCpArrive($cpArrive)
    {
        $this->cpArrive = $cpArrive;

        return $this;
    }

    /**
     * Get cpArrive
     *
     * @return string
     */
    public function getCpArrive()
    {
        return $this->cpArrive;
    }

    /**
     * Set voieArrive
     *
     * @param string $voieArrive
     *
     * @return Course
     */
    public function setVoieArrive($voieArrive)
    {
        $this->voieArrive = $voieArrive;

        return $this;
    }

    /**
     * Get voieArrive
     *
     * @return string
     */
    public function getVoieArrive()
    {
        return $this->voieArrive;
    }

    /**
     * Set voieDepart
     *
     * @param string $voieDepart
     *
     * @return Course
     */
    public function setVoieDepart($voieDepart)
    {
        $this->voieDepart = $voieDepart;

        return $this;
    }

    /**
     * Get voieDepart
     *
     * @return string
     */
    public function getVoieDepart()
    {
        return $this->voieDepart;
    }

    /**
     * Set rueDepart
     *
     * @param string $rueDepart
     *
     * @return Course
     */
    public function setRueDepart($rueDepart)
    {
        $this->rueDepart = $rueDepart;

        return $this;
    }

    /**
     * Get rueDepart
     *
     * @return string
     */
    public function getRueDepart()
    {
        return $this->rueDepart;
    }

    /**
     * Set rueArrive
     *
     * @param string $rueArrive
     *
     * @return Course
     */
    public function setRueArrive($rueArrive)
    {
        $this->rueArrive = $rueArrive;

        return $this;
    }

    /**
     * Get rueArrive
     *
     * @return string
     */
    public function getRueArrive()
    {
        return $this->rueArrive;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return Course
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateArrive
     *
     * @param \DateTime $dateArrive
     *
     * @return Course
     */
    public function setDateArrive($dateArrive)
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    /**
     * Get dateArrive
     *
     * @return \DateTime
     */
    public function getDateArrive()
    {
        return $this->dateArrive;
    }

    /**
     * Set heurDepart
     *
     * @param \DateTime $heurDepart
     *
     * @return Course
     */
    public function setHeurDepart($heurDepart)
    {
        $this->heurDepart = $heurDepart;

        return $this;
    }

    /**
     * Get heurDepart
     *
     * @return \DateTime
     */
    public function getHeurDepart()
    {
        return $this->heurDepart;
    }

    /**
     * Set heurArrive
     *
     * @param \DateTime $heurArrive
     *
     * @return Course
     */
    public function setHeurArrive($heurArrive)
    {
        $this->heurArrive = $heurArrive;

        return $this;
    }

    /**
     * Get heurArrive
     *
     * @return \DateTime
     */
    public function getHeurArrive()
    {
        return $this->heurArrive;
    }

    /**
     * Set confirmer
     *
     * @param boolean $confirmer
     *
     * @return Course
     */
    public function setConfirmer($confirmer)
    {
        $this->confirmer = $confirmer;

        return $this;
    }

    /**
     * Get confirmer
     *
     * @return bool
     */
    public function getConfirmer()
    {
        return $this->confirmer;
    }

    /**
     * Set user
     *
     * @param \taxi\UserBundle\Entity\User $user
     *
     * @return Course
     */
    public function setUser(\taxi\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \taxi\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

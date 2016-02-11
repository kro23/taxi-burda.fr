<?php

namespace taxi\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="taxi\MainBundle\Repository\CommandeRepository")
 */
class Commande
{

    /**
     * @ORM\ManyToOne(targetEntity="taxi\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="taxi\MainBundle\Entity\ModePaiement")
     * @ORM\JoinColumn(name="id_paiement",referencedColumnName="id",onDelete="CASCADE")
     */
    private $mode_paiement;

    /**
     * @ORM\ManyToOne(targetEntity="taxi\MainBundle\Entity\PackCourse")
     * @ORM\JoinColumn(name="id_pack",referencedColumnName="id",onDelete="CASCADE")
     */
    private $pack_course;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="datetime")
     */
    private $dateDepart;

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
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return Commande
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
     * Set confirmer
     *
     * @param boolean $confirmer
     *
     * @return Commande
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
     * @return Commande
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

    /**
     * Set modePaiement
     *
     * @param \taxi\MainBundle\Entity\ModePaiement $modePaiement
     *
     * @return Commande
     */
    public function setModePaiement(\taxi\MainBundle\Entity\ModePaiement $modePaiement = null)
    {
        $this->mode_paiement = $modePaiement;

        return $this;
    }

    /**
     * Get modePaiement
     *
     * @return \taxi\MainBundle\Entity\ModePaiement
     */
    public function getModePaiement()
    {
        return $this->mode_paiement;
    }

    /**
     * Set packCourse
     *
     * @param \taxi\MainBundle\Entity\PackCourse $packCourse
     *
     * @return Commande
     */
    public function setPackCourse(\taxi\MainBundle\Entity\PackCourse $packCourse = null)
    {
        $this->pack_course = $packCourse;

        return $this;
    }

    /**
     * Get packCourse
     *
     * @return \taxi\MainBundle\Entity\PackCourse
     */
    public function getPackCourse()
    {
        return $this->pack_course;
    }
}

<?php

namespace taxi\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="taxi\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @ORM\ManyToMany(targetEntity="taxi\MainBundle\Entity\Adresse",cascade={"persist"})
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

/*    public function __construct()
    {
        parent::__construct();

    }*/

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255,nullable=true)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer",nullable=true)
     */
    private $telephone;

    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     maxSizeMessage = "Votre avatar ne peut pas excéder 1Mo",
     *     mimeTypes = {"image/jpeg", "image/png","image/gif"},
     *     mimeTypesMessage = "Choisissez un fichier jpg,png ou gif valide"
     * )
     */
    protected $avatarFile;

    /**
     * @var string
     *
     * @ORM\Column(name="avatarPath", type="string", length=255,nullable=true)
     */
    private $avatarPath;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float",nullable=true)
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float",nullable=true)
     */
    private $latitude;


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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
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
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set avatarPath
     *
     * @param string $avatarPath
     *
     * @return User
     */
    public function setAvatarPath($avatarPath = null)
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    /**
     * Get avatarPath
     *
     * @return string
     */
    public function getAvatarPath()
    {
        return $this->avatarPath;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return User
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return User
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }


 /************* dedier a l'uplode************/

    public function getAvatarFile() {
        return $this->avatarFile;
    }

    public function setAvatarFile(UploadedFile $avatarFile) {
        $this->avatarFile = $avatarFile;
        return $this;
    }

    // Retourner le chemin absolu d'un fichier (utile depuis les controllers)

    public function getAbsolutePath() {
        return null === $this->avatarPath ? null : $this->getUploadRootDir().'/'.$this->avatarPath;
    }
    // Retourne le chemin relatif d'un fichier (utile dans les vues twig)

    public function getWebPath() {
        return null === $this->avatarPath ? null : $this->getUploadDir().'/'.$this->avatarPath;
    }


    protected function getUploadRootDir() {
        return __DIR__."/../../../../web/".$this->getUploadDir();
    }

    // Chemin réel de stockage des fichiers qui seront uploadés

    protected function getUploadDir() {
        return "uploads/avatars";
    }

    // Gestion des cycles de vie, un avatar ne peut être persisté dans la DB si le fichier jpg, png ou gif n'est pas uploadé.

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if(null !== $this->avatarFile) {
            $this->avatarPath = sha1(uniqid(mt_rand(),true)).'.'.$this->avatarFile->guessExtension();
        } else {
            return;
        }
    }

    /**
     * Après la sauvegarde ou la mise à jour d'un avatar dans la DB, on déplace le fichier dans son répertoire d'upload designé dans getUploadDir()
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if(null === $this->avatarFile) {
            return;
        }
        $this->avatarFile->move($this->getUploadRootDir(),$this->avatarPath);
        // vide le fichier en mémoire temporaire, une fois que le fichier est déplacé dans le repertoire d'upload
      /*  unset($this->avatarFile);*/
        $this->avatarFile = null;
    }

    /**
     * Si je supprime un avatar dans la db, je supprime aussi le fichier dans le répertoire d'upload
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if($file = $this->getAbsolutePath()!= null ) {
            unlink($file);
        }
    }


    /**
     * Add adresse
     *
     * @param \taxi\MainBundle\Entity\Adresse $adresse
     *
     * @return User
     */
    public function addAdresse(\taxi\MainBundle\Entity\Adresse $adresse)
    {
        $this->adresse[] = $adresse;

        return $this;
    }

    /**
     * Remove adresse
     *
     * @param \taxi\MainBundle\Entity\Adresse $adresse
     */
    public function removeAdresse(\taxi\MainBundle\Entity\Adresse $adresse)
    {
        $this->adresse->removeElement($adresse);
    }

    /**
     * Get adresse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}

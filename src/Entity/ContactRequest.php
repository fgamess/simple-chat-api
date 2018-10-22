<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactRequest
 *
 * @ORM\Table(name="contact_request")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRequestRepository")
 */
class ContactRequest
{
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * [private description]
     * @var int
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $sender;

    /**
     * @var int
     * @ORM\Column(type="integer")
     *
     */
    private $recipient;

    public function __construct()
    {
        $this->setStatus(self::STATUS_PENDING);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * [getStatus description]
     * @return int [description]
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * [setStatus description]
     * @param  int            $status [description]
     * @return ContactRequest         [description]
     */
    public function setStatus(int $status) : ContactRequest
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set sender
     *
     * @param int $sender
     *
     * @return ContactRequest
     */
    public function setSender(int $sender) : ContactRequest
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return int
     */
    public function getSender() : int
    {
        return $this->sender;
    }

    /**
     * Set recipient
     *
     * @param int $recipient
     *
     * @return ContactRequest
     */
    public function setRecipient(int $recipient) : ContactRequest
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return int
     */
    public function getRecipient() : int
    {
        return $this->recipient;
    }
}

<?php


namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * reminder
 *
 * @ORM\Table(name="reminder")
 * @ORM\Entity(repositoryClass="Customize\Entity\Repository\Reminder")
 */
class Reminder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="day_before", type="integer", length=45, nullable=false)
     */
    private $dayBefore = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="smallint", length=60, nullable=false)
     */
    private $active = 1;

    /**
     * @var EmailTemplate
     * @ORM\ManyToOne(targetEntity="Customize\Entity\EmailTemplate")
     * @ORM\JoinColumn(name="email_template_id", referencedColumnName="id")
     */
    private $emailTemplate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDayBefore()
    {
        return $this->dayBefore;
    }

    /**
     * @param string $dayBefore
     * @return self
     */
    public function setDayBefore($dayBefore)
    {
        $this->dayBefore = $dayBefore;
        return $this;
    }

    /**
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $active
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return EmailTemplate
     */
    public function getEmailTemplate()
    {
        return $this->emailTemplate;
    }

    /**
     * @param EmailTemplate $emailTemplate
     * @return self
     */
    public function setEmailTemplate($emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
        return $this;
    }


}
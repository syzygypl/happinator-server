<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity
 */
class HappinessLevel
{

    const LEVEL_HAPPY = 'happy';
    const LEVEL_NEUTRAL = 'neutral';
    const LEVEL_SAD = 'sad';

    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string General happiness level
     *
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank
     */
    private $level;

    /**
     * @var \DateTime Date of vote
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level)
    {
        $this->level = $level;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return array
     */
    public static function getOptions()
    {
        return [
            self::LEVEL_HAPPY,
            self::LEVEL_NEUTRAL,
            self::LEVEL_SAD
        ];
    }
}

<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * * @ApiResource(collectionOperations={"post"={"method"="POST"}}, itemOperations={})
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\HappinessLevelRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\Choice(
     *     choices={"happy","neutral","sad"},
     *     message="The level must match (happy|neutral|sad)"
     * )
     * @Assert\NotBlank
     */
    private $level;

    /**
     * @var string Entrypoint identifier
     *
     * @ORM\Column(type="string", length=255)
     */
    private $entrypoint = '';

    /**
     * @var \DateTime Date of vote
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getEntrypoint(): string
    {
        return $this->entrypoint;
    }

    /**
     * @param string $entrypoint
     */
    public function setEntrypoint(string $entrypoint)
    {
        $this->entrypoint = (string)$entrypoint;
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

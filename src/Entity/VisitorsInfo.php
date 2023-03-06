<?php

namespace App\Entity;

use App\Repository\VisitorsInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: VisitorsInfoRepository::class)]
#[ORM\UniqueConstraint(
    name: 'ym_uid_fingerprint',
    columns: ['_ym_uid', 'fingerprint']
)]

class VisitorsInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_agent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ip = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fingerprint = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $_ym_uid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_on = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $visited_on = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVid(): ?string
    {
        return $this->vid;
    }

    public function setVid(?string $vid): self
    {
        $this->vid = $vid;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->user_agent;
    }

    public function setUserAgent(?string $user_agent): self
    {
        $this->user_agent = $user_agent;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->created_on;
    }

    public function setCreatedOn(?\DateTimeInterface $created_on): self
    {
        $this->created_on = $created_on;

        return $this;
    }

    public function getVisitedOn(): ?\DateTimeInterface
    {
        return $this->visited_on;
    }

    public function setVisitedOn(?\DateTimeInterface $visited_on): self
    {
        $this->visited_on = $visited_on;

        return $this;
    }

    public function getFingerprint(): ?string
    {
        return $this->fingerprint;
    }

    public function setFingerprint(string $fingerprint): self
    {
        $this->fingerprint = $fingerprint;

        return $this;
    }

    public function getYmUid(): ?string
    {
        return $this->_ym_uid;
    }

    public function setYmUid(?string $_ym_uid): self
    {
        $this->_ym_uid = $_ym_uid;

        return $this;
    }
}

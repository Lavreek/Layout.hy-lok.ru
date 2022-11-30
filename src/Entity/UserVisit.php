<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Repository\UserVisitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserVisitRepository::class)]
class UserVisit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $u_ip = null;

    #[ORM\Column(length: 255)]
    private ?string $site_page = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $u_geo = null;

    #[ORM\Column]
    private ?int $u_width = null;

    #[ORM\Column(length: 255, unique: true)]
    #[UniqueEntity('u_ym_uid')]
    private ?string $u_ym_uid = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $fingerprint_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUIp(): ?string
    {
        return $this->u_ip;
    }

    public function setUIp(string $u_ip): self
    {
        $this->u_ip = $u_ip;

        return $this;
    }

    public function getSitePage(): ?string
    {
        return $this->site_page;
    }

    public function setSitePage(string $site_page): self
    {
        $this->site_page = $site_page;

        return $this;
    }

    public function getUGeo(): ?string
    {
        return $this->u_geo;
    }

    public function setUGeo(string $u_geo): self
    {
        $this->u_geo = $u_geo;

        return $this;
    }

    public function getUWidth(): ?int
    {
        return $this->u_width;
    }

    public function setUWidth(int $u_width): self
    {
        $this->u_width = $u_width;

        return $this;
    }

    public function getUYmUid(): ?string
    {
        return $this->u_ym_uid;
    }

    public function setUYmUid(string $u_ym_uid): self
    {
        $this->u_ym_uid = $u_ym_uid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getFingerprintId(): ?string
    {
        return $this->fingerprint_id;
    }

    public function setFingerprintId(string $fingerprint_id): self
    {
        $this->fingerprint_id = $fingerprint_id;

        return $this;
    }
}

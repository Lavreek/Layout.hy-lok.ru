<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Validate;
use App\Repository\UserRequestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRequestsRepository::class)]
class UserRequests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Validate\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $u_email = null;

    #[Validate\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $u_comment = null;

    #[ORM\Column(length: 15)]
    private ?string $u_ip = null;

    #[ORM\Column(length: 255)]
    private ?string $u_ym_uid = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $u_geo = null;

    #[Validate\NotBlank]
    #[ORM\Column]
    private ?int $u_width = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $fingerprint_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUEmail(): ?string
    {
        return $this->u_email;
    }

    public function setUEmail(string $u_email): self
    {
        $this->u_email = $u_email;

        return $this;
    }

    public function getUComment(): ?string
    {
        return $this->u_comment;
    }

    public function setUComment(string $u_comment): self
    {
        $this->u_comment = $u_comment;

        return $this;
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

    public function getUYmUid(): ?string
    {
        return $this->u_ym_uid;
    }

    public function setUYmUid(string $u_ym_uid): self
    {
        $this->u_ym_uid = $u_ym_uid;

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

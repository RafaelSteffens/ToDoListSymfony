<?php

namespace App\Entity;

use App\Repository\SalesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalesRepository::class)]
class Sales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nome = null;

    #[ORM\Column(length: 255)]
    private ?string $Endereco = null;

    #[ORM\Column(length: 255)]
    private ?string $pagamento = null;

    #[ORM\Column]
    private ?int $produtos_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->Nome;
    }

    public function setNome(string $Nome): static
    {
        $this->Nome = $Nome;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->Endereco;
    }

    public function setEndereco(string $Endereco): static
    {
        $this->Endereco = $Endereco;

        return $this;
    }

    public function getPagamento(): ?string
    {
        return $this->pagamento;
    }

    public function setPagamento(string $pagamento): static
    {
        $this->pagamento = $pagamento;

        return $this;
    }

    public function getProdutosId(): ?int
    {
        return $this->produtos_id;
    }

    public function setProdutosId(int $produtos_id): static
    {
        $this->produtos_id = $produtos_id;

        return $this;
    }
}

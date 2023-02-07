<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagsRepository::class)]
class Tags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stacks = null;

    #[ORM\ManyToMany(targetEntity: Projects::class, inversedBy: 'tags')]
    private Collection $project;

    public function __construct()
    {
        $this->project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStacks(): ?string
    {
        return $this->stacks;
    }

    public function setStacks(?string $stacks): self
    {
        $this->stacks = $stacks;

        return $this;
    }

    /**
     * @return Collection<int, Projects>
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(Projects $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project->add($project);
        }

        return $this;
    }

    public function removeProject(Projects $project): self
    {
        $this->project->removeElement($project);

        return $this;
    }
}

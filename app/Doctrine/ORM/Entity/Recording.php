<?php

declare(strict_types=1);

namespace App\Doctrine\ORM\Entity;

use ApiSkeletons\Doctrine\ORM\GraphQL\Attribute as GraphQL;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Recording
 */
#[GraphQL\Entity(typeName: 'recording', description: 'Performance recordings')]
class Recording
{
    #[GraphQL\Field(description: 'Source')]
    private string $source;

    #[GraphQL\Field(description: 'Primary key')]
    private int $id;

    #[GraphQL\Association(description: 'Performance entity')]
    private Performance $performance;

    /** @var mixed[]> */
    #[GraphQL\Association(description: 'Users')]
    private Collection $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Set source.
     */
    public function setSource(string $source): Recording
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source.
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Get id.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set performance.
     */
    public function setPerformance(Performance $performance): Recording
    {
        $this->performance = $performance;

        return $this;
    }

    /**
     * Get performance.
     */
    public function getPerformance(): Performance
    {
        return $this->performance;
    }

    /**
     * Add user.
     */
    public function addUser(User $user): Recording
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUser(User $user): bool
    {
        return $this->users->removeElement($user);
    }

    /**
     * Get users.
     *
     * @return mixed[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }
}

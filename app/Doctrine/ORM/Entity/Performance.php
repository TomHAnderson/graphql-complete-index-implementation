<?php

declare(strict_types=1);

namespace App\Doctrine\ORM\Entity;

use ApiSkeletons\Doctrine\ORM\GraphQL\Attribute as GraphQL;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Performance
 */
#[GraphQL\Entity(typeName: 'performance', description: 'Performances')]
class Performance
{
    #[GraphQL\Field(description: 'Venue name')]
    private string|null $venue = null;

    #[GraphQL\Field(description: 'City name')]
    private string|null $city = null;

    #[GraphQL\Field(description: 'State name')]
    private string|null $state = null;

    #[GraphQL\Field(description: 'Performance date', alias: 'date')]
    private DateTime $performanceDate;

    #[GraphQL\Field(description: 'Primary key')]
    private int $id;

    /** @var mixed[]]> */
    #[GraphQL\Association(description: 'Recordings by artist')]
    private Collection $recordings;

    #[GraphQL\Association(description: 'Artist entity')]
    private Artist $artist;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recordings = new ArrayCollection();
    }

    /**
     * Set venue.
     */
    public function setVenue(string|null $venue = null): Performance
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue.
     */
    public function getVenue(): string|null
    {
        return $this->venue;
    }

    /**
     * Set city.
     */
    public function setCity(string|null $city = null): Performance
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     */
    public function getCity(): string|null
    {
        return $this->city;
    }

    /**
     * Set state.
     */
    public function setState(string|null $state = null): Performance
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     */
    public function getState(): string|null
    {
        return $this->state;
    }

    /**
     * Set performanceDate.
     */
    public function setPerformanceDate(DateTime $performanceDate): Performance
    {
        $this->performanceDate = $performanceDate;

        return $this;
    }

    /**
     * Get performanceDate.
     */
    public function getPerformanceDate(): DateTime
    {
        return $this->performanceDate;
    }

    /**
     * Get id.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Add recording.
     */
    public function addRecording(Recording $recording): Performance
    {
        $this->recordings[] = $recording;

        return $this;
    }

    /**
     * Add recordings.
     *
     * @param Collection<int, Recording> $recordings
     */
    public function addRecordings(Collection $recordings): self
    {
        foreach ($recordings as $recording) {
            $recording->setPerformance($this);
            $this->addRecording($recording);
        }

        return $this;
    }

    /**
     * Remove recording.
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRecording(Recording $recording): bool
    {
        return $this->recordings->removeElement($recording);
    }

    /**
     * Remove recordings.
     *
     * @param Collection<int, Recording> $recordings
     */
    public function removeRecordings(Collection $recordings): self
    {
        foreach ($recordings as $recording) {
            $this->removeRecording($recording);
        }

        return $this;
    }

    /**
     * Get recordings.
     *
     * @return mixed[]
     */
    public function getRecordings(): Collection
    {
        return $this->recordings;
    }

    /**
     * Set artist.
     */
    public function setArtist(Artist $artist): Performance
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist.
     */
    public function getArtist(): Artist
    {
        return $this->artist;
    }
}

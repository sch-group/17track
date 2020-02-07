<?php


namespace SchGroup\SeventeenTrack\Components;


class TrackEvent
{

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $location;

    /**
     * TrackEvent constructor.
     * @param string $date
     * @param string $content
     * @param string $location
     */
    public function __construct(string $date, string $content, string $location)
    {
        $this->date = $date;
        $this->content = $content;
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

}
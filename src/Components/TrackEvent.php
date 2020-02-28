<?php


namespace SchGroup\SeventeenTrack\Components;


class TrackEvent
{

    const NOT_FOUND_CODE = 0;

    const IN_TRANSIT_CODE = 10;

    const ALERT_CODE = 20;

    CONST PICKUP_CODE = 30;

    const UNDELIVERED_CODE = 35;

    const DELIVERED_CODE = 40;

    const EXPIRED_CODE = 50;

    const STATUS_CODES = [
        self::NOT_FOUND_CODE => 'Not found',
        self::IN_TRANSIT_CODE => 'In transit',
        self::ALERT_CODE => 'Alert',
        self::PICKUP_CODE => 'Pick up',
        self::UNDELIVERED_CODE => 'Undelivered',
        self::DELIVERED_CODE => 'Delivered',
        self::EXPIRED_CODE => 'Expired'
    ];

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
     * @var int
     */
    private $currentStatusCode;

    /**
     * TrackEvent constructor.
     * @param string $date
     * @param string $content
     * @param string $location
     * @param int|null $currentStatusCode
     */
    public function __construct(string $date, string $content, string $location, int $currentStatusCode = null)
    {
        $this->date = $date;
        $this->content = $content;
        $this->location = $location;
        $this->currentStatusCode = $currentStatusCode;
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

    /**
     * @return int
     */
    public function getCurrentStatusCode(): ?int
    {
        return $this->currentStatusCode;
    }

    /**
     * @return string
     */
    public function getCurrentStatusName(): string
    {
        return self::STATUS_CODES[$this->currentStatusCode] ?? '';
    }

}
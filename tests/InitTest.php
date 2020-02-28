<?php


namespace SchGroup\SeventeenTrack\Tests;

use Matomo\Ini\IniReader;
use PHPUnit\Framework\TestCase;
use SchGroup\SeventeenTrack\Components\TrackEvent;
use SchGroup\SeventeenTrack\Connectors\TrackingConnector;
use SchGroup\SeventeenTrack\Exceptions\SeventeenTrackMethodCallException;

class InitTest extends TestCase
{
    /**
     * @var string
     */
    protected $trackNumber;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var TrackingConnector $trackingConnector
     */
    protected $trackingConnector;

    /**
     * InitTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     * @throws \Matomo\Ini\IniReadingException
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $reader = new IniReader();
        $this->config = $reader->readFile(__DIR__ . '/config.ini');
        $this->trackingConnector = new TrackingConnector($this->config['api_key']);
        $this->trackNumber = $this->config['track_number'];
    }

    /**
     * @test
     * @expectedException \SchGroup\SeventeenTrack\Exceptions\SeventeenTrackMethodCallException
     * @throws \Exception
     */
    public function it_fails_on_register_track()
    {
        $trackNumber = $this->generateRandomString();
        $this->trackingConnector->register($trackNumber);
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10): string
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    /**
     * @test
     */
    public function it_successfully_registers_track()
    {
//        $this->assertTrue($this->trackingConnector->register($this->trackNumber));
    }

    /**
     * @test
     * @throws SeventeenTrackMethodCallException
     */
    public function it_gets_track_info()
    {
        $trackInfo = $this->trackingConnector->getTrackInfo($this->trackNumber);
        $this->assertNotEmpty($trackInfo);
        $this->assertEquals($this->trackNumber, $trackInfo['number']);
    }

    /**
     * @test
     * @throws SeventeenTrackMethodCallException
     */
    public function it_gets_pure_info()
    {
        $trackInfo = $this->trackingConnector->getPureTrackInfo($this->trackNumber);
        $this->assertInstanceOf(TrackEvent::class, $trackInfo[0]);
        /* @var TrackEvent $firstTrackEvent */
        $firstTrackEvent = $trackInfo[0];

        $this->assertNotEmpty($firstTrackEvent->getContent());
        $this->assertNotEmpty($firstTrackEvent->getDate());

    }

    /**
     * @test
     * @throws SeventeenTrackMethodCallException
     */
    public function it_gets_last_status()
    {
        $trackEvent = $this->trackingConnector->getLastTrackEvent($this->trackNumber);
        $this->assertTrue($trackEvent->getCurrentStatusCode() == TrackEvent::DELIVERED_CODE);
        $this->assertInstanceOf(TrackEvent::class, $trackEvent);
        $this->assertNotEmpty($trackEvent->getContent());
    }

    /**
     * @test
     * @throws SeventeenTrackMethodCallException
     */
    public function it_gets_multi_pure_array_of_last_statuses_with_many_tracks()
    {
        $trackNumbers = [$this->config['track_number'], $this->config['second_track_number']];
        $lastTrackNumbersEvents = $this->trackingConnector->getLastTrackEventMulti($trackNumbers);
        $this->assertNotEmpty($lastTrackNumbersEvents);
        $firstTrackNumberEvent = $lastTrackNumbersEvents[$trackNumbers[0]];
        $this->assertInstanceOf(TrackEvent::class, $firstTrackNumberEvent);
        $this->assertNotEmpty($firstTrackNumberEvent->getContent());
        /** @var TrackEvent $secondTrackNumberEvent */
        $secondTrackNumberEvent = $lastTrackNumbersEvents[$trackNumbers[1]];
        $this->assertTrue(is_int($secondTrackNumberEvent->getCurrentStatusCode()));
    }

    /**
     * @test
     * @expectedException \SchGroup\SeventeenTrack\Exceptions\SeventeenTrackMethodCallException
     */
    public function it_fails_change_carrier()
    {
        $newCarrierId = 100;
        $this->trackingConnector->changeCarrier($this->trackNumber, $newCarrierId);
        $this->expectException(SeventeenTrackMethodCallException::class);
    }

    /**
     * @test
     */
    public function it_successfully_stop_and_re_track()
    {
//        $isReTracked = $this->trackingConnector->reTrack($this->trackNumber);
//        $this->assertTrue($isReTracked);
//        $isStopped = $this->trackingConnector->stopTracking($this->trackNumber);
//        $this->assertTrue($isStopped);
    }
    /**
     * @test
     * @expectedException \SchGroup\SeventeenTrack\Exceptions\SeventeenTrackMethodCallException
     */
    public function it_fails_re_track()
    {
        $isReTracked = $this->trackingConnector->reTrack($this->generateRandomString(10));
        $this->expectException(SeventeenTrackMethodCallException::class);
    }

    /**
     * @test
     * @expectedException \SchGroup\SeventeenTrack\Exceptions\SeventeenTrackMethodCallException
     */
    public function it_fails_stop_track()
    {
        $isStopped = $this->trackingConnector->stopTracking($this->generateRandomString(10));
        $this->expectException(SeventeenTrackMethodCallException::class);
    }
}
<?php

namespace SchGroup\SeventeenTrack\Contracts;

use SchGroup\SeventeenTrack\Components\TrackEvent;

interface ShipmentTracker
{
    public function register(string $trackNumber): bool;

    public function getTrackInfo(string $trackNumber, int $carrier = null): array;

    public function getPureTrackInfo(string $trackNumber, int $carrier = null): array;

    public function getLastTrackEvent(string $trackNumber, int $carrier = null): TrackEvent;

    public function getLastTrackEventMulti(array $trackNumbers): array;

    public function changeCarrier(string $trackNumber, int $carrierNew, int $carrierOld = null): bool;

    public function stopTracking(string $trackNumber, int $carrier = null): bool;

    public function reTrack(string $trackNumber, int $carrier = null): bool;

    public function getTrackInfoMulti(array $trackNumbers): array;

    public function registerMulti(array $trackNumbers): array;

    public function stopTrackingMulti(array $trackNumbers): array;

    public function changeCarrierMulti(array $trackNumbers): array;

    public function reTrackMulti(array $trackNumbers): array;

}
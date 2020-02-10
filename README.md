SeventeenTrack 17track API CONNECTOR


```bash
composer require sch-group/17track
```


```
$apiKey = ''; // your api key

$trackNumber = ''; // Your track number

$trackingConnector = new TrackingConnector($apiKey);

$isReggiestered = $trackingConnector->register($trackNumber);

$isStopped = $trackingConnector->stopTracking($trackNumber);

$isRetracked = $trackingConnector->reTrack($trackNumber);

$isChanged = $trackingConnector->changeCarrier($trackNumber, $newCarrierId);

```
Retrieve last status 

```
$trackEvent = $trackingConnector->getLastTrackEvent($trackNumber);
```

Retrieve tracknumber history 

```
$trackHistory = $trackingConnector->getPureTrackInfo($trackNumber);
```

Retrieve many tracknumber's last statuses

```
$trackNumbers = [$trackNumberFirst, $trackNumberSecond];

$lastTrackNumbersEvents = $trackingConnector->getLastTrackEventMulti($trackNumbers);

```
Retrieve many tracknumber's histories
```
$trackNumbers = [[
     'number' => $trackNumber,
     'carrier' => $carrier
  ],
  [
     'number' => $trackNumberSecond,
     'carrier' => null
]];
 
$trackNumbersHistories =  $trackingConnector->getTrackInfoMulti($trackNumbers);
```
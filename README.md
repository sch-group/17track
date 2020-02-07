WELDPAY PAYMENT SYSTEM

@ainurecm telegram

```bash
composer require sch-group/weldpay
```
Create transaction 
```
        $weldPayConfig = new WeldPayConfig($config['host'], $config['client_id'], $config['client_secret']);
        $client = new WeldPayConnector($weldPayConfig);
        $orderNumber = "order_number: 123456";

        $address = new Address(
            "20132",
            "Milano",
            "MI",
            "via Roma, 18A"
        );
        $shippingAddress = new Address();
        $buyer = new Buyer(
            "Mario",
            "Rossi",
            "mario.rossi@email.it",
            $address,
            $shippingAddress
        );
        $numberOfPackages = 2;
        $item1 = new Item("Product 1", 70);
        $item2 = new Item("Product 2", 10.53);
        $items = [$item1, $item2];
        $deliveryItem = new Item("Delivery", 6.4);
        $deliveryItems = [$deliveryItem];
        $successUrl = "https://ecommerce.test.it?success=181024174141&token=e685801c-76cc-45d1-8a75-285dadde";
        $failUrl = "https://ecommerce.test.it?fail=181024174141&token=e685801c-76cc-45d1-8a75-285dadde";
        $callbackUrl = "https://ecommerce.test.it?paymentConfirmed=181024174141&token=e685801c-76cc-45d1-8a75-285d";

        $transaction = new Transaction(
            "es",
            $orderNumber,
            $buyer,
            $numberOfPackages,
            $items,
            $deliveryItems,
            $successUrl,
            $failUrl,
            $callbackUrl
        );

        $client->generateTransactionUrl($transaction);

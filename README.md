# Laravel - Billable

This a personal project to can accept a variety of payments methods and based on currency
``If u have some recommendations, please do.``

## ORDER

```php
//Return the Order cached and ready to use
$order = Order::get('9b3731fd-290d-4fbd-ab99-3d675080c37f');

// This can use it to set as api response
$order->toResource();
```

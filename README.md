# Laravel - Billable

**Laravel - Billable** is a project to can accept a variety of payments methods and based on currency
``If u have some recommendations, please do.``

* **Author**: MCris112
* **Vendor**: mcris112
* **Package**: laravel-billable
* **Version**: `1.x`
* **PHP Version**: 8.1+
* **Laravel Version**: `10.x`

### Payment Supports
* MercadoPago
* Paypal


## Installation

Install the package with the command
**[Composer](https://getcomposer.org/):** 
```php
composer require mcris112/laravel-billable
```
## Usage

### ORDER

```php
//Return the Order cached and ready to use
$order = Order::get('9b3731fd-290d-4fbd-ab99-3d675080c37f');

// This can use it to set as api response
$order->toResource();
```
## Contributing

## License


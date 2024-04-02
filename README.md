# Laravel - Billable

**Laravel - Billable** is a project to can accept a variety of payments methods and based on currency
``If u have some recommendations, please do.``

* **Author**: MCris112
* **Vendor**: mcris112
* **Package**: laravel-billable
* **Version**: `1.x`
* **PHP Version**: 8.1+
* **Laravel Version**: `10.x`

# Table of Contents
1. [Installation](#Installation)
2. [Usage](#usage)
   1. [Order](#order)
      1. [Get](#orderget)
      2. [Get](#orderget-a-nameorder-geta)
      3. [Create](#ordercreate)
      4. [Item](#orderitem)
      5. [toResource()](#order-toresource)

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

```php
//Return the Order cached and ready to use
$order = Order::get('9b3731fd-290d-4fbd-ab99-3d675080c37f');

// This can use it to set as api response
$order->toResource();
```

### ORDER
`Order::class` is a Model from laravel but with some additional functions, and It's used for creating Orders or use it into payment processing

#### Functions
##### Order::get()
This static method is called when u want to retrieve the Order
```php
$order = Order::get('9b3731fd-290d-4fbd-ab99-3d675080c37f');
```

Why do I have to use `Order::get($id)` instead of `Order::whereId($id)->get()` if It's a laravel model class?

Internally this method uses `whereId()` but this is returned as cached from DB

```php
/**
* Return the Order cached forever
* @param string $id
* @return self
* @throws OrderNotFoundException
*/
public static function get(string $id): self
{
    ...
}
```

##### Order::create()
##### Order::Item()
##### $order->toResource()

#### Relations
##### Items
##### User
##### Statuses

## Contributing

## License


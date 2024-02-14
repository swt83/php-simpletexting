# SimpleTexting

A PHP package for working w/ the SimpleTexting API.

## Install

Normal install via Composer.

## Usage

```php
use Travis\SimpleTexting;

$apikey = 'yourapikey';
$response = SimpleTexting::run($apikey, 'post', 'contacts', [
    'upsert' => true,
    'listsReplacement' => false,
    'contactPhone' => 123456789,
    'firstName' => 'John',
    'lastName' => 'Doe',
    'customFields' => [
        'city' => 'Austin',
        'state' => 'TX',
        'zip' => 77777
    ],
    'listIds' => [
        'yourlistid1',
        'yourlistid2',
    ],
]);
```

The response will look like this:

```
stdClass Object
(
    [id] => yourcontactid? // not sure what this id represents, maybe an id of the request you made
)
```

See the [documentation](https://simpletexting.com/api/docs/v2/#section/Authentication) for more information.
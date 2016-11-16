#jnjxp.http-csv

Use [HTTPlug](http://httplug.io/) to create an instance of
[Leage\Csv](http://csv.thephpleague.com/) from a remote csv file.
eg. Google Spreadsheet.

## Install
```shell
composer require jnjxp/http-csv
```

## Usage
```php
use Jnjxp\HttpCsv\Reader;

$csv = (new Reader)->fromUri($uri);
```


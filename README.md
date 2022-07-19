# Nova Apex Chart

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lonnyx/nova-apex-chart)](https://packagist.org/packages/lonnyx/nova-apex-chart)
[![Total Downloads](https://img.shields.io/packagist/dt/lonnyx/nova-apex-chart)](https://packagist.org/packages/lonnyx/nova-apex-chart)
[![License](https://img.shields.io/packagist/l/lonnyx/nova-apex-chart)](https://github.com/lonnyx/nova-apex-chart/blob/master/LICENSE)

A Laravel Nova ApexCharts Component

This package is a fork of `dcasia/nova-apex-chart`, compatible with Nova 4 and with date filter

[ApexCharts Documentation](https://apexcharts.com/docs/series/#)

![LineCharts in Action](https://raw.githubusercontent.com/lonnyx/nova-apex-chart/master/screenshot1.png)
![LineCharts DateFilter](https://raw.githubusercontent.com/lonnyx/nova-apex-chart/master/screenshot2.png)

# Installation

You can install the package via composer:

```
composer require lonnyx/nova-apex-chart
```

## Basic Usage

```php
class ExampleNovaResource extends Resource
{

    public function cards(Request $request)
        {

            return [
                (new NovaApexChart())
                    ->type('bar')
                    ->series(
                        [
                            new DataOnlySeries([ 400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380 ])
                        ])
                    ->options([
                        'xaxis' => [
                            'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                        ],
                        'tooltip' => [
                            'y' => [
                                'formatter' => new BasicFormatter('$', 'USD')
                            ]
                        ]
                    ])
            ];
        }

}
```

Create basic series by calling
```php
use LonnyX\NovaApexChart\BasicSeries;
new BasicSeries('title', [ 400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380 ]);
```

Create data only series by calling
```php
use LonnyX\NovaApexChart\DataOnlySeries;
new DataOnlySeries([ 400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380 ]);
```

Create custom formatter
```php
use LonnyX\NovaApexChart\formatter\BasicFormatter;
new BasicFormatter('$', 'USD');
```

Show comma separated numbers
```php
use LonnyX\NovaApexChart\formatter\BasicFormatter;
new BasicFormatter('', '', true);
```

## License

The MIT License (MIT). Please see [License File](https://raw.githubusercontent.com/lonnyx/nova-apex-chart/master/LICENSE) for more information.

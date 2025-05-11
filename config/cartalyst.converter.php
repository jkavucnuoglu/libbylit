<?php

/*
 * Part of the Converter package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Converter
 * @version    9.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2024, Cartalyst LLC
 * @link       https://cartalyst.com
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Measurements
    |--------------------------------------------------------------------------
    |
    | The available measurements to convert and format units.
    |
    */

    'measurements' => [
        /*
        |--------------------------------------------------------------------------
        | Currency
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format currencies.
        |
        */

        'currency' => [
            'usd' => [
                'format' => '$1,0.00',
            ],

            'eur' => [
                'format' => '&euro;1,0.00',
            ],

            'gbp' => [
                'format' => '&pound;1,0.00',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Length
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format lengths.
        |
        */

        'dimensions' => [
            'km' => [
                'format' => '1,0.000 km',
                'unit'   => 0.001,
            ],

            'mi' => [
                'format' => '1,0.000 mi.',
                'unit'   => 0.000621371,
            ],

            'm' => [
                'format' => '1,0.000 m',
                'unit'   => 1.00,
            ],

            'cm' => [
                'format' => '1!0 cm',
                'unit'   => 100,
            ],

            'mm' => [
                'format' => '1,0.00 mm',
                'unit'   => 1000,
            ],

            'ft' => [
                'format' => '1,0.00 ft.',
                'unit'   => 3.28084,
            ],

            'in' => [
                'format' => '1,0.00 in.',
                'unit'   => 39.3701,
            ],
        ],

        /*
         * |--------------------------------------------------------------------------
         * | Quantity
         * |--------------------------------------------------------------------------
         * |
         * | The available measurements to convert and format quantities.
         */
        'quantity' => [
            'piece' => [
                'format' => '1,0.00 pcs',
                'unit'   => 1.00,
            ],

            'dozen' => [
                'format' => '1,0.00 doz',
                'unit'   => 0.0833333,
            ],

            'gross' => [
                'format' => '1,0.00 grs',
                'unit'   => 0.00833333,
            ],
            'score' => [
                'format' => '1,0.00 sc',
                'unit'   => 0.0166667,
            ],
            'hundred' => [
                'format' => '1,0.00 c',
                'unit'   => 0.01,
            ],
        ],
        /*
        |--------------------------------------------------------------------------
        | Weight
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format weights.
        |
        */

        'weight' => [
            'kg' => [
                'format' => '1,0.00 kg',
                'unit'   => 1.00,
            ],

            'g' => [
                'format' => '1,0.00 g',
                'unit'   => 1000.00,
            ],
            'milligram' => [
                'format' => '1,0.00 mg',
                'unit'   => 1000000,
            ],
            'microgram' => [
                'format' => '1,0.00 µg',
                'unit'   => 1000000000,
            ],
            'oz' => [
                'format' => '1,0.00 oz.',
                'unit'   => 35.274,
            ],
            'lb' => [
                'format' => '1,0.00 lb.',
                'unit'   => 2.20462,
            ],
            'st' => [
                'format' => '1,0.00 st.',
                'unit'   => 0.157473,
            ],
            'ton' => [
                'format' => '1,0.00 ton',
                'unit'   => 0.001,
            ],
            'stone' => [
                'format' => '1,0.00 st.',
                'unit'   => 0.157473,
            ],
            'pound' => [
                'format' => '1,0.00 lb.',
                'unit'   => 2.20462,
            ],
            'ounce' => [
                'format' => '1,0.00 oz.',
                'unit'   => 35.274,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Volume
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format volumes.
        |
        */

        'volume' => [
            'l' => [
                'format' => '1,0.00 l',
                'unit'   => 1.00,
            ],
            'ml' => [
                'format' => '1,0.00 ml',
                'unit'   => 1000.00,
            ],
            'cl' => [
                'format' => '1,0.00 cl',
                'unit'   => 100.00,
            ],
            'fl_oz' => [
                'format' => '1,0.00 fl. oz.',
                'unit'   => 33.814,
            ],
            'cup' => [
                'format' => '1,0.00 cup',
                'unit'   => 4.22675,
            ],
            'pint' => [
                'format' => '1,0.00 pt.',
                'unit'   => 2.11338,
            ],
            'quart' => [
                'format' => '1,0.00 qt.',
                'unit'   => 1.05669,
            ],
            'gallon' => [
                'format' => '1,0.00 gal.',
                'unit'   => 0.264172,
            ],
            'barrel' => [
                'format' => '1,0.00 bbl',
                'unit'   => 0.00628981,
            ],
            'cubic_meter' => [
                'format' => '1,0.00 m³',
                'unit'   => 0.001,
            ],
            'cubic_centimeter' => [
                'format' => '1,0.00 cm³',
                'unit'   => 1000000,
            ],
            'cubic_inch' => [
                'format' => '1,0.00 in³',
                'unit'   => 61023.7,
            ],
            'cubic_foot' => [
                'format' => '1,0.00 ft³',
                'unit'   => 35.3147,
            ],
            'cubic_yard' => [
                'format' => '1,0.00 yd³',
                'unit'   => 1.30795,
            ],
            'teaspoon' => [
                'format' => '1,0.00 tsp',
                'unit'   => 202.884,
            ],
            'tablespoon' => [
                'format' => '1,0.00 tbsp',
                'unit'   => 67.628,
            ],
            'fluid_ounce' => [
                'format' => '1,0.00 fl. oz.',
                'unit'   => 33.814,
            ],
            'liter' => [
                'format' => '1,0.00 l',
                'unit'   => 1.00,
            ],
            'milliliter' => [
                'format' => '1,0.00 ml',
                'unit'   => 1000.00,
            ],
            'deciliter' => [
                'format' => '1,0.00 dl',
                'unit'   => 10.00,
            ],
            'centiliter' => [
                'format' => '1,0.00 cl',
                'unit'   => 100.00,
            ],
            'hectoliter' => [
                'format' => '1,0.00 hl',
                'unit'   => 0.01,
            ],
            'kiloliter' => [
                'format' => '1,0.00 kl',
                'unit'   => 0.001,
            ],
            'gallon_uk' => [
                'format' => '1,0.00 gal.',
                'unit'   => 0.219969,
            ],
            'imperial_gallon' => [
                'format' => '1,0.00 gal.',
                'unit'   => 0.219969,
            ],
            'imperial_pint' => [
                'format' => '1,0.00 pt.',
                'unit'   => 1.75975,
            ],
            'imperial_quart' => [
                'format' => '1,0.00 qt.',
                'unit'   => 0.879876,
            ],
            'imperial_fluid_ounce' => [
                'format' => '1,0.00 fl. oz.',
                'unit'   => 35.1951,
            ],
            'imperial_tablespoon' => [
                'format' => '1,0.00 tbsp',
                'unit'   => 67.628,
            ],
            'imperial_teaspoon' => [
                'format' => '1,0.00 tsp',
                'unit'   => 202.884,
            ],
            'fluid_dram' => [
                'format' => '1,0.00 fl. dr.',
                'unit'   => 256,
            ],
            'fluid_scruple' => [
                'format' => '1,0.00 fl. scruple',
                'unit'   => 576,
            ],
            'fluid_minim' => [
                'format' => '1,0.00 fl. min.',
                'unit'   => 60000,
            ],
            'fluid_dram_uk' => [
                'format' => '1,0.00 fl. dr.',
                'unit'   => 256,
            ],
            'fluid_scruple_uk' => [
                'format' => '1,0.00 fl. scruple',
                'unit'   => 576,
            ],
            'fluid_minim_uk' => [
                'format' => '1,0.00 fl. min.',
                'unit'   => 60000,
            ],
            'fluid_dram_us' => [
                'format' => '1,0.00 fl. dr.',
                'unit'   => 256,
            ],
            'fluid_scruple_us' => [
                'format' => '1,0.00 fl. scruple',
                'unit'   => 576,
            ],
            'fluid_minim_us' => [
                'format' => '1,0.00 fl. min.',
                'unit'   => 60000,
            ],
            'fluid_ounce_us' => [
                'format' => '1,0.00 fl. oz.',
                'unit'   => 33.814,
            ],
            'fluid_ounce_uk' => [
                'format' => '1,0.00 fl. oz.',
                'unit'   => 35.1951,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Temperature
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format temperatures.
        |
        */

        'temperature' => [
            'c' => [
                'format' => '1,0.00 C',
                'unit'   => 1.00,
            ],

            'f' => [
                'format' => '1,0.00 °F',
                'unit'   => 1.80,
                'offset' => 32,
            ],

            'k' => [
                'format' => '1,0.00 K',
                'unit'   => 1.00,
                'offset' => 273.15,
            ],

            'rankine' => [
                'format' => '1,0.00 °R',
                'unit'   => 1.80,
                'offset' => 491.67,
            ],

            'romer' => [
                'format' => '1,0.00 °Rø',
                'unit'   => 0.525,
                'offset' => 7.5,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency Cache Expiration Duration
    |--------------------------------------------------------------------------
    |
    | The duration currency rates are cached in minutes.
    |
    */

    'expires' => 60,

    /*
    |--------------------------------------------------------------------------
    | Currency Service Exchangers
    |--------------------------------------------------------------------------
    |
    | Here, you may specify any number of service exchangers configurations
    | your application requires.
    |
    */

    'exchangers' => [
        /*
        |--------------------------------------------------------------------------
        | Default Exchanger
        |--------------------------------------------------------------------------
        |
        | Define here the default exchanger.
        |
        */

        'default' => 'native',

        /*
        |--------------------------------------------------------------------------
        | OpenExchangeRates.org
        |--------------------------------------------------------------------------
        |
        | Define here the OpenExchangeRates.org app id.
        |
        */

        'openexchangerates' => [
            'app_id' => null,
        ],
    ],
];

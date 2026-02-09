<?php

return [
    'BRL' => ['symbol' => 'R$', 'precision' => 2, 'decimal' => ',', 'thousand' => '.'],
    'USD' => ['symbol' => '$',  'precision' => 2, 'decimal' => '.', 'thousand' => ','],
    'EUR' => ['symbol' => '€',  'precision' => 2, 'decimal' => ',', 'thousand' => '.'], 
    'GBP' => ['symbol' => '£',  'precision' => 2, 'decimal' => '.', 'thousand' => ','],
    
    // Atenção nestes aqui (Sem decimais):
    'JPY' => ['symbol' => '¥',  'precision' => 0, 'decimal' => '',  'thousand' => ','],
    'KRW' => ['symbol' => '₩',  'precision' => 0, 'decimal' => '',  'thousand' => ','],
    'CLP' => ['symbol' => '$',  'precision' => 0, 'decimal' => '',  'thousand' => '.'],
    'PYG' => ['symbol' => '₲',  'precision' => 0, 'decimal' => '',  'thousand' => '.'],
];
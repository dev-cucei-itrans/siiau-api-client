<?php

use PhpCsFixer\{Config, Finder};

return (new Config())
    ->setFinder(Finder::create()
        ->in(__DIR__)
        ->name('*.php')
        ->ignoreDotFiles(true)
        ->exclude(['vendor'])
    )
    ->setRules([
        '@PER-CS2.0' => true,
    ]);

<?php

use PhpCsFixer\{Config, Finder};

return (new Config())
    ->setFinder(
        Finder::create()
            ->in(__DIR__)
            ->name('*.php')
            ->ignoreDotFiles(true)
            ->exclude(['vendor'])
    )
    ->setRules([
        '@PER-CS2.0' => true,
        'single_import_per_statement' => false,
        'class_reference_name_casing' => true,
        'integer_literal_case' => true,
        'magic_constant_casing' => true,
        'native_type_declaration_casing' => true,
        'native_function_casing' => true,
        'magic_method_casing' => true,
        'cast_spaces' => true,
        'no_short_bool_cast' => true,
        'no_unset_cast' => true,
        'lambda_not_used_import' => true,
        'group_import' => true,
    ]);

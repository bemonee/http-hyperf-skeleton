<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->exclude('runtime')
    ->exclude('bin')
    ->exclude('vendor')
    ->in(__DIR__);

return (new PhpCsFixer\Config)->setRules([
        '@PSR2' => true,
        'blank_line_after_opening_tag' => true,
        'compact_nullable_typehint' => true,
        'declare_equal_normalize' => ['space' => 'none'],
        'function_typehint_space' => true,
        'new_with_braces' => true,
        'no_empty_statement' => true,
        'no_unused_imports' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'return_type_declaration' => ['space_before' => 'none'],
        'single_trait_insert_per_statement' => true,
        'no_empty_phpdoc' => true,
        'single_blank_line_before_namespace' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sortAlgorithm' => 'length'],

        'class_attributes_separation' => [
            'elements' => [
                'const',
                'method',
                'property',
            ]
        ],

        'blank_line_before_statement' => [
            'statements' => [
                'return',
            ]
        ],
    ])
    ->setFinder($finder);

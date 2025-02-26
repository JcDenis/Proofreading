<?php
/**
 * @file
 * @brief       The plugin Proofreading definition
 * @ingroup     Proofreading
 *
 * @defgroup    Proofreading Plugin Proofreading.
 *
 * Add status for your posts.
 *
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-3.0
 */
declare(strict_types=1);

$this->registerModule(
    'Proofreading',
    'Add proofreading statuses for your posts',
    'Jean-Christian Denis and Contributors',
    '0.5',
    [
        'requires'    => [['core', '2.33']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'support'     => 'https://github.com/JcDenis/' . $this->id . '/issues',
        'details'     => 'https://github.com/JcDenis/' . $this->id . '/src/branch/master/README.md',
        'repository'  => 'https://github.com/JcDenis/' . $this->id . '/raw/branch/master/dcstore.xml',
    ]
);

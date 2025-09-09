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
    '0.6',
    [
        'requires'    => [['core', '2.36']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'support'     => 'https://github.com/JcDenis/' . $this->id . '/issues',
        'details'     => 'https://github.com/JcDenis/' . $this->id . '/',
        'repository'  => 'https://raw.githubusercontent.com/JcDenis/' . $this->id . '/master/dcstore.xml',
        'date'        => '2025-09-09T16:42:59+00:00',
    ]
);

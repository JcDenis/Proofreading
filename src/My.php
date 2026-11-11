<?php
/**
 * @package     Dotclear
 *
 * @copyright   Olivier Meunier & Association Dotclear
 * @copyright   AGPL-3.0
 */
declare(strict_types=1);

namespace Dotclear\Plugin\Proofreading;

use Dotclear\App;
use Dotclear\Module\MyPlugin;

/**
 * @brief       The module helper.
 * @ingroup     Proofreading
 *
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-3.0
 */
class My extends MyPlugin
{
    public const POST_READY            = -111;
    public const POST_PROOFREAD        = -112;
    public const POST_DRAFT            = -113;

    /**
     * Get the URL of a status icon.
     *
     * A status is declared on every page load, but backend URLs do not exist
     * in some backend contexts (installation, upgrade, command line): no icon there.
     *
     * @param   string  $resource   The icon path in module
     */
    public static function statusIcon(string $resource): string
    {
        if (App::task()->checkContext('BACKEND') && !App::backend()->url()->dumpUrls()->offsetExists('load.plugin.file')) {
            return '';
        }

        return self::fileURL($resource);
    }
}

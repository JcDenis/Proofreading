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
    public const PERMISSION_SUBSCRIBER = 'subscriber';
    public const POST_SUBSCRIBED       = -110;
    public const POST_READY            = -111;
    public const POST_PROOFREAD        = -112;
    public const POST_DRAFT            = -113;
}

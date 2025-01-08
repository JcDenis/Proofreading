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
    public const POST_READY     = -100;
    public const POST_PROOFREAD = -110;
    public const POST_DRAFT     = -120;
}

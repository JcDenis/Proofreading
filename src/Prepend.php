<?php
declare(strict_types=1);

namespace Dotclear\Plugin\Proofreading;

use ArrayObject;
use Dotclear\App;
use Dotclear\Core\PostType;
use Dotclear\Helper\Process\TraitProcess;
use Dotclear\Helper\Stack\Status;

/**
 * @brief       The module prepend process.
 * @ingroup     Proofreading
 *
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-3.0
 */
class Prepend
{
    use TraitProcess;

    public static function init(): bool
    {
        return self::status(My::checkContext(My::PREPEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        // Add post status
        return
            // Add "Draft" post status, used on backend only.
            App::status()->post()->set(
                (new Status(My::POST_DRAFT , My::id() . 'draft', 'Draft', 'Draft (>1)', My::fileURL('img/draft.svg'))),
            )
            // Add "To proofread" post status, used on backend only.
             && App::status()->post()->set(
                (new Status(My::POST_PROOFREAD , My::id() . 'proofread', 'To proofread', 'To proofread (>1)', My::fileURL('img/proofread.svg'))),
            )
            // Add "Fulfilled" post status, used on backend only.
             && App::status()->post()->set(
                (new Status(My::POST_READY , My::id() . 'ready', 'Fulfilled', 'Fulfilled (>1)', My::fileURL('img/ready.svg'))),
            );
    }
}

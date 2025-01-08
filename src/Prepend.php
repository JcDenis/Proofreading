<?php
declare(strict_types=1);

namespace Dotclear\Plugin\Proofreading;

use Dotclear\App;
use Dotclear\Core\PostType;
use Dotclear\Core\Process;
use Dotclear\Helper\Stack\Status;

/**
 * @brief       The module prepend process.
 * @ingroup     Proofreading
 *
 * @author      Jean-Christian Denis (latest)
 * @copyright   GPL-3.0
 */
class Prepend extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::PREPEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        return 
            App::status()->post()->set(
                (new Status(My::POST_DRAFT , My::id() . 'draft', 'Draft', 'Draft (>1)', My::fileURL('img/draft.svg'))),
            )
             && App::status()->post()->set(
                (new Status(My::POST_REVIEW , My::id() . 'toproofread', 'To proofread', 'To proofread (>1)', My::fileURL('img/toproofread.svg'))),
            )
             && App::status()->post()->set(
                (new Status(My::POST_READY , My::id() . 'fulfiled', 'Fulfilled', 'Fulfilled (>1)', My::fileURL('img/fulfilled.svg'))),
            );

    }
}

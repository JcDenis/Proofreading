<?php

declare(strict_types=1);

namespace Dotclear\Plugin\Proofreading;

use ArrayObject;
use Dotclear\App;
use Dotclear\Helper\Process\TraitProcess;

/**
 * @brief       Proofreading frontend class.
 * @ingroup     Proofreading
 *
 * Nothing on the public side, except the statuses given to the plugin ClaudetteMcp:
 * an AI assistant connected to the blog lists and sets them with its entries tools
 * (list_posts, set_post_status). ClaudetteMcp is not required by Proofreading.
 *
 * @author      Jean-Christian Denis
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Frontend
{
    use TraitProcess;

    public static function init(): bool
    {
        return self::status(My::checkContext(My::FRONTEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        // Statuses for AI assistants connected to the blog with the plugin ClaudetteMcp
        App::behavior()->addBehavior('ClaudetteMcpAddPostStatus', function (ArrayObject $statuses): void {
            $statuses['draft']        = My::POST_DRAFT;
            $statuses['to_proofread'] = My::POST_PROOFREAD;
            $statuses['proofread']    = My::POST_READY;
        });

        return true;
    }
}

<?php
declare(strict_types=1);

namespace Dotclear\Plugin\Proofreading;

use ArrayObject;
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

        // subscirber permission
        App::auth()->setPermissionType(My::PERMISSION_SUBSCRIBER, __('Posts subscriber'));

        // posts status
        $status = 
            App::status()->post()->set(
                (new Status(My::POST_DRAFT , My::id() . 'draft', 'Draft', 'Draft (>1)', My::fileURL('img/draft.svg'))),
            )
             && App::status()->post()->set(
                (new Status(My::POST_PROOFREAD , My::id() . 'proofread', 'To proofread', 'To proofread (>1)', My::fileURL('img/proofread.svg'))),
            )
             && App::status()->post()->set(
                (new Status(My::POST_READY , My::id() . 'ready', 'Fulfilled', 'Fulfilled (>1)', My::fileURL('img/ready.svg'))),
            )
             && App::status()->post()->set(
                (new Status(My::POST_SUBSCRIBED , My::id() . 'subscriber', 'Subscription', 'Subscription (>1)', My::fileURL('img/subscriber.svg'))),
            );

        // tweak frontend
        if ($status) {
            App::behavior()->addBehaviors([
                'coreBlogBeforeGetPostsAddingParameters' => self::getPosts(...),
            ]);
        }

        return $status;
    }

    /**
     * @param   array<string, mixed>|ArrayObject<string, mixed>     $params     Parameters
     */
    public static function getPosts(ArrayObject $params, string|null $arg = null): void
    {
        if (App::task()->checkContext('FRONTEND') && App::auth()->check(My::PERMISSION_SUBSCRIBER, App::blog()->id()) === true) {
            if (!isset($params['psot_status'])) {
                $params['post_status'] = [];
            }
            if (!is_array($params['post_status'])) {
                $params['post_status'] = [$params['post_status']];
            }

            //$params['post_status'][] = App::status()->post()::PUBLISHED;
            $params['post_status'][] = My::POST_SUBSCRIBED;
        }
    }
}

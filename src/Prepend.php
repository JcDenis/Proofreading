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

        // Add "Posts subscriber" user permission
        App::auth()->setPermissionType(My::PERMISSION_SUBSCRIBER, __('Posts subscriber'));

        // Add post status
        $status = 
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
            )
            // Add "Subscription" post status on backend and frontend.
             && App::status()->post()->set(
                (new Status(My::POST_SUBSCRIBED , My::id() . 'subscriber', 'Subscription', 'Subscription (>1)', My::fileURL('img/subscriber.svg'))),
            );

        // Tweak frontend post related queries
        if ($status) {
            App::behavior()->addBehaviors([
                'coreBlogBeforeGetPostsAddingParameters' => self::coreBlogBeforeGetPostsAddingParameters(...),
            ]);
        }

        return $status;
    }

    /**
     * Add subscriber post status.
     * 
     * This adds post marked with status subscriber 
     * to Frontend if user is loggued and has subscriber right.
     *
     * @param   ArrayObject<string, mixed>     $params     Parameters
     */
    public static function coreBlogBeforeGetPostsAddingParameters(ArrayObject $params, string|null $arg = null): void
    {
        if (App::task()->checkContext('FRONTEND') && App::auth()->check(My::PERMISSION_SUBSCRIBER, App::blog()->id()) === true) {
            if (!isset($params['post_status'])) {
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

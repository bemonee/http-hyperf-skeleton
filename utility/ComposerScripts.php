<?php

declare(strict_types=1);

namespace Utility;

use Composer\Script\Event;

class ComposerScripts
{
    /**
     * Run scripts that follow only if dev packages are installed.
     */
    public static function devModeOnly(Event $event)
    {
        if (!$event->isDevMode()) {
            $event->stopPropagation();
            print("Skipping {$event->getName()} as this is a non-dev installation.\n");
        }
    }
}

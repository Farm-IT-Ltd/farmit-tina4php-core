<?php

/**
 * Tina4 - This is not a 4ramework.
 * Copy-right 2007 - current Tina4
 * License: MIT https://opensource.org/licenses/MIT
 */

namespace Tina4;

// Lazy bridge: registers FarmIT\ -> Tina4\ alias autoloader so that
// `use FarmIT\Get;` and similar statements encountered during Initialize()
// route scanning can resolve. This must run BEFORE (new Data()) below.
if (!defined('FARMIT_ALIASES_REGISTERED')) {
    define('FARMIT_ALIASES_REGISTERED', true);
    spl_autoload_register(function (string $class): void {
        if (strncmp($class, 'FarmIT\\', 7) !== 0) {
            return;
        }
        $tina4Class = 'Tina4\\' . substr($class, 7);
        if (class_exists($tina4Class, true) || interface_exists($tina4Class, true) || trait_exists($tina4Class, true)) {
            class_alias($tina4Class, $class);
        }
    }, true, true);
}

//Get the sub folders etc using the data class
(new Data());

// Eager aliasing — must run AFTER (new Data()) because that call triggers
// Initialize() which loads all route files and Tina4 core classes.
//
// PHP 8.5 behaviour change: class_alias called from inside an spl_autoload
// callback (lazy) does NOT make pre-existing Tina4\ instances satisfy
// FarmIT\ typed parameter checks on route closures. Calling class_alias
// directly here (outside any callback) does work.
//
// Two passes:
//   1. Alias every Tina4\ class already in get_declared_classes().
//   2. Force-load + alias classes used as closure type hints — these are
//      resolved lazily in PHP 8 (not at parse time), so they may not be
//      in get_declared_classes() after Initialize() returns.
if (!defined('FARMIT_EAGER_ALIASES')) {
    define('FARMIT_EAGER_ALIASES', true);
    foreach (get_declared_classes() as $farmitEagerCls) {
        if (strncmp($farmitEagerCls, 'Tina4\\', 6) === 0) {
            $farmitEagerAlias = 'FarmIT\\' . substr($farmitEagerCls, 6);
            if (!class_exists($farmitEagerAlias, false)
                && !interface_exists($farmitEagerAlias, false)
                && !trait_exists($farmitEagerAlias, false)
            ) {
                class_alias($farmitEagerCls, $farmitEagerAlias);
            }
        }
    }
    foreach (['Response', 'Request', 'Route', 'Auth', 'ORM', 'Api', 'Migration', 'FileUpload', 'Debug', 'Container'] as $farmitEagerName) {
        $farmitEagerTina4  = 'Tina4\\' . $farmitEagerName;
        $farmitEagerAlias2 = 'FarmIT\\' . $farmitEagerName;
        if (!class_exists($farmitEagerAlias2, false)
            && !interface_exists($farmitEagerAlias2, false)
            && !trait_exists($farmitEagerAlias2, false)
            && (class_exists($farmitEagerTina4, true)
                || interface_exists($farmitEagerTina4, true)
                || trait_exists($farmitEagerTina4, true))
        ) {
            class_alias($farmitEagerTina4, $farmitEagerAlias2);
        }
    }
    unset($farmitEagerCls, $farmitEagerAlias, $farmitEagerName, $farmitEagerTina4, $farmitEagerAlias2);
}

/**
 * Initialize function loads the library for use
 */
function Initialize(): void
{
    if (defined("TINA4_PROJECT_ROOT") && file_exists(TINA4_PROJECT_ROOT. DIRECTORY_SEPARATOR. "tina4php". DIRECTORY_SEPARATOR. "Tina4". DIRECTORY_SEPARATOR ."Initialize.php")) {
        require_once TINA4_PROJECT_ROOT. DIRECTORY_SEPARATOR. "tina4php". DIRECTORY_SEPARATOR. "Tina4". DIRECTORY_SEPARATOR ."Initialize.php";
    } else {
        require_once __DIR__."/Initialize.php";
    }
}

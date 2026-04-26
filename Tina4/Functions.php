<?php

/**
 * Tina4 - This is not a 4ramework.
 * Copy-right 2007 - current Tina4
 * License: MIT https://opensource.org/licenses/MIT
 */

namespace Tina4;

// Register FarmIT\ -> Tina4\ namespace alias autoloader BEFORE any
// Tina4 classes are instantiated. This file loads first via Composer
// autoload.files, so the alias autoloader will be available when
// Initialize.php later loads route files that use FarmIT\ imports.
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

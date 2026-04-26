<?php

/**
 * FarmIT namespace aliases.
 *
 * Maps FarmIT\ClassName to Tina4\ClassName so both namespaces
 * work during the migration period. Existing Tina4\ imports are
 * unaffected. New code may use FarmIT\ imports.
 */

$__t4 = 'Tina4\\Annotation';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Annotation');
}
$__t4 = 'Tina4\\Cache';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Cache');
}
$__t4 = 'Tina4\\Data';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Data');
}
$__t4 = 'Tina4\\Module';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Module');
}
$__t4 = 'Tina4\\Test';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Test');
}
$__t4 = 'Tina4\\Utilities';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Utilities');
}
$__t4 = 'Tina4\\Utility';
if (class_exists($__t4, false) || interface_exists($__t4, false) || trait_exists($__t4, false)) {
    class_alias($__t4, 'FarmIT\\Utility');
}
unset($__t4);

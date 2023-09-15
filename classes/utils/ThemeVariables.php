<?php

namespace PassionImpact\Utils;

use PassionImpact\Interfaces\PassionImpactClassInterface;
use PassionImpact\PassionImpactSingleton;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class ThemeVariables
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class ThemeVariables extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(): void {}

    static public function getThemeVariables(): array
    {
        return [
            'domain' => 'passion-impact',
        ];
    }
}

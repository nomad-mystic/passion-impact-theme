<?php

namespace PassionImpact;

use PassionImpact\Interfaces\PassionImpactClassInterface;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @class PassionImpactThemeBootstrap
 * @implements PassionImpactClassInterface
 * @extends PassionImpactSingleton
 * @package PassionImpact
 */
class PassionImpactThemeBootstrap extends PassionImpactSingleton implements PassionImpactClassInterface
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        $this->instantiateClasses();
    }

    /**
     * @author Keith Murphy | nomadmystics@gmail.com
     * @description Build our list of classes to instantiate
     *
     * @return array
     */
    private function getClasses(): array
    {
        return [
            'PassionImpact\Admin\AdminPluginDeactivation',
            'PassionImpact\Admin\AdminUpdates',
            'PassionImpact\EnqueueScriptsAndStyles',
            'PassionImpact\AdvancedCustomFields',
            'PassionImpact\AddFilters',
            'PassionImpact\AddMicroData',
            'PassionImpact\CustomPostTypes',
            'PassionImpact\RestEndpoints',
            'PassionImpact\ThemeOptions',
            'PassionImpact\WpSEO',
            'PassionImpact\Utils\SiteUtils',
            'PassionImpact\Utils\ThemeVariables',
        ];
    }

    /**
     * @description Call each class in the list for usage around the site.
     * @author Keith Murphy | nomadmystics@gmail.com
     *
     * @return void
     */
    private function instantiateClasses(): void
    {
        $classes = $this->getClasses();

        foreach ($classes as $class) {
            if (!empty($class)) {
                $result = call_user_func($class . '::getInstance');

                // If everything call the init method
                if ($result) {
                    $result->init();
                }
            }
        }
    }
}

if (class_exists(__NAMESPACE__ . '\PassionImpactThemeBootstrap') && class_exists(__NAMESPACE__ . '\PassionImpactSingleton')) {
    $bootstrap = PassionImpactThemeBootstrap::getInstance();
    $bootstrap->init();
}

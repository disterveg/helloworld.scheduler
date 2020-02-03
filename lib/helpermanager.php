<?php

namespace HelloWorld\Scheduler;

use HelloWorld\Scheduler\Exceptions\HelperException;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

/**
 * @method IblockHelper             Iblock()
 * @method HlblockHelper            Hlblock()
 * @method AgentHelper              Agent()
 * @method EventHelper              Event()
 * @method LangHelper               Lang()
 * @method SiteHelper               Site()
 * @method UserOptionsHelper        UserOptions()
 * @method UserTypeEntityHelper     UserTypeEntity()
 * @method UserGroupHelper          UserGroup()
 * @method OptionHelper             Option()
 * @method FormHelper               Form()
 * @method DeliveryServiceHelper    DeliveryService()
 * @method SqlHelper                Sql()
 * @method MedialibHelper           Medialib()
 * @method AdminIblockHelper        AdminIblock()
 */
class HelperManager
{

    private $cache = [];

    private static $instance = null;

    private $registered = [];

    /**
     * @return HelperManager
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param $name
     * @param $arguments
     * @throws HelperException
     * @return Helper
     */
    public function __call($name, $arguments)
    {
        return $this->callHelper($name);
    }

    public function registerHelper($name, $class)
    {
        $this->registered[$name] = $class;
    }

    /**
     * @param $name
     * @throws HelperException
     * @return Helper
     */
    protected function callHelper($name)
    {
        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        $helperClass = '\\HelloWorld\\Scheduler\\Helpers\\' . $name . 'Helper';
        if (class_exists($helperClass)) {
            $this->cache[$name] = new $helperClass;
            return $this->cache[$name];
        }

        if (isset($this->registered[$name])) {
            $helperClass = $this->registered[$name];
            if (class_exists($helperClass)) {
                $this->cache[$name] = new $helperClass;
                return $this->cache[$name];
            }
        }

        Throw new HelperException("Helper $name not found");
    }
}

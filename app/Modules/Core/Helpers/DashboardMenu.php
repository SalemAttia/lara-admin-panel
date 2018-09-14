<?php

if(!class_exists('DashboardMenu')) {
    /**
     * Class DashboardMenu
     */
    class DashboardMenu
    {
        /**
         * @var array
         */
        private $menu = [];
        /**
         * @var
         */
        private static $instance;

        /**
         * @return mixed
         */
        public static function instance()
        {
            if (null === static::$instance) {
                static::$instance = new static;
            }
            return static::$instance;
        }

        /**
         * @param $module
         * @param $html
         */
        public function add($module, $html)
        {

            $this->menu[$module] = $html;
        }

        /**
         * @return mixed
         */
        public function get()
        {
            $return = '';
            foreach ($this->menu as $html) {
                $return .= $html;
            }

            return eval('?>' . \Blade::compileString($return));
        }
    }
}
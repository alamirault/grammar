<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 15:52
 */

namespace Alamirault\Grammar;


class Definition
{
    private $id;
    /** @var array */
    private $rule;
    /** @var null|callable */
    private $action;

    /**
     * @param string        $id
     * @param null|callable $action Transforms the result to a custom value
     */
    public function __construct($id, $rule, $action = null)
    {
        $this->id = $id;
        $this->rule = $rule;
        $this->action = $action;
    }

    public function identifier()
    {
        return $this->id;
    }

    public function rule()
    {
        return $this->rule;
    }

    /**
     * Parses the value matched by this definition.
     *
     * If no action was provided, this will flatten the nested
     * input array and return it as a string.
     *
     * Otherwise, the action will be called with the nested
     * input array as argument.
     *
     * @param mixed $value
     *
     * @return string|mixed
     */
    public function call($value)
    {
        $_value = (array) $value;

        if ($this->action) {
            return call_user_func($this->action, $_value);
        }

        return is_array($value) ? implode('', Util::flattenArray($value)) : $value;
    }
}
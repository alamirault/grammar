<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 15:50
 */

namespace Alamirault\Grammar;


class Grammar
{
    private $mainDefinitionId;
    /** @var Parser */
    private $parser;

    /**
     * @param string       $mainDefinitionId The definition to use as top-level
     * @param Definition[] $definitions
     */
    public function __construct($mainDefinitionId, array $definitions)
    {
        $this->mainDefinitionId = $mainDefinitionId;

        $this->parser = new Parser($definitions);
    }

    /**
     * Parses the input string using the defined grammar.
     *
     * The return value is one of:
     *   `null`   there is no match
     *   `string` the consumed part of the string
     *   `mixed`  the value returned by the PEG actions defined in the grammar
     *
     * @param string $input
     *
     * @return null|string|mixed
     */
    public function parse($input)
    {
        $result = $this->parser->parse($this->mainDefinitionId, $input);

        if (!$result->isMatch()) {
            return null;
        }

        return $result;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 15:23
 */

namespace Alamirault\Grammar;


use Alamirault\Grammar\Operator\OperatorInterface;
use WouterJ\Peg\Exception\DefinitionException;

final class Parser
{
    /** @var Definition[] */
    private $definitions;

    /**
     * @param Definition[] $definitions
     */
    public function __construct(array $definitions)
    {
        foreach ($definitions as $definition) {
            $this->definitions[$definition->identifier()] = $definition;
        }
    }

    /**
     * Parses using a definition.
     *
     * @param string $definitionId
     * @param string $input
     * @param int $offset Current position in the $input
     *
     * @return Result
     *
     * @throws \LogicException When the definition is invalid.
     */
    public function parse($definitionId, $input, $offset = 0)
    {
        if (!isset($this->definitions[$definitionId])) {
            throw DefinitionException::undefined($definitionId, array_keys($this->definitions));
        }
        $definition = $this->definitions[$definitionId];

        try {
            $result = $this->parseOperator($definition->rule(), $input, $offset);

            if (!$result->isMatch()) {
                return $result;
            }

            return Result::match($result->length(), $definition->call($result->value()), $result->offset());
        } catch (OperatorException $e) {
            throw DefinitionException::invalid($definitionId, $e);
        }
    }

    /**
     * Parses using an operator.
     *
     * @param array $operator First element is the operator name, other elements operator values
     * @param string $input
     * @param int $offset Current position in the input string
     *
     * @return Result
     *
     * @throws \LogicException When the operator is not known
     */
    public function parseOperator(OperatorInterface $operator, $input, $offset)
    {
        return $operator->find($this, $input, $offset);
    }
}

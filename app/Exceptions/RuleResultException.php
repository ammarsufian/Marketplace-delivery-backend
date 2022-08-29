<?php

namespace App\Exceptions;

use App\Rules\RuleResult;
use Exception;

class RuleResultException extends Exception
{

    protected RuleResult $ruleResult;

    public function __construct(RuleResult $ruleResult)
    {
        $this->ruleResult = $ruleResult;
        parent::__construct($ruleResult->getMessage(), $ruleResult->getStatusCode());
    }

    /**
     * @return RuleResult
     */
    public function ruleResult(): RuleResult
    {
        return $this->ruleResult;
    }

}

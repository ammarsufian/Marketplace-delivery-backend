<?php


namespace App\Rules;


use App\Domains\Interfaces\Rulable;
use App\Exceptions\RuleResultException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class RulesBus
{
    protected Collection $results;

    public function __construct()
    {
        $this->results = collect();
    }

    public function apply($rules): self
    {
        collect($rules)->map(function (Rulable $rule) {
            $ruleResult = new RuleResult($rule);
            $ruleResult->setResult($rule->run());
            if ($ruleResult->hasFailed()) {
                $ruleResult->setMessage($rule->getMessage());
                $ruleResult->setStatusCode(400);
            }
            $this->results->push($ruleResult);
        });

        return $this;
    }

    public function results(): Collection
    {
        return $this->results;
    }

    public function allPassed(): bool
    {
        return $this->results->every(function (RuleResult $result) {
            return $result->isSuccessful();
        });
    }

    public function hasFailures(): bool
    {
        return $this->results->contains(function (RuleResult $result) {
            return $result->hasFailed();
        });
    }

    public function failedDueTo(): RuleResult
    {
        return $this->results->first(function (RuleResult $result) {
            return $result->hasFailed();
        });
    }

    public function toResponse(): JsonResponse
    {
        $failingRule = $this->failedDueTo();

        return response()->json([
            'message' => $failingRule->getMessage(),
            'success' => false,
            'status_code' => $failingRule->getStatusCode(),
        ], $failingRule->getStatusCode());
    }

    /**
     * @throws RuleResultException
     */
    public function toException()
    {
        $failingRule = $this->failedDueTo();
        throw new RuleResultException($failingRule);
    }

    public function resetCollection(): Collection
    {
        return $this->results = collect();
    }
}

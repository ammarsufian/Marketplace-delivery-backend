<?php

namespace App\Rules;

use App\Domains\Interfaces\Rulable;
use Illuminate\Http\JsonResponse;

class RuleResult
{
    protected Rulable $rule;
    protected bool $result;
    protected string $message;
    protected ?int $statusCode;
    protected ?bool $isCritical;

    /**
     * @param Rulable $rule
     */
    public function __construct(Rulable $rule)
    {
        $this->rule = $rule;
        $this->statusCode = null;
    }

    /**
     * @return bool
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->result == true;
    }

    /**
     * @return bool
     */
    public function hasFailed(): bool
    {
        return $this->result == false;
    }

    /**
     * @param bool $result
     */
    public function setResult(bool $result): void
    {
        $this->result = $result;
    }

    public function withResult(bool $result): self
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @param string $message
     * @return RuleResult
     */
    public function withMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function withStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function toExceptionResponse(): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'success' => $this->result,
            'status_code' => $this->getStatusCode(),
            'data' => []
        ], $this->getStatusCode());
    }

}

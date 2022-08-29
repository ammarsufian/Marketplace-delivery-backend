<?php

namespace App\Domains\Transaction\Services;

use App\Domains\Transaction\Actions\CreateCreditCardAction;
use App\Domains\Transaction\Actions\DeleteCreditCardAction;
use App\Domains\Transaction\Actions\UpdateCreditCardAction;
use App\Domains\Transaction\Http\Requests\CreateCreditCardRequest;
use App\Domains\Transaction\Http\Requests\UpdateCreditCardRequest;
use App\Domains\Transaction\Http\Resources\CreditCardResource;
use App\Domains\Transaction\Models\CreditCard;
use App\Domains\Transaction\Rules\CheckCreditCardBelongsToUser;
use App\Domains\Transaction\Rules\CheckCreditCardValidityRule;
use App\Exceptions\RuleResultException;
use App\Rules\Rules;
use Exception;
use Illuminate\Support\Facades\Auth;

class CreditCardService
{
    public function create(CreateCreditCardRequest $request)
    {
        try {
            $results = Rules::apply([
                (new CheckCreditCardValidityRule($request->get('expiration_date')))
            ]);

            if ($results->hasFailures()) {
                $results->toException();
            }

            (new CreateCreditCardAction($request))->execute();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return CreditCardResource::collection(Auth::user()->creditCards);
    }

    public function update(CreditCard $creditCard, UpdateCreditCardRequest $request)
    {
        try {
            $results = Rules::apply([
                (new CheckCreditCardBelongsToUser($creditCard))
            ]);

            if ($results->hasFailures()) {
                $results->toException();
            }

            (new UpdateCreditCardAction($creditCard, $request))->execute();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return CreditCardResource::collection(Auth::user()->creditCards);
    }

    public function index()
    {
        return CreditCardResource::collection(Auth::user()->creditCards);
    }

    public function delete(CreditCard $creditCard)
    {
        try {
            $results = Rules::apply([
                (new CheckCreditCardBelongsToUser($creditCard))
            ]);

            if ($results->hasFailures()) {
                $results->toException();
            }

            (new DeleteCreditCardAction($creditCard))->execute();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return CreditCardResource::collection(Auth::user()->creditCards);
    }
}

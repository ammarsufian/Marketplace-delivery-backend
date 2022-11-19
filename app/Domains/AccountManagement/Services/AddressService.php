<?php

namespace App\Domains\AccountManagement\Services;

use App\Domains\AccountManagement\Actions\CreateUserAddressAction;
use App\Domains\AccountManagement\Actions\DeleteUserAddressAction;
use App\Domains\AccountManagement\Actions\UpdateUserAddressAction;
use App\Domains\AccountManagement\Http\Requests\CreateUserAddressRequest;
use App\Domains\AccountManagement\Http\Requests\UpdateUserAddressRequest;
use App\Domains\AccountManagement\Http\Resources\UserAddressResource;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Rules\ModelInstanceBelongsToActiveUserRule;
use App\Exceptions\RuleResultException;
use App\Rules\Rules;
use Exception;
use Illuminate\Support\Facades\Auth;

class AddressService
{

    public function createUserAddress(CreateUserAddressRequest $request)
    {
        try {
            $address = (new CreateUserAddressAction($request))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false
            ], 400);
        }
        return UserAddressResource::collection(Auth::user()->addresses);
    }

    public function updateUserAddress(Address $address, UpdateUserAddressRequest $request)
    {
        try {
            $ruleResult = Rules::apply([
                (new ModelInstanceBelongsToActiveUserRule($address))
            ]);

            if ($ruleResult->hasFailures()) {
                $ruleResult->toException();
            }

            (new UpdateUserAddressAction($address, $request))->execute();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }
        return UserAddressResource::collection(Auth::user()->addresses);
    }

    public function deleteUserAddress(Address $address)
    {
        try {
            $ruleResult = Rules::apply([
                (new ModelInstanceBelongsToActiveUserRule($address))
            ]);

            if ($ruleResult->hasFailures()) {
                $ruleResult->toException();
            }

            (new DeleteUserAddressAction($address))->execute();

        } catch (RuleResultException $exception) {
            return $exception->ruleResult()->toExceptionResponse();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }
        return UserAddressResource::collection(Auth::user()->addresses);
    }

    public function UserAddressesList()
    {
        //business requirement to display only 4 addresses
        $addresses = Auth::user()->addresses()->limit(4)->get();
        return UserAddressResource::collection($addresses);
    }
}

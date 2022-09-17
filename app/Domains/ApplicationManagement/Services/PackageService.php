<?php

namespace App\Domains\ApplicationManagement\Services;

use Exception;
use App\Rules\Rules;
use Illuminate\Http\Request;
use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Authentication\Rules\CheckIfUserIsActiveRule;
use App\Domains\Authentication\Rules\UserHasRoleApplicationRule;
use App\Domains\ApplicationManagement\Actions\GetPackageListAction;
use App\Domains\ApplicationManagement\Http\Resources\PackageResource;
use App\Domains\ApplicationManagement\Actions\CreateUserPackageAction;

class PackageService
{
    public function index()
    {
        try {
            $ruleResults = Rules::apply([
                new UserHasRoleApplicationRule(),
                new CheckIfUserIsActiveRule(),
            ]);
            if ($ruleResults->hasFailures()) {
                $ruleResults->toException();
            }

            $packages = (new GetPackageListAction())->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }

        return PackageResource::collection($packages);
    }

    public function createUserPackage(Package $package)
    {
        try {
            (new CreateUserPackageAction($package))->execute();
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }
        return response()->json([
            'message' => 'success',
            'success' => true,
        ]);
    }

}

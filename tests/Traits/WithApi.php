<?php


namespace Tests\Traits;


use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Authentication\Models\User;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\Transaction\Models\CreditCard;
use Illuminate\Testing\TestResponse;
use Illuminate\Validation\ValidationException;

trait WithApi
{
    use ActingAsSanctum;

    /**
     * @param string $route
     * @param array $headers
     * @return TestResponse
     */
    protected function getApi(string $route, array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
        ]);
        return $this->get("/api$route", $headers);
    }

    /**
     * @param string $route
     * @param array $body
     * @param array $headers
     * @return TestResponse
     * @throws ValidationException
     */
    protected function postApi(string $route, array $body = [], array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        try {
            return $this->post("/api$route", $body, $headers);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $route
     * @param array $body
     * @param array $headers
     * @return TestResponse
     */
    protected function putApi(string $route, array $body = [], array $headers = [], string $prefix = '/api'): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        return $this->put($prefix . $route, $body, $headers);
    }

    /**
     * @param string $route
     * @param array $body
     * @param array $headers
     * @return TestResponse
     */
    protected function patchApi(string $route, array $body = [], array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        try {
            $response = $this->patch("/api$route", $body, $headers);
            return $response;
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param string $route
     * @return mixed
     */
    protected function deleteApi(string $route, array $data = []): TestResponse
    {
        $headers = [
            'Accept' => 'application/json'
        ];
        return $this->delete("/api$route", $data, $headers);
    }

    public function login(array $attributes = []): TestResponse
    {
        return $this->postApi('/user/login', $attributes);
    }

    public function register(array $attributes = []): TestResponse
    {
        return $this->postApi('/user/register', $attributes);
    }

    public function categoriesList($per_page): TestResponse
    {
        return $this->getApi('/categories', ['per_page' => $per_page]);
    }

    public function updateFirebaseToken($token): TestResponse
    {
        return $this->putApi('/user/fcm-token', ['fcm_token' => $token]);
    }

    public function GetNearerLocations(array $attributes): TestResponse
    {
        return $this->getApi('/locations?' . http_build_query($attributes));
    }

    public function createUserAddress($attributes): TestResponse
    {
        return $this->postApi('/user/address', $attributes);
    }

    public function getUserAddress(): TestResponse
    {
        return $this->getApi('/user/address');
    }

    public function updateUserAddress(Address $address, array $attributes = []): TestResponse
    {
        return $this->putApi("/user/address/{$address->id}", $attributes);
    }

    public function deleteUserAddress(Address $address): TestResponse
    {
        return $this->deleteApi("/user/address/{$address->id}");
    }

    public function logout(): TestResponse
    {
        return $this->postApi('/user/logout');
    }

    public function listEntityProductsByBranchId(Branch $branch, array $attributes = []): TestResponse
    {
        return $this->getApi("/branch/{$branch->id}/products?" . http_build_query($attributes));
    }

    public function setEntityProductFavorite(array $attributes): TestResponse
    {
        return $this->postApi('/favorites', $attributes);
    }

    public function ListUserFavorite(): TestResponse
    {
        return $this->getApi('/favorites');
    }

    public function addItemToCart(array $attributes, ?Address $address = null): TestResponse
    {
        $addressId = $address->id ?? null;
        return $this->postApi('/cart?addressId=' . $addressId, $attributes);
    }

    public function deleteCartItemById(CartItem $cartItem, Address $address): TestResponse
    {
        return $this->deleteApi('/cart/' . $cartItem->id . '?addressId=' . $address->id);
    }

    public function checkPromoCode(array $attributes)
    {
        return $this->postApi('/promo-code/apply', $attributes);
    }

    public function updateProfile(array $attributes = []): TestResponse
    {
        return $this->putApi('/user/profile', $attributes);
    }

    public function placeOrder(array $attributes = []): TestResponse
    {
        return $this->postApi('/order', $attributes);
    }

    public function getOrderList(): TestResponse
    {
        return $this->getApi('/order');
    }

    public function createCreditCard(array $attributes = []): TestResponse
    {
        return $this->postApi('/user/credit-card', $attributes);
    }

    public function updateCreditCard(CreditCard $creditCard, array $attributes = []): TestResponse
    {
        return $this->patchApi("/user/credit-card/$creditCard->id", $attributes);
    }

    public function deleteCreditCard(CreditCard $creditCard): TestResponse
    {
        return $this->deleteApi("/user/credit-card/$creditCard->id");
    }

    public function listCreditCard(): TestResponse
    {
        return $this->getApi("/user/credit-card");
    }

    public function getUserInvitationLink(): TestResponse
    {
        return $this->getApi('/user/invitation-link');
    }
}

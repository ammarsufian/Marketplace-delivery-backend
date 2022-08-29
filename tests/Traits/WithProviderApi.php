<?php


namespace Tests\Traits;

use App\Domains\AccountManagement\Models\Branch;
use Illuminate\Testing\TestResponse;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Validation\ValidationException;


trait WithProviderApi
{
    use ActingAsSanctum;

    /**
     * @param string $route
     * @param array $headers
     * @return TestResponse
     */
    protected function getProvider(string $route, array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
        ]);
        return $this->get("/provider$route", $headers);
    }

    protected function postProvider(string $route, array $body = [], array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        try {
            return $this->post("/provider$route", $body, $headers);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    protected function putProvider(string $route, array $body = [], array $headers = []): TestResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        try {
            return $this->put("/provider$route", $body, $headers);
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function loginProvider(array $attributes = []): TestResponse
    {
        return $this->postProvider('/login', $attributes);
    }

    public function getOrderListProvider($per_page = 10): TestResponse
    {
        return $this->getProvider('/orders?per_page=' . $per_page);
    }

    public function updateOrderStatusProvider(Order $order, array $attributes = []): TestResponse
    {
        return $this->putProvider("/orders/{$order->id}/edit", $attributes);
    }

    public function createEntityProduct(array $attributes = []): TestResponse
    {
        return $this->postProvider("/entity-product", $attributes);
    }

    public function updateEntityProduct(EntityProduct $entityProduct, array $attributes = []): TestResponse
    {
        return $this->putProvider("/entity-product/{$entityProduct->id}", $attributes);
    }

    public function updateTimeBranch(Branch $branch, array $attributes=[]): TestResponse
    {
        return $this->putProvider("/branch/{$branch->id}", $attributes);
    }
}

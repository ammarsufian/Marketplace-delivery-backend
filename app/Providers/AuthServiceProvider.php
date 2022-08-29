<?php

namespace App\Providers;

use App\Policies\CartPolicy;
use App\Policies\CityPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\AdminPolicy;
use App\Policies\BrandPolicy;
use App\Policies\OrderPolicy;
use App\Policies\BranchPolicy;
use App\Policies\AddressPolicy;
use App\Policies\CountryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\VariantPolicy;
use App\Policies\CartItemPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ContactUsPolicy;
use App\Policies\OrderItemPolicy;
use App\Policies\PromoCodePolicy;
use App\Policies\UserBranchPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\VariantGroupPolicy;
use App\Policies\EntityProductPolicy;
use App\Policies\PaymentMethodPolicy;
use App\Policies\AdditionalItemPolicy;
use App\Policies\CartItemVariantPolicy;
use App\Policies\OrderItemVariantPolicy;
use App\Policies\CreditCardCompanyPolicy;
use App\Policies\OrderCancelReasonPolicy;
use Illuminate\Support\Facades\Gate;
use App\Domains\Authentication\Models\User;
use App\Domains\Authentication\Models\Admin;
use App\Domains\OrderManagement\Models\Cart;
use App\Policies\EntityProductVariantPolicy;
use App\Domains\OrderManagement\Models\Order;
use App\Domains\AccountManagement\Models\Brand;
use App\Domains\Transaction\Models\Transaction;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\OrderManagement\Models\OrderItem;
use App\Domains\OrderManagement\Models\PromoCode;
use App\Domains\ProductManagement\Models\Product;
use App\Domains\ProductManagement\Models\Variant;
use App\Domains\Transaction\Models\PaymentMethod;
use App\Domains\ApplicationManagement\Models\City;
use App\Domains\AccountManagement\Models\ContactUs;
use App\Policies\EntityProductAdditionalItemPolicy;
use App\Domains\AccountManagement\Models\UserBranch;
use App\Domains\ApplicationManagement\Models\Country;
use App\Domains\Transaction\Models\CreditCardCompany;
use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\ProductManagement\Models\GroupVariant;
use App\Domains\OrderManagement\Models\CartItemVariant;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\OrderManagement\Models\OrderItemVariant;
use App\Domains\ProductManagement\Models\AdditionalItem;

use App\Domains\OrderManagement\Models\OrderCancelReason;
use App\Domains\ProductManagement\Models\EntityProductVariants;
use App\Domains\ProductManagement\Models\EntityProductAdditionalItem;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AdditionalItem::class => AdditionalItemPolicy::class,
        Address::class => AddressPolicy::class,
        Admin::class=> AdminPolicy::class,
        Branch::class => BranchPolicy::class,
        Brand::class => BrandPolicy::class,
        Cart::class => CartPolicy::class,
        CartItem::class => CartItemPolicy::class,
        CartItemVariant::class => CartItemVariantPolicy::class,
        Category::class=> CategoryPolicy::class,
        Country::class => CountryPolicy::class,
        City::class => CityPolicy::class,
        EntityProduct::class => EntityProductPolicy::class,
        Order::class => OrderPolicy::class,
        OrderItem::class => OrderItemPolicy::class,
        OrderItemVariant::class => OrderItemVariantPolicy::class,
        Product::class => ProductPolicy::class,
        PromoCode::class => PromoCodePolicy::class,
        User::class => UserPolicy::class,
        Variant::class => VariantPolicy::class,
        GroupVariant::class => VariantGroupPolicy::class,
        EntityProductVariants::class => EntityProductVariantPolicy::class,
        EntityProductAdditionalItem::class => EntityProductAdditionalItemPolicy::class,
        PaymentMethod::class => PaymentMethodPolicy::class,
        Transaction::class => TransactionPolicy::class,
        OrderCancelReason::class => OrderCancelReasonPolicy::class,
        CreditCardCompany::class => CreditCardCompanyPolicy::class,
        ContactUs::class => ContactUsPolicy::class,
        UserBranch::class => UserBranchPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}

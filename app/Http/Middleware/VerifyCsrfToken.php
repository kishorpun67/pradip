<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/check-current-password",
        "/admin/update-section-status",
        "/admin/update-category-status",
        "/admin/append-categories-level",
        "/admin/update-product-status",
        "/admin/update-post-status",
        "/products/url",
        "/admin/update-product-attr-status",
        "/admin/update-product-img-status",
        "/admin/update-coupon-status",
        "/check-current-password",
        "/admin/update-cms-status",
        "/admin/update-user-status",
        "/check-subcriber-email",
        "/add-subcriber-email",
        "/admin/update-newsletter-status",
        "/admin/update-brand-status",
        "/products/{url?}",
        '/cart/upate-quantity',
    ];
}

<?php

Breadcrumbs::for('admin.pricing.index', function ($trail) {
    $trail->push('Pricing Management', route('admin.pricing.index'));
});

Breadcrumbs::for('admin.pricing.upload', function ($trail) {
    $trail->push('Pricing Management', route('admin.pricing.index'));
    $trail->push('Pricing Management', route('admin.pricing.indexwave2'));
});

Breadcrumbs::for('admin.pricing.indexwave2', function ($trail) {
    $trail->push('Pricing Management', route('admin.pricing.indexwave2'));
});


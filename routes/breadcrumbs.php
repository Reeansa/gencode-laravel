<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for( 'dashboard', function (BreadcrumbTrail $trail) {
    $trail->push( 'Dashboard', route( 'dashboard' ) );
} );

// Dashboard > pesanan
Breadcrumbs::for( 'order', function (BreadcrumbTrail $trail) {
    $trail->parent( 'dashboard' );
    $trail->push( 'Pesanan', route( 'order.index' ) );  
} );

// Dashboard > pesanan > {order}
Breadcrumbs::for( 'order.edit', function (BreadcrumbTrail $trail, $order) {
    $trail->parent( 'order' );
    $trail->push( $order->product->name, route( 'order.edit', $order ) );  
} );

// Dashboard > Faktur
Breadcrumbs::for( 'invoice', function (BreadcrumbTrail $trail) {
    $trail->parent( 'dashboard' );
    $trail->push( 'faktur', route( 'invoice.index' ) );  
} );

// Dashboard > Produk
Breadcrumbs::for( 'product', function (BreadcrumbTrail $trail) {
    $trail->parent( 'dashboard' );
    $trail->push( 'produk', route( 'produk.index' ) );  
} );

// Dashboard -> produk -> Tambah Produk
Breadcrumbs::for( 'product.create', function (BreadcrumbTrail $trail) {
    $trail->parent( 'product' );
    $trail->push( 'Tambah Produk', route( 'product.create') );
} );

// Dashboard -> produk -> edit {produk}
Breadcrumbs::for( 'product.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent( 'product' );
    $trail->push( 'Edit ' . $product->name, route( 'product.edit', $product ) );
} );

// Dashboard > customer
Breadcrumbs::for( 'customer', function (BreadcrumbTrail $trail) {
    $trail->parent( 'dashboard' );
    $trail->push( 'Customer', route( 'customer.index' ) );  
} );

// Dashboard > customer > Lihat Customer
Breadcrumbs::for( 'customer.show', function (BreadcrumbTrail $trail) {
    $trail->parent( 'customer' );
    $trail->push( 'Lihat Customer', route( 'customer.index' ) );  
} );

// Dashboard > customer > > Lihat > Edit {customer}
Breadcrumbs::for( 'customer.edit', function (BreadcrumbTrail $trail, $customer) {
    $trail->parent( 'customer.show' );
    $trail->push( 'Edit '. $customer->first_name . ' ' . $customer->last_name, route( 'customer.index', $customer ) );  
} );

// Dashboard > user
Breadcrumbs::for( 'user', function (BreadcrumbTrail $trail) {
    $trail->parent( 'dashboard' );
    $trail->push( 'User', route( 'user.index' ) );  
} );
// Dashboard -> user -> edit {user}
Breadcrumbs::for( 'user.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent( 'user' );
    $trail->push( 'Edit ' . $user->first_name.' '.$user->last_name, route( 'user.edit', $user) );
} );
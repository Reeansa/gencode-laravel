<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Product;
use App\Models\productImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        // Cek apakah produk telah melewati satu bulan
        foreach ( $products as $product ) {
            if ( $product->is_new && now()->greaterThan( $product->new_until ) ) {
                $product->update( [ 
                    'is_new'    => false,
                    'new_until' => null,
                ] );
            }
        }

        $users    = auth()->user()->id;
        $products = Product::with( 'productImage' )->where( 'user_id', $users )->get();
        return view( 'administrator.product.index', compact( 'products' ) );
    }

    public function create(): View
    {
        return view( 'administrator.product.create' );
    }

    public function store( Request $request ): RedirectResponse
    {
        $request->validate( [ 
            'productName' => [ 'required', 'string', 'max:255' ],
            'image.*'     => [ 'required', 'image', 'mimes:jpeg,jpg,png', 'max:2048' ],
            'description' => [ 'required', 'string' ],
            'price'       => [ 'required', 'numeric' ],
        ] );

        $data    = [ 
            'user_id'     => auth()->user()->id,
            'name'        => $request->input('productName'),
            'description' => $request->input('description'),
            'price'       => $request->input('price'),
            'new_until'   => now()->addMonth(),
        ];

        $product = Product::create( $data );

        $image = $request->file( 'image' );
        if ( $request->hasFile( 'image' ) ) {
            foreach ( $image as $images ) {
                $imagePath = Storage::disk( 'administrator' )->put( 'images/products', $images, 'public' );
                $product->productImage()->create( [ 'image' => $imagePath ] );
            }
            return redirect()->route( 'product.index' )->with( 'success', 'Product berhasil ditambahkan' );
        }
        else {
            return redirect()->route( 'product.index' )->with( 'success', 'Product berhasil ditambahkan tanpa gambar' );
        }
    }

    public function edit( Product $product ): View
    {
        return view( 'administrator.product.edit', compact( 'product' ) );
    }

    public function update( Request $request, Product $product ): RedirectResponse
    {
        $request->validate( [ 
            'productName' => [ 'string', 'max:255' ],
            'image.*'     => [ 'image', 'mimes:jpeg,jpg,png', 'max:2048' ],
            'description' => [ 'string' ],
            'price'       => [ 'numeric' ],
        ] );

        $data = [ 
            'user_id'     => auth()->user()->id,
            'name'        => $request->input('productName'),
            'description' => $request->input('description'),
            'price'       => $request->input('price'),
        ];

        $product->update( $data );
        $image = $request->file( 'image' );
        if ( $request->hasFile( 'image' ) ) {
            foreach ( $product->productImage as $images ) {
                Storage::disk( 'administrator' )->delete( $images->image );
            }
            foreach ( $image as $images ) {
                $imagePath = Storage::disk( 'administrator' )->put( 'images/products', $images, 'public' );
                $product->productImage()->create( [ 'image' => $imagePath ] );
            }
        }
        return redirect()->route( 'product.index' )->with( 'success', 'Produk berhasil diupdate' );
    }

    public function deleteImage(Product $product, productImage $productImage): RedirectResponse
    {
        Storage::disk( 'administrator' )->delete( $productImage->image );
        $productImage->delete();
        return redirect()->route( 'product.edit', $product )->with( 'success', 'Gambar berhasil dihapus' );
    }

    public function destroy( Product $product ): RedirectResponse
    {
        $product->delete();
        return redirect()->route( 'product.index' )->with( 'success', 'Product berhasil dihapus' );
    }
}

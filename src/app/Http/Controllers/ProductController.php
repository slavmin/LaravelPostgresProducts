<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreatedJob;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->options = Product::getOptions();
    }

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('dashboard', compact('products'));
    }

    public function trashbin()
    {
        $products = Product::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('dashboard', compact('products'));
    }

    public function available()
    {
        $products = Product::available()->orderBy('id', 'desc')->get();
        return view('welcome', compact('products'));
    }

    public function create()
    {
        return view('products.create')
            ->with('method', 'POST')
            ->with('action', 'product.store')
            ->with('colors', $this->options['colors'])
            ->with('sizes', $this->options['sizes'])
            ->with('status', ['available', 'unavailable']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:10', 'max:255'],
            'art' => ['required', 'alpha_num', Rule::unique('products'), 'min:12', 'max:12'],
            'status' => ['required'],
        ]);

        $product = new Product($request->all());
        $product->save();

        // Dispatching job
        ProductCreatedJob::dispatch($product);

        return redirect()->route('dashboard')->with('status', 'Product created');

    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'))
            ->with('method', 'POST')
            ->with('action', 'product.update')
            ->with('colors', $this->options['colors'])
            ->with('sizes', $this->options['sizes'])
            ->with('status', ['available', 'unavailable']);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => ['required', 'min:10', 'max:255'],
            'art' => ['required', 'alpha_num', Rule::unique('products')->ignore($product->id), 'min:12', 'max:12'],
            'status' => ['required'],
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard')->with('status', 'Product updated');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard')->with('status', 'Product deleted');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product->deleted_at !== null && $product->restore()) {
            return redirect()->route('trashbin')->with('status', 'Product restored');
        }

        return redirect()->route('dashboard')->with('status', 'Product not restored');
    }

    public function delete($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product->deleted_at !== null && $product->forceDelete()) {
            return redirect()->route('trashbin')->with('status', 'Product deleted permanently');
        }

        return redirect()->route('trashbin')->with('status', 'Product not deleted');
    }
}

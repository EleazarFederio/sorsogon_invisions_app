<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $customer = Customer::find($id);

        return $customer->products;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $fileName = null;
//        return $request;

        $validator = Validator::make($request->all(), [
            'product_picture' => 'max:5000',
//            'product_name' => 'required',
            'details' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'details' => 'required'
//            'customer' => 'required'
        ]);

//        dd($request->all());

        if ($validator->passes()){

            if($request->product_picture != null){
                $dataTime = date('Ymd_His');
                $file = $request->file('product_picture');
//                dd($file);

                $fileName = $dataTime. '-'.rand(00000000, 99999999).'.jpg';
                $savePath = public_path("images");
                Storage::disk('dropbox')->putFileAs('public-upload', $file, $fileName);
//                dd($savePath);
                $file->move($savePath, $fileName);
            }

//            dd($request->quantity);
            $request->request->add(['customer_id' => Customer::find($id)->id]);
//            dd($request->category);
//            dd($request->due_date);
            Product::create([
                'quantity' => $request->quantity,
                'price' => $request->price,
                'details' => $request->details,
                'customer_id' => $request->customer_id,
                'category' => $request->category,
                'due_date' => $request->due_date,

                'status' => $request->status,
                'picture' => $fileName
            ]);
//            dd($fileName);
//            $customer->products()->save($request->all());
            $products = Product::all();
            return back()->with('products', $products);

        }else{
//            return redirect()->back()->with(['errors' => $validator->errors()->all()]);
            dd($validator->errors()->all());
        }

    }

    public function showAll(){
        $products = Product::all()->where('due_date', '<', 'NOW()')->sortBy('due_date');
        return view('pages/products/show_all')->with('products', $products);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($customerId, $productId)
    {
        $customer = Customer::find($customerId);
        $product = $customer->products()->find($productId);
        return view('pages/products/view')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id1, $id2, Request $request)
    {

//                return $request;

        $fileName = null;

        $validator = Validator::make($request->all(), [
            'product_picture' => 'image'
        ]);

        if($validator->passes()){

            if($request->product_picture != null){
                $dataTime = date('Ymd_His');
                $file = $request->file('product_picture');
                $fileName = $dataTime. '-'.rand(00000000, 99999999).'.jpg';
                $savePath = public_path('/images/');
                $file->move($savePath, $fileName);
            }

            $customer = Customer::find($id1);
            $selectedProduct = $customer->products()->find($id2);
            $selectedProduct->details = $request->details;
            $selectedProduct->quantity = $request->quantity;
            $selectedProduct->price = $request->price;
            $selectedProduct->category = $request->category;
            $selectedProduct->due_date = $request->due_date;
            $selectedProduct->status = $request->status;
            if ($request->product_picture != ''){
                $selectedProduct->picture = $fileName;
            }
            $selectedProduct->save();
            $customer = Customer::find($id1);
            return back()->with('customers', $customer);

            $books = Book::all();
            return view('pages/books/index')->with('books', $books);
        }else{
            return redirect()->back()
                ->with(['errors'=>$validator->errors()->all()]);
        }


//        return $request;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerId, $orderId)
    {
            $customer = Customer::find($customerId);
            $customer->products->find($orderId)->delete();
            $customers = Customer::all()->sortByDesc('id');
            return back()->with('customers', $customers);
    }
}

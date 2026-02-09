<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
// use Illuminate\Support\Facades\Auth;
// use App\Models\Wishlist;
use App\Models\Product;


class WishlistController extends Controller
{
//    public function index()
//     {
//         $wishlist = Wishlist::where('user_id', auth()->id())->get();
//         return view('wishlist.index', compact('wishlist'));
//     }

//     public function store(Request $request)
//     {
//         Wishlist::create([
//             'user_id' => auth()->id(),
//             'product_id' => $request->product_id,
//         ]);
//         return redirect()->route('wishlist.index');
//     }

// this code given by chtgpt
// Show the wishlist
   

//  public function index(\Illuminate\Http\Request $request)
//     {
//         $wishlists = session()->get('wishlist', []);
//         return view('wishlist.index',['wishlist' => $wishlists]);
//     }

//     public function add(Request $request, $id)
//     {
//         $wishlists = session()->get('wishlist', []);
//         $wishlists[$id] = $id;

//         session()->put('wishlist', $wishlists);

//         return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist!');
//     }

//     public function remove(Request $request, $id)
//     {
//         $wishlists = session()->get('wishlist', []);
//         unset($wishlists[$id]);

//         session()->put('wishlist', $wishlists);

//         return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist!');
//     }


 /**
     * Display wishlist products.
     */
    public function index(Request $request)
    {
        $wishlistIds = session()->get('wishlist', []);

        // Get actual product data from DB
        $wishlist = Product::whereIn('id', $wishlistIds)->get();

        return view('wishlist.index', ['wishlist' => $wishlist]);
    }

    /**
     * Add a product to the wishlist.
     */
    public function add(Request $request, $id)
    {
        $wishlist = session()->get('wishlist', []);

        // Prevent duplicates
        if (!in_array($id, $wishlist)) {
            $wishlist[$id] = $id;
            session()->put('wishlist', $wishlist);
        }

        return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist!');
    }

    /**
     * Remove a product from the wishlist.
     */
    public function remove(Request $request, $id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            session()->put('wishlist', $wishlist);
        }

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist!');
    }
}

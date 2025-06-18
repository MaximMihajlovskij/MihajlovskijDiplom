<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with(['camera', 'turniket', 'barrier', 'accessorie'])
            ->where('user_id', Auth::id()) // 🔹 Фильтрация по текущему пользователю
            ->get();
        return view('Wishlist.wishlist', ['wishlistItems' => $wishlistItems]);
    }

    public function store(Request $request){
        $wishlist = Wishlist::create([
            'user_id' => Auth::id(),
            'camera_id' => $request->camera_id ?? null,
            'turniket_id' => $request->turniket_id ?? null,
            'barrier_id' => $request->barrier_id ?? null,
            'accessory_id' => $request->accessory_id ?? null,
        ]);

        return redirect()->back()->with('success', 'Товар добавлен в избранное!');
    }

    public function removeFromWishlist($id)
    {
        Wishlist::destroy($id);
        return redirect()->back()->with('success', 'Товар удалён из избранного!');
    }

    public function countWishlist()
    {
        return response()->json(['count' => Wishlist::count()]);
    }  
}

<ul class="nav navbar-nav">
    <li><a href="{{ route('shop.index') }}">Shop</a></li>
    @if (Auth::user()->is_admin == 1)
    <li><a href="{{ route('products.index') }}">Products</a></li>
    <li><a href="{{ route('uploads.index') }}">File Manager</a></li>
    @endif
    @if(sizeof(Cart::content()) > 0)
    <li><a href="{{ route('cart.index') }}">Cart</a></li>
    @endif
</ul>
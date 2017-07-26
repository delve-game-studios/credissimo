<ul class="nav navbar-nav">
    <!-- <li><a href="{{ route('shop.index') }}">Shop</a></li> -->
    @if (!Auth::guest() && Auth::user()->hasRole('Admin'))
    <li><a href="{{ route('products.index') }}"><i class="glyphicon glyphicon-list"></i> Products</a></li>
    <li><a href="{{ route('orders.index') }}"><i class="glyphicon glyphicon-tasks"></i> Orders</a></li>
    <li><a href="{{ route('uploads.index') }}"><i class="glyphicon glyphicon-cloud-download"></i> File Manager</a></li>
    @endif
    @if(sizeof(Cart::content()) > 0 || Auth::user()->hasPendingOrders())
    <li><a href="{{ route('cart.index') }}"><i class="glyphicon glyphicon-shopping-cart"></i> Cart</a></li>
    @endif
</ul>
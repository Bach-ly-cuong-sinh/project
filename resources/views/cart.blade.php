@extends('layouts.frontend')

@section ('content')

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Cart</span></p>
        <h1 class="mb-0 bread">My Cart</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      @if (Cart::count()>=1)
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>Delete</th>
						    <th>&nbsp;</th>
						    <th>Product name</th>

						    <th>Price</th>
						    <th>Quantity</th>
						    <th>Total</th>
              </tr>
            </thead>
            @foreach (Cart::content() as $item)
            <tbody>
              <tr class="text-center">
                <td class="product-remove"><a href="delete/{{$item->rowId}}"><span class="ion-ios-close"></span></a></td>

                <td class="image-prod"><div class="img" style="background-image:url('images/{{$item->options->img}}')"></div></td>

                <td class="product-name">
                  <h3>{{$item->name}}</h3>
                </td>
                <td class="price">$ {{$item->price}}</td>
                <td class="quantity">
                  <div class="input-group mb-3">
                    <input type="text" name="quantity" class="quantity form-control input-number" value="{{$item->qty}}" min="1" max="100"
                    onchange="updateCart(this.value,'{{$item->rowId}}')">
                  </div>
                </td>

                <td class="total">$ {{$item->price*$item->qty}} </td>
              </tr><!-- END TR-->


            </tbody>
            @endforeach
          </table>
        </div>
      </div>

    </div>
    <div class="row justify-content-end">
      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <p><a href="shop.html" class="btn btn-primary py-3 px-4">Continue Shopping</a></p>
      </div>
      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <p><a href="delete/all" class="btn btn-primary py-3 px-4">Delete Cart</a></p>
      </div>
      <div class="col-lg-4 mt-5 cart-wrap ftco-animatet">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <!-- <p class="d-flex">
            <span>Subtotal</span>
            <span>$ {{Cart::subtotal()}}</span>
          </p> -->
          <!-- <p class="d-flex">
            <span>Discount</span>
            <span>{{$item->options->discount}} %</span>
          </p> -->
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span>$ {{Cart::subtotal()}}</span>
          </p>
        </div>
        <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
      </div>
    </div>
    @else
    <h1>Empty Cart!</h1>
    @endif
  </div>
</section>

<script type="text/javascript">
  function updateCart(qty,rowId){
    $.get(
      '{{asset('update')}}',
      {qty:qty,rowId:rowId},
      function(){
        location.reload();
      }
    );
  }
</script>

@endsection

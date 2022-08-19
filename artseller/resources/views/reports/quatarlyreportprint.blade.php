<!DOCTYPE html>
<html lang="en">
<head>
 <TItle>QUATARLY REPORT</TItle>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body onload="window.print()">

  
<div class="container">
    <h3 style="text-align: center;text-decoration:underline">QUATARLY REPORT</h3>
   
  <div class="row">
    <table id="" class="table">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Order Id</th>
                <th>User</th>
                <th>Product</th>
                <th>Image</th>
                <th>Store</th>
                <th>Category</th>
                <th>Payment</th>
                <th>Dates</th>
                <th>Time</th>
                <th>Payment</th>
                
                
            </tr>
        </thead>
        @foreach($orderlist as $no => $order)
        <tbody>
            <tr>
                    <td>{{ $no +1 }}</td>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->product_name }}</td>
                    <td>
                    @foreach(explode(',',$order->product_image)  as $images)
                        <img src='{{ URL('public/images/product') }}/{{ str_replace('"', '', $images); }}' alt="" height="50px" width="50px">
                         @endforeach
                    </td>
                    <td>{{ $order->store_name }}</td>
                    <td>{{ $order->category }}</td>
                    <td>{{ $order->payment }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->times }}</td>
                    <td>{{ $order->payment_method }}</td>
                   
        </tbody>
        @endforeach
        <tfoot>
    
        </tfoot>
    </table>
  </div>
</div>

</body>
</html>

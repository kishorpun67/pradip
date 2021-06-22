<!DOCTYPE html>
<html lang="en">

<body>
    <table style="width:700px;">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Hello: {{$admin_name}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>New Order has been place by {{$name}}. Customer  order details are as below:</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Order No: {{$order_id}} </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table with='95%' cellpadding="5" cellspacing="5"  bgcolor="#e0d9d9">
                    <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Product Code</td>
                        <td> Size</td>
                        <td> Color</td>
                        <td>Quantity </td>
                        <td>Unit Price</td>
                    </tr>
                    @foreach($productDetails['orders'] as $product)
                        <tr>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_size'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>{{ $product['product_qty'] }}</td>
                            <td>Rs.{{ $product['product_price'] }}.00</td>
                        </tr>

                    @endforeach
                        <tr>
                            <td colspan="5" align="right"> Shipping Charges</td>
                            <td>Rs.{{$productDetails['shipping_charges']}}.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"> Coupon Discount</td>
                            <td>
                                @if(!empty($productDetails['coupon_amount']))
                                    Rs.{{$productDetails['coupon_amount']}}.00
                                @else
                                    Rs.00.00
                                @endif
                            </td>
                        </tr>
                            <td colspan="5" align="right"> Grand Total</td>
                            <td>Rs.{{$productDetails['grand_total']}}.00</td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <td width="50%">
                        <table>
                            <tr>
                                <td><strong>Bill To:</strong></td>
                            </tr>
                            <tr>
                                <td>{{$userDetails->name}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetails->address}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetails->city}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetails->state}}</td>
                            </tr>
                            <tr>
                                <td>{{$userDetails->mobile}}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <table>
                            <tr>
                                <td><strong>Ship To:</strong></td>
                            </tr>
                            <tr>
                                <td>{{$productDetails->name}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails->address}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails->city}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails->state}}</td>
                            </tr>
                            <tr>
                                <td>{{$productDetails->mobile}}</td>
                            </tr>
                        </table>
                    </td>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>
</html>

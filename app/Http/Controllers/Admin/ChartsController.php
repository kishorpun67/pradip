<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use App\User;
use App\Order;
class ChartsController extends Controller
{

    public function userChart()
    {
        $current_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_users = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        Session::flash('page','user_chart');
        return view('admin.charts.user_chart', compact('current_month_users','last_month_users','last_to_last_month_users'));
    }

    public function ordersChart()
    {
        $current_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        // echo $current_month_orders, die;
        $last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        Session::flash('page','orders_chart');
        return view('admin.charts.orders_chart', compact('current_month_orders','last_month_orders','last_to_last_month_orders'));
    }
}

<?php

use App\Models\Category;
use App\Models\Setting;
use App\Models\Tip;
function categories($category_type)
{  
	if($category_type)
	{
		$categories = Category::select('id','category_type','category_name','created_at','updated_at')->where('category_type',$category_type)->orderBy('order_no','ASC')->get();
	}


	
	return $categories;
}


function allCategory()
{
       $categories = Category::select('id','category_type','category_name','created_at','updated_at')->orderBy('order_no','ASC')->get();
       return $categories;
}

function setting()
 {
 	if(env('DB_DATABASE') != '')
 	{
 		$count = Setting::count();
 		if($count == 0)
 		{
 			Setting::insert(['id'=>1]);
 		}
 	}
 	$setting = Setting::find(1);
 	return $setting;
 }

function totalTips()
{
	$total = Tip::count();
	return $total;
}

function todayTips()
{
	$today_tips = Tip::where('date', date('Y-m-d'))->count();
	return $today_tips;
}

function thisMonthtTips()
{
	$data = Tip::whereMonth('date', date('m'))->count();
	return $data;
}

function orderNo()
{
	$count = Category::count();
	if($count == 0)
	{
		$order_no = $count+1;
	}
	$get_order_no = Category::max('order_no');
	$order_no = $get_order_no+1;
	return $order_no;
}
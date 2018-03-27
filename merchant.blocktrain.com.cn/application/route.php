<?php
/**
 * 路由注册
 *
 * 以下代码为了尽量简单，没有使用路由分组
 * 实际上，使用路由分组可以简化定义
 * 并在一定程度上提高路由匹配的效率
 */

// 写完代码后对着路由表看，能否不看注释就知道这个接口的意义
use think\Route;

Route::get('api/:version/platform/shopDetails', 'api/:version.Platform/shopDetails');
Route::get('api/:version/platform/shoplist', 'api/:version.Platform/shoplist');
Route::get('api/:version/platform/share', 'api/:version.Platform/share');
Route::get('api/:version/login', 'api/:version.Login/login');

//核销
Route::get('api/:version/writeoff/qrcode', 'api/:version.Writeoff/qrcode');

//微信分享
Route::get('api/:version/wxshare/share', 'api/:version.Wxshare/share');

//消息入队
Route::get('api/:version/matrixs/newsPush', 'api/:version.matrixs/newsPush');
Route::get('api/:version/matrixs/newsPop', 'api/:version.matrixs/newsPop');
Route::get('api/:version/matrixs/newsClear', 'api/:version.matrixs/newsClear');
Route::get('api/:version/matrixs/testNewsPush', 'api/:version.matrixs/testNewsPush');

//Sample
//Route::get('api/:version/sample/:key', 'api/:version.Sample/getSample');
Route::get('api/:version/sample/sms', 'api/:version.Sample/sendSMS');
Route::get('api/:version/sample/test4', 'api/:version.Sample/test4');

//Order
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);
Route::get('api/:version/order/check_status', 'api/:version.Order/checkOrderStatus');
Route::get('api/:version/order/by_checker/:order_no', 'api/:version.Order/getDetailByChecker');
Route::put('api/:version/order/delivery', 'api/:version.Order/delivery');

//不想把所有查询都写在一起，所以增加by_user，很好的REST与RESTFul的区别
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');
Route::get('api/:version/order/generateOrder', 'api/:version.Order/generateOrder');
Route::get('api/:version/order/getOrder', 'api/:version.Order/getOrder');

import { Base } from '../../utils/base.js'

class OrderList extends Base {

	constructor() {
		super();
	}

	//获取课程详情
	getLesson(id, callback) {
		var params = {
			url: 'course/courseData?id=' + id,
			sCallback: function (res) {
				callback && callback(res);
			}
		}
		this.request(params);
	}


	/*获得所有订单,pageIndex 从1开始*/
	getOrders(pageIndex,callback){
	    var allParams = {
	        url: 'order/by_user',
	        data:{page:pageIndex},
	        type:'get',
	        sCallback: function (data) {
	            callback && callback(data);  //1 未支付  2，已支付  3，已发货，4已支付，但库存不足
	         }
	    };
	    this.request(allParams);
	}

	/*获得订单的具体内容*/
	getOrderInfoById(id,callback){
	    var that=this;
	    var allParams = {
	        url: 'order/'+id,
	        sCallback: function (data) {
	            callback &&callback(data);
	        },
	        eCallback:function(){

	        }
	    };
	    this.request(allParams);
	}

}

export { OrderList };
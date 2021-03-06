// var productObj = require('product-model.js');

import { Club } from 'club-model.js';

var club = new Club();  //实例化 商品详情 对象

var WxParse = require('../../wxParse/wxParse.js');

Page({
	data: {
		isFly: true,
		currentTabsIndex: 0,
		lessonIndex: 0,
		content: null,
		markers: [],
    plan:1
	},
	onLoad: function (options) {
		this.setData({
			id: options.id
		})
		this._loadData();
	},

	/*加载所有数据*/
	_loadData: function (callback) {
		var that = this;
		club.getClubInfo(this.data.id, (res) => {
			console.log(res)
			that.setData({
				clubInfo: res,
				name: res.name,
				address: res.address,
				latitude: res.latitude,
				longitude: res.longitude,
				markers: [
					{
						iconPath: "/images/icon/marks.png",
						id: res.id,
						latitude: res.latitude,
						longitude: res.longitude,
						width: 33,
						height: 33,
					}
				]
			}
			)
		});

		club.getLessonInfo(this.data.id, (res) => {
			console.log(res);
			this.setData({
				lessons: res.time
			})
			this._chooseDay(res);
			this._chooseLesson(res);
		})

	},

	//循环7天
	_chooseDay: function (data) {
		var week = [];
		var today = new Date().getUTCDay();
		switch (today) {
			case 0:
				week = ['今天', '一', '二', '三', '四', '五', '六']
				break;
			case 1:
				week = ['今天', '二', '三', '四', '五', '六', '日']
				break;
			case 2:
				week = ['今天', '三', '四', '五', '六', '日', '一']
				break;
			case 3:
				week = ['今天', '四', '五', '六', '日', '一', '二']
				break;
			case 4:
				week = ['今天', '五', '六', '日', '一', '二', '三']
				break;
			case 5:
				week = ['今天', '六', '日', '一', '二', '三', '四']
				break;
			case 6:
				week = ['今天', '日', '一', '二', '三', '四', '五']
				break;
		}
		// console.log(week);
		this.setData({
			week: week
		})
	},
	//将7天的课程列表写到数组
	_chooseLesson: function (data) {
		var lessonArr = [];
		var lesson = data.time;
		for (var i in lesson) {
			var time = i.value;
			console.log(time)
		}
	},

	//商品详情点击更多商品
	clubTap: function (event) {
		var id = club.getDataSet(event, 'id');
    var plan = club.getDataSet(event, 'plan');
		wx.navigateTo({
      url: '../product/product?id=' + id + '&plan=' + plan
		})
	},

	//切换详情面板
	onTabsItemTap: function (event) {
		var index = club.getDataSet(event, 'index');
		this.setData({
			currentTabsIndex: index
		});
	},
	//切换日期面板
	onLessonItemTap: function (event) {
		var index = club.getDataSet(event, 'index');
		this.setData({
			lessonIndex: index
		});
	},
	//点击查看地图
	onAddressTap: function (event) {
		wx.openLocation({
			latitude: Number(this.data.latitude),
			longitude: Number(this.data.longitude),
			scale: 28,
			name: this.data.name,
			address: this.data.address
		})
	},
	//打电话
	tel: function (event){
		var tel = club.getDataSet(event, 'tel');
		wx.makePhoneCall({
			phoneNumber: tel 
		})
	},

	/*提交订单*/
	//   submitOrder: function (events) {
	//     if (this.data.product.stock != 0) {
	//       //可以购买
	//       console.log(1);
	//       wx.navigateTo({
	//         url: '../order/order?productId=' + this.data.id + '&from=product'
	//       });
	//     } else {
	//       wx.showModal({
	//         title: '购买失败',
	//         content: '该商品已下架！',
	//         showCancel: false,
	//         success: function (res) {
	//           return;
	//         }
	//       });

	//     }
	//   },

	//分享效果
	onShareAppMessage: function () {
		return {
			//   title: this.data.product.name
		}
	}

})



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
	},
	onLoad: function (options) {
		this.setData({
			id: options.id,
			type: options.type,
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
				markers: [
					{
						iconPath: "/images/icon/marks.png",
						id: res.id,
						latitude: res.latitude,
						longitude: res.longitude,
						width: 16,
						height: 24,
					}
				]
			}
			)
			callback && callback();
		});

		club.getLessonInfo(this.data.id, (res) => {
			console.log(res);
			this._chooseDay(res);
			this._chooseLesson(res);
		})

	},

	//循环7天
	_chooseDay: function (data) {
		var week = ['日', '一', '二', '三', '四', '五', '六']
		var time = data.time;
		var arr = [];
		var lessonArr=[];
		for (var i in time) {
			var timer = new Date(i).getUTCDay();
			arr.push(week[timer])
			lessonArr.push(time.i)
		}
		arr[0]='今天';
		this.setData({
			timeArr: arr,
			lessonArr: lessonArr
		})
	},
	//将7天的课程列表写到数组
	_chooseLesson:function(data){
		var lessonArr=[];
		var lesson=data.time;
		for (var i in lesson) {
			var time = i.value;
			console.log(time)
		}
	},

	//商品详情点击更多商品
	clubTap: function (event) {
		var id = club.getDataSet(event, 'id');
		wx.navigateTo({
			url: '../product/product?id=' + id
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
			latitude: 39.899117,
			longitude: 116.47062,
			scale: 28,
			name: '黑弧数码文化传媒股份有限公司',
			address: '北京市朝阳区百子湾路32号二十二院街艺术区6号楼20号'
		})
	},

	/*提交订单*/
	submitOrder: function (events) {
		if (this.data.product.stock != 0) {
			//可以购买
			console.log(1);
			wx.navigateTo({
				url: '../order/order?productId=' + this.data.id + '&from=product'
			});
		} else {
			wx.showModal({
				title: '购买失败',
				content: '该商品已下架！',
				showCancel: false,
				success: function (res) {
					return;
				}
			});

		}
	},

	//分享效果
	onShareAppMessage: function () {
		return {
			title: this.data.product.name
		}
	}

})



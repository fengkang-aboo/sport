
import { Kill } from 'kill-model.js';
var kill = new Kill();

Page({

	/**
	 * 页面的初始数据
	 */
	data: {
	},

	onShow: function () {
		wx.showNavigationBarLoading() //在标题栏中显示加载
		this._loadData();
	},

	_loadData: function () {
		var that=this;
		kill.getKillList((res) => {
			wx.hideNavigationBarLoading() //完成停止加载
			wx.stopPullDownRefresh()
			if (res.status == 1) {
				that.setData({
					timeUp: true,
					killList: res.data
				})
			}else{
				this.setData({
					killList: res.data
				})
			}
			// this._date(res.start_time, res.end_time);
		});
	},

	//进入课程
	killTap: function (event) {
		var id = kill.getDataSet(event, 'id');
		var killprice = kill.getDataSet(event, 'kill');
		wx.navigateTo({
			url: '../product/product?id=' + id + '&from=kill&kill=' + killprice,
		})
	},
	//拼接后台传来的开始时间和结束时间
	// _date: function (start, end) {
	// 	var timer = null;
	// 	var that = this;
	// 	var Y = new Date().getFullYear(); //年份
	// 	var M = new Date().getMonth() + 1; //月份 
	// 	var d = new Date().getDate(); //日 
	// 	if (M < 10) {
	// 		M = '0' + M;
	// 	}
	// 	if (d < 10) {
	// 		d = '0' + d;
	// 	}
	// 	var str = Y + '-' + M + '-' + d;
	// 	var startTime = str + ' ' + start;
	// 	startTime = Date.parse(new Date(startTime));
	// 	var endTime = str + ' ' + end;
	// 	endTime = Date.parse(new Date(endTime));
	// 	//获取当前时间戳
	// 	var timestamp = Date.parse(new Date());
	// 	if (timestamp >= startTime && timestamp <= endTime) {
	// 		that.setData({
	// 			timeUp: true
	// 		})
	// 	}
	// 	wx.hideNavigationBarLoading() //完成停止加载
	// },
	//下拉刷新
	onPullDownRefresh: function () {
		wx.showNavigationBarLoading() //在标题栏中显示加载
		this._loadData();
	},
	//分享效果
	onShareAppMessage: function () {
		return {
		}
	}
})
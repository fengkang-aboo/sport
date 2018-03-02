
import { Kill } from 'kill-model.js';
var kill = new Kill();

Page({

	/**
	 * 页面的初始数据
	 */
	data: {

	},

	onLoad: function () {
		this._loadData();
	},

	_loadData: function () {
		kill.getKillList((res) => {
			this._isTime();
			this.setData({
				killList:res,
				startTime: res.start_time,
				endTime: res.end_time
			})
		});
	},

	//判断是否可以秒杀
	_isTime: function (startTime, endTime){
		var startTime = startTime;
		var endTime = endTime;
		console.log(new Date().toLocaleTimeString())
	},


	//进入场馆
	onClubItemTap: function (event) {
		var id = home.getDataSet(event, 'id');
		wx.navigateTo({
			url: '../club/club?id=' + id,
		})
	},



	//分享效果
	onShareAppMessage: function () {
		return {
		}
	}
})
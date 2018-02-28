
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
			this.setData({
				killList:res
			})
		});
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
// pages/product/product.js
import { Collection } from 'collection-model.js';
var collection = new Collection();

//引入全局变量
Page({

	/**
	 * 页面的初始数据
	 */
	data: {

	},

	/**
	 * 生命周期函数--监听页面加载
	 */
	onLoad: function (options) {
		var longitude = wx.getStorageSync('longitude');
		var latitude = wx.getStorageSync('latitude')
		this.setData({
			longitude: longitude,
			latitude: latitude
		})
		this._loadData(longitude, latitude);
	},

	_loadData: function (longitude, latitude) {
		collection.getClubList(longitude, latitude, (res) => {
			console.log(res);
			// this.setData({
				
			// })
		})
	},

})
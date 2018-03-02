// pages/product/product.js
import { Search } from 'search-model.js';
var search = new Search();

//引入全局变量
Page({

	/**
	 * 页面的初始数据
	 */
	data: {
		currentTabsIndex: 0,
		isSearch:false,
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

		//获取热搜
		search.getHotSearch((res) => {
			this.setData({
				hot:res
			})
		})

		search.getClubList(longitude, latitude, (res) => {
			console.log(res);
			this.setData({

			})
		})

	},

	//搜索
	search:function(event){
		var value = event.detail.value

	},
	//切换详情面板
	onTabsItemTap: function (event) {
		var index = search.getDataSet(event, 'index');
		this.setData({
			currentTabsIndex: index
		});
	},

})
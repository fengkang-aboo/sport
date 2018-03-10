// pages/product/product.js
import { Collection } from 'collection-model.js';
import { Home } from '../home/home-model.js';
var collection = new Collection();
var home = new Home();

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
	onShow: function (options) {
		wx.showNavigationBarLoading() //在标题栏中显示加载
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
			wx.hideNavigationBarLoading() //完成停止加载
			if(res.code!=404){
				this.setData({
					collection: res
				})
			}
		})
	},

	//收藏
	collection: function (event) {
		var status = home.getDataSet(event, 'status');
		var id = home.getDataSet(event, 'id');
		var index = home.getDataSet(event, 'index');
		if (status == 1) {
			//已收藏，点击取消收藏
			home.cancle(id, (res) => {
				console.log(res);
				if (res.code == 200) {
					this.data.collection[index].status = 2;
					this.setData({
						collection: this.data.collection
					});
					wx.showToast({
						title: '已取消收藏！',
						icon: 'success',
						duration: 1000
					})
				} else {
					wx.showModal({
						title: '区块练',
						content: res.msg,
						showCancel: false,
						success: function (res) {
							return;
						}
					})
				}
			})
		} else {
			//未收藏，点击已收藏
			home.add(id, (res) => {
				console.log(res);
				if (res.code == 200) {
					this.data.collection[index].status = 1;
					this.setData({
						collection: this.data.collection
					});
					wx.showToast({
						title: '已加入收藏！',
						icon: 'success',
						duration: 1000
					})
				} else {
					wx.showModal({
						title: '区块练',
						content: res.msg,
						showCancel: false,
						success: function (res) {
							return;
						}
					})
				}
			})
		}
	},

	//进入
	tap:function(event){
		var id = home.getDataSet(event, 'id');
		wx.navigateTo({
			url: '../club/club?id=' + id,
		})
	}

})
// home.js

import { Home } from 'home-model.js';
var home = new Home();
//引入全局变量
import { Config } from "../../utils/config.js";

Page({

	/**
	 * 页面的初始数据
	 */
	data: {
		cityName: null,
		adcode: 0,
		longitude: 0,
		latitude: 0,
		markers: []
	},

	onLoad: function () {
		//地理定位
		var that = this;
		wx.getLocation({
			type: 'gcj02', //返回可以用于wx.openLocation的经纬度
			success: function (res) {
				var latitude = res.latitude;
				var longitude = res.longitude;
				wx.setStorageSync('latitude', latitude)
				wx.setStorageSync('longitude', longitude)
				//获取数据
				that._loadData(longitude, latitude);
				that.setData({
					longitude: longitude,
					latitude: latitude
				})
			},
			fail: function () {
				Config.cityName = '北京市';
				Config.cityCode = 0;
				that.setData({
					cityName: '北京市',
					adcode: 0
				})
			}
		})
	},

	_loadData: function (longitude, latitude) {
		home.getClubList(longitude, latitude, (res) => {
			this._drawMap(res);
			this.setData({
				clubList: res
			});
		});
	},
	//地图描点
	_drawMap: function (data) {
		console.log(data);
		var markers = [];
		for (var i = 0; i < data.length; i++) {
			var mark = {
				iconPath: "/images/icon/marks.png",
				id: data[i].id,
				latitude: data[i].latitude,
				longitude: data[i].longitude,
				width: 16,
				height: 24,
				callout: {
					content: data[i].name,
					color: '#fff',
					fontSize: '14',
					borderRadius: '5',
					bgColor: '#00b4d0',
					padding: '5',
					display: 'BYCLICK',
					textAlign: 'center'
				}
			};
			markers.push(mark)
		}
		// console.log(markers)
		this.setData({
			markers: markers
		})
	},
	//点击地图放大
	bindtap: function () {
		wx.navigateTo({
			url: '../map/map?longitude=' + this.data.longitude + '&latitude=' + this.data.latitude,
		})
	},

	//进入场馆
	onClubItemTap: function (event) {
		var id = home.getDataSet(event, 'id');
		wx.navigateTo({
			url: '../club/club?id=' + id,
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
					this.data.clubList[index].collection.status = 2;
					this.setData({
						clubList: this.data.clubList
					});
					wx.showToast({
						title: '已取消收藏！',
						icon: 'success',
						duration: 1000
					})
				} else {
					wx.showModal({
						title: '黑弧文艺社',
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
					this.data.clubList[index].collection.status = 1;
					console.log(this.data.clubList[index].collection.status)
					this.setData({
						clubList: this.data.clubList
					});
					wx.showToast({
						title: '已加入收藏！',
						icon: 'success',
						duration: 1000
					})
				} else {
					wx.showModal({
						title: '黑弧文艺社',
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

	//分享效果
	onShareAppMessage: function () {
		return {
		}
	}
})
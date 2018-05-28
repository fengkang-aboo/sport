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
		markers: [],
		isNew:false,
		First:true,
		Second:false,
    red_bag:0,
	},
	onLoad: function () {
		wx.showNavigationBarLoading() //在标题栏中显示加载
		//地理定位
		var that = this;
		wx.getLocation({
			type: 'gcj02', //返回可以用于wx.openLocation的经纬度
			success: function (res) {
				var latitude = res.latitude;
				var longitude = res.longitude;
				wx.setStorageSync('latitude', latitude)
				wx.setStorageSync('longitude', longitude)
				that.setData({
					longitude: longitude,
					latitude: latitude
				})
				that._loadData(longitude, latitude);
			},
			fail: function () {
				that.retryGetLocation();
			}
		})
	},
	//重新获取地理定位
	retryGetLocation: function () {
		var that = this;
		wx.showModal({
			title: '警告',
			content: '本服务基于您的地理位置为您推荐健身场馆，请务必开启地理定位权限！',
			showCancel: false,
			success: function (res) {
				if (res.confirm) {
					wx.openSetting({
						success: (res) => {
							if (res.authSetting["scope.userLocation"]) {////如果用户重新同意了授权登录
								wx.getLocation({
									type: 'gcj02', //返回可以用于wx.openLocation的经纬度
									success: function (res) {
										var latitude = res.latitude;
										var longitude = res.longitude;
										wx.setStorageSync('latitude', latitude)
										wx.setStorageSync('longitude', longitude)
										that.setData({
											longitude: longitude,
											latitude: latitude
										})
										that._loadData(longitude, latitude);
									},
									fail: function () {
										wx.setStorageSync('latitude', 31.236134)
										wx.setStorageSync('longitude', 121.466781)
										that.setData({
											longitude: 121.466781,
											latitude: 31.236134
										})
										that._loadData(121.466781, 31.236134);
									}
								})
							} else {
								//用户依然不同意授权
								wx.showModal({
									title: '警告',
									content: '您拒绝了向我们提供您的地理位置，您可以在“我的”页面重新进行授权！',
									showCancel: false,
									success: function () {
										return;
									}
								})
								wx.setStorageSync('latitude', 31.236134)
								wx.setStorageSync('longitude', 121.466781)
								that.setData({
									longitude: 121.466781,
									latitude: 31.236134
								})
								that._loadData(121.466781, 31.236134);
							}
						},
						fail: function (res) {
							wx.setStorageSync('latitude', 31.236134)
							wx.setStorageSync('longitude', 121.466781)
							that.setData({
								longitude: 121.466781,
								latitude: 31.236134
							})
							that._loadData(121.466781, 31.236134);
						}
					})
				}
			}
		})
	},
	onShow: function () {
		var longitude = wx.getStorageSync('longitude');
		var latitude = wx.getStorageSync('latitude');
		this.setData({
			longitude: longitude,
			latitude: latitude
		})
		if (longitude && latitude) {
			wx.showNavigationBarLoading() //在标题栏中显示加载
			this._loadData(this.data.longitude, this.data.latitude);
		}
	},
	//下拉刷新
	// onPullDownRefresh: function () {
	// 	wx.showNavigationBarLoading() //在标题栏中显示加载
	// 	this._loadData(longitude, latitude);
	// },

	_loadData: function (longitude, latitude) {
		home.getClubList(longitude, latitude, (res) => {
			wx.hideNavigationBarLoading() //完成停止加载
			this._drawMap(res);
      var red_bag = res.red_bag;
      if (red_bag!=0){
        //新用户
        this.setData({
          clubList: res,
          red_bag: res.red_bag,
          isNew:true
        });
      }else{
        this.setData({
          clubList: res,
          red_bag: res.red_bag,
          isNew: false
        });
      }
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
				width: 33,
				height: 33,
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
	//搜索
	search: function () {
		wx.navigateTo({
			url: '../search/search',
		})
	},

	//红包领取
	redBagfirst(){
    home.receiveBag(this.data.red_bag,(res)=>{
      congsole.log(res);
    });
		// this.setData({
		// 	First:false,
		// 	Second:true
		// })
	},
	//红包去使用
	goForUse(){
		this.setData({
			isNew: !this.data.isNew
		})
	},
	//红包关闭
	redBagClose(){
		this.setData({
			isNew: !this.data.isNew
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
				if (res.code == 200) {
					this.data.clubList[index].collect = 2;
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
					this.data.clubList[index].collect = 1;
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

	//分享效果
	onShareAppMessage: function () {
		return {
		}
	}
})
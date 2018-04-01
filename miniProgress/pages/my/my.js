// my.js

import { Address } from '../../utils/address.js';
import { Order } from '../order/order-model.js';
import { My } from 'my-model.js';

var address = new Address();
var order = new Order();
var my = new My();

Page({

    /**
     * 页面的初始数据
     */
	data: {
		loadingHidden: false,
		again: true
	},

    /**
     * 生命周期函数--监听页面加载
     */
	onLoad: function (options) {
		this._loadData();
		// this._getUserAddressInfo();
	},
	_loadData: function () {
		var that = this;
		wx.login({
			success: function () {
				wx.getUserInfo({
					success: function (res) {
						console.log(res);
						that._postData(res);
						that.setData({
							nickName: res.userInfo.nickName,
							avatarUrl: res.userInfo.avatarUrl,
							loadingHidden: true
						})
					},
					fail: function (res, callBack) {
						wx.showModal({
							title: '警告',
							content: '您点击了拒绝授权,将无法正常显示个人信息,点击确定重新获取授权。',
							success: function (res) {
								if (res.confirm) {
									wx.openSetting({
										success: (res) => {
											if (res.authSetting["scope.userInfo"]) {////如果用户重新同意了授权登录
												wx.getUserInfo({
													success: function (res) {
														that._postData(res);
														that.setData({
															nickName: res.userInfo.nickName,
															avatarUrl: res.userInfo.avatarUrl,
															loadingHidden: true
														})
													},
												})
											}else{
												that.setData({
													loadingHidden: true,
													nickName: '区块练',
													avatarUrl: '../../images/icon/user@default.png',
												})
											}
										},
										fail: function (res) {
											that.setData({
												loadingHidden: true,
												nickName: '区块练',
												avatarUrl: '../../images/icon/user@default.png',
											})
										}
									})
								}else{
									that.setData({
										loadingHidden: true,
										nickName: '区块练',
										avatarUrl: '../../images/icon/user@default.png',
									})
								}
							}
						})
					}
				})
			},
			fail: function () {
				that.setData({
					loadingHidden: true,
					nickName: '区块练',
					avatarUrl: '../../images/icon/user@default.png',
				})
			}
		})
	},

	//向后台发送用户数据
	_postData: function (data) {
		// console.log(data);
		var info = data.userInfo;
		var that = this;
		my.postData(info, (res) => {
			if (res.code == 2 && that.data.again) {
				that.setData({
					again: false
				})
				my.postData(info, (res) => {
					console.log(res);
				})
			}
		})
	},

	//授权管理
	onAuthorizationTap:function(){
		var that=this;
		wx.openSetting({
			success: (res) => {
				if (res.authSetting["scope.userInfo"]) {////如果用户重新同意了授权登录
					wx.getUserInfo({
						success: function (res) {
							that._postData(res);
							that.setData({
								nickName: res.userInfo.nickName,
								avatarUrl: res.userInfo.avatarUrl,
								loadingHidden: true
							})
						},
					})
				};
				if (res.authSetting["scope.userLocation"]){
					wx.getLocation({
						type: 'gcj02', //返回可以用于wx.openLocation的经纬度
						success: function (res) {
							var latitude = res.latitude;
							var longitude = res.longitude;
							wx.setStorageSync('latitude', latitude)
							wx.setStorageSync('longitude', longitude)
						},
						fail: function () {
							wx.setStorageSync('latitude', 31.236134)
							wx.setStorageSync('longitude', 121.466781)
						}
					})
				}
			},
			fail: function (res) {
				that.setData({
					loadingHidden: true,
					nickName: '区块练',
					avatarUrl: '../../images/icon/user@default.png',
				})
			}
		})
	},

	//进入我的订单
	onMyOrderTap: function () {
		wx.navigateTo({
			url: '../my-order/my-order',
		})
	},
	//常见问题
	onQuestionTap: function () {
		wx.navigateTo({
			url: '../question/question',
		})
	},
	//关于我们
	onAboutTap: function () {
		wx.navigateTo({
			url: '../about/about',
		})
	},
	//用户协议
	onAgreementTap: function () {
		wx.navigateTo({
			url: '../agreement/agreement',
		})
	},
	//收藏
	onCollectionTap: function () {
		wx.navigateTo({
			url: '../collection/collection',
		})
	},
	//卡券
	onCardTap(){
		wx.navigateTo({
			url: '../card/card',
		})
	},
	//切换
	onChange:function(){
		wx.navigateToMiniProgram({
			appId: 'wxbfef62f9fafd9057',
			path: 'pages/home/home',
			envVersion: 'release',
			success(res) {
				// 打开成功
			},
			fail(res) {
				
			},
		})
	},
    /**
     * 用户点击右上角分享
     */
	onShareAppMessage: function () {

	}
})
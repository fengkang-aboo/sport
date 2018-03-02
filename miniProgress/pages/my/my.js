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
											}
										},
										fail: function (res) {
											that.setData({
												loadingHidden: true,
												nickName: 'Literature',
												avatarUrl: '../../images/icon/user@default.png',
											})
										}
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
					nickName: 'Literature',
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

	//获取用户地址信息
	// _getUserAddressInfo: function () {
	// 	address.getAddress((res) => {
	// 		this._bindAddressInfo(res);
	// 	})
	// },
	//绑定用户地址信息
	// _bindAddressInfo: function (res) {
	// 	this.setData({
	// 		addressInfo: res
	// 	})
	// },
	/*修改或者添加地址信息*/
	// editAddress: function (event) {
	// 	var that = this;
	// 	wx.chooseAddress({
	// 		success: function (res) {
	// 			var addressInfo = {
	// 				name: res.userName,
	// 				mobile: res.telNumber,
	// 				totalDetail: address.setAddressInfo(res)
	// 			};
	// 			if (res.telNumber) {
	// 				that._bindAddressInfo(addressInfo);
	// 				//保存地址
	// 				address.submitAddress(res, (flag) => {
	// 					if (!flag) {
	// 						that.showTips('操作提示', '地址信息更新失败！');
	// 					}
	// 				});
	// 			}
	// 			//模拟器上使用
	// 			else {
	// 				that.showTips('操作提示', '地址信息更新失败,手机号码信息为空！');
	// 			}
	// 		},
	// 		fail: function (res) {
	// 			wx.getSetting({
	// 				success: (res) => {
	// 					if (!res.authSetting["scope.address"]) {
	// 						wx.showModal({
	// 							title: '警告',
	// 							content: '您点击了拒绝授权,将无法查看并管理地址信息，点击确定重新获取授权。',
	// 							success: function (res) {
	// 								if (res.confirm) {
	// 									wx.openSetting({
	// 										success: (res) => {
	// 											// console.log(res);
	// 										},
	// 										fail: function (res) {

	// 										}
	// 									})
	// 								}
	// 							}
	// 						})
	// 					};
	// 				},
	// 				fail: function (res) {

	// 				}
	// 			})
	// 		}
	// 	})
	// },
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
	onCollectionTap: function () {
		wx.navigateTo({
			url: '../collection/collection',
		})
	},
    /**
     * 用户点击右上角分享
     */
	onShareAppMessage: function () {

	}
})
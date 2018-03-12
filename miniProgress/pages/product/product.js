// pages/product/product.js
import { Product } from 'product-model.js';
var product = new Product();
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
		var id = options.id;
		var from = options.from;
		if (from == 'kill') {
			var kill = options.kill;
			this.setData({
				id: id,
				kill: kill
			})
		} else {
			this.setData({
				id: id,
			})
		}
		this._loadData(id);
	},

	_loadData: function (id) {
		product.getLesson(id, (res) => {
			console.log(res);
			this.setData({
				product: res
			})
		})
	},


	goOrder: function (event) {
		if (this.data.product.stock > 0) {
			var id = this.data.id;
			if (this.data.kill) {
				wx.navigateTo({
					url: '../order/order?id=' + id + '&from=kill&kill=' + this.data.kill,
				})
			} else {
				wx.navigateTo({
					url: '../order/order?id=' + id,
				})
			}
		}else{
			wx.showModal({
				title: '区块练',
				content: '对不起，该商品已售完！',
				showCancel: false,
				success:function(){
					return;
				}
			})

		}
	}

})
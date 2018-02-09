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
    var id=options.id;
    this.setData({
      id:id
    })
    this._loadData(id);
	},

  _loadData: function (id){
    product.getLesson(id,(res)=>{
      console.log(res);
      this.setData({
        product:res
      })
    })
  },


  goOrder: function (event) {
    var id = this.data.id;
		wx.navigateTo({
			url: '../order/order?id='+id,
		})
	}


})
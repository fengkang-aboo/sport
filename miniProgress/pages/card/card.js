import { Card } from 'card-model.js';

var card = new Card();  //实例化 商品详情 对象


Page({
  data: {
    currentTabsIndex: 0,
  },
  onLoad: function (options) {
    // this.setData({
    //   id: options.id
    // })
    // this._loadData();
  },

  /*加载所有数据*/

  //切换详情面板
  onTabsItemTap: function (event) {
    var index = card.getDataSet(event, 'index');
    this.setData({
      currentTabsIndex: index
    });
  },

  //分享效果
  onShareAppMessage: function () {
    return {
      //   title: this.data.product.name
    }
  }

})



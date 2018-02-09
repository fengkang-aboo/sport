import { Order } from '../order/order-model.js';

var order = new Order();

Page({
  data: {
    id: null,
    countsArray: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    countValue: 1,
    productPrice: 0,    //商品单价
    sumMoney: 0,     //用户选择数量后总价
    orderStatus: 0,   //订单状态，0还未生成订单，刚从商品详情过来，可以修改地址，1未支付，2已支付
    isCanPay: true,
  },

  /*
  * 订单数据来源包括两个：
  * 1.直接下单
  * 2.旧的订单5
  * */
  onLoad: function (options) {
    var id = options.id;
    this._getProduct(id);
    this.setData({
      id: id,
    })
  },
  //获取详情
  _getProduct: function (id) {
    var that = this;
    order.getLesson(id, (res) => {
      let multiple = 100;
      var price = res.discount_price ? res.discount_price : res.price;
      var sumMoney = Number(price) * multiple * Number(this.data.countValue) * multiple;
      this.setData({
        product: res,
        productPrice: price,
        sumMoney: sumMoney / (multiple * multiple)
      })
    })
  },



  //选择商品数量
  bindPickerCount: function (e) {
    var val = e.detail.value;
    this.setData({
      countValue: this.data.countsArray[val],
    })
    //选择完数量计算价格
    let multiple = 100;
    let sumMoney = Number(this.data.countsArray[val]) * multiple * Number(this.data.productPrice) * multiple;
    //选择完之后更新价格
    this.setData({
      sumMoney: sumMoney / (multiple * multiple)
    })
  },

  //获取姓名
  userNameInput: function (e) {
    this.setData({
      name: e.detail.value
    })
  },
  //获取手机号：
  userTelInput: function (e) {
    this.setData({
      tel: e.detail.value
    })
  },

  /*下单和付款*/
  pay: function () {
    if (this.data.orderStatus == 0) {
      this._firstTimePay();
    } else {
      this._oneMoresTimePay();
    }
  },

  /*第一次支付*/
  _firstTimePay: function () {		
    if (this.data.name && this.data.tel) {
      var myreg = /^[1][3,4,5,7,8][0-9]{9}$/; 
      if (myreg.test(this.data.tel)){
        //将要发送的订单数据数组下标转化为具体值
        var orderInfo = [{}];
        orderInfo[0]['product_id'] = this.data.id;		//商品id
        orderInfo[0]['count'] = this.data.countValue;		//数量
        orderInfo[0]['parameterA'] = this.data.name;	//规格
        orderInfo[0]['parameterB'] = this.data.tel;		//快递方式 
        orderInfo[0]['type'] = 0;							//固定为0
        this.doOrder(orderInfo);
      }else{
        wx.showModal({
          title: '黑弧文艺社',
          content: '手机号码错误！',
          showCancel: false,
          success: function (res) {
            return;
          }
        })
      }
    } else {
      wx.showModal({
        title: '黑弧文艺社',
        content: '请先填写预约信息！',
        showCancel: false,
        success: function (res) {
          return;
        }
      })
    }
  },
  //支付
  doOrder: function (orderInfo) {
    var that = this;
    // 支付分两步，第一步是生成订单号，然后根据订单号支付
    order.doOrder(orderInfo, (data) => {
      console.log(data);
      this.data.orderId = data.order_id;
      //订单生成成功
      if (data.pass) {
        //更新订单状态
        var id = data.order_id;
        that.data.orderId = id;
        that.data.fromProductFlag = false;
        //开始支付
        that._execPay(id);
      } else {
        that._orderFail(data);  // 下单失败
      }
    });
  },
  /*
  *下单失败
  * params:
  * data - {obj} 订单结果信息
  * */
  _orderFail: function (data) {
    this.setData({
      isCanPay: false
    })
    var str = this.data.productDetailInfo.name + this.data.productDetailInfo.describe;
    str += ' 缺货';
    wx.showModal({
      title: '下单失败',
      content: str,
      showCancel: false,
      success: function (res) {

      }
    });
  },

  /* 再次次支付*/
  _oneMoresTimePay: function () {
    this._execPay(this.data.orderId);
  },

  /*
  *开始支付
  * params:
  * id - {int}订单id
  */
  _execPay: function (id) {
    if (!order.onPay) {
      this.showTips('支付提示', '本产品仅用于演示，支付系统已屏蔽', true);//屏蔽支付，提示
      return;
    }
    var that = this;
    order.execPay(id, (statusCode) => {
      //1未支付，2已支付,0未生成订单
      if (statusCode != 0) {
        var flag = statusCode == 2;
        wx.redirectTo({
          url: '../pay-result/pay-result?id=' + id + '&flag=' + flag + '&from=order'
        });
      }
    });
  },

  onShow: function () {
  },

  /*修改或者添加地址信息*/
  editAddress: function () {
    console.log('editAddress')
    var that = this;
    wx.chooseAddress({
      success: function (res) {
        var addressInfo = {
          name: res.userName,
          mobile: res.telNumber,
          totalDetail: address.setAddressInfo(res)
        };
        that._bindAddressInfo(addressInfo);

        //保存地址
        address.submitAddress(res, (flag) => {
          if (!flag) {
            that.showTips('操作提示', '地址信息更新失败！');
          }
        });
      }
    })
  },




  /*
  * 提示窗口
  * params:
  * title - {string}标题
  * content - {string}内容
  * flag - {bool}是否跳转到 "我的页面"
  */
  showTips: function (title, content, flag) {
    wx.showModal({
      title: title,
      content: content,
      showCancel: false,
      success: function (res) {
        if (flag) {
          wx.switchTab({
            url: '/pages/my/my'
          });
        }
      }
    });
  }



})


import { Base } from '../../utils/base.js';

class Home extends Base {

  constructor() {
    super();
  }

  //根据经纬度获取场馆列表
  getClubList(longitude, latitude, callback) {
    var params = {
      url: 'venue/venueList?longitude=' + longitude + '&latitude=' + latitude,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }

  //取消收藏
  cancle(id, callback){
    var params = {
      url: 'collection/cancel?id=' + id,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }

  //加入收藏
  add(id, callback) {
    var params = {
      url: 'collection/collect?id=' + id,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }

  //领取红包
  receiveBag(id, callback){
    var params = {
      url: 'redbag/receiveRedBagen?red_bag_id=' + id,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }
}
export { Home };
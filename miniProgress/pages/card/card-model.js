
import { Base } from '../../utils/base.js';

class Card extends Base {
  constructor() {
    super();
  }
  //获取场馆详情
  // getUserCard(id, callback) {
  //   var param = {
  //     url: 'venue/' + id,
  //     sCallback: function (res) {
  //       callback && callback(res);
  //     }
  //   };
  //   this.request(param);
  // }

  //获取七天内课程列表
  // getClubCard(id, callback) {
  //   var param = {
  //     url: 'course/courseTimeList?id=' + id,
  //     sCallback: function (res) {
  //       callback && callback(res);
  //     }
  //   };
  //   this.request(param);
  // }
  // 获取红包
  getRedBag(id, callback) {
    var params = {
      url: 'redbag/userRedBag',
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }
  // 获取商家红包
  getSellRedBag(id, callback) {
    var params = {
      url: 'course/courseData?id=' + id,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }
};

export { Card }

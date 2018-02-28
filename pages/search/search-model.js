
import { Base } from '../../utils/base.js';

class Search extends Base {

  constructor() {
    super();
  }

  //获取热搜
  getHotSearch(callback) {
	  var params = {
		  url: 'course/courseHot',
		  sCallback: function (res) {
			  callback && callback(res);
		  }
	  }
	  this.request(params);
  }

  //根据经纬度获取场馆列表
  getClubList(longitude, latitude, callback) {
    var params = {
      url: 'collection/collectionList?longitude=' + longitude + '&latitude=' + latitude,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }

}
export { Search };
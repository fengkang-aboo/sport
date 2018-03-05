
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
  getHotClub(callback){
    var params = {
      url: 'venue/key_word',
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }

  //搜索
  search(type, info, longitude,latitude,callback) {
    var params = {
      url: 'search?type=' + type + '&info=' + info + '&longitude=' + longitude + '&latitude=' + latitude,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }

}
export { Search };
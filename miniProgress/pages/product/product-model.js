
import { Base } from '../../utils/base.js';

class Product extends Base {

  constructor() {
    super();
  }

  //获取课程详情
  getLesson(id, callback) {
    var params = {
      url: 'course/courseData?id='+id,
      sCallback: function (res) {
        callback && callback(res);
      }
    }
    this.request(params);
  }
}
export { Product };
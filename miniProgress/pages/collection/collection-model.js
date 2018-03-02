
import { Base } from '../../utils/base.js';

class Collection extends Base {

	constructor() {
		super();
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
export { Collection };

import { Base } from '../../utils/base.js';

class Search extends Base {

	constructor() {
		super();
	}

	//获取分类
	getType(callback) {
		var params = {
			url: 'search/type',
			sCallback: function (res) {
				callback && callback(res);
			}
		}
		this.request(params);
	}
	//获取功效
	getEffect(callback) {
		var params = {
			url: 'search/effect',
			sCallback: function (res) {
				callback && callback(res);
			}
		}
		this.request(params);
	}

	//搜索
	search(name, effect_id, type_id,longitude, latitude, callback) {
		var params = {
			url: 'search?name=' + name + '&effect_id=' + effect_id + '&type_id=' + type_id + '&longitude=' + longitude + '&latitude=' + latitude,
			sCallback: function (res) {
				callback && callback(res);
			}
		}
		this.request(params);
	}

}
export { Search };

import { Base } from '../../utils/base.js';

class Kill extends Base {

	constructor() {
		super();
	}

	//根据经纬度获取秒杀列表
	getKillList(callback) {
		var params = {
			url: 'seckill/lists',
			sCallback: function (res) {
				callback && callback(res);
			}
		}
		this.request(params);
	}

}
export { Kill };
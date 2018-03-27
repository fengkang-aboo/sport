// pages/product/product.js
import { Search } from 'search-model.js';
var search = new Search();

//引入全局变量
Page({

	/**
	 * 页面的初始数据
	 */
	data: {
		currentTabsIndex: 0,
		isSearch: false,
		effectStatus: [],
		typeStatus: [],
		name:''
	},

	/**
	 * 生命周期函数--监听页面加载
	 */
	onLoad: function (options) {
		wx.showNavigationBarLoading() //在标题栏中显示加载
		var longitude = wx.getStorageSync('longitude');
		var latitude = wx.getStorageSync('latitude')
		this.setData({
			longitude: longitude,
			latitude: latitude
		})
		this._loadData(longitude, latitude);
	},

	_loadData: function (longitude, latitude) {
		//获取热搜
		search.getEffect((res) => {
			if (res.code == 200) {
				this.setData({
					effect: this.echoStatus(res.data)
				})
				wx.hideNavigationBarLoading() //完成停止加载
			}

		})
		search.getType((res) => {
			if (res.code == 200) {
				this.setData({
					type: this.echoStatus(res.data)
				})
			}
		})
	},

	//循环获取初始状态
	echoStatus: function (data) {
		let arr = [];
		for (let i = 0; i < data.length; i++) {
			let obj = new Object;
			obj['name'] = data[i].name;
			obj['id'] = data[i].id;
			obj['checked'] = false;
			arr.push(obj);
		}
		return arr;
	},

	//功效选中
	effectSelect: function (event) {
		var index = search.getDataSet(event, 'index');
		var id = search.getDataSet(event, 'id');
		this.data.effect[index].checked = !this.data.effect[index].checked;
		this.setData({
			effect: this.data.effect
		})
	},

	// 分类选中
	typeSelect: function (event) {
		var index = search.getDataSet(event, 'index');
		var id = search.getDataSet(event, 'id');
		this.data.type[index].checked = !this.data.type[index].checked;
		this.setData({
			type: this.data.type
		})
	},
	//输入框
	onInput: function (event) {
		var value = event.detail.value;
		this.setData({
			name: value
		})
	},
	bindfocus(event){
		this.setData({
			isSearch: false,
			name: ''
		})
	},

	//点击搜索获取功效和分类id
	getSearchId(data) {
		var arr = [];
		for (let i = 0; i < data.length; i++) {
			if (data[i].checked) {
				arr.push(data[i].id)
			}
		}
		return arr.toString();
	},

	//输入搜索
	search: function (event) {
		let effectId = this.getSearchId(this.data.effect) ? this.getSearchId(this.data.effect) : '';
		let typeId = this.getSearchId(this.data.type) ? this.getSearchId(this.data.type) : '';
		let name = this.data.name ? this.data.name : '';
		if (effectId || typeId || name) {
			search.search(name, effectId, typeId, this.data.longitude, this.data.latitude, (res) => {
				if (res.code == 200) {
					this.setData({
						isSearch: true,
						lessonList: res.data.courseData,
						clubList: res.data.venue
					})
				}else{
					wx.showModal({
						title: '提示',
						content: res.msg,
						showCancel: false,
						success: function (res) {
							return;
						}
					})
				}
			})
		} else {
			wx.showModal({
				title: '提示',
				content: '请先选择或输入搜索内容',
				showCancel: false,
				success: function (res) {
					return;
				}
			})
		}
	},

	//进入场馆
	clubTap: function (event) {
		var id = search.getDataSet(event, 'id');
		wx.navigateTo({
			url: '../club/club?id=' + id,
		})
	},
	//进入课程
	lessonTap: function (event) {
		var id = search.getDataSet(event, 'id');
		wx.navigateTo({
			url: '../product/product?id=' + id,
		})
	},
	//切换详情面板
	onTabsItemTap: function (event) {
		var index = search.getDataSet(event, 'index');
		this.setData({
			currentTabsIndex: index
		});
	},

})
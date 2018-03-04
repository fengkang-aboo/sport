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
		isSearch:false,
	},

	/**
	 * 生命周期函数--监听页面加载
	 */
	onLoad: function (options) {
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
		search.getHotSearch((res) => {
			this.setData({
				hotLesson:res
			})
		})
    search.getHotClub((res) => {
      this.setData({
        hotClub: res
      })
    })
	},

  //输入框
  onInput:function(event){
    var value = event.detail.value;
    if(value.length>0){
      this.setData({
        isSearch: true
      })
    }else{
      this.setData({
        isSearch: false,
        lessonList: [],
        clubList: []
      })
    }
  },

	//输入搜索
	search:function(event){
		var value = event.detail.value;
    if(value){
      search.search(1,value,this.data.longitude, this.data.latitude, (res) => {
        this.setData({
          lessonList: res.data.courseData,
          clubList: res.data.venue
        })
      })
    }
	},

  //点击课程标签
  lessonLabel:function(event){
    var id = search.getDataSet(event, 'id');
    this.setData({
      isSearch: true
    })
    search.search(2, id, this.data.longitude, this.data.latitude, (res) => {
      this.setData({
        lessonList: res.data.courseData,
        clubList: res.data.venue
      })
    })
  },
  //点击场馆标签
  clubLabel: function (event) {
    var id = search.getDataSet(event, 'id');
    this.setData({
      isSearch: true
    })
    search.search(3, id, this.data.longitude, this.data.latitude, (res) => {
      this.setData({
        lessonList: res.data.courseData,
        clubList: res.data.venue
      })
    })
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
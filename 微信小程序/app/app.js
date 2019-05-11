/**
 * App() 函数
 * 
 * 用来注册一个小程序。接受一个 object 参数，其指定小程序的生命周期函数等。
 * @param onLaunch // 当小程序初始化完成时，会触发 onLaunch（全局只触发一次）
 * @param onShow   // 当小程序启动，或从后台进入前台显示，会触发 onShow
 * @param onHide   // 当小程序从前台进入后台，会触发 onHide
 * @param getUserInfo // 获取用户信息
 * 
 */
App({
  onLaunch: function () {
  
  },

	onLaunch: function() {
	
	},

	onShow: function() {
	
	},

	onHide: function() {
		
	},
	getUserInfo: function(cb) {
		var that = this
		if (this.globalData.userInfo) {
			typeof cb == "function" && cb(this.globalData.userInfo)
		} else {
			//调用登录接口
			wx.login({
				success: function(r) {
         
					// 获取用户信息 
					wx.getUserInfo({
						success: function(res) {
							that.globalData.userInfo = res.userInfo
							typeof cb == "function" && cb(that.globalData.userInfo) 

              //获取用户openid
              wx.request({
                url: 'https://liuyuhang.xin/lyzg/public/index.php/wxapi/login/get',
                data: {
                  'code': r.code,
                },
                method: 'GET',
                success: function (res_openid) {
                  wx.setStorageSync('openId', res_openid.data);  
                  //存贮用户信息
                  wx.request({
                    url: 'https://liuyuhang.xin/lyzg/public/index.php/wxapi/spuser/insert_user',
                    data: {
                      'openid': res_openid.data,
                      'nickname': res.userInfo.nickName,
                      'avatarurl': res.userInfo.avatarUrl,
                      'gender': res.userInfo.gender,
                      'city': res.userInfo.city,
                      'province': res.userInfo.province,
                      'country': res.userInfo.country,
                      'language': res.userInfo.language,
                    },
                    method: 'GET',
                    success: function (res_user) {
                      // console.log(res_user);
                    },
                    fail: function (res_user) {
                      console.log('no');
                    },
                  })
                  
                },
                fail: function (res_openid) {
                  console.log('no');
                },
              })

						}
					})

				}
    	})
		}

   


    
	},



 
	globalData: {
		userInfo: null,
		openId: ''
	}
})
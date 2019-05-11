Page({
  data: {
    invitation: '',
    modalHidden: true
  },
  changeInput: function (e) {
    this.setData({
      invitation: e.detail.value
    })
  },
  modalChange: function (e) {
    this.setData({
      modalHidden: true
    })
  },
  next: function () {
    var invitation = this.data.invitation;
    
    if (/^[0-9A-Za-z]+$/.test(invitation)) {
      wx.navigateTo({
        url: '/pages/add/add?taskID=' + invitation,
        success: function(res){
          // success
        },
        fail: function() {
          // fail
        },
        complete: function() {
          // complete
        }
      })
    } else {
      this.setData({
          modalHidden: false
      });
    }
  }
})
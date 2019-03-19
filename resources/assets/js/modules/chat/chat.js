export default {
    state: {
        userList: [],//在线用户
        //当前窗口信息
        currentChat: {
            who: 'all',
            name: '群聊'
        },
        mask: true,//输入名称控制
        inNeedPush: 0,//控制了解界面刷新显示消息
        noRead: [],//未读信息记录，数组简单处理
    },
    mutations: {

    },
    actions: {

    }
}

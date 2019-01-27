import * as types from './mutation-types'
export default {
    state: {
        weekRankId: '',
        monthRankId: '',
        totalRankId: '',
        headTitle: '', // 头部文字
        previousPosition: '书架',
        source: '', // 小说源
        backPath: {},
        bookInfo: {}
    },
    mutations: {
        [types.SET_RANK] (state, rankDetail) {
            state.weekRankId = rankDetail._id
            state.monthRankId = rankDetail.monthRank
            state.totalRankId = rankDetail.totalRank
            state.headTitle = rankDetail.shortTitle
        },
        [types.SET_BACK_POSITION] (state, position) {
            state.previousPosition = position
        },
        [types.SET_CURRENT_SOURCE] (state, source) {
            state.source = source
        },
        [types.SET_SEC_PATH] (state, prePath) {
            state.backPath.secPath = prePath
        },
        [types.SET_THIRD_PATH] (state, prePath) {
            state.backPath.thirdPath = prePath
        },
        [types.SET_HEAD_TITLE] (state, text) {
            state.headTitle = text
        },
        [types.SET_READ_BOOK] (state, book) {
            state.bookInfo = book
        }
    }
}

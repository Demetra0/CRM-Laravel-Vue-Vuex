import axios from "axios";

export default {
    state: () => ({
        oneProfile: {},
    }),
    mutations: {
        setOneProfiler: (state, data) => {
            state.oneProfile = data
        },
        setEditStatusProfile: (state, data) => {
            state.oneProfile.status_profile = data
        },
    },
    actions: {
        // Получение первой анкеты на рассмотрение
        async ajaxOneProfilerFromDB({commit}, id) {
            await axios
                .get('/api/profile/'+id)
                .then(response => {
                    commit('setOneProfiler', response.data)
                })
                .catch(error => {
                    console.log('Error ajax setFirstProfiler From DB', error)
                })
        },
    },
    getters: {
        getOneProfiler(state) {
            return state.oneProfile
        },
    }
}

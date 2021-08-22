import axios from "axios";

export default {
    state: () => ({
        amount: 0,
        firstProfile: []
    }),
    mutations: {
        setFirstProfiler: (state, data) => {
             state.firstProfile = data
        },
        setAmountProfiles: (state, data) => {
             state.amount = data
        },
        setEditStatusProfile: (state, data) => {
             state.firstProfile.status_profile = data
        }
    },
    actions: {
        // Получение первой анкеты на рассмотрение
        async ajaxFirstProfilerFromDB({commit}) {
            await axios
                .get('/api/profile')
                .then(response => {
                    commit('setFirstProfiler', response.data.data)
                    commit('setAmountProfiles', response.data.amount)
                })
                .catch(error => {
                    console.log('Error ajax setFirstProfiler From DB', error)
                })
        },
    },
    getters: {
        getFirstProfiler(state) {
            return state.firstProfile
        },
        getAmountProfiles(state) {
            return state.amount
        },
    }
}

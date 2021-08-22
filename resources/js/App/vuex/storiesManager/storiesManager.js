export default {
    state: () => ({
        storiesManager: []
    }),
    mutations: {
        setStoriesManager: (state, data) => {
            return state.storiesManager = data
        }
    },
    actions: {
        // Показать историю менеджера (id анкет)
        // Controller ManagerStoryController -> show()
        async ajaxStoriesManagerFromDB(context) {
            const id = this.state.currentUser.id
            await axios
                .get('/api/manage-story/' + id)
                .then(response => {
                    context.commit('setStoriesManager', response.data.profiles)
                })
                .catch(error => {
                    console.log('Error ajax StoriesManager From DB', error)
                })
        }
    },
    getters: {
        getStoriesManager(state) {
            return state.storiesManager
        }
    }
}

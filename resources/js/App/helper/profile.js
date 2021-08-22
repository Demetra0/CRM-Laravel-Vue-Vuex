///////////////////////////////////////////////////
//    Working with the ManagerStoryController    //
///////////////////////////////////////////////////

// Добавить анкету в историю менеджера
// Controller ManagerStoryController -> store()
export function addStoriesManager(request) {
    return new Promise((res, rej) => {
        axios.post('/api/manage-story', request)
            .then(response => {
                if (response.status) {
                    res(response.data)
                } else {
                    rej(response.data.message)
                }
            })
            .catch(err => {
                rej('Not found profile')
            })
    })
}

// Обновить статус анкеты на рассмотренную
// Controller ManagerStoryController -> update()
export function updateStatusProfile(request) {
    return new Promise((res, rej) => {
        axios.put('/api/manage-story/' + request.id, request)
            .then(response => {
                res(response.data)
            })
            .catch(err => {
                rej('Not profiles')
            })
    })
}

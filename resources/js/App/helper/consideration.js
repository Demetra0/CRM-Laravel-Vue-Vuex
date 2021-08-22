// Обновить статус в таблице Profile
// Controller ProfileController -> update()
export function updateStatus(request) {
    return new Promise((res, rej) => {
        axios.put('/api/profile/' + request.profile_id, request)
            .then(response => {
                if (response.status) {
                    res(response.data.message)
                } else {
                    res(response.data.message)
                }
            })
            .catch(error => {
                rej(error)
            })
    })
}

export function updateData(time) {
    setInterval(function () {
        this.ajaxFirstProfilerFromDB()
    }.bind(this), 2000);
}

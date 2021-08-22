// Авторизация google 2fa
// Controller Google2FAController -> enable2fa()
export function login2fa(request) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/enable2fa', request)
            .then(response => {
                if (response.data.status) {
                    res(response.data)
                } else {
                    rej(response.data)
                }
            })
            .catch(error => {
                rej(error.data)
            })
    })
}

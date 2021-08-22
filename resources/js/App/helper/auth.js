// Controller AuthController
export function registerUser(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/register', credentials)
            .then(response => {
                res(response.data)
            })
            .catch(error => {
                rej('An error occurred.. try again later')
            })
    })
}

export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
            .then(response => {
                res(response.data)
            })
            .catch(error => {
                rej("Incorrect email or password")
            })
    })
}

// Получить данные менеджера в системе
export function getLoggedinUser() {

    const userStr = localStorage.getItem('user');
    if (!userStr) {   // если пользователь не вошел
        return null
    }

    return JSON.parse(userStr);
}

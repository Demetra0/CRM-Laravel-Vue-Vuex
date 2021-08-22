import {getLoggedinUser} from '../helper/auth'
import storiesManager from './storiesManager/storiesManager'
import firstProfile from './firstProfile/firstProfile'
import oneProfile from "./oneProfile/oneProfile";
const user = getLoggedinUser()

export default {
    state: {
        // JWT
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        reg_error: null,
        google2fa_error: null,
        registeredUser: null,
        token: localStorage.getItem("auth") || '',
        google2fa: sessionStorage.getItem("2fa") || '',
    },
    getters: {
        // JWT
        isLoading(state){
            return state.loading
        },
        isLoggedIn(state){
            return state.isLoggedin
        },
        currentUser(state){
            return state.currentUser
        },
        authError(state){
            return state.auth_error
        },
        regError(state){
            return state.reg_error
        },
        google2faError(state){
            return state.google2fa_error
        },
        registeredUser(state){
            return state.registeredUser
        },
    },
    mutations: {
        // JWT
        login(state){
            state.loading = true
            state.auth_error = null
            state.reg_error = null
        },
        loginSuccess(state, payload){
            state.auth_error = null
            state.isLoggedin = true
            state.loading = false
            state.currentUser = Object.assign({}, payload.user)
            localStorage.setItem("user", JSON.stringify(state.currentUser))
        },
        setToken(state, token){
            localStorage.setItem("auth", token)
            state.token = token
        },
        clearToken(state){
            localStorage.removeItem("auth")
            state.token = ''
        },
        loginFailed(state, payload){
            state.loading = false
            state.auth_error = payload.error
        },
        logout(state){
            localStorage.removeItem("user");
            sessionStorage.removeItem("2fa")
            state.google2fa = ''
            state.isLoggedin = false
            state.currentUser = null
        },
        registerSuccess(state, payload){
            state.reg_error = null
            state.registeredUser = payload.user
        },
        registerFailed(state, payload){
            state.reg_error = payload.error
        },
        // google2fa
        setGoogle2fa(state){
            sessionStorage.setItem("2fa", true)
            state.google2fa = true
            state.reg_error = true
        },
        google2faFailed(state) {
            state.google2fa_error = true
        }

    },
    actions: {
        // JWT
        login(context){
            context.commit("login")
        },
    },
    modules:{
        storiesManager,
        firstProfile,
        oneProfile
    }
};

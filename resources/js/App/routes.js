import Home from "./pages/Home";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Users from "./pages/Users";
import Logs from "./pages/Logs";
import Profile from "./pages/Profile";
import Google2fa from "./pages/Google2fa";

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/users',
        name: 'users',
        component: Users,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/logs',
        name: 'logs',
        component: Logs,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: "/profile/:id",
        name: 'profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/2fa",
        name: 'google2fa',
        component: Google2fa,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: "*",
        redirect: '/'
    }
]
